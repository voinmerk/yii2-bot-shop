<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        //'homeLink' => ['label' => Yii::t('frontend', 'Bots Catalog')],
    ]) ?>

    <?= Alert::widget() ?>
    
    <?= $content ?>
</div>
