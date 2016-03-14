<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2016/3/7
 * Time: 14:51
 */
namespace restAction\adp;

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
    public function run($start,$end,$channel,$platform,$server)
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        return $this->prepareDataProvider($start,$end,$channel,$platform,$server);
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider($start,$end,$channel,$platform,$server)
    {
        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;
        $query      = $modelClass::find();
        $query -> andWhere(['>=','ymd',$start]);
        $query -> andWhere(['<=','ymd',$end]);
        $query -> andFilterWhere(['channel'  => $channel]);
        $query -> andFilterWhere(['platform' => $platform]);
        $query -> andFilterWhere(['server'   => $server]);
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
