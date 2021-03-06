<?php

namespace frontend\modules\slg\models\offline;

use frontend\components\OfflineActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%avp}}".
 *
 * @property integer $id
 * @property string $platform
 * @property string $channel
 * @property string $server
 * @property integer $player_num
 * @property string $ymd
 */
class Avp extends OfflineActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%avp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform', 'channel', 'server', 'player_num', 'ymd'], 'required'],
            [['player_num'], 'integer'],
            [['platform', 'channel', 'server'], 'string', 'max' => 64],
            [['ymd'], 'string', 'max' => 10],
            [['platform', 'channel', 'server', 'player_num', 'ymd'], 'unique', 'targetAttribute' => ['platform', 'channel', 'server', 'player_num', 'ymd'], 'message' => 'The combination of 平台标示, 渠道标示, 服务器标示, 新增玩家数 and 激活日期 has already been taken.']
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
            'player_num' => Yii::t('app', '新增玩家数'),
            'ymd' => Yii::t('app', '激活日期'),
        ];
    }
}
