<?php

namespace frontend\modules\slg\models\offline;

use Yii;

/**
 * This is the model class for table "remain".
 *
 * @property integer $id
 * @property string $platform
 * @property string $channel
 * @property string $server
 * @property string $ymd
 * @property integer $d
 * @property integer $d1
 * @property integer $d2
 * @property integer $d3
 * @property integer $d4
 * @property integer $d5
 * @property integer $d6
 * @property integer $d7
 * @property integer $d8
 * @property integer $d9
 * @property integer $d10
 * @property integer $d11
 * @property integer $d12
 * @property integer $d13
 * @property integer $d14
 * @property integer $d15
 * @property integer $d16
 * @property integer $d17
 * @property integer $d18
 * @property integer $d19
 * @property integer $d20
 * @property integer $d21
 * @property integer $d22
 * @property integer $d23
 * @property integer $d24
 * @property integer $d25
 * @property integer $d26
 * @property integer $d27
 * @property integer $d28
 * @property integer $d29
 * @property integer $d30
 */
class Remain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'remain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform', 'channel', 'server', 'ymd', 'd', 'd1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7', 'd8', 'd9', 'd10', 'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20', 'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30'], 'required'],
            [['d', 'd1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7', 'd8', 'd9', 'd10', 'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20', 'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30'], 'integer'],
            [['platform', 'channel', 'server'], 'string', 'max' => 64],
            [['ymd'], 'string', 'max' => 10],
            [['platform', 'channel', 'server', 'ymd'], 'unique', 'targetAttribute' => ['platform', 'channel', 'server', 'ymd'], 'message' => 'The combination of 平台标示, 渠道标示, 服务器标示 and 新增日期 has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'platform' => Yii::t('app', '平台标示'),
            'channel' => Yii::t('app', '渠道标示'),
            'server' => Yii::t('app', '服务器标示'),
            'ymd' => Yii::t('app', '新增日期'),
            'd' => Yii::t('app', '新增日期下注册用户数'),
            'd1' => Yii::t('app', '1天前注册玩家留存数'),
            'd2' => Yii::t('app', '2天前注册玩家留存数'),
            'd3' => Yii::t('app', '3天前注册玩家留存数'),
            'd4' => Yii::t('app', '4天前注册玩家留存数'),
            'd5' => Yii::t('app', '5天前注册玩家留存数'),
            'd6' => Yii::t('app', '6天前注册玩家留存数'),
            'd7' => Yii::t('app', '7天前注册玩家留存数'),
            'd8' => Yii::t('app', '8天前注册玩家留存数'),
            'd9' => Yii::t('app', '9天前注册玩家留存数'),
            'd10' => Yii::t('app', '10天前注册玩家留存数'),
            'd11' => Yii::t('app', '11天前注册玩家留存数'),
            'd12' => Yii::t('app', '12天前注册玩家留存数'),
            'd13' => Yii::t('app', '13天前注册玩家留存数'),
            'd14' => Yii::t('app', '14天前注册玩家留存数'),
            'd15' => Yii::t('app', '15天前注册玩家留存数'),
            'd16' => Yii::t('app', '16天前注册玩家留存数'),
            'd17' => Yii::t('app', '17天前注册玩家留存数'),
            'd18' => Yii::t('app', '18天前注册玩家留存数'),
            'd19' => Yii::t('app', '19天前注册玩家留存数'),
            'd20' => Yii::t('app', '20天前注册玩家留存数'),
            'd21' => Yii::t('app', '21天前注册玩家留存数'),
            'd22' => Yii::t('app', '22天前注册玩家留存数'),
            'd23' => Yii::t('app', '23天前注册玩家留存数'),
            'd24' => Yii::t('app', '24天前注册玩家留存数'),
            'd25' => Yii::t('app', '25天前注册玩家留存数'),
            'd26' => Yii::t('app', '26天前注册玩家留存数'),
            'd27' => Yii::t('app', '27天前注册玩家留存数'),
            'd28' => Yii::t('app', '28天前注册玩家留存数'),
            'd29' => Yii::t('app', '29天前注册玩家留存数'),
            'd30' => Yii::t('app', '30天前注册玩家留存数'),
        ];
    }
}
