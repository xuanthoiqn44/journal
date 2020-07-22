<?php
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['account/verify-account', 'token' => $user->Auth_key]);
?>
    Hello <?= $user->username ?>,
    Follow the link below to reset your password:
<?= $resetLink ?>