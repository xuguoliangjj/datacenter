<?php

namespace backend\modules\main\controllers;

use backend\assets\AppAsset;
use backend\components\BaseController;
use backend\components\Curl;
use Yii;
use yii\helpers\Json;
use yii\web\Response;


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

    public function actionLoginmin()
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
            -> get(Yii::$app->session['api_url'] . '/login/minute?' . $params_str);
        $data = Json::decode($response);
        $max  = max($data);
        $now  = $data[count($data) - 1];
        $result = [
            'data'      => $data,
            'year'      => date('Y',strtotime($_POST['endtime'])),
            'month'     => date('m',strtotime($_POST['endtime'])),
            'day'       => date('d',strtotime($_POST['endtime'])),
            'subtitle'  => $_POST['endtime'] . ' - 最高在线：' . $max . ' 当前在线：' . $now
        ];
        return $result;
    }
}
