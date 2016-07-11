<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Login form
 */
class AuthPlatformForm extends Model
{
    public $platform;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['platform', 'in', 'range'=>ArrayHelper::getColumn(Platform::find()->asArray()->all(),'id')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'platform'=>'平台'
        ];
    }

}
