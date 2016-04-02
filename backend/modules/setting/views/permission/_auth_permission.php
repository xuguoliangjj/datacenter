<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/9/27
 * Time: 2:58
 */
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['id' => 'auth-role-form']); ?>
<?= $form->field($model, 'permissions')->checkboxList($permissions); ?>
<?= $form->field($model, 'app')->checkboxList($app); ?>
<?php $flag = 1;?>
<?php foreach($routes as $items):?>
    <?php
    if($flag === 1){
        $label = Html::activeLabel($model, 'routes', ['class' => 'control-label']);
        $flag  = 0;
    }else{
        $label = '';
    }
    ?>
    <?= $form->field($model, 'routes',['parts'=>['{label}'=>$label]])->checkboxList($items,
        [
            'unselect'=>null,
            'class'=>'own-routes-list'
        ]
    ); ?>
<?php endforeach;?>
    <div class="form-group">
        <?= Html::submitButton('修改', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php ActiveForm::end(); ?>