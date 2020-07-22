<?php
$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>
    Hello <?= $user->username ?>,
    Your order has been completed click here for details:
<?= $orderlink ?>