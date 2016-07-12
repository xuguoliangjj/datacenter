<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/9/13
 * Time: 19:04
 */
namespace backend\modules\setting\models;

use yii\base\Model;

class RoleAuthForm extends Model
{
    public $routes;
    public $roles;
    public $permissions;
    public $app;
    public $platforms;

    public function rules()
    {
        return [
            ['roles','required']
        ];
    }

    public function scenarios()
    {
        return [
            'auth'=>['routes','permissions','roles','app','platforms']
        ];
    }

    public function attributeLabels()
    {
        return [
            'routes'=>'权限',
            'roles'=>'角色',
            'permissions'=>'权限组',
            'app'=>'游戏',
            'platforms'=>'地区'
        ];
    }
}