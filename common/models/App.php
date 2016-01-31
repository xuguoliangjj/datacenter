<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%app}}".
 *
 * @property integer $id
 * @property string $app_name
 * @property string $app_id
 * @property string $app_secret
 * @property string $app_code
 * @property string $tbl_prefix
 * @property string $version
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $cp_id
 * @property integer $active
 *
 * @property Cp $cp
 * @property Channel[] $channels
 */
class App extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'cp_id', 'active'], 'integer'],
            [['app_name'], 'string', 'max' => 64],
            [['app_id', 'app_code'], 'string', 'max' => 16],
            [['app_secret', 'tbl_prefix', 'version'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'app_name' => Yii::t('app', '应用名称'),
            'app_id' => Yii::t('app', 'App id'),
            'app_secret' => Yii::t('app', 'App secret'),
            'app_code' => Yii::t('app', '应用简称'),
            'tbl_prefix' => Yii::t('app', '数据库表前缀'),
            'version' => Yii::t('app', '应用版本号'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '修改时间'),
            'cp_id' => Yii::t('app', 'CP'),
            'active' => Yii::t('app', '是否激活'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCp()
    {
        return $this->hasOne(Cp::className(), ['id' => 'cp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChannels()
    {
        return $this->hasMany(Channel::className(), ['app_id' => 'id']);
    }
}
