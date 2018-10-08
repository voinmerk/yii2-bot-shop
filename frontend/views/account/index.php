<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;

$user = Yii::$app->user->identity;

$this->title = Yii::t('frontend', 'Your profile');

$this->params['breadcrumbs'][] = [
    'label' => $user->first_name . ' ' . $user->last_name,
    'url' => Url::to(['account/index']),
];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Profile');
?>
<div class="account-index">
    <div class="page-header">
        <h1><?= Yii::t('frontend', 'Your profile') ?></h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_menu') ?>
        </div>

        <div class="col-md-8">
            <div class="col-md-4">
                <p class="text-center"><?= Html::img($user->avatar, ['style' => 'width:100%;border-radius:50%;border: 1px solid #ddd']) ?></p>
            </div>
            <div class="col-md-8">
                <h4><?= $user->username ?></h4>
                <p><?= $user->first_name . ' ' . $user->last_name ?></p>
            </div>
        </div>
    </div>
</div>
