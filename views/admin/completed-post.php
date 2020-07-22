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
                                //'filterModel'=>$searchModel,
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
                                        //'attribute'=>'Id',
                                        'label' => "ID",
                                        'value' => "id",
                                        'headerOptions' => ['style' => 'width:10%'],
                                    ],

                                    [
                                        'label' => 'Topic',
                                        //'attribute'=>'topic',
                                        'enableSorting' => true,
                                        //'value' => 'Topic',
                                        'headerOptions' => ['style' => 'width:20%'],
                                        'content' =>function ($model) {
                                            //return "<div class='pull-left break-word'><a href=".Url::to('all-post/id/'.$model->id)." title='click for details Post'>$model->Topic</a></div>";
                                            return "<div class='pull-left break-word'><a href=".Url::toRoute(['all-post','id'=>$model->id])." title='click for details Post'>$model->Topic</a></div>";
                                            //return "<a href=".Yii::$app->urlManager->createAbsoluteUrl('admid/all-post?id='.$model->id).">$model->Topic</a>";
                                            //return "<span >".$model->Rating."/5</span>";
                                        },
                                    ],
                                    [
                                        'label' => 'Date Create',
                                        'enableSorting' => true,
                                        //'attribute'=>'Date_Create',
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
                                        'label' => 'Date Completed',
                                        //'attribute'=>'Dead_Line',
                                        'value' => 'Date_Finish',
                                        'enableSorting' => true,
                                        //'filter'=> Html::activeDropDownList($searchModel,'Completed_order',app\models\Editor::getOrderPlus(),['class' => 'form-control']),
                                    ],
                                    /*[
                                        'label' => 'Order Token',
                                        //'attribute'=>'Token_Order',
                                        'value' => 'Token_Order',
                                        'enableSorting' => true,
                                        //'filter'=> Html::activeDropDownList($searchModel,'Completed_order',app\models\Editor::getOrderPlus(),['class' => 'form-control']),
                                    ],*/
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
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => 'Salary',
                                        //'headerOptions' => [],
                                        'template' => '{order}',
                                        'buttons' => [
                                            'order' => function ($url, $model) {
                                                return Html::a('<button class="btn _writer_order">Salary for editor</button>', $url, [
                                                    'title' => Yii::t('app', 'Salary for editor'),
                                                ]);
                                            },
                                        ],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                            if ($action === 'order') {
                                                $url ='salary-editor/post_id/'.$model->id;
                                                return $url;
                                            }


                                        }
                                    ],

                                ],
                            ])?>



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
