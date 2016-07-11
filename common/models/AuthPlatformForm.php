<?php
namespace common\models;

use Yii;
use yii\base\Model;

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
            [['platform'], 'required']
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
