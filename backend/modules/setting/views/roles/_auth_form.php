<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/9/13
 * Time: 19:07
 */
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['id' => 'auth-role-form']); ?>
<?= $form->field($model, 'roles')->checkboxList($result['Roles']); ?>
<?php $flag = 1;?>
<?php foreach($routes as $items):?>
    <?php
        if($flag === 1){
            $label = Html::activeLabel($model, 'routes', ['class' => 'control-label']);
            $flag  = 0;
        }else{
            $label = '<hr>';
        }
    ?>
    <?= $form->field($model, 'routes',['parts'=>[
        '{label}'=>$label
    ]])->checkboxList($items,['unselect'=>null]); ?>

<?php endforeach;?>
<?= $form->field($model, 'permissions')->checkboxList($result['Permissions']); ?>
    <div class="form-group">
        <?= Html::submitButton('修改', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php ActiveForm::end(); ?>