<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Catalog') . ' - ' . $bot->meta_title;

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('frontend', 'Bots Catalog'),
    'url' => Url::to(['bot/index']),
];
$this->params['breadcrumbs'][] = [
    'label' => $category->title,
    'url' => ['bot/category', 'category' => $category->slug],
];
$this->params['breadcrumbs'][] = $bot->title;
?>
<div class="catalog-index">
    <div class="page-header">
        <h1><?= $bot->title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</div>
