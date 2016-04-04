<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<?php
NavBar::begin([
    'brandLabel' => '挖掘机技术数据分析平台',
    'brandUrl' => Yii::$app->homeUrl,
    'innerContainerOptions'=>['class'=>'container-fluid'],
    'options' => [
        'class' => 'navbar-inverse navbar-static-top own-navbar-top navbar-fixed-top',
    ],
]);
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
} else {
    $menuItems[] = [
        'label' => isset(Yii::$app->session['app_name']) ? Yii::$app->session['app_name'] : '',
    ];
    $menuItems[] = [
        'label' => '中文',
        'items' => [
            ['label' => '中文', 'url' => ['/main']],
            ['label' => '英文', 'url' => ['/main']],
            ['label' => '韩语', 'url' => ['/main']],
            ['label' => '日语', 'url' => ['/main']],
        ]
    ];
    $menuItems[] = [
        'label' => '<span class="glyphicon glyphicon-user"></span> '.Yii::$app->user->identity->username,
        'items' => [
            ['label' => '<span class="glyphicon glyphicon-lock"></span> 修改密码','url'=>['/site/reset-password']],
            ['label' => '<span class="glyphicon glyphicon-off"></span> 注销登录', 'url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
        ]
    ];

}
if(!Yii::$app->user->isGuest) {
    echo Nav::widget([
        'encodeLabels'=>false,
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $this->context->topMenu,
    ]);
}
echo Nav::widget([
    'encodeLabels'=>false,
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>