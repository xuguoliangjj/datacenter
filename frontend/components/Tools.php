<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2016/3/27
 * Time: 0:01
 */
namespace frontend\components;
use \yii\base\Object;
use Yii;
class Tools extends Object
{
    public static function fixedArrayToInterger($array)
    {
        $result = [];
        foreach($array as $key => $item){
            $result[$key] = intval($item);
        }
        return $result;
    }
}