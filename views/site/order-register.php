<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(['id' => 'order-register']); ?>
<?= $form->field($model, 'FirstName')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'LastName')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'EmailID')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'Password')->passwordInput() ?>
<?= $form->field($model, 'ConfirmPassword')->passwordInput() ?>
<div class="container-login100-form-btn m-t-20">

    <?= Html::submitButton('Register', ['class' => 'login100-form-btn', 'name' => 'register-button']) ?>
</div>
<?php ActiveForm::end(); ?>
