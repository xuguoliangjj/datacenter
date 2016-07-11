<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\PlatformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '平台管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php \yii\widgets\Pjax::begin()?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        平台管理
        <span class="pull-right own-toggle">
        <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= \xuguoliangjj\editorgridview\EditorGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'summary'      => '',
            'buttons'=>[
                Html::a('新增平台',['/join/platform/create'],['class'=>'btn btn-sm btn-primary'])
            ],
            'columns' => [
                'id',
                ['attribute'=>'platform','filter'=>true],
                'remark',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
<?php \yii\widgets\Pjax::end()?>
