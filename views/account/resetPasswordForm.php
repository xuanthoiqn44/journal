<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
            <span class="login100-form-title p-b-33">
                        <?= Html::encode($this->title) ?>

                    </span>
            <p>Please choose your new password:</p>
            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

            <div class="container-login100-form-btn m-t-20">


                <?= Html::submitButton('Save', ['class' => 'login100-form-btn','name'=>'verify-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
