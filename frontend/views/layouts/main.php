<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

$isGuest = Yii::$app->user->isGuest;

if($isGuest) {

$js = <<<JS
$(document).ready(function() {
    $('.popup-open').magnificPopup({
        type: 'inline',

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,
        
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
});
JS;

$this->registerJs($js);

}

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if ($isGuest) {
        /*$menuItems[] = ['label' => 'Signup', 'url' => ['/auth/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/auth/login']];*/

        $menuItems[] = '<li class="oauth-button">
            <script async src="https://telegram.org/js/telegram-widget.js?4" data-telegram-login="voinmerk_bot" data-size="medium" data-radius="5" data-auth-url="http://botshop.loc/auth/telegram" data-request-access="write"></script>
        </li>';

        // $menuItems[] = ['label' => 'Sign In', 'url' => ['auth/login'], 'linkOptions' => ['class' => 'ajax-popup-open']];

        //$menuItems[] = ['label' => 'Sign In', 'url' => ['#' => 'authDialog'], 'linkOptions' => ['class' => 'popup-open']];

        // $menuItems[] = '<li><a href="#authDialog" class="popup-open">Sign In</a></li>';
    } else {
        $menuItems[] = ['label' => 'Logout', 'url' => ['/auth/logout'], 'linkOptions' => ['data-method' => 'post']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <?php if($isGuest) { ?>
    <!-- <div id="authDialog" class="zoom-anim-dialog mfp-hide">
        <script async src="https://telegram.org/js/telegram-widget.js?4" data-telegram-login="voinmerk_bot" data-size="large" data-radius="5" data-auth-url="http://botshop.loc/auth/telegram" data-request-access="write"></script>

        <h4 style="margin-top: 15px;">Войдите в систему с помощью <b>Telegram</b>.</h4>
    </div> -->
    <?php } ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
