<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\bootstrap\Modal;
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">User Profile</h4>
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
                                        ->textInput(['autofocus' => true,'disabled' => true]
                                        ) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'Phone_Number',[
                                        'template' => '<div class="form-group bmd-form-group">{label}{input}{error}</div>'])
                                        ->textInput(['autofocus' => true,'disabled' => true]
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
                        <div class="row">
                            <div class="col-md-6">
                        <?= Html::submitButton('Update Profile', ['class' => 'btn btn-primary']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                            <div class="col-md-6">
                        <?= $user->editors?'':Html::a('Add to editor',['admin/add-editor','id'=>$model->id],['class'=>'btn btn-primary pull-left'])?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <?php echo Html::img( $model->Image?'@web/upload_img_user/'.$model->Image:'@web/upload_img_user/bg-img/default-user.png', ['class' => 'img']); ?>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>