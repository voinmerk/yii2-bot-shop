<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;

?>
<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><?= $post->title ?></h2>
        </div>
        <div class="panel-body">
            <p><?= $post->preview_content ?></p>
        </div>
        <div class="panel-footer clearfix">
            <?= Html::a(Fa::icon('eye'), Url::to(['post/view', 'category' => isset($category) ? $category->slug : $post->defCategory->slug, 'post' => $post->slug]), ['class' => 'btn btn-primary btn-flat pull-right']) ?>
        </div>
    </div>
</div>
