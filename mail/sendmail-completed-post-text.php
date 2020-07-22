<?php
$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>
    Hello <?= $user->username ?>,
    Bài viết của bạn đã hoàn thành, nhấn vào link sau đây để đi tới bài viết của bạn:
<?= $orderlink ?>