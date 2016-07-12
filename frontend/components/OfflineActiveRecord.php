<?php
namespace frontend\components;
use Yii;
/**
 * Created by PhpStorm.
 * Date: 2016/7/12
 * Time: 17:26
 * @author: xuguoliang <1044748759@qq.com>
 */
class OfflineActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        return Yii::$app->offlineDb;
    }
}