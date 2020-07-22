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
                        <h4 class="card-title ">All Feedback</h4>
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
                                    [
                                        'attribute'=>'Id_Order',
                                        'label' => "Order ID",
                                        'value' => "Id_Order",
                                        'headerOptions' => ['style' => 'width:10%'],
                                        'content' =>function ($model) {
                                            return "<div class='break-word'>"."<a href=".Url::toRoute(['all-post','id'=>$model->post->id])." title='click for details User'".">".$model->Id_Order."</a>"."</div>";
                                        },
                                    ],
                                    [
                                        'label' => 'Name User Create',
                                        //'attribute'=>'Id_User',
                                        //'enableSorting' => true,
                                        //'value' => 'post.user.LastName',
                                        'content' =>function ($model, $key, $index, $column) {
                                            //return "<div class='pull-left break-word'><a href=".Url::toRoute(['request-editor','id'=>$model->id])." title='click for details Post'>$model->user->LastName</a></div>";
                                            return "<div class='break-word'>"."<a href=".Url::toRoute(['manage-user','id'=>$model->post->user->id])." title='click for details User'".">".$model->post->user->FirstName.' '.$model->post->user->LastName."</a>"."</div>";
                                        },
                                    ],
                                    [
                                        'label' => 'ID Editor',
                                        //'attribute'=>'Id_User',
                                        //'enableSorting' => true,
                                        'value' => 'post.Id_Editor',
                                    ],
                                    [
                                        'label' => 'Date Feedback',
                                        //'enableSorting' => true,
                                        'attribute'=>'Date_Time',
                                        'value' => 'Date_Time',

                                    ],
                                    [
                                        'label' => 'Feedback',
                                        //'enableSorting' => true,
                                        //'attribute'=>'Date_time',
                                        'value' => 'Feedbacks',
                                    ],
                                    [
                                        'label' => 'Rate',
                                        //'enableSorting' => true,
                                        'attribute'=>'Rate',
                                        'value' => 'Rate',
                                    ],

                                ],
                            ])?>



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
