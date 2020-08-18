<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
?>
<div class="col-md-3 col-sm-3 col-xs-12 _menu-us">
    <div class="my-info">
        <div class="profile">
            <!--<div class="upload-img">-->
            <div class="profile-image">
                <?php echo Html::img( Yii::$app->user->identity->getImage()?'@web/upload_img_user/'.Yii::$app->user->identity->getImage():'@web/upload_img_user/bg-img/default-user.png', ['class' => 'pull-left img-responsive']); ?>
            </div>

            <!--</div>-->
            <div class="my-name">
                <span class="name"><?php echo Yii::$app->user->identity->getUsername(); ?></span>
                <p class=" "><?php echo Yii::$app->user->identity->getId();?></p>
                <span class="online"><?=\Yii::t('app', 'Online')?></span>
            </div>




        </div>
        <div class="upload-img">
            <?php
            Modal::begin([
                'header' => '<h4>' . \Yii::t('app', 'Upload') . '</h4>',
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-camera"></i> ' . \Yii::t('app', 'Upload'),

                    'class'=>'btn btn-primary'
                ],

            ]);
            $form = ActiveForm::begin(['id' => 'upload-image','options'=>['enctype'=>'multipart/form-data'],'action'=>Url::to(['user/upload-file']
            )]);

            echo FileInput::widget([
                'model' => $model,
                'attribute'=>'upload_file',
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showCaption' => false,
                    //'elCaptionText' => '#customCaption'
                ]
            ]);
            ActiveForm::end();
            //Html::endForm();
            Modal::end();
            ?>
        </div>
        <div class="all-orders">
            <ul class="info-orders">
                <li>
                    <a class="profile-link <?php if ($active == 'profile'){echo 'active';}?> " href="<?php echo Url::to(['user/profile'])?>">
                        <span class="big"><?=\Yii::t('app', 'Profile')?></span>
                    </a>
                </li>
                <li>
                    <a class="profile-link <?php if ($active == 'my-order'){echo 'active';}?>" href="<?php echo Url::to(['user/my-order'])?>">
                        <span class="big"><?=\Yii::t('app', 'My Orders')?></span>
                    </a>
                    <ul class="mini  "></ul>
                </li>
                <!--<li class="li">
                    <a class="profile-link <?php if ($active == 'my-order-completed'){echo 'active';}?>" href="<?php echo Url::to(['user/my-order-completed'])?>">
                        <span class="big">My Orders Completed</span>
                    </a>
                </li>-->
                <li class="li">
                    <a class="profile-link <?php if ($active == 'feedbacks'){echo 'active';}?>" href="<?php echo Url::to(['user/feedbacks'])?>">
                        <span class="big"><?=\Yii::t('app', 'My Feedbacks')?></span>
                    </a>
                </li>
            </ul>

        </div>


    </div>
</div>