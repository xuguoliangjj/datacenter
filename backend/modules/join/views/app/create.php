<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\app */

$this->title = Yii::t('app', '新增游戏');
$this->params['breadcrumbs'][] = ['label' => '游戏接入', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        <?= $this->title?>
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