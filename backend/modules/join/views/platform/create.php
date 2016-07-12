<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Platform */

$this->title = Yii::t('app', '新增平台');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '平台管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        平台管理
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