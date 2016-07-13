<?php
/**
 * Created by PhpStorm.
 * Date: 2016/7/12
 * Time: 17:30
 * @author: xuguoliang <1044748759@qq.com>
 */
return [
    'runtimeDb' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=master;dbname=slg',
        'username' => 'xuguoliang',
        'password' => 'xuguoliang',
        'charset'  => 'utf8',
    ],
    'offlineDb' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=own;dbname=wjj',
        'username' => 'xuguoliang',
        'password' => 'xuguoliang!@#',
        'charset' => 'utf8',
    ]
];