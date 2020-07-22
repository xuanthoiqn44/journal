<?php

use yii\helpers\Html;

$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>

<div class="order_completed">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Your order has been completed click here for details:</p>
    <p><?= Html::a(Html::encode($orderlink), $orderlink) ?></p>
</div>