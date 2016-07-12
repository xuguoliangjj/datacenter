<?php

namespace backend\modules\main\controllers;

use backend\components\BaseController;
use backend\components\Curl;
use yii\web\Response;

class OnlineController extends BaseController
{
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
            -> get(Yii::$app->session['api_url'] . '/onlmins?' . $params_str);
        $data = [];
       return $data;
    }

    /**
     * @return array
     * 在线按时数据
     */
    public function actionOnlhou()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            20166,
            9115,
            19208,
            19277,
            9466,
            19890,
            20128,
            20216,
            10210,
            20230,
            20285,
            20286,
            20285,
            20270,
            20250,
            20189,
            20134,
            20011,
            19970,
            19947,
            19885,
            19838,
            19791,
            19709,
            10614,
        ];
    }

    public function actionDays()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            20166,
            9115,
            19208,
            19277,
            9466,
            19890,
            20128,
            20216,
            10210,
            20230,
            20285,
            20286,
            20285,
            20270,
            20250,
            20189,
            20134,
            20011,
            19970,
            19947,
            19885,
            19838,
            19791,
            19709,
            10614,
        ];
    }
}
