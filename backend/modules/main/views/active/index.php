<?php
use yii\bootstrap\Tabs;
$this->title = '活跃玩家';
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>
<?= $this -> context -> renderPartial('@backend/views/layouts/_filter');?>
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
