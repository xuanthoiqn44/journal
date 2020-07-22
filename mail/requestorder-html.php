<?php

use yii\helpers\Html;

$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>

<div class="order_completed">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Đã có người chọn bạn để thực hiện dự án</p>
</div>