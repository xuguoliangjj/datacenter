<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cp_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '新增') : Yii::t('app', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
