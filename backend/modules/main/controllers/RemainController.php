<?php

namespace backend\modules\main\controllers;

use backend\assets\AppAsset;
use backend\components\BaseController;
use yii\web\Response;

class RemainController extends BaseController
{
    public function init()
    {
        parent::init();
        \Yii::$app->view->registerJsFile('/js/app/remain.js',['depends'=>[AppAsset::className()]]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 留存统计
     * @return array
     */
    public function actionRem()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return [];
    }
}
