<?php
use yii\bootstrap\Tabs;
$this->title = '新增玩家';
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>
<?= $this -> context -> renderPartial('@backend/views/layouts/_filter');?>
<div class="row own-tips-bar">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>新增玩家：</strong>游戏内新增的游戏账号数<br>
        <strong>激活玩家：</strong>游戏新增了账号且进入游戏的账号
    </div>
 </div>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        新增玩家
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
                        'label' => '新增玩家',
                        'content' => $this->render('_adp'),
                        'active' => true
                    ],
                    [
                        'label' => '激活玩家',
                        'content' => $this->render('_avp'),
                    ]
                ],
            ]);
        ?>
    </div>
</div>