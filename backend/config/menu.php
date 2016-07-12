<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/7/11
 * Time: 2:06
 */

return [
    'menu'=>[
        'data'=> ['label'=>'数据统计','items'=>[
                ['icon'=>'glyphicon glyphicon-user','label' => '玩家分析','items' => [
                    ['label' => '新增玩家', 'url' => ['/main/add']],
                    ['label' => '活跃玩家', 'url' => ['/main/active']],
                    ['label' => '玩家留存', 'url' => ['/main/remain']],
                    ['label' => '滚服统计', 'url' => ['/main/rollserv']],
                    ['label' => '设备详情', 'url' => ['/main/device']],
                ]],
                ['icon'=>'glyphicon glyphicon-time','label' => '实时分析','items' => [
                    ['label' => '实时在线', 'url' => ['/main/online']],
                    ['label' => '实时登录', 'url' => ['/product/index4']],
                ]],
                ['icon'=>'glyphicon glyphicon-yen','label' => '付费分析','items' => [
                    ['label' => '充值统计', 'url' => ['/site/indsex']],
                    ['label' => '充值分布', 'url' => ['/product/index4']],
                    ['label' => '充值排行', 'url' => ['/product/index4']],
                ]],
                ['icon'=>'glyphicon glyphicon-random','label' => '流失分析','items' => [
                    ['label' => '每日流失', 'url' => ['/product/index5']],
                    ['label' => '等级流失', 'url' => ['/product/index6']],
                ]],
                ['icon'=>'glyphicon glyphicon-level-up','label' => '等级分析','items' => [
                    ['label' => '等级分布', 'url' => ['/product/index5']]
                ]],
                ['icon'=>'glyphicon glyphicon-tasks','label' => '任务分析','items' => [
                    ['label' => '任务统计', 'url' => ['/product/index5']],
                    ['label' => '任务流失', 'url' => ['/product/index6']],
                ]],
                ['icon'=>'glyphicon glyphicon-oil','label' => '消费分析','items' => [
                    ['label' => '消费分布', 'url' => ['/product/index5']],
                    ['label' => '消费统计', 'url' => ['/product/index6']],
                ]],
            ]
        ],
        'join'=> ['label'=>'接入管理', 'items'=>[
                ['icon'=>'glyphicon glyphicon-user','label' => '接入管理','items' => [
                    ['label' => '公司接入', 'url' => ['/join/cp']],
                    ['label' => '游戏接入', 'url' => ['/join/app']],
                    ['label' => '地区管理', 'url' => ['/join/platform']],
                    ['label' => '渠道接入', 'url' => ['/join/channel']],
                ]]
            ]
        ],
        'setting'=> ['label'=>'系统设置', 'items'=>[
                ['icon'=>'glyphicon glyphicon-eye-open','label' => '权限管理','items' => [
                    ['label' => '用户管理', 'url' => ['/setting/user']],
                    ['label' => '角色管理', 'url' => ['/setting/roles']],
                    ['label' => '权限列表', 'url' => ['/setting/permission']],
                    ['label' => '路由列表', 'url' => ['/setting/route']],
                    ['label' => '规则列表', 'url' => ['/setting/rule']],
                ]],
                ['icon'=>'glyphicon glyphicon-user','label' => '个人中心','items' => [
                    ['label' => '修改密码', 'url' => ['/site/reset-password']],
                ]]
            ]
        ]
    ]
];