<?php

namespace backend\modules\main\controllers;

use backend\components\BaseController;
use yii\web\Response;

class RemainController extends BaseController
{
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
