<?php

namespace backend\modules\join\controllers;

use common\models\AuthPlatform;
use common\models\AuthPlatformForm;
use common\models\Platform;
use Yii;
use common\models\App;
use common\models\searchs\AppSearch;
use backend\components\BaseController;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppController implements the CRUD actions for App model.
 */
class AppController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all App models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single App model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new App model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new App();

        if ($model->load(Yii::$app->request->post())) {
            $model->app_id     = strtolower(substr(md5(Yii::$app->security->generateRandomString()),0,15));
            $model->app_secret = strtolower(md5(Yii::$app->security->generateRandomString()));
            if ($model->save()) {
                $auth = Yii::$app->authManager;
                $item = $auth->createPermission('app_' . $model->app_code);
                $item->description = $model->app_name;
                $auth->add($item);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing App model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing App model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete()) {
            $auth = Yii::$app->getAuthManager();
            $item = $auth->getPermission('app_' . $model->app_code);
            $auth->remove($item);
        }
        return $this->redirect(['index']);
    }

    /**
     * @return string
     */
    public function actionAuth($id)
    {
        $app          = $this->findModel($id);
        $model        = new AuthPlatformForm();
        $data         = Platform::find()->asArray()->all();
        $platforms    = ArrayHelper::map($data,'id','remark');
        $authPlatform = AuthPlatform::findAll(['app_id' => $id]);
        foreach ($authPlatform as $item){
            $model->platform[$item->platform->id] = $item->platform->id;
        }
        if($model->load(Yii::$app->request->post())){
            $auth = Yii::$app->getAuthManager();
            foreach($auth->getPermissions() as $item)
            {
                $arr = explode('_',$item->name);
                if(count($arr) == 3 && $arr[0] == 'platform' && $arr[1] == $app->app_code)
                {
                    $auth->remove($item);
                }
            }
            AuthPlatform::deleteAll(['app_id' => $id]);
            $model->platform = $model->platform == "" ? [] : $model->platform;
            foreach ($model->platform as $platform_id){
                $authModel = new AuthPlatform();
                $authModel->app_id = $id;
                $authModel->platform_id = $platform_id;
                if($authModel->save()){
                    $platModel = Platform::findOne(['id'=>$platform_id]);
                    $item = $auth->createPermission('platform_'.$app->app_code.'_'.$platModel->platform);
                    $item->description = $app->app_name . '-' . $platModel->remark;
                    $auth->add($item);
                }
            }
            Yii::$app->session->setFlash('success','修改成功');
            $this->redirect(['index']);
        }
        return $this->render('auth',[
            'model'     => $model,
            'app'       => $app,
            'platforms' => $platforms
        ]);
    }
    /**
     * Finds the App model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return App the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = App::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
