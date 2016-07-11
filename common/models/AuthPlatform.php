<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%auth_platform}}".
 *
 * @property integer $id
 * @property integer $app_id
 * @property integer $platform_id
 *
 * @property App $app
 * @property Platform $platform
 */
class AuthPlatform extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_platform}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'platform_id'], 'required'],
            [['app_id', 'platform_id'], 'integer'],
            [['app_id'], 'exist', 'skipOnError' => true, 'targetClass' => App::className(), 'targetAttribute' => ['app_id' => 'id']],
            [['platform_id'], 'exist', 'skipOnError' => true, 'targetClass' => Platform::className(), 'targetAttribute' => ['platform_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'app_id' => Yii::t('app', '用户id'),
            'platform_id' => Yii::t('app', '平台唯一标示'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApp()
    {
        return $this->hasOne(App::className(), ['id' => 'app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlatform()
    {
        return $this->hasOne(Platform::className(), ['id' => 'platform_id']);
    }

    /**
     * @inheritdoc
     * @return AuthPlatformQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthPlatformQuery(get_called_class());
    }
}
