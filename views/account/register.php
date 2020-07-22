<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;

$this->title = 'Register';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
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



