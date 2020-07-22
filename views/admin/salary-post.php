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
use kartik\rating\StarRating;

?>
<?php /*foreach ($order_post as $order){
    print($order);
}*/?>

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
                                        <label class="bmd-label-floating">Author's ID:</label>
                                    <p><?= $order_post->Id_Author?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Payment Method:</label>
                                    <p><?= $order_post->Payment_Method?></p>
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
                                <label class="bmd-label-floating">Type of currency:</label>
                                <p><?=  $order_post->getNameService($order_post->Type_of_currency)?></p>
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
                        <?php if ($order_post->File_Editor_Completed != null){?>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                       <?php echo Html::a('File completed',['file','file'=>$order_post->File_Editor_Completed,'type'=>'editor_completed'],['class'=>'btn btn-primary pull-left']);?>
                            </div>
                        </div>
                        <?php }?>
                    </div>


                </div>
            </div>
            <?php if ($order_post->feedback != null){?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title mt-0"> Feedback</h4>
                            <!--<p class="card-category"> Here is a subtitle for this table</p>-->
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Date feedback:</label>
                                    <p><?= $order_post->feedback->Date_Time?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Rate:</label>

                                    <?php
                                    echo StarRating::widget([
                                        'name' => 'rating',
                                        'value' => $order_post->feedback->Rate,
                                        'pluginOptions' => ['disabled' => true, 'showClear' => false,'showCaption' => false]
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="bmd-label-floating">Content feedback:</label>
                                    <p><?= $order_post->feedback->Feedbacks?></p>
                                </div>
                            </div>
                            <hr>





                        </div>

                    </div>
                </div>
            <?php }?>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Editor</h4>
                        <p class="card-category"> </p>
                    </div>
                    <div class="card-body">


                            <div class="row">
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Salary for Editor:</label>
                                    <?php if ($order_post->feedback != null) {
                                        //$money = ($order_post->Price * 60)/100;
                                        $rate = (70 - (5*(5 - $order_post->feedback->Rate)));
                                        $money = ($order_post->Price * $rate)/100;
                                        echo '<p>$'.$money.'</p>';
                                    }else{
                                        $money = ($order_post->Price * 60)/100;
                                        echo '<p>$'.$money.'</p>';
                                    }
                                    ?>
                                    <p></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Editor Name:</label>
                                    <p><?php echo $order_post->editors->user->FirstName .' '.$order_post->editors->user->LastName?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Editor's ID:</label>
                                    <p><?php echo $order_post->editors->id?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Editor Phone:</label>
                                    <p><?= $order_post->editors->user->Phone_Number?></p>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Editor mail:</label>
                                    <p><?= $order_post->editors->user->EmailID?></p>
                                </div>
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Specialized:</label>
                                    <p><?= $order_post->editors->skillWriter->NameSkill?></p>
                                </div>

                            </div>
                        <?php if ($order_post->editors->File_Info_Editor != null){?>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo Html::a('Profile editor',['file','file'=>$order_post->editors->File_Info_Editor,'type'=>'editor'],['class'=>'btn btn-primary pull-left']);?>
                                </div>
                            </div>
                        <?php }?>

                    </div>
                </div>
            </div>

            <?php if ($order_post->Status_Salary_Editor == 'No'){?>
            <div class="col-md-3">
                <?php $form = ActiveForm::begin(); ?>
                <?= Html::submitButton('Submit Salary', ['class' => 'btn btn-primary pull-left']) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <?php }?>
    </div>
</div>
