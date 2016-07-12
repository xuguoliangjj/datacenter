<?php

namespace frontend\modules\slg\controllers;

class WauController extends \yii\rest\ActiveController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
