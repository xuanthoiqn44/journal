<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<!-- Login Modal-->

<div class="modal-dialog">

    <div class="modal-content">

        <div class="modal-body" style="text-align:left;">

            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->

            <?php $form = ActiveForm::begin(['id' => 'login-form','enableAjaxValidation' => false]); ?>

            <span class="login100-form-title p-b-33">
                <?=\Yii::t('app', 'Login')?>
            </span>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= Yii::$app->session->getFlash('message'); ?>
            <div class="container-login100-form-btn m-t-20">
                <?= Html::submitButton(\Yii::t('app', 'Login'), ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
            </div>

            <div class="text-center p-t-45 p-b-4">
                        <span class="txt1">
                        <?=\Yii::t('app', 'Forgot')?>
                        </span>

                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('account/request-password-reset'); ?>" class="txt2 hov1">
                <?=\Yii::t('app', 'Password')?>?
                </a>
            </div>

            <div class="text-center">
                        <span class="txt1">
                        <?=\Yii::t('app', 'Create an account')?>?
                        </span>
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('account/register'); ?>" class="txt2 hov1">
                <?=\Yii::t('app', 'Register')?>
                </a>
            </div>
            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>



