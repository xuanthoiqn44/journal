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
                        <h4 class="card-title ">All Post</h4>
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
                                    [
                                        'label' => 'Topic',
                                        'headerOptions' => ['style' => 'width:20%'],
                                        'enableSorting' => true,
                                        //'value' => 'Topic',
                                        'content' =>function ($model) {
                                            return '<div class="pull-left break-word"><p>'.$model->Topic.'</p></div>';
                                        },
                                    ],
                                    [
                                        'label' => 'Type of service',
                                        'enableSorting' => true,
                                        'value' => 'Type_of_services',
                                        'content' =>function ($model) {
                                            return '<p>'.\app\models\Post::getNameService($model->Type_of_services).'<p>';
                                        },
                                    ],
                                    [
                                        'label' => 'Type of paper',
                                        'enableSorting' => true,
                                        'value' => 'Type_of_paper',
                                        'content' =>function ($model) {
                                            return '<p>'.\app\models\Post::getNameService($model->Type_of_paper).'<p>';
                                        },
                                    ],
                                    [
                                        'label' => 'Subject area',
                                        'enableSorting' => true,
                                        'value' => 'Subject_area',
                                        'content' =>function ($model) {
                                            return '<p>'.\app\models\Post::getNameService($model->Subject_area).'<p>';
                                        },
                                    ],
                                    [
                                        'label' => 'Dead Line',
                                        'value' => 'Deadline',
                                        'enableSorting' => true,
                                    ],
                                    [
                                        'label' => 'Date Finish',
                                        'value' => 'Date_Finish',
                                        'enableSorting' => true,
                                    ],
                                    [
                                        'label' => 'Status',
                                       // 'attribute'=>'Status',
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
                                        },

                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header'=>'Actions',
                                        'template' => '{view} {accept} {detail}',
                                        'buttons' => [

                                            //view button
                                            'view' => function ($url, $model) {
                                                return $model->Status == 'Waiting editor'?Html::a('<span class="fa fa-search"></span>View', $url, [
                                                    'title' => Yii::t('app', 'View post'),
                                                    'class'=>'btn btn-primary btn-xs',
                                                ]):'';
                                            },
                                            'accept' => function ($url, $model) {
                                                return $model->Status == 'Waiting editor'?Html::a('<span class="fa fa-check"></span>Accept', $url, [
                                                    'title' => Yii::t('app', 'Accept post'),
                                                    'class'=>'btn btn-primary btn-xs',
                                                ]):'';
                                            },
                                            'detail' => function ($url, $model) {
                                                return $model->Status == 'Waiting editor'?'':'<a class="text-primary" href="'.$url.'" style="text-decoration: underline;">View detail'.'</a>';
                                            },
                                        ],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                            if ($action === 'view') {
                                                $url =Url::to(['manage-editor/view/token/'.$model->Order_Code]);
                                                return $url;
                                            }
                                            elseif ($action === 'accept') {
                                                $url =Url::to(['manage-editor/accept','token'=>$model->Order_Code]);
                                                return $url;
                                            }
                                            elseif ($action === 'detail') {
                                                $url =Url::to(['manage-post','id'=>$model->id]);
                                                return $url;
                                            }
                                        }
                                    ],

                                    /*[
                                        'label' => 'Action',
                                        'content' =>function ($model) {
                                            return '<a class="text-primary" href="'.Url::to(['manage-editor','post'=>$model->id]).'" style="text-decoration: underline;">View detail'.'</a>';
                                        },
                                    ],*/



                                ],
                            ])?>



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
