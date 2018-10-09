<?php

use yii\helpers\Html;

?>
<div class="page-comment">
    <?= Html::a('@' . $comment->author, 'http://t.me/' . $comment->author, ['class' => 'comment-username', 'target' => '_blank']) ?>

    <p><?= $comment->content ?></p>
</div>
