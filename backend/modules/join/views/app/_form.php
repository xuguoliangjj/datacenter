<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\app */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'app_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cp_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Cp::find()->all(),'id','cp_name')) ?>

    <?= $form->field($model, 'active')->dropDownList([
        1=>'激活',
        0=>'不激活'
    ]) ?>
    <?= $form->field($model, 'api_url')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '新增') : Yii::t('app', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
