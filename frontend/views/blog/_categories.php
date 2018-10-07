<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\widgets\Menu;
use valiant\widgets\ListGroupWidget as Menu;

$menuItems = [];

if($categories) {
    foreach($categories as $category) {
        $menuItems[] = [
            'label' => $category->title . ' (' . $category->getBots()->count() . ') ',
            'url' => Url::to(['blog/category', 'category' => $category->slug]),
            'options' => ['class' => 'list-group-item'],
            'active' => Yii::$app->request->get('category') == $category->slug,
        ];
    }

    echo Menu::widget([
        'items' => $menuItems,
        'options' => ['class' => 'list-group'],
    ]);
} else { ?>
<div class="alert alert-warning">
    <p><?= Yii::t('frontend', 'The list of categories is not filled!') ?></p>
</div>
<?php } ?>
