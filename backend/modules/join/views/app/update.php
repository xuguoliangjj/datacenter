<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\app */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'App',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '游戏接入'), 'url' => ['index']];

$this->params['breadcrumbs'][] = Yii::t('app', '修改');
?>

<div class="panel panel-default own-panel">
    <div class="panel-heading">
        修改
        <span class="pull-right own-toggle">
        <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>