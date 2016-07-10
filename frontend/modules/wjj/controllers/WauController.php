<?php

namespace frontend\modules\wjj\controllers;

class WauController extends \yii\rest\ActiveController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
