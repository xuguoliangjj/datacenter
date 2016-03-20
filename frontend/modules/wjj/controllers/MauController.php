<?php

namespace frontend\modules\wjj\controllers;

class MauController extends \yii\rest\ActiveController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
