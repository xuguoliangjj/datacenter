<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\AppSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '游戏接入');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '游戏接入'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $app->app_name), 'url' => ['view','id'=>$app->id]];
$this->params['breadcrumbs'][] = '上线配置';
?>
<?php \yii\widgets\Pjax::begin()?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        上线配置
        <span class="pull-right own-toggle">
        <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= $this->render('_auth_form', [
            'model'     => $model,
            'platforms' => $platforms
        ]) ?>
    </div>
</div>
<?php \yii\widgets\Pjax::end()?>
