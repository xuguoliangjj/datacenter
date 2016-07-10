<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\ChannelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '渠道接入');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php \yii\widgets\Pjax::begin()?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        <?= $this->title?>
        <span class="pull-right own-toggle">
        <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
    <?= \xuguoliangjj\editorgridview\EditorGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'buttons'      => [
            Html::a('新增渠道',['/join/channel/create'],['class'=>'btn btn-sm btn-primary'])
        ],
        'columns' => [
            'id',
            ['attribute'=>'channel','filter'=>true],
            ['attribute'=>'app_id','filter'=>true],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
<?php \yii\widgets\Pjax::end()?>