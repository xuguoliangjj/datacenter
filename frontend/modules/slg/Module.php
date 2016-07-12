<?php

namespace frontend\modules\slg;

use Yii;
/**
 * slg module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\slg\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::setAlias('@restAction', "@frontend/modules/slg/actions");
        $config =  require(__DIR__ . '/config/config.php');
        Yii::$app->setComponents($config);
        // custom initialization code goes here
    }
}
