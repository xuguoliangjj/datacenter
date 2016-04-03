<?php
namespace backend\controllers;

use backend\components\Tools;
use common\models\App;
use common\models\searchs\AppSearch;
use Yii;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\components\BaseController;
use yii\web\ForbiddenHttpException;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    public $layout='full';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel  = new AppSearch();
        $dataProvider = $searchModel -> search(Yii::$app->request->post());
        return $this->render('index',[
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSelect($app_id,$app_secret)
    {
        $session = Yii::$app->session;
        $model   = App::findOne(['app_id'=>$app_id,'app_secret'=>$app_secret]);
        if(!Yii::$app->user->can('app_'.$model->app_code))
        {
            throw new ForbiddenHttpException('没有该项目权限');
        }
        $session['api_url'] = $model->api_url;
        $session['app_code']= $model->app_code;
        $session['app_name']= $model->app_name;
        $this -> redirect(['main/add']);
    }


    public function actionAbout()
    {
        return $this -> render('about');
    }


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
