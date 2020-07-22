<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\grid\GridView;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Completed Post</h4>
                        <!--<p class="card-category"> Here is a subtitle for this table</p>-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel'=>$searchModel,
                                'filterPosition' => \yii\grid\GridView::FILTER_POS_HEADER,
                                //'layout'=>"{pager}\n{summary}\n{items}",
                                'summary'=> "",
                                'id' => 'table',

                                'columns' => [
                                    [
                                        'class' => 'yii\grid\SerialColumn',
                                        //'value'=>'N0',
                                    ],
                                    /*[
                                        'attribute'=>'Image',
                                        'label'=>'Picture',
                                        'contentOptions' =>function ($model, $key, $index, $column){
                                            return ['class' => '_image'];
                                        },
                                        'content'=>function($data){
                                            return "<div class='_image_user'><img src=".Url::to('@web/assets/img/bg-img/writer-3d087f6f2bb692adca3616965214164cf8ad9d4f2ce8c50f2c8196144270c941.png')."></div>"."<a href=".Yii::$app->urlManager->createAbsoluteUrl('writers/id/'.$data->id).">View profile</a>";
                                        }
                                    ],*/
                                    [
                                        'attribute'=>'Id',
                                        'label' => "ID Post",
                                        'value' => "id",
                                        'headerOptions' => ['style' => 'width:10%'],
                                        'content' =>function ($model) {
                                            //return "<div class='pull-left break-word'><a href=".Url::to('all-post/id/'.$model->id)." title='click for details Post'>$model->Topic</a></div>";
                                            return "<div class='pull-left break-word'><a href=".Url::toRoute(['all-post','id'=>$model->id])." title='click for details Post'>$model->id</a></div>";
                                            //return "<a href=".Yii::$app->urlManager->createAbsoluteUrl('admid/all-post?id='.$model->id).">$model->Topic</a>";
                                            //return "<span >".$model->Rating."/5</span>";
                                        },
                                    ],

                                    [
                                        'label' => 'ID User create',
                                        'attribute'=>'Id_User',
                                        'enableSorting' => true,
                                        //'value' => 'Topic',
                                        'headerOptions' => ['style' => 'width:20%'],
                                        'content' =>function ($model) {

                                            return "<div class='pull-left break-word'><a href=".Url::toRoute(['manage-user','id'=>$model->Id_Author])." title='click for details User'>$model->Id_Author</a></div>";

                                        },
                                    ],
                                    [
                                        'label' => 'ID Editor ',
                                        'attribute'=>'Id_Editor',
                                        'enableSorting' => true,
                                        //'value' => 'Topic',
                                        'headerOptions' => ['style' => 'width:20%'],
                                        'content' =>function ($model) {

                                            return "<div class='pull-left break-word'><a href=".Url::toRoute(['editor','id'=>$model->Id_Editor])." title='click for details Editor'>$model->Id_Editor</a></div>";

                                        },
                                    ],
                                    [
                                        'label' => 'Date Create',
                                        'enableSorting' => true,
                                        'attribute'=>'Date_Create',
                                        'value' => 'Date_Create',

                                    ],
                                    [
                                        'label' => 'Dead Line',
                                        'attribute'=>'Dead_Line',
                                        'value' => 'Deadline',
                                        'enableSorting' => true,
                                        //'filter'=> Html::activeDropDownList($searchModel,'Completed_order',app\models\Editor::getOrderPlus(),['class' => 'form-control']),
                                    ],
                                    [
                                        'label' => 'Date Edit',
                                        'attribute'=>'Date_Edit',
                                        'value' => 'Date_Edit',
                                        'enableSorting' => true,
                                        //'filter'=> Html::activeDropDownList($searchModel,'Completed_order',app\models\Editor::getOrderPlus(),['class' => 'form-control']),
                                    ],
                                    [
                                        'label' => 'Date Completed',
                                        'attribute'=>'Date_Finish',
                                        'value' => 'Date_Finish',
                                        'enableSorting' => true,
                                        //'filter'=> Html::activeDropDownList($searchModel,'Completed_order',app\models\Editor::getOrderPlus(),['class' => 'form-control']),
                                    ],
                                    [
                                        'label' => 'Status',
                                        //'attribute'=>'Status',
                                        'enableSorting' => true,
                                        'content' =>function ($model) {
                                        if ($model->Status == 'New') {
                                            return "<a class='text-primary'>$model->Status</a>";
                                        }
                                        elseif ($model->Status == 'Completed')
                                        {
                                            return "<a class='text-completed'>$model->Status</a>";
                                        }
                                        else
                                        {
                                            return "<a class='text-process'>$model->Status</a>";
                                        }
                                            //return $model->Status=='1'?"<span style='color:green;'>Open to suggestions</span>":"<span style='color: #99A3BF;'>Searching for orders</span>";

                                        },

                                    ],

                                    [
                                        'label' => 'Information',
                                        //'attribute'=>'topic',
                                        'enableSorting' => true,
                                        //'value' => 'Topic',
                                        'headerOptions' => ['style' => 'width:20%'],
                                        'content' =>function ($model) {

                                            return "<div class='pull-left break-word'><a href=".Url::toRoute(['detail-salary-post','id'=>$model->id])." title='click for details Salary Post'>Details</a></div>";

                                        },
                                    ],

                                ],
                            ])?>



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
