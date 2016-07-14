<?php

namespace backend\modules\main\controllers;

use backend\assets\AppAsset;
use backend\components\BaseController;
use backend\components\Curl;
use yii\helpers\Json;
use yii\web\Response;
use Yii;

class OnlineController extends BaseController
{
    public function init()
    {
        parent::init();
        \Yii::$app->view->registerJsFile('/js/app/online.js',['depends'=>[AppAsset::className()]]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return array
     * 在线数据
     */
    public function actionOnlmin()
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
            -> get(Yii::$app->session['api_url'] . '/onl/minute?' . $params_str);
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

    /**
     * @return array
     * 在线按时数据
     */
    public function actionOnlhou()
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
            -> get(Yii::$app->session['api_url'] . '/onl/hour?' . $params_str);
        $data = Json::decode($response);
        $max  = max($data);
        $result = [
            'data'      => $data,
            'year'      => date('Y',strtotime($_POST['endtime'])),
            'month'     => date('m',strtotime($_POST['endtime'])),
            'day'       => date('d',strtotime($_POST['endtime'])),
            'subtitle'  => $_POST['endtime'] . ' - 最高在线：' . $max
        ];
        return $result;
    }

    /**
     * ACU PCU
     * @return array
     */
    public function actionOnlday()
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
            -> get(Yii::$app->session['api_url'] . '/onl/day?' . $params_str);
        $data = Json::decode($response);
        $result = [
            'acu'      => $data['acu'],
            'pcu'      => $data['pcu'],
            'year'      => date('Y',strtotime($_POST['starttime'])),
            'month'     => date('m',strtotime($_POST['starttime'])),
            'day'       => date('d',strtotime($_POST['starttime'])),
            'subtitle'  => $_POST['starttime'] . ' -- ' . $_POST['endtime']
        ];
        return $result;
    }
}
