<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;

$menuItems = [
    ['label' => Fa::icon('user') . ' ' . Yii::t('frontend', 'Your profile'), 'url' => ['account/index'], 'options' => ['class' => 'list-group-item']],
    ['label' => Fa::icon('list') . ' ' . Yii::t('frontend', 'Your bots'), 'url' => ['account/mybots'], 'options' => ['class' => 'list-group-item']],
    ['label' => Fa::icon('plus') . ' ' . Yii::t('frontend', 'Added bot'), 'url' => ['account/add'], 'options' => ['class' => 'list-group-item']],
    ['label' => Fa::icon('cog') . ' ' . Yii::t('frontend', 'Setting'), 'url' => ['account/setting'], 'options' => ['class' => 'list-group-item']],
    ['label' => Fa::icon('sign-out') . ' ' . Yii::t('frontend', 'Logout'), 'url' => ['/auth/logout'], 'options' => ['class' => 'list-group-item', 'data-method' => 'post']],
];


echo Menu::widget([
    'items' => $menuItems,
    'options' => ['class' => 'list-group'],
    'encodeLabels' => false,
]);
?>
