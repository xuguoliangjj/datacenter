<?php

namespace frontend\modules\slg\controllers;

class MauController extends \yii\rest\ActiveController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
