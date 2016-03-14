<?php

namespace backend\modules\main\controllers;

use backend\components\BaseController;
use yii\helpers\Json;
use yii\web\Response;
use backend\components\Curl;
class DefaultController extends BaseController
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
        $params_str = http_build_query([
            'start'    => date('Ymd',strtotime($_POST['starttime'])),
            'end'      => date('Ymd',strtotime($_POST['endtime'])),
            'platform' => $_POST['platform'],
            'channel'  => $_POST['channel'],
            'server'   => $_POST['server'],
        ]);
        $curl = new Curl();
        $response = $curl -> setOption(CURLOPT_HTTPHEADER , ['Accept:application/json'])
                          -> get('http://api.loadata.com/wjj/adps?' . $params_str);
        $data     = Json::decode($response);
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $series     = array_column($data,'player_num');
        $categories = array_column($data,'ymd');
        $max  = max($series);
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
        $params_str = http_build_query([
            'start'    => date('Ymd',strtotime($_POST['starttime'])),
            'end'      => date('Ymd',strtotime($_POST['endtime'])),
            'platform' => $_POST['platform'],
            'channel'  => $_POST['channel'],
            'server'   => $_POST['server'],
        ]);
        $curl = new Curl();
        $response = $curl -> setOption(CURLOPT_HTTPHEADER , ['Accept:application/json'])
                          -> get('http://api.loadata.com/wjj/avps?' . $params_str);
        $data     = Json::decode($response);
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $series     = array_column($data,'player_num');
        $categories = array_column($data,'ymd');
        $max  = max($series);
        return [
            'max'        => $max,
            'categories' => $categories,
            'series'     => $series
        ];
    }
}
