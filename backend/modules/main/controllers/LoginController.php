<?php

namespace backend\modules\main\controllers;

use backend\assets\AppAsset;
use backend\components\BaseController;

class LoginController extends BaseController
{
    public function init()
    {
        parent::init();
        \Yii::$app->view->registerJsFile('/js/app/login.js',['depends'=>[AppAsset::className()]]);
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}
