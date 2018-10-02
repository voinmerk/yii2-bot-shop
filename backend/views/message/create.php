<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SourceMessage */

$this->title = Yii::t('backend', 'Create Source Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Source Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
