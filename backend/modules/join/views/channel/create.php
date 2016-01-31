<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\channel */

$this->title = Yii::t('app', 'Create Channel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Channels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
