<?php

namespace backend\modules\join\controllers;

use backend\components\BaseController;

class DefaultController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
