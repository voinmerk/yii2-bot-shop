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
        <div class="col-md-3">
            <h4>Поддерживаемые языки:</h4>
            <?php foreach($bot->botLanguages as $language) { ?>
            <p class="label label-success"><?= $language->name ?></p>
            <?php } ?>
        </div>

        <div class="col-md-9">
            <h3>Описание:</h3>
            <?= $bot->content ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-9">
            <h3>Отзывы:</h3>
            <?php foreach($bot->comments as $comment) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= $comment->author ?></h4>
                </div>
                <div class="panel-body">
                    <?= $comment->content ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
