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
    /**
     * 将数据的所有值转换成int类型
     * @param $array
     * @return array
     */
    public static function fixedArrayToInterger($array)
    {
        $result = [];
        foreach($array as $key => $item){
            $result[$key] = intval($item);
        }
        return $result;
    }

    /**
     * 将一个数组按照每分钟补充缺省值为0
     * @param $array
     * @return mixed
     */
    public static function fixStepMinute($array)
    {
        foreach($array as $key => $num){
            $minute = explode(':',$key);
            if($minute[1] < 10){
                unset($array[$key]);
                $array[$minute[0].":0".intval($minute[1])] = $num;
            }
        }

        foreach($array as $key => $num){
            $minute = explode(':',$key);
            if($minute[0] < 10){
                unset($array[$key]);
                $array["0".intval($minute[0]).':'.$minute[1]] = $num;
            }
        }

        for ($i = 0; $i< 1440; $i++) {
            $h = (int)($i / 60);
            $m = $i - $h * 60;//
            $h = str_pad($h, 2, "0", STR_PAD_LEFT);
            $m = str_pad($m, 2, "0", STR_PAD_LEFT);
            $fulltime = $h . ":" . $m;
            if(!isset($array[$fulltime]))
            {
                $array[$fulltime]=0;
            }
        }

        ksort($array);
        return $array;
    }

    /**
     * 填充小时不连续
     * @param $array
     * @return mixed
     */
    public static function fixStepHour($array)
    {
        foreach($array as $key => $row){
            if($key < 10){
                unset($array[$key]);
                $array[trim($key)] = $row;
            }
        }
        for($i=0;$i<24;$i++){
            if(!isset($array[$i])){
                $array[$i]=0;
            }
        }
        ksort($array);
        return $array;
    }

    /**
     * 填充日期不连续
     * @param $array
     * @param $startdt
     * @param $enddt
     * @return mixed
     */
    public static function fixStepDay($array,$startdt,$enddt)
    {
        $start = new \DateTime($startdt);
        $end   = new \DateTime($enddt);
        $interval = $start->diff($end);
        $days = $interval->format('%a');
        for($i=0;$i<=$days;$i++){
            $date =date('Ymd',strtotime($startdt)+$i*86400);
            if(!isset($array[$date])){
                $array[$date]=0;
            }
        }
        ksort($array);
        return $array;
    }
}