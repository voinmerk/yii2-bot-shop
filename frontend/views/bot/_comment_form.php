<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\ActiveForm;
// use yii\widgets\Pjax;

?>
<?php if(!empty($comment_success)) { ?>
<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> <?= $comment_success ?>
    <button type="button" class="close" data-dismiss="alert">×</button>
</div>
<?php } ?>

<?php if(!empty($comment_error)) { ?>
<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> <?= $comment_error ?>
    <button type="button" class="close" data-dismiss="alert">×</button>
</div>
<?php } ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($commentForm, 'bot_id')->hiddenInput(['value' => $bot_id])->label(false); ?>

<?= $form->field($commentForm, 'comment')->textarea(['rows' => 3]) ?>

<div class="form-group clearfix">
    <?= Html::submitButton(Yii::t('frontend', '{icon} Send', ['icon' => FA::icon('paper-plane-o')]), ['class' => 'btn btn-primary btn-flat pull-right']) ?>
</div>

<?php ActiveForm::end(); ?>
