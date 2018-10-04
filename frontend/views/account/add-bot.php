<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;

$user = Yii::$app->user->identity;

$this->title = Yii::t('frontend', 'Add bot');

$this->params['breadcrumbs'][] = [
    'label' => $user->first_name . ' ' . $user->last_name,
    'url' => Url::to(['account/index']),
];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Add bot');
?>
<div class="account-index">
    <div class="page-header">
        <h1><?= Yii::t('frontend', 'Add bot') ?></h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_menu') ?>
        </div>

        <div class="col-md-8">
            <h2>Content</h2>
        </div>
    </div>
</div>
