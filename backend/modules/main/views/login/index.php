<?php
use yii\bootstrap\Tabs;
$this->title = '实时登录';
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>
<?= $this -> context -> renderPartial('@backend/views/layouts/_filter');?>
<div class="row own-tips-bar">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>登录按分：</strong>每分钟登录玩家数<br>
    </div>
</div>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        实时登录
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
                    'label' => '登录按分',
                    'content' => $this->render('_login_minute'),
                ]
            ],
        ]);
        ?>
    </div>
</div>
