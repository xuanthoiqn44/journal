<?php

use yii\helpers\Html;

$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>

<div class="order_completed">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Có 1 bài viết đang chờ đợi bạn chỉnh sửa, nhấn vào link sau đây để đi tới trang chỉnh sửa:</p>
    <p><?= Html::a(Html::encode($orderlink), $orderlink) ?></p>
</div>