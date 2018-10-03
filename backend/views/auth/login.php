<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?php if(isset($error)) { ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php } else { ?>
        <p class="login-box-msg"><?= Yii::t('backend', 'Sign in to start your session') ?></p>
        <?php } ?>

        <p class="text-center">
            <?= Yii::$app->params['tg_widget'] ?>
        </p>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
