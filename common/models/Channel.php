<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%channel}}".
 *
 * @property integer $id
 * @property string $channel
 * @property integer $app_id
 *
 * @property App $app
 */
class Channel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%channel}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id'], 'integer'],
            [['channel'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'channel' => Yii::t('app', '渠道唯一标示'),
            'app_id' => Yii::t('app', 'App id'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApp()
    {
        return $this->hasOne(App::className(), ['id' => 'app_id']);
    }
}
