<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add User</h4>
                        <p class="card-category">Complete your profile</p>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
                            <div class="row">

                                <div class="col-md-3">

                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <?= $form->field($model, 'FirstName',[
                                            'template' => '<div class="form-group bmd-form-group">{label}{input}{error}</div>'])
                                            ->textInput(['autofocus' => true,]
                                            ) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'LastName',[
                                        'template' => '<div class="form-group bmd-form-group">{label}{input}{error}</div>'])
                                        ->textInput(['autofocus' => true,]
                                        ) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'EmailID',[
                                        'template' => '<div class="form-group bmd-form-group">{label}{input}{error}</div>'])
                                        ->textInput(['autofocus' => true,]
                                        ) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'Phone_Number',[
                                        'template' => '<div class="form-group bmd-form-group">{label}{input}{error}</div>'])
                                        ->textInput(['autofocus' => true,]
                                        ) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'Password',[
                                        'template' => '<div class="form-group bmd-form-group">{label}{input}{error}</div>'])
                                        ->passwordInput(['autofocus' => true,]
                                        ) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'ConfirmPassword',[
                                        'template' => '<div class="form-group bmd-form-group">{label}{input}{error}</div>'])
                                        ->passwordInput(['autofocus' => true,]
                                        ) ?>
                                </div>
                            </div>
                        <?= Html::submitButton('Add User', ['class' => 'btn btn-primary pull-right']) ?>
                            <div class="clearfix"></div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>