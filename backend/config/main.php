<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php'),
    require(__DIR__ . '/menu.php')
);

return [
    'id' => 'datacenter',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        //系统设置模块
        'setting' => [
            'class' => 'backend\modules\setting\settingModule',
        ],
        'main' => [
            'class'   => 'backend\modules\main\mainModule',
            'modules' => [
                'slg' => [
                    'class' => 'backend\modules\main\modules\slg\Modules',
                ]
            ]
        ],
        //接入管理模块
        'join' => [
            'class' => 'backend\modules\join\joinModule',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'enableStrictParsing' => true,
            'suffix' => '.html',
//             'rules' => [
//                     '<controller:\w+>/<action:\w+>‘=>‘<controller>/<action>',
//             ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
