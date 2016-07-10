<?php
/* @var $this yii\web\View */
?>
<div class="container">
    <div class="jumbotron">
        <h2><?=Yii::$app->user->identity->username?>，欢迎使用挖掘机技术数据分析平台!</h2>
    </div>
    <div class="row">
        <?php
        echo \xuguoliangjj\editorgridview\EditorGridView::widget([
            'dataProvider'=>$dataProvider,
            'summary'=>'',
            'columns'=>[
                ['attribute'=>'app_name','label'=>'应用名称','format'=>'raw','value'=>function($data){
                    return \yii\helpers\Html::a($data->app_name,['/site/select','app_id'=>$data->app_id,'app_secret'=>$data->app_secret]);
                }],
                ['attribute'=>'app_id','label'=>'应用ID'],
                ['attribute'=>'app_code','label'=>'应用简写'],
                ['attribute'=>'version','label'=>'版本'],
                ['attribute'=>'created_at','label'=>'创建时间','format'=>['date', 'php:Y-m-d']],
                ['attribute'=>'api_url','label'=>'数据接口'],
            ]
        ]);

        ?>
     </div>
</div>
