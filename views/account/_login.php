<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<!-- Login Modal-->

<div class="modal-dialog modal-ctn">

    <div class="modal-content">

        <div class="modal-body" style="text-align:left;">

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            <?php $form = ActiveForm::begin(['id' => 'login-form','enableAjaxValidation' => true]); ?>

            <span class="login100-form-title p-b-33">
                        Account Login
                    </span>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= Yii::$app->session->getFlash('message'); ?>
            <div class="container-login100-form-btn m-t-20">
                <?= Html::submitButton('Sign in', ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
            </div>

            <div class="text-center p-t-45 p-b-4">
                        <span class="txt1">
                            Forgot
                        </span>

                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('account/request-password-reset'); ?>" class="txt2 hov1">
                    Password?
                </a>
            </div>

            <div class="text-center">
                        <span class="txt1">
                            Create an account?
                        </span>
                <a href="javascript:void(0);" class="txt2 hov1" onclick="register();return false;">Register</a>
            </div>
            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>



