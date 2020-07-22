<?php

use yii\helpers\Html;

$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>

<div class="order_completed">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Đã có editor chấp nhận sửa bài viết, nhấn vào link sau đây để xem quá trình chỉnh sửa bài viết:</p>
    <p><?= Html::a(Html::encode($orderlink), $orderlink) ?></p>
</div>