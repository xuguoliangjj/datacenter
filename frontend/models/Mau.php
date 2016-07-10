<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%mau}}".
 *
 * @property integer $id
 * @property string $platform
 * @property string $channel
 * @property string $server
 * @property integer $mau
 * @property string $ymd
 */
class Mau extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mau}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform', 'channel', 'server', 'mau', 'ymd'], 'required'],
            [['mau'], 'integer'],
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
            'mau' => Yii::t('app', '周活跃玩家数量'),
            'ymd' => Yii::t('app', '激活日期'),
        ];
    }
}
