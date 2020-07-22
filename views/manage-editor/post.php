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
                        <h4 class="card-title "><?= $order_post->Topic?></h4>
                        <!--<p class="card-category"> Here is a subtitle for this table</p>-->
                    </div>

                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                        <label class="bmd-label-floating">Deadline:</label>
                                    <p><?= $order_post->Deadline?></p>
                                </div>
                                <div class="col-md-3">
                                        <label class="bmd-label-floating">Price:</label>
                                    <p><?php if($order_post->getNameService($order_post->Type_of_currency) == 'USD'){
                                        echo '$'.$order_post->Price;
                                        }else{
                                            echo 'đ'.$order_post->Price;
                                        }?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Your salary:</label>
                                    <p><?= $order_post->Money_Editor?$order_post->Money_Editor:'---------------'; ?></p>
                                </div>
                            </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="bmd-label-floating">Status:</label>
                                <p><?= $order_post->Status?></p>
                            </div>
                            <div class="col-md-3">
                                <label class="bmd-label-floating">Status Order:</label>
                                <p><?= $order_post->Status_Order?></p>
                            </div>

                            <div class="col-md-3">
                                <label class="bmd-label-floating">Page Numbers:</label>
                                <p><?=  $order_post->PageNumbers?></p>
                            </div>

                        </div>
                        <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Subject area: </label>
                                    <p><?=  $order_post->getNameService($order_post->Subject_area)?></p>
                                </div>
                                <div class="col-md-3">
                                        <label class="bmd-label-floating">Type of service:</label>
                                    <p><?=  $order_post->getNameService($order_post->Type_of_services)?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Type of paper: </label>
                                    <p><?=  $order_post->getNameService($order_post->Type_of_paper)?></p>
                                </div>
                            </div>
                        <hr>
                            <div class="row">

                                <div class="col-md-12">
                                        <label class="bmd-label-floating">Paper details</label>
                                    <p><?= $order_post->Decription?></p>
                                </div>

                            </div>
                        <hr>
                        <?php if ($order_post->File_Name != null){?>
                        <div class="row">

                            <div class="col-md-2">
                                <?php echo Html::a('Old File',['file','file'=>$order_post->File_Name,'type'=>'post'],['class'=>'btn btn-primary pull-left']);?>
                            </div>


                        </div>

                        <?php }?>
                        <hr>
                        <?php if ($order_post->Status == "Process"){?>
                            <div class="row">
                                <div class="col-md-3">
                                    <?php
                                    $upload_file = new \app\models\UploadFile();
                                    $form = ActiveForm::begin([
                                        'id' => 'upload_file',
                                        //'enableAjaxValidation' => true,
                                        'enableClientValidation'=>true,]);
                                    echo $form->field($upload_file, 'upload_file_editor_completed',[
                                        'template' => '<div class="order-form-group"><div class="">{label}</div><div class="col-md-9">{input}{error}</div></div>'])->fileInput();
                                    echo Html::submitButton('Complete Order',['class'=>'btn btn-primary pull-left']);
                                    ActiveForm::end();
                                  ?>
                                </div>
                            </div>
                        <?php }?>

                    </div>

                </div>
            </div>





        </div>
    </div>
</div>
