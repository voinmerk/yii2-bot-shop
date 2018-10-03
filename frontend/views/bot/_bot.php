<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;

$this->title = Yii::t('frontend', 'Catalog') . ' - ' . $category->metaTitle;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('frontend', 'Bots Catalog'),
    'url' => Url::to(['bot/index']),
];
$this->params['breadcrumbs'][] = $category->title;
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
            <?= Html::a(Fa::icon('eye'), Url::to(['bot/view', 'category' => 'null', 'bot' => $bot->username]), ['class' => 'btn btn-primary btn-flat pull-left']) ?>
            <?= Html::button('Add bot ' . Fa::icon('telegram'), ['class' => 'btn btn-default btn-flat pull-right']) ?>
        </div>
    </div>
</div>
