<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;

?>
<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><?= $bot->title ?></h2>
        </div>
        <div class="panel-body">
            <p><?= $bot->content ?></p>
        </div>
        <div class="panel-footer clearfix">
            <?= Html::a(Fa::icon('eye'), Url::to(['bot/view', 'category' => isset($category) ? $category->slug : $bot->defCategory->slug, 'bot' => $bot->username]), ['class' => 'btn btn-primary btn-flat pull-left']) ?>
            <?= Html::a(Yii::t('frontend', 'Add to {icon}', ['icon' => Fa::icon('telegram')]), 'https://telegram.me/' . $bot->username, ['class' => 'btn btn-success btn-flat pull-right', 'target' => '_blank']) ?>
        </div>
    </div>
</div>
