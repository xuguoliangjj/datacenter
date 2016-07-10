<?php
$this->title = '修改用户';
$this->params['breadcrumbs'] = \backend\components\Tools::buildBreadcrumbs($this,$this->title);
?>

<div class="panel panel-default own-panel">
    <div class="panel-heading">
        修改用户
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= $this->render('_resetpass_form',['model'=>$model])?>
    </div>
</div>