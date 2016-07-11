<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\AppSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '游戏接入');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php \yii\widgets\Pjax::begin()?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        公司接入
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
            Html::a('新增游戏',['/join/app/create'],['class'=>'btn btn-sm btn-primary'])
        ],
        'columns' => [
            'id',
            ['attribute'=>'app_name','filter'=>true],
            'app_id',
            'app_secret',
            'app_code',
            // 'tbl_prefix',
            'version',
            // 'created_at',
            // 'updated_at',
            // 'cp_id',
            'active',

            ['class' => 'yii\grid\ActionColumn','buttons'=>[
                    'app' => function ($url, $model, $key) {
                         return Html::a('<span class="glyphicon glyphicon-wrench"></span>', ['auth','id'=>$model->id],[
                             'title' => '游戏平台上线配置',
                             'aria-label' => '游戏平台上线配置',
                             'data-pjax' => 0
                         ]);
                    }
            ],'template'=>'{view} {app} {update} {delete}'],
        ],
    ]); ?>
    </div>
</div>
<?php \yii\widgets\Pjax::end()?>
