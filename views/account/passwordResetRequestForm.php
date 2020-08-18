<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = \Yii::t('app', 'Request password reset');
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <span class="login100-form-title p-b-33">
                        <?= Html::encode($this->title) ?>

                    </span>

            <?= $form->field($model, 'EmailID')->textInput(['autofocus' => true])->label('Email') ?>

            <div class="container-login100-form-btn m-t-20">

                <?= Html::submitButton(\Yii::t('app', 'Reset'), ['class' => 'login100-form-btn', 'name' => 'reset-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>



