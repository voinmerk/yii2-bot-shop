<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\ActiveForm;

$user = Yii::$app->user->identity;

$this->title = Yii::t('frontend', 'Your bots');

$this->params['breadcrumbs'][] = [
    'label' => $user->first_name . ' ' . $user->last_name,
    'url' => Url::to(['account/index']),
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('frontend', 'Bots'),
    'url' => ['account/bots'],
];
$this->params['breadcrumbs'][] = $bot->title;
?>
<div class="account-bot-update">
    <div class="page-header">
        <h1><?= Yii::t('frontend', 'Update bot: {bot}', ['bot' => $bot->title]) ?></h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_menu') ?>
        </div>

        <div class="col-md-8">
            <h2>@<?= $bot->username ?></h2>

            <p><?= Yii::t('frontend', 'Status') . ': ' . $bot->statusName ?></p>

            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($bot, 'meta_title')->textInput() ?>

            <?= $form->field($bot, 'title')->textInput() ?>

            <?= $form->field($bot, 'content')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', '{icon} Save', ['icon' => FA::icon('save')]), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
