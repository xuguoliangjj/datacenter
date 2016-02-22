<?php

namespace backend\modules\main\controllers;

use backend\components\BaseController;
use yii\helpers\Json;
use yii\web\Response;

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
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = [123, 11, 122, 21, 124, 172, 182, 192, 121, 211, 232, 82];
        $max  = max($data);
        return [
            'max'        =>$max,
            'categories' => [
                20160201,20160202,20160203,20160204,20160205,20160206,20160207,20160208,20160209,20160210,
                20160211,20160212
            ],
            'series'     =>$data
        ];
    }

    /**
     * @return array
     * 激活玩家数据
     */
    public function actionAvp()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = [111, 11, 112, 23, 23, 44, 66, 192, 12, 22, 222, 122];
        $max  = max($data);
        return [
            'max'        =>$max,
            'categories' => [
                20160201,20160202,20160203,20160204,20160205,20160206,20160207,20160208,20160209,20160210,
                20160211,20160212
            ],
            'series'     =>$data
        ];
    }
}
