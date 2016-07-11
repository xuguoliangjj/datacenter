<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\app */

$this->title = '游戏详情'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '游戏接入'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '游戏详情';
?>

<div class="panel panel-default own-panel">
    <div class="panel-heading">
        游戏详情
        <span class="pull-right own-toggle">
        <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'app_name',
                'app_id',
                'app_secret',
                'app_code',
                'version',
                'created_at',
                'updated_at',
                'cp_id',
                'active',
                'api_url'
            ],
        ]) ?>
    </div>
</div>