<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\rating\StarRating;
use rmrevin\yii\fontawesome\FA;

?>
<tr>
    <td><?= $botCount ?></td>
    <td class="text-center"><?= Html::img('@web/uploads/bots/' . $bot->image, ['style' => 'max-width: 85px;width: 100%;border-radius: 50%;']) ?></td>
    <td><?= $bot->title ?></td>
    <td>@<?= $bot->username ?></td>
    <td>
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
    </td>
    <td><?= $bot->status ? Yii::t('frontend', 'Published') : Yii::t('frontend', 'Unpublished') ?></td>
    <td class="text-right"><?= Html::a(FA::icon('pencil'), ['account/bot-update', 'bot' => $bot->username], ['class' => 'btn btn-primary']) ?></td>
</tr>
