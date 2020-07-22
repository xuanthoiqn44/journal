<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Profile';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="col-md-9 col-sm-9 col-xs-12">

            <?php $form = ActiveForm::begin(['id' => 'profile-user']); ?>
            <span class="login100-form-title p-b-33">
                        Profile
                    </span>
            <?= $form->field($model, 'FirstName')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'LastName')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'EmailID')->textInput(['autofocus' => true,'disabled'=>true]) ?>
            <?= $form->field($model, 'Phone_Number')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'Password')->passwordInput() ?>
            <?= $form->field($model, 'ConfirmPassword')->passwordInput() ?>
            <div class="container-login100-form-btn m-t-20">

                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'pf-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
    </div>

