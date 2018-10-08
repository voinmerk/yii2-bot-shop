<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FA;

$user = Yii::$app->user->identity;

$this->title = Yii::t('frontend', 'Add bot');

$this->params['breadcrumbs'][] = [
    'label' => $user->first_name . ' ' . $user->last_name,
    'url' => Url::to(['account/index']),
];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Add bot');
?>
<div class="account-index">
    <div class="page-header">
        <h1><?= Yii::t('frontend', 'Add bot') ?></h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_menu') ?>
        </div>

        <div class="col-md-8">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'meta_title')->textInput() ?>

            <?= $form->field($model, 'title')->textInput() ?>

            <?= $form->field($model, 'username')->textInput() ?>

            <?php /* $form->field($model, 'username', [
                'template' => "{label}\n<div class=\"input-group\">{input}\n<span class=\"input-group-btn\"><button class=\"btn btn-default\" type=\"button\"><span class=\"glyphicon glyphicon-refresh\" aria-hidden=\"true\"></span></button></span></div>\n{hint}\n{error}"
            ]) */?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'image')->fileInput() ?>

            <?= $form->field($model, 'default_category_id')->dropDownList($categoryList, ['prompt' => '-- Выбор категории --', 'class' => 'turnintodropdown']) ?>

            <?= $form->field($model, 'category_ids')->dropDownList($categoryList, ['multiple' => true, 'class' => 'turnintodropdown']) ?>

            <?= $form->field($model, 'language_ids')->dropDownList($botLanguageList, ['multiple' => true, 'class' => 'turnintodropdown']) ?>

            <?= $form->field($model, 'token')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'Add bot'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
