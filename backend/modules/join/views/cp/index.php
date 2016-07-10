<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '公司接入');
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
        'filterModel' => $searchModel,
        'summary'=>'',
        'buttons'=>[
            Html::a('新增公司',['/join/cp/create'],['class'=>'btn btn-sm btn-primary'])
        ],
        'columns' => [
            'id',
            ['attribute'=>'cp_name','filter'=>true],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
     </div>
</div>
<?php \yii\widgets\Pjax::end()?>