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
                        <h4 class="card-title ">Request Post</h4>
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
                                    ],
                                    [
                                        'label' => 'Topic',
                                        'enableSorting' => true,
                                        'value' => 'Topic',
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
                                            'class' => 'yii\grid\ActionColumn',
                                        'header'=>'Actions',
                                        'template' => '{view} {accept}',
                                        'buttons' => [

                                            //view button
                                            'view' => function ($url, $model) {
                                                return Html::a('<span class="fa fa-search"></span>View', $url, [
                                                    'title' => Yii::t('app', 'View post'),
                                                    'class'=>'btn btn-primary btn-xs',
                                                ]);
                                            },
                                            'accept' => function ($url, $model) {
                                                return Html::a('<span class="fa fa-check"></span>Accept', $url, [
                                                    'title' => Yii::t('app', 'Accept post'),
                                                    'class'=>'btn btn-primary btn-xs',
                                                ]);
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

