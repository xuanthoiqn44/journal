<?php
$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>
    Hello <?= $user->username ?>,
    Có 1 bài viết đang chờ đợi bạn chỉnh sửa, nhấn vào link sau đây để đi tới trang chỉnh sửa:
<?= $orderlink ?>