<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Bots Catalog');

//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_categories', ['categories' => $categories]) ?>
        </div>

        <div class="col-md-8">
            <?php foreach($bots as $bot) { ?>
            <?= $this->render('_bot', ['bot' => $bot]) ?>
            <?php } ?>
        </div>
    </div>
</div>
