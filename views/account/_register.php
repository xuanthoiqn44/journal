<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
?>

<!-- Login Modal -->

<div class="modal-dialog modal-ctn">

    <div class="modal-content">

        <div class="modal-body" style="text-align:left;">

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            <?php $form = ActiveForm::begin(['id' => 'registration-form','enableAjaxValidation' => true]); ?>
            <span class="login100-form-title p-b-33">
                        Register
                    </span>
            <?= $form->field($model, 'FirstName')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'LastName')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'EmailID')->textInput(['autofocus' => true]) ?>
            <label class="control-label" for="registerform-phone_number">Phone  Number</label>
            <?= $form->field($model, 'Phone_Number')->widget(PhoneInput::className(), [
                'jsOptions' => [
                    'preferredCountries' => ['vn', 'us'],
                    //'nationalMode' => false
                ]
            ])->label(false);?>
            <?= $form->field($model, 'Password')->passwordInput() ?>
            <?= $form->field($model, 'ConfirmPassword')->passwordInput() ?>
            <div class="container-login100-form-btn m-t-20">

                <?= Html::submitButton('Register', ['class' => 'login100-form-btn', 'name' => 'register-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>