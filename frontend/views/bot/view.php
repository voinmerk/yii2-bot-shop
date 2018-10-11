<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\rating\StarRating;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$js = <<<JS

jQuery('#comment-form').submit(function () {
    // send data to actionSave by ajax request.
    return false; // Cancel form submitting.
});

JS;

//$this->registerJs($js);

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
<div class="catalog-view">
    <div class="page-header">
        <h1><?= $bot->title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="bot-avatar">
                <p class="text-center"><?= Html::img('@web/uploads/bots/' . $bot->image, ['style' => 'border-radius:50%;max-width:150px;width:100%;']) ?></p>
                <p class="text-center"><?= StarRating::widget([
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
                <p class="text-center"><?= Html::a(Yii::t('frontend', 'Add to {icon}', ['icon' => Fa::icon('telegram')]), 'https://t.me/' . $bot->username . ($bot->start_param ? '?start=' . $bot->start_param : ''), ['class' => 'btn btn-primary btn-flat', 'style' => 'font-size: 18px;', 'target' => '_blank']) ?></p>
            </div>
            <div class="bot-languages">
                <h4><?= Yii::t('frontend', 'Supported language') ?>:</h4>
                <?php foreach($bot->botLanguages as $language) { ?>
                <p class="label label-success"><?= $language->name ?></p>
                <?php } ?>
            </div>
        </div>

        <div class="col-md-9">
            <h3><?= Yii::t('frontend', 'Description') ?>:</h3>
            <?= $bot->content ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-9">
            <!-- Nav tabs -->
            <div class="bot-comment">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab"><?= Yii::t('frontend', 'Comments') ?></a>
                    </li>
                    <li role="presentation">
                        <a href="#reports" aria-controls="reports" role="tab" data-toggle="tab"><?= Yii::t('frontend', 'Reports') ?></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="comments">
                        <div class="comment-editor">
                            <?= $this->render('_comment_form', [
                                'commentForm' => $commentForm,
                                'bot_id' => $bot->id,
                                'comment_success' => isset($comment_success) ? $comment_success : null,
                                'comment_error' => isset($comment_error) ? $comment_error : null,
                            ]) ?>
                        </div>

                        <?php foreach($bot->botComments as $comment) { ?>
                        <?= $this->render('_comment', ['comment' => $comment]) ?>
                        <?php } ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="reports">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
