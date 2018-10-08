<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Bots Catalog') . ' - Поиск ботов';

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('frontend', 'Bots Catalog'),
    'url' => Url::to(['bot/index']),
];
$this->params['breadcrumbs'][] = $search;
?>
<div class="catalog-search">
    <div class="page-header">
        <h1><?= Yii::t('frontend', 'Response to query: {query}', ['query' => $search, /*'<i><b>' . $search . '</b></i>'*/]) ?></h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $this->render('_categories', ['categories' => $categories]) ?>
        </div>

        <div class="col-md-9">
            <?php if($bots) { ?>
            <?php foreach($bots as $bot) { ?>
            <?= $this->render('_bot', ['bot' => $bot]) ?>
            <?php } ?>
            <?php } else { ?>
            <div class="alert alert-danger">
                <p><?= Yii::t('frontend', 'At your request, nothing found!') ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
