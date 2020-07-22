<?php

use yii\helpers\Html;

$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>

<div class="order_completed">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Yêu cầu trở thành editor thành công.</p>
</div>