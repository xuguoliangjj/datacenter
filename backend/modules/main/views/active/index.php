<?php
use yii\bootstrap\Tabs;
$this->title = '活跃玩家';
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>
<?= $this -> context -> renderPartial('@backend/views/layouts/_filter');?>
<div class="row own-tips-bar">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>DAU：</strong>有登录行为的玩家数量（天）<br>
        <strong>MAU：</strong>有登录行为的玩家数量（月）<br>
        <strong>WAU：</strong>有登录行为的玩家数量（周）
    </div>
</div>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        活跃玩家
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
                    'label' => 'DAU',
                    'content' => $this->render('_dau'),
                    'active' => true
                ],
                [
                    'label' => 'DAU|WAU|MAU',
                    'content' => $this->render('_dau_wau_mau'),
                ],
                [
                    'label' => 'DAU/MAU',
                    'content' => $this->render('_dau_mau'),
                ]
            ],
        ]);
        ?>
    </div>
</div>
