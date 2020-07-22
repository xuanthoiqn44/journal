<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/1/2018
 * Time: 12:03 PM
 */
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInput;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\bootstrap\Modal;

?>
<?php /*foreach ($order_post as $order){
    print($order);
}*/?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title "><?= $info_editor->user->LastName.' '.$info_editor->user->FirstName?></h4>
                            <input type="hidden" class="rating" data-readonly value="<?= $info_editor->Rating ?>"/>
                        <!--<p class="card-category"> Here is a subtitle for this table</p>-->
                    </div>

                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                        <label class="bmd-label-floating">ID:</label>
                                    <p><?= $info_editor->id?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Email:</label>
                                    <p><?= $info_editor->user->EmailID?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Phone Number:</label>
                                    <p><?= $info_editor->user->Phone_Number?></p>
                                </div>
                            </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="bmd-label-floating">Status:</label>
                                <?php
                                if ($info_editor->Status_Active == '2') {
                                    echo "<p class='text-completed'>Active</p>";
                                }
                                elseif ($info_editor->Status_Active == '1')
                                {
                                    echo "<p class='text-block'>Block</p>";
                                }
                                else
                                {
                                    echo "<p class='text-process'>Request to editor</p>";
                                }?>
                            </div>
                            <div class="col-md-3">
                                <label class="bmd-label-floating">Specialized:</label>
                                <p><?= $info_editor->skillWriter->NameSkill?></p>
                            </div>
                            <div class="col-md-3">
                                <label class="bmd-label-floating">Completed Order:</label>
                                <p><?= $info_editor->Completed_order?></p>
                            </div>
                            <div class="col-md-3">
                                <label class="bmd-label-floating">Order Process:</label>
                                <p><?= $info_editor->Order_Process?></p>
                            </div>
                        </div>
                        <hr>
                            <div class="row">

                                <?php if($info_editor->File_Info_Editor!=null){
                                    echo Html::a('Profile Editor',['file','file'=>$info_editor->File_Info_Editor,'type'=>'editor'],['class'=>'btn btn-primary pull-right']);
                                }else{?>
                                    <div class="upload-img">
                                        <?php
                                        Modal::begin([
                                            'header' => '<h4>Upload your file</h4>',
                                            'toggleButton' => [
                                                'label' => '<i class="glyphicon glyphicon-file"></i> Upload your profile',

                                                'class'=>'btn btn-primary'
                                            ],

                                        ]);
                                        $form = ActiveForm::begin(['id' => 'upload-profile','options'=>['enctype'=>'multipart/form-data']]);


                                        echo FileInput::widget([
                                            'model' => $model,
                                            'attribute'=>'upload_file_editor',
                                            //'options' => ['accept' => 'image/*'],
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
                                <?php }?>
                                <?php if ($info_editor->Status_Active == 0){?>
                                <?php $form = ActiveForm::begin(); ?>
                                <?= Html::submitButton('Accept Editor',['class'=>'btn btn-primary pull-right']);?>
                                <?php ActiveForm::end(); ?>

                                <?php }?>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
