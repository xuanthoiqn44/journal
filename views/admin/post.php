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
                        <hr>
                        <?php if ($order_post->File_Name != null){?>
                        <div class="row">

                            <div class="col-md-12">
                                <?php echo Html::a('File',['file','file'=>$order_post->File_Name,'type'=>'post'],['class'=>'btn btn-primary pull-left']);?>
                            </div>

                        </div>

                        <?php }?>

                    </div>

                </div>
            </div>


            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Editor</h4>
                        <p class="card-category"> </p>
                    </div>
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="card-body">
                        <?php if ($order_post->Id_Editor == 0){?>
                            <div class="table-responsive">

                                <?=
                                GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'summary'=> "",
                                    'id' => 'table',

                                    'columns' => [
                                        [
                                            //'attribute'=>'Profile',
                                            //'class' => 'yii\grid\CheckboxColumn',
                                            'class' => 'yii\grid\RadioButtonColumn',
                                        ],
                                        [
                                            'attribute'=>'Profile',
                                            'label'=>'Profile',
                                            'contentOptions' =>function ($model, $key, $index, $column){
                                                return ['class' => '_image'];
                                            },
                                            'content'=>function($data){
                                                return "<a href=".Url::toRoute(['editor','id'=>$data->id]).">View profile</a>";
                                                //return "<a href=".Yii::$app->urlManager->createAbsoluteUrl('writers/id/'.$data->id).">View profile</a>";
                                            }
                                        ],

                                        [
                                            'attribute'=>'Writer_id',
                                            'label' => "Writer's ID",
                                            'value' => 'id',
                                            'headerOptions' => ['style' => 'width:20%'],

                                        ],
                                        [
                                            'label' => 'Rating',
                                            'attribute'=>'Rating',
                                            'enableSorting' => false,
                                            //'value' => 'Score',
                                            'content' =>function ($model) {
                                                return "<span >".$model->Rating."/5</span>";
                                            },
                                        ],
                                        [
                                            'label' => 'Skill',
                                            'enableSorting' => false,
                                            //'attribute'=>'Skill_Writer',
                                            'value' => 'Chuyen_Nganh',

                                        ],
                                        [
                                            'label' => 'Completed orders',
                                            'attribute'=>'Completed_order',
                                            'enableSorting' => false,
                                            'value' => 'Completed_order',
                                            'enableSorting' => false,

                                        ],
                                        [
                                            'label' => 'Status',
                                            'attribute'=>'Status',
                                            'enableSorting' => false,
                                            'content' =>function ($model) {

                                                return $model->Status=='1'?"<span style='color:green;'>Open to suggestions</span>":"<span style='color: #99A3BF;'>Searching for orders</span>";

                                            },

                                        ],
                                    ],
                                ])?>
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary pull-left']) ?>
                                <div class="clearfix"></div>
                            </div>
                        <?php }else{?>

                            <div class="row">
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
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Editor mail:</label>
                                    <p><?= $order_post->editors->user->EmailID?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="bmd-label-floating">Specialized:</label>
                                    <p><?= $order_post->editors->skillWriter->NameSkill?></p>
                                </div>

                            </div>


                        <?php }?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>


        </div>
    </div>
</div>
