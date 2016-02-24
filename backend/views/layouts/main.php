<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?=$this -> context -> renderPartial('@backend/views/layouts/_top');?>
    <div class="container-fluid own-container-fluid">
        <?php if(!Yii::$app->user->isGuest && !empty($this ->context -> leftMenu)):?>
        <div class="row">
            <div class="col-xs-12 col-sm-2 own-search-bar">
                <div class="input-group input-group" style="padding:10px;">
                    <input type="text" class="form-control" placeholder="搜索......" aria-describedby="sizing-addon1">
                    <span class="input-group-addon btn" id="sizing-addon1"><span class="glyphicon glyphicon-search"></span></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-10">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class' => 'breadcrumb','style'=>'margin:13px 0px 0px;'],
                    'homeLink' => [
                        'label' => '首页',                  // required
                        'url' => '/',                      // optional, will be processed by Url::to()
                        'template' => "<li>{link}</li>\n", // optional, if not set $this->itemTemplate will be used
                    ]
                ]) ?>
            </div>
        </div>
        <?php endif;?>
        <div class="row">
            <div class="col-xs-12 col-sm-2 own-menu-bar">
            <?php if (!Yii::$app->user->isGuest):?>
                <?=$this -> context -> renderPartial('@backend/views/layouts/_left');?>
            <?php endif;?>
            </div>
            <div class="col-xs-12 col-sm-10">
                <div class="row">
                        <div class="panel panel-default own-panel">
                            <div class="panel-body">
                                <div class="col-xs-12 col-sm-10">
                                    <input size="16" type="text" value="2012-06-15" readonly class="form_datetime">
                                    <?= \yii\bootstrap\Button::widget([
                                        'label' => '<span>2016-01-01 - 2016-01-05</span> 日期&nbsp;&nbsp;<i class="fa fa-calendar"></i>',
                                        'options'=>['id'=>'own-date-filter','class'=>'btn btn-success'],
                                        'encodeLabel'=>false
                                    ])?>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <?php
                                    \yii\bootstrap\Modal::begin([
                                        'options'=>['class'=>'own-filter'],
                                        'header' => '<h5>筛选</h5>',
                                        'footer' => '<button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                                                     <button type="button" class="btn btn-primary" id="own-sure-filter">确认</button>',
                                        'toggleButton' => ['label' => '<i class="fa fa-filter"></i>&nbsp;&nbsp;过滤','class'=>'btn btn-success btn-sm pull-right'],
                                    ]);
                                    echo 'Say hello...';
                                    \yii\bootstrap\Modal::end();
                                    ?>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>