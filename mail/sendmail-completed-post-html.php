<?php

use yii\helpers\Html;

$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>

<div class="order_completed">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Bài viết của bạn đã hoàn thành, nhấn vào link sau đây để đi tới bài viết của bạn:</p>
    <p><?= Html::a(Html::encode($orderlink), $orderlink) ?></p>
</div>