<?php

use yii\helpers\Url;
use yii\helpers\Html;

$isGuest = Yii::$app->user->isGuest;

\frontend\assets\AppAsset::register($this);

$js = <<< 'SCRIPT'
/* To initialize BS3 tooltips set this below */
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});;
/* To initialize BS3 popovers set this below */
$(function () {
    $("[data-toggle='popover']").popover();
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?= $this->render('_header', [
            'isGuest' => $isGuest,
            'user' => !$isGuest ? Yii::$app->user->identity : null,
        ]) ?>

        <?= $this->render('_content', [
            'content' => $content
        ]) ?>
    </div>

    <?= $this->render('_footer', [

    ]) ?>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
