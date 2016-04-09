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

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header">
    <?= $this -> context -> renderPartial('@backend/views/layouts/_top');?>
</div>
<div class="content">
    <div class="row" id="own-main">
        <div class="col-xs-12 col-sm-2 own-left-bar">
            <div class="own-search-bar hidden-xs">
                <div class="input-group input-group" style="padding:10px;">
                    <input type="text" class="form-control" placeholder="搜索......" aria-describedby="sizing-addon1">
                    <span class="input-group-addon btn" id="sizing-addon1"><span class="glyphicon glyphicon-search"></span></span>
                </div>
            </div>
                <?php if (!Yii::$app->user->isGuest):?>
                    <?=$this -> context -> renderPartial('@backend/views/layouts/_left');?>
                <?php endif;?>
        </div>
        <div class="col-xs-12 col-sm-10 own-main-bar">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumb'],
                'homeLink' => [
                    'label' => '首页',                  // required
                    'url' => '/',                      // optional, will be processed by Url::to()
                    'template' => "<li>{link}</li>\n", // optional, if not set $this->itemTemplate will be used
                ]
            ]) ?>
            <div class="row">
                <?= $content ?>
            </div>
        </div>
        <div class="clear:both"></div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>