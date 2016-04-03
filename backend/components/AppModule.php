<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2016/4/4
 * Time: 1:04
 */
namespace backend\components;

use Yii;
use yii\web\ForbiddenHttpException;

class AppModule extends \yii\base\Module
{

    public function init()
    {
        parent::init();
        if(Yii::$app->session['app_code'] != $this->id){
            throw new ForbiddenHttpException("错误请求，请从项目入口进入");
        }
        // custom initialization code goes here
    }
}
