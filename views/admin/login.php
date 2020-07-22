<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<!-- Login Modal-->

<div class="modal-dialog">

    <div class="modal-content">

        <div class="modal-body" style="text-align:left;">

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            <?php $form = ActiveForm::begin(['id' => 'login-form','enableAjaxValidation' => false]); ?>

            <span class="login100-form-title p-b-33">
                        Account Login
                    </span>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= Yii::$app->session->getFlash('message'); ?>
            <div class="container-login100-form-btn m-t-20">
                <?= Html::submitButton('Sign in', ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
            </div>




            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>



