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
            <?php if(isset($error_warning)) { ?>
            <div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> <?= $error_warning ?>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
            <?php } ?>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($model, 'meta_title')->textInput() ?>

            <?= $form->field($model, 'title')->textInput() ?>

            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'image')->fileInput() ?>

            <?= $form->field($model, 'default_category_id')->dropDownList($categoryList, ['prompt' => '-- Выбор категории --']) ?>

            <?= $form->field($model, 'category_ids')->dropDownList($categoryList, ['multiple' => true]) ?>

            <?= $form->field($model, 'language_ids')->dropDownList($botLanguageList, ['multiple' => true]) ?>

            <?= $form->field($model, 'token')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'Add bot'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
