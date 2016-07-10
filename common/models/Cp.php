<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cp}}".
 *
 * @property integer $id
 * @property string $cp_name
 *
 * @property App[] $apps
 */
class Cp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cp_name'],'required'],
            [['cp_name'], 'string', 'max' => 125]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cp_name' => Yii::t('app', '开发商名'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApps()
    {
        return $this->hasMany(App::className(), ['cp_id' => 'id']);
    }
}
