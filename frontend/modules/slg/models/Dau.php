<?php

namespace frontend\modules\slg\models;

use frontend\components\OfflineActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%dau}}".
 *
 * @property integer $id
 * @property string $platform
 * @property string $channel
 * @property string $server
 * @property integer $dau
 * @property integer $dau_adp
 * @property integer $dau_payp
 * @property integer $dau_npayp
 * @property string $ymd
 */
class Dau extends OfflineActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dau}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform', 'channel', 'server', 'dau', 'dau_adp', 'dau_payp', 'dau_npayp', 'ymd'], 'required'],
            [['dau', 'dau_adp', 'dau_payp', 'dau_npayp'], 'integer'],
            [['platform', 'channel', 'server'], 'string', 'max' => 64],
            [['ymd'], 'string', 'max' => 10],
            [['platform', 'channel', 'server', 'ymd'], 'unique', 'targetAttribute' => ['platform', 'channel', 'server', 'ymd'], 'message' => 'The combination of 平台标示, 渠道标示, 服务器标示 and 激活日期 has already been taken.']
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
            'dau' => Yii::t('app', '日活跃玩家数量'),
            'dau_adp' => Yii::t('app', '日活跃玩家中的新增玩家数量'),
            'dau_payp' => Yii::t('app', '日活跃玩家中的付费玩家数量'),
            'dau_npayp' => Yii::t('app', '日活跃玩家中的非付费玩家数量'),
            'ymd' => Yii::t('app', '激活日期'),
        ];
    }
}
