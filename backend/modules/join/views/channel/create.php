<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\channel */

$this->title = Yii::t('app', '新增渠道');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '渠道接入'), 'url' => ['index']];
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
