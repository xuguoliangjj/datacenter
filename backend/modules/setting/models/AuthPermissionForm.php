<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/9/27
 * Time: 2:55
 */
namespace backend\modules\setting\models;

use yii\base\Model;

class AuthPermissionForm extends Model
{
    public $routes;
    public $permissions;
    public $app;

    public function rules()
    {
        return [
           // ['routes,permissions','default','value'=>[]]
        ];
    }

    public function scenarios()
    {
        return [
            'auth'=>['routes','permissions','app']
        ];
    }

    public function attributeLabels()
    {
        return [
            'routes'=>'路由',
            'permissions'=>'权限',
            'app'=>'游戏'
        ];
    }
}