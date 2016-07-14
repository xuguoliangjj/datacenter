<?php

namespace backend\modules\main\controllers;

use backend\assets\AppAsset;
use backend\components\BaseController;
use backend\components\Curl;
use yii\helpers\Json;
use yii\web\Response;

class ActiveController extends BaseController
{
    public function init()
    {
        parent::init();
        \Yii::$app->view->registerJsFile('/js/app/active.js',['depends'=>[AppAsset::className()]]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDau()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $params_str = http_build_query([
            'starttime'    => date('Ymd',strtotime($_POST['starttime'])),
            'endtime'      => date('Ymd',strtotime($_POST['endtime'])),
            'platform' => $_POST['platform'],
            'channel'  => $_POST['channel'],
            'server'   => $_POST['server'],
        ]);
        $curl = new Curl();
        $response = $curl -> setOption(CURLOPT_HTTPHEADER , ['Accept:application/json'])
            -> get(\Yii::$app->session['api_url'] . '/daus?' . $params_str);
        $data = Json::decode($response);
        return $data;
    }

}
