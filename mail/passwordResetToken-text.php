<?php
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['account/reset-password', 'token' => $user->Password_reset_token]);
?>
    Hello <?= $user->username ?>,
    Follow the link below to reset your password:
<?= $resetLink ?>