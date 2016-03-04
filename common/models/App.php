<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%app}}".
 *
 * @property integer $id
 * @property string $app_name
 * @property string $app_id
 * @property string $app_secret
 * @property string $app_code
 * @property string $version
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $cp_id
 * @property integer $active
 * @property integer $api_url
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
            [['app_name','app_id','app_secret','app_code','version','cp_id','active','api_url'],'required'],
            [['created_at', 'updated_at', 'cp_id', 'active'], 'integer'],
            [['app_name'], 'string', 'max' => 64],
            [['app_id', 'app_code'], 'string', 'max' => 16],
            [['app_secret', 'version'], 'string', 'max' => 32]
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
            'version' => Yii::t('app', '应用版本号'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '修改时间'),
            'cp_id' => Yii::t('app', 'CP'),
            'active' => Yii::t('app', '是否激活'),
            'api_url' => Yii::t('app', '数据接口地址'),
        ];
    }

    /*
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'=>function(){
                    return time();
                },
            ],
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
