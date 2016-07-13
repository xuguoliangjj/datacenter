<?php

namespace frontend\modules\slg\models\offline;

use frontend\components\RuntimeActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%pay}}".
 *
 * @property string $id
 * @property string $appId
 * @property string $appVersion
 * @property string $accountId
 * @property string $channelAccid
 * @property string $roleId
 * @property string $roleName
 * @property integer $level
 * @property integer $vipLevel
 * @property string $payMoney
 * @property string $currency
 * @property string $productId
 * @property integer $deviceType
 * @property string $platform
 * @property string $region
 * @property integer $serverId
 * @property string $channel
 * @property string $mac
 * @property string $imei
 * @property integer $sex
 * @property string $resolution
 * @property string $deviceName
 * @property string $systemName
 * @property integer $network
 * @property string $ip
 * @property string $country
 * @property string $operators
 * @property integer $logTime
 */
class Pay extends RuntimeActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pay}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'level', 'vipLevel', 'deviceType', 'serverId', 'sex', 'network', 'logTime'], 'integer'],
            [['appId'], 'string', 'max' => 16],
            [['appVersion', 'platform', 'region', 'channel', 'resolution'], 'string', 'max' => 20],
            [['accountId', 'channelAccid', 'roleId', 'payMoney', 'productId', 'mac', 'imei', 'operators'], 'string', 'max' => 30],
            [['roleName', 'deviceName', 'systemName'], 'string', 'max' => 125],
            [['currency'], 'string', 'max' => 10],
            [['ip', 'country'], 'string', 'max' => 64],
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
            'accountId' => Yii::t('app', '游戏账号ID'),
            'channelAccid' => Yii::t('app', '渠道账号ID'),
            'roleId' => Yii::t('app', '角色ID'),
            'roleName' => Yii::t('app', '角色名'),
            'level' => Yii::t('app', '等级'),
            'vipLevel' => Yii::t('app', 'vip等级'),
            'payMoney' => Yii::t('app', '充值金额'),
            'currency' => Yii::t('app', '货币类型 CNY,TWD,USD'),
            'productId' => Yii::t('app', '商品id'),
            'deviceType' => Yii::t('app', '设备类型 1:ios 2:android 3:ios越狱 4:window phone'),
            'platform' => Yii::t('app', '平台标示'),
            'region' => Yii::t('app', '专区标示'),
            'serverId' => Yii::t('app', '服务器id'),
            'channel' => Yii::t('app', '渠道唯一标示'),
            'mac' => Yii::t('app', 'mac地址'),
            'imei' => Yii::t('app', '设备唯一标示'),
            'sex' => Yii::t('app', '玩家角色性别'),
            'resolution' => Yii::t('app', '客户端分辨率'),
            'deviceName' => Yii::t('app', '设备名'),
            'systemName' => Yii::t('app', '系统名'),
            'network' => Yii::t('app', '网络类型 1:2G 2:3G 3:4G 4:wifi 5:其他网络'),
            'ip' => Yii::t('app', 'IP地址'),
            'country' => Yii::t('app', '国家'),
            'operators' => Yii::t('app', '网络运营商'),
            'logTime' => Yii::t('app', '日志时间'),
        ];
    }

    /**
     * @inheritdoc
     * @return PayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PayQuery(get_called_class());
    }
}
