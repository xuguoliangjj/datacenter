<?php

namespace frontend\modules\slg\models\runtime;

use frontend\components\RuntimeActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%online}}".
 *
 * @property string $id
 * @property string $appId
 * @property string $appVersion
 * @property integer $deviceType
 * @property string $platform
 * @property string $region
 * @property integer $serverId
 * @property string $channel
 * @property integer $onlineNum
 * @property integer $ipOnlineNum
 * @property integer $logTime
 */
class Online extends RuntimeActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%online}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'deviceType', 'serverId', 'onlineNum', 'ipOnlineNum', 'logTime'], 'integer'],
            [['appId'], 'string', 'max' => 16],
            [['appVersion', 'platform', 'region', 'channel'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'appId' => Yii::t('app', '应用ID'),
            'appVersion' => Yii::t('app', '应用版本号'),
            'deviceType' => Yii::t('app', '设备类型 1:ios 2:android 3:ios越狱 4:window phone'),
            'platform' => Yii::t('app', '平台标示'),
            'region' => Yii::t('app', '专区标示'),
            'serverId' => Yii::t('app', '服务器id'),
            'channel' => Yii::t('app', '渠道唯一标示'),
            'onlineNum' => Yii::t('app', '在线人数'),
            'ipOnlineNum' => Yii::t('app', 'IP在线人数'),
            'logTime' => Yii::t('app', '日志时间'),
        ];
    }

    /**
     * @inheritdoc
     * @return OnlineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OnlineQuery(get_called_class());
    }
}
