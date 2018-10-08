<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\rating\StarRating;

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
            <p><?= StarRating::widget([
                'name' => 'rating_' . $bot->id,
                'value' => 3,
                'language' => Yii::$app->language,
                'pluginOptions' => [
                    //'disabled' => true,
                    'showClear' => false,
                    'showCaption' => false,
                    'step' => 1,
                ],
            ]); ?></p>
            <?= $bot->content ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-9">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active" style="width: 50%;">
                    <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Comments</a>
                </li>
                <li role="presentation" style="width: 50%;">
                    <a href="#reports" aria-controls="reports" role="tab" data-toggle="tab">Reports</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="comments">
                    <?php foreach($bot->comments as $comment) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="panel-title"><?= $comment->author ?></h4>
                        </div>
                        <div class="panel-body">
                            <?= $comment->content ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="reports">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>

        </div>
    </div>
</div>
