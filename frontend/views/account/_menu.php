<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\widgets\Menu;
use valiant\widgets\ListGroupWidget as Menu;
use rmrevin\yii\fontawesome\FA;

$isActive = function($controller, $action, $onlyController = false) {
    if($onlyController) {
        return Yii::$app->controller->id == $controller;
    }

    return Yii::$app->controller->id == $controller && Yii::$app->controller->action->id == $action;
};

$menuItems = [
    ['label' => Fa::icon('user') . Yii::t('frontend', 'Your profile'), 'url' => ['account/index'], 'options' => ['class' => 'list-group-item']],
    [
        'label' => Fa::icon('list') . Yii::t('frontend', 'Your bots'),
        'url' => ['account/bots'],
        'options' => [
            'class' => 'list-group-item'
        ],
        'active' => $isActive('account', 'bots') || $isActive('account', 'bot-update'),
    ],
    ['label' => Fa::icon('plus') . Yii::t('frontend', 'Add bot'), 'url' => ['account/add-bot'], 'options' => ['class' => 'list-group-item']],
    ['label' => Fa::icon('cog') . Yii::t('frontend', 'Setting'), 'url' => ['account/setting'], 'options' => ['class' => 'list-group-item']],
    ['label' => Fa::icon('sign-out') . Yii::t('frontend', 'Logout'), 'url' => ['/auth/logout'], 'options' => ['class' => 'list-group-item'], 'itemOptions' => ['data-method' => 'post']],
];

echo Menu::widget([
    'items' => $menuItems,
    'options' => ['class' => 'list-group'],
    'encodeLabels' => false,
]);
?>
