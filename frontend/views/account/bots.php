<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;

$user = Yii::$app->user->identity;

$this->title = Yii::t('frontend', 'Your bots');

$this->params['breadcrumbs'][] = [
    'label' => $user->first_name . ' ' . $user->last_name,
    'url' => Url::to(['account/index']),
];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Bots');

$botCount = 0;
?>
<div class="account-index">
    <div class="page-header">
        <h1><?= Yii::t('frontend', 'Your bots') ?></h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_menu') ?>
        </div>

        <div class="col-md-8">
            <?php if(isset($success)) { ?>
            <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> <?= $success ?>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
            <?php } ?>

            <div class="mubots-list">
                <?php if($bots) { ?>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th><?= Yii::t('frontend', 'Avatar') ?></th>
                        <th><?= Yii::t('frontend', 'Bot name') ?></th>
                        <th><?= Yii::t('frontend', 'Bot login') ?></th>
                        <th><?= Yii::t('frontend', 'Rating') ?></th>
                        <th><?= Yii::t('frontend', 'Status') ?></th>
                        <th class="text-right"><?= Yii::t('yii', 'Update') ?></th>
                    </tr>
                    <?php foreach($bots as $bot) { ?>
                    <?php $botCount++; ?>
                    <?= $this->render('_bot', ['bot' => $bot, 'botCount' => $botCount]) ?>
                    <?php } ?>
                    </table>
                <?php } else { ?>
                <div class="alert alert-info">
                    <?= Yii::t('frontend', 'You have not added a single bot, you can do this by clicking on the link: {link}', [
                        'link' => Html::a(Yii::t('frontend', 'Added bot'), ['account/add-bot']),
                    ]) ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
