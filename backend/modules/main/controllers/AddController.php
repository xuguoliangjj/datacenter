<?php

namespace backend\modules\main\controllers;

use backend\components\BaseController;
use yii\helpers\Json;
use yii\web\Response;
use backend\components\Curl;
use Yii;
class AddController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return array
     * 新增玩家数据
     */
    public function actionAdp()
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
                          -> get(Yii::$app->session['api_url'] . '/adps?' . $params_str);
        $data       = Json::decode($response);
        $series     = array_column($data,'player_num');
        $categories = array_column($data,'ymd');
        $max  = !empty($series) ? max($series) : 0;
        return [
            'max'        => $max,
            'categories' => $categories,
            'series'     => $series
        ];
    }

    /**
     * @return array
     * 激活玩家数据
     */
    public function actionAvp()
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
                          -> get(Yii::$app->session['api_url'] . '/avps?' . $params_str);
        $data     = Json::decode($response);
        $series     = array_column($data,'player_num');
        $categories = array_column($data,'ymd');
        $max        = !empty($series) ? max($series) : 0;
        return [
            'max'        => $max,
            'categories' => $categories,
            'series'     => $series
        ];
    }
}
