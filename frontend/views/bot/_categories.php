<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

$menuItems = [];

foreach($categories as $category) {
    $menuItems[] = [
        'label' => $category->title,
        'url' => Url::to(['bot/category', 'category' => $category->slug]),
        'options' => ['class' => 'list-group-item'],
    ];
}

echo Menu::widget([
    'items' => $menuItems,
    'options' => ['class' => 'list-group'],
    //'active' => true,
]);

?>