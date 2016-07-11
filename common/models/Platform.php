<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%platform}}".
 *
 * @property integer $id
 * @property string $platform
 * @property string $remark
 *
 * @property AuthPlatform[] $authPlatforms
 */
class Platform extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%platform}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform', 'remark'], 'required'],
            [['platform'], 'string', 'max' => 30],
            [['remark'], 'string', 'max' => 125]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'platform' => Yii::t('app', '平台唯一标示'),
            'remark' => Yii::t('app', '备注'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthPlatforms()
    {
        return $this->hasMany(AuthPlatform::className(), ['platform_id' => 'id']);
    }
}
