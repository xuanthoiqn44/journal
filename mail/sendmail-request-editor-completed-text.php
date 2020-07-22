<?php
$orderlink = Yii::$app->urlManager->createAbsoluteUrl(['user/my-order']);
?>
    Hello <?= $user->username ?>,
    Đã có editor chấp nhận sửa bài viết, nhấn vào link sau đây để xem quá trình chỉnh sửa bài viết:
<?= $orderlink ?>