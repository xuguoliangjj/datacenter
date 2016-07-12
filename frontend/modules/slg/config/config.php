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
        'dsn' => 'mysql:host=127.0.0.1;dbname=slg',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ],
    'offlineDb' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=127.0.0.1;dbname=slg-offline',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ]
];