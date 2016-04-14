<?php
use yii\bootstrap\Tabs;
$this->title = '实时在线';
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>
<?= $this -> context -> renderPartial('@backend/views/layouts/_filter');?>
<div class="row own-tips-bar">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>在线按分：</strong>每分钟在线玩家数
    </div>
</div>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        实时在线
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
                    'label' => '在线按分',
                    'content' => $this->render('_online_minute'),
                ],
                [
                    'label' => '在线按时',
                    'content' => $this->render('_online_hour'),
                ],
                [
                    'label' => '在线按天',
                    'content' => $this->render('_online_day'),
                ]
            ],
        ]);
        ?>
    </div>
</div>
