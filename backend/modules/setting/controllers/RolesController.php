<?php

namespace backend\modules\setting\controllers;
use backend\components\BaseController;
use backend\components\Tools;
use backend\modules\setting\models\RoleAuthForm;
use backend\modules\setting\models\searchs\AuthItemSearch;
use backend\modules\setting\models\AuthItem;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\web\NotFoundHttpException;

class RolesController extends BaseController
{
    public function actionIndex()
    {
        $model = new AuthItemSearch(['type'=>Item::TYPE_ROLE]);
        $dataProvider = $model->search(Yii::$app->request->get());
        return $this->render('index',[
            'dataProvider'=>$dataProvider,
            'model'=>$model
        ]);
    }

    public function actionCreate()
    {
        $rules = ArrayHelper::merge([''=>'NONE'],ArrayHelper::map(Yii::$app->getAuthManager()->getRules(),'name','name'));
        $model = new AuthItem();
        $model->type=Item::TYPE_ROLE;             //角色
        if($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $this->redirect(['view','id'=>$model->name]);
        }else{
            return $this->render('create',[
                'model'=>$model,
                'rules'=>$rules
            ]);
        }
    }

    //删除角色，id是角色名
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Yii::$app->authManager->remove($model->item);         //删除角色
        $this->redirect(['index']);
    }

    //修改角色名、简述。。
    public function actionUpdate($id)
    {
        $rules = ArrayHelper::merge([''=>'NONE'],ArrayHelper::map(Yii::$app->getAuthManager()->getRules(),'name','name'));
        $model =  $this->findModel($id);
        if($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',"修改 $id 成功");
            $this->redirect(['index']);
        }
        return $this->render('update',[
            'model'=>$model,
            'rules'=>$rules
        ]);
    }

    public function actionView($id,  $term = '')
    {
        $model = new RoleAuthForm();
        $model->roles = [$id=>$id];
        $model->setScenario('auth');
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            foreach($model->getAttributes() as $key => $value){
                if(empty($value)){
                    $model->$key=[];
                }
            }
            $roles = ArrayHelper::merge($model->roles,$model->routes,$model->permissions,$model->app);
            $manager = Yii::$app->getAuthManager();
            $parent = $manager->getRole($id);
            $manager->removeChildren($parent);
            foreach ($roles as $role) {
                if($role == $id){
                    continue;
                }
                $child = $manager->getRole($role);
                $child = $child ? : $manager->getPermission($role);
                $manager->addChild($parent, $child);
            }
            Yii::$app->session->setFlash('success',"修改 $id 权限成功");
            $this->redirect(['index']);
        }
        $result = [
            'Roles'       => [],
            'Permissions' => [],
            'Routes'      => [],
            'App'         => []
        ];
        $authManager = Yii::$app->authManager;
        $children = array_keys($authManager->getChildren($id));
        $children[] = $id;
        foreach ($authManager->getRoles() as $name => $role) {
            if (empty($term) or strpos($name, $term) !== false) {
                $result['Roles'][$name] = $name;
            }
        }
        foreach ($authManager->getPermissions() as $name => $role) {
            if (empty($term) or strpos($name, $term) !== false) {
                if(substr($name,0,3) === 'app'){
                    $result['App'][$name] = $role->description;
                }elseif($name[0] === '/'){
                    $result['Routes'][$name] = $role->description;
                }else{
                    $result['Permissions'][$name] = $role->description;
                }
            }
        }
        foreach ($authManager->getChildren($id) as $name => $child) {
            if (empty($term) or strpos($name, $term) !== false) {
                if ($child->type == Item::TYPE_ROLE) {
                    $model->roles[$name]      = $name;
                } else {
                    if(substr($name,0,3) === 'app'){
                        $model->app[$name]    = $name;
                    }elseif($name[0] === '/'){
                        $model->routes[$name] = $name;
                    }else{
                        $model->permissions   = $name;
                    }
                }
            }
        }
        $routes = Tools::serializeRoutes($result['Routes']);
        return $this->render('view',[
            'result'=>$result,
            'model' =>$model,
            'routes'=>$routes
        ]);
    }

    protected function findModel($id)
    {
        $item = Yii::$app->getAuthManager()->getRole($id);
        if ($item) {
            return new AuthItem($item);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
