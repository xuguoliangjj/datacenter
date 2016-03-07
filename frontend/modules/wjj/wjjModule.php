<?php

namespace frontend\modules\wjj;

class wjjModule extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\wjj\controllers';

    public function init()
    {
        parent::init();
        \Yii::setAlias('@restAction', "@frontend/modules/wjj/actions");
        // custom initialization code goes here
    }
}
