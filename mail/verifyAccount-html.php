<?php

use yii\helpers\Html;
?>

<div class="password-reset">
    <p>Hello <?= Html::encode($fullName) ?>,</p>
    <p>Follow the link below to reset your password:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>