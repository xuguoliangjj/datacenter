<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2016/4/2
 * Time: 16:19
 */
return [
    'wjj'=> ['label'=>'运营工具', 'items'=>[
            ['icon'=>'glyphicon glyphicon-user','label' => 'GM工具','items' => [
                ['label' => '玩家邮件', 'url' => ['/main/slg/mail']],
                ['label' => '游戏公告', 'url' => ['/main/slg/notice']],
                ['label' => '玩家封禁', 'url' => ['/main/slg/stop']],
            ]]
        ]
    ]
];