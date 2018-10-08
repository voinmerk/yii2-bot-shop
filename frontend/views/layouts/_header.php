<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use rmrevin\yii\fontawesome\FA;
use frontend\models\Language;

$isActive = function($controller, $action, $onlyController = false) {
    if($onlyController) {
        return Yii::$app->controller->id == $controller;
    }

    return Yii::$app->controller->id == $controller && Yii::$app->controller->action->id == $action;
};

/*if($isGuest) {
    $js = '
        $(document).ready(function() {
            $(\'.popup-open\').magnificPopup({
                type: \'inline\',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: \'auto\',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: \'my-mfp-zoom-in\'
            });
        });
    ';

    $this->registerJs($js);
}*/

$model = new \frontend\models\forms\SearchForm;

$this->beginBlock('search');
    $form = ActiveForm::begin(['id' => 'form-search', 'action' => ['/bot']]);
    echo $form->field($model, 'q')->textInput()->input('q', ['placeholder' => Yii::t('frontend', 'Search...')])->label(false);
    ActiveForm::end();
$this->endBlock();

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [
    ['label' => Yii::t('frontend', 'Catalog'), 'url' => ['/bot'], 'active' => $isActive('bot', '', true)],
    /*['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],*/
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => $menuItems,
]);
$menuItems = [];

$menuItems[] = [
    'label' => FA::icon('search'),
    'items' => [
        ['label' => $this->blocks['search']],
        //'options' => ['class' => 'my-class'],
    ],
    'options' => ['class' => 'item-search-form'],
];

$items = [];

foreach (Language::getLanguages() as $language) {
    if ($language['code'] == Yii::$app->language)
        continue;

    $items[] = ['label' => $language['name'], 'url' => ['languages/default/index', 'lang' => $language['code']]];
}

$menuItems[] = [
    'label' => Language::getLanguageNameByCode(Yii::$app->language),
    'items' => $items,
];

if ($isGuest) {
    $menuItems[] = '<li class="oauth-button">'.Yii::$app->params['tg_widget'].'</li>';
    // 'tg_widget' => '<script async src="https://telegram.org/js/telegram-widget.js?4" data-telegram-login="voinmerk_bot" data-size="medium" data-radius="5" data-auth-url="http://botshop.loc/auth/telegram" data-request-access="write"></script>',
    // Почти тоже самое и в админке

    // $menuItems[] = '<li><a href="#authDialog" class="popup-open">Sign In</a></li>';
} else {
    $menuItems[] = [
        'label' => $user->username,
        'items' => [
             ['label' => Fa::icon('user') . ' ' . Yii::t('frontend', 'Your profile'),   'url' => ['account/index'],     'active' => $isActive('account', 'index')],
             ['label' => Fa::icon('list') . ' ' . Yii::t('frontend', 'Your bots'),      'url' => ['account/bots'],      'active' => $isActive('account', 'bots')],
             ['label' => Fa::icon('plus') . ' ' . Yii::t('frontend', 'Add bot'),        'url' => ['account/add-bot'],   'active' => $isActive('account', 'add-bot')],
             ['label' => Fa::icon('cog')  . ' ' . Yii::t('frontend', 'Setting'),        'url' => ['account/setting'],   'active' => $isActive('account', 'setting')],
             '<li class="divider"></li>',
             ['label' => Fa::icon('sign-out') . ' ' . Yii::t('frontend', 'Logout'), 'url' => ['/auth/logout'], 'linkOptions' => ['data-method' => 'post']],
        ],
        'active' => $isActive('account', '', true),
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
    'encodeLabels' => false,
]);
NavBar::end();

/*if($isGuest) {
    echo '
        <div id="authDialog" class="zoom-anim-dialog mfp-hide">
            <script async src="https://telegram.org/js/telegram-widget.js?4" data-telegram-login="voinmerk_bot" data-size="large" data-radius="5" data-auth-url="http://botshop.loc/auth/telegram" data-request-access="write"></script>

            <h4 style="margin-top: 15px;">Войдите в систему с помощью <b>Telegram</b>.</h4>
        </div>
    ';
}*/
?>
