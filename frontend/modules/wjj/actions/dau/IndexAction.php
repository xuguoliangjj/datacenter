<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2016/3/7
 * Time: 14:51
 */
namespace restAction\dau;

use frontend\components\Tools;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class IndexAction extends Action
{
    /**
     * @var callable a PHP callable that will be called to prepare a data provider that
     * should return a collection of the models. If not set, [[prepareDataProvider()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($action) {
     *     // $action is the action object currently running
     * }
     * ```
     *
     * The callable should return an instance of [[ActiveDataProvider]].
     */
    public $prepareDataProvider;


    /**
     * @return ActiveDataProvider
     */
    public function run($starttime,$endtime,$channel,$platform,$server)
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        return $this->prepareDataProvider($starttime,$endtime,$channel,$platform,$server);
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider($starttime,$endtime,$channel,$platform,$server)
    {
        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;
        $query      = $modelClass::find();
        $query -> select = [
            'ymd',
            'SUM(dau) as dau',
            'SUM(dau_adp) as dau_adp',
            'SUM(dau_payp) as dau_payp',
            'SUM(dau_npayp) as dau_npayp'
        ];
        $query -> andWhere(['>=','ymd',$starttime]);
        $query -> andWhere(['<=','ymd',$endtime]);
        $query -> andFilterWhere(['channel'  => $channel]);
        $query -> andFilterWhere(['platform' => $platform]);
        $query -> andFilterWhere(['server'   => $server]);
        $query -> groupBy('ymd');
        $query -> orderBy([
            'ymd' => SORT_ASC
        ]);
        $response = [
            'max'        => 0,
            'categories' => [],
            'series'     => []
        ];
        $data = $query -> asArray() -> all();
        $response['categories'] = array_column($data,'ymd');
        $dau  = Tools::fixedArrayToInterger(array_column($data,'dau'));
        $response['series'][0]  = [
            'name'  => 'DAU',
            'data'  => $dau
        ];
        $response['series'][1]  = [
            'name'  => '新增玩家',
            'data'  => Tools::fixedArrayToInterger(array_column($data,'dau_adp'))
        ];
        $response['series'][2]  = [
            'name'  => '付费玩家',
            'data'  => Tools::fixedArrayToInterger(array_column($data,'dau_payp'))
        ];
        $response['series'][3]  = [
            'name'  => '非付费玩家',
            'data'  => Tools::fixedArrayToInterger(array_column($data,'dau_npayp'))
        ];
        $response['max']        = empty($dau) ? 0 : max($dau);
        return $response;
    }
}
