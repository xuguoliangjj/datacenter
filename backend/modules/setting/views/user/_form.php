<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/9/5
 * Time: 18:15
 */

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['id' => 'assignment-form']); ?>

<?= $form->field($model, 'roles')->checkboxList($roles); ?>
<?php $flag = 1;?>
<?php foreach($permissions as $items):?>
    <?php
    if($flag === 1){
        $label = Html::activeLabel($model, 'permissions', ['class' => 'control-label']);
        $flag  = 0;
    }else{
        $label = '';
    }
    ?>
    <?= $form->field($model, 'permissions',['parts'=>['{label}'=>$label]])->checkboxList($items,
        [
            'unselect'=>null,
            'class'=>'own-routes-list'
        ]
    ); ?>
<?php endforeach;?>

<div class="form-group">
    <?= Html::submitButton('修改',
        ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php ActiveForm::end(); ?>