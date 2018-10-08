<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;
use kartik\rating\StarRating;

?>
<div class="col-md-6">
    <div class="panel panel-default item-bot">
        <div class="panel-heading">
            <h2 class="panel-title"><?= $bot->title ?></h2>
        </div>
        <div class="panel-body">
            <p class="clearfix text-left">
                <?= Html::img('@web/uploads/bots/' . $bot->image, ['class' => 'pull-left', 'style' => 'max-width:120px;width:100%;border-radius:50%;margin-right:15px;']) ?>
                <?= $bot->content ?>
                <?= StarRating::widget([
                    'name' => 'rating_' . $bot->id,
                    'value' => 3,
                    'language' => Yii::$app->language,
                    'pluginOptions' => [
                        'theme' => 'krajee-svg',
                        'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                        'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                        //'disabled' => true,
                        'showClear' => false,
                        'showCaption' => false,
                        'step' => 1,
                    ],
                ]); ?>
            </p>
        </div>
        <div class="panel-footer clearfix">
            <?= Html::a(Fa::icon('eye'), Url::to(['bot/view', 'category' => isset($category) ? $category->slug : $bot->defCategory->slug, 'bot' => $bot->username]), ['class' => 'btn btn-primary btn-flat pull-left']) ?>
            <?= Html::a(Yii::t('frontend', 'Add to {icon}', ['icon' => Fa::icon('telegram')]), 'https://telegram.me/' . $bot->username, ['class' => 'btn btn-success btn-flat pull-right', 'target' => '_blank']) ?>
        </div>
    </div>
</div>
