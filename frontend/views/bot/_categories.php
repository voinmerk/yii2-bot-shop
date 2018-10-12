<?php

use yii\helpers\Html;
use yii\helpers\Url;
use valiant\widgets\ListGroupWidget;

$request = Yii::$app->request;

$menuItems = [];

if($categories) {
    foreach($categories as $category) {
        $menuItems[] = [
            'label' => $category->title . ' (' . $category->getBots()->count() . ') ',
            'url' => Url::to(['bot/category', 'category' => $category->slug]),
            'options' => ['class' => 'list-group-item'],
            'active' => isset($request->get['category']) && $request->get['category'] == $category->slug,
        ];
    }

    echo ListGroupWidget::widget([
        'items' => $menuItems,
        'options' => ['class' => 'list-group'],
        //'active' => true,
    ]);
} else { ?>
<div class="alert alert-warning">
    <p><?= Yii::t('frontend', 'The list of categories is not filled!') ?></p>
</div>
<?php } ?>
