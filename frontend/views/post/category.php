<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Blogs') . ' - ' . $category->title;

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('frontend', 'Blogs'),
    'url' => ['blog/index'],
];
$this->params['breadcrumbs'][] = $category->title;
?>
<div class="blog-index">
    <div class="page-header">
        <h1><?= $category->title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $this->render('_categories', ['categories' => $categories]) ?>
        </div>

        <div class="col-md-9">
            <?php if($posts) { ?>
            <?php foreach($posts as $post) { ?>
            <?= $this->render('_post', ['post' => $post, 'category' => $category]) ?>
            <?php } ?>
            <?php } else { ?>
            <div class="alert alert-danger">
                <p><?= Yii::t('frontend', 'There is nothing in the blog!') ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
