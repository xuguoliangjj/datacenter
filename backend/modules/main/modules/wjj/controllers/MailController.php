<?php

namespace backend\modules\main\modules\wjj\controllers;

use backend\components\BaseController;

class MailController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
