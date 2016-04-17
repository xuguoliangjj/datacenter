<?php
use yii\bootstrap\Tabs;
$this->title = '玩家留存';
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>
<?= $this -> context -> renderPartial('@backend/views/layouts/_filter');?>
<div class="row own-tips-bar">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>次日留存率：</strong>统计所选时期内，当日成功登陆游戏的新增玩家中，第二日再次登陆游戏的玩家数量，占当日游戏新增玩家数量的比例。<br>
        <strong>三日留存率：</strong>统计所选时期内，当日成功登陆游戏的新增玩家中，往后推第3日（当日不计入天数）登陆游戏的玩家数量，占当日游戏新增玩家数量的比例。<br>
        <strong>七日留存率：</strong>统计所选时期内，当日成功登陆游戏的新增玩家中，往后推第7日（当日不计入天数）登陆游戏的玩家数量，占当日游戏新增玩家数量的比例。
    </div>
</div>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        玩家留存
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
        <span class="pull-right own-download">
            <a class="glyphicon glyphicon-download-alt"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= Tabs::widget([
            'navType'=>'nav-pills',
            'items' => [
                [
                    'label' => '玩家留存',
                    'content' => $this->render('_remain'),
                ]
            ],
        ]);
        ?>
    </div>
</div>
