<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\console\widgets\Table;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'My Order';
?>
<div class="col-md-9 col-sm-9 col-xs-12">
<h3>All Order</h3>
<hr>
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
                'value' => 'Topic',
                'content' =>function ($model) {
                    return "<div class='break-word'>"."<a href=".Url::toRoute(['my-order','id'=>$model->id])." title='click for details Post'".">".$model->Topic."</a>"."</div>";
                },
            ],
            [
                'label' => 'Date Create',
                'headerOptions' => ['style' => 'width:20%'],
                'enableSorting' => true,
                'value' => 'Date_Create',
                /*'content' =>function ($model) {
                    return '<div class="pull-left break-word"><p>'.$model->Topic.'</p></div>';
                },*/
            ],
            [
                'label' => 'Deadline',
                'headerOptions' => ['style' => 'width:20%'],
                'enableSorting' => true,
                'value' => 'Deadline',
                /*'content' =>function ($model) {
                    return '<div class="pull-left break-word"><p>'.$model->Topic.'</p></div>';
                },*/
            ],
            [
                'label' => 'Status Order',
                'headerOptions' => ['style' => 'width:20%'],
                'enableSorting' => true,
                'value' => 'Status_Order',
                /*'content' =>function ($model) {
                    return '<div class="pull-left break-word"><p>'.$model->Topic.'</p></div>';
                },*/
            ],
            [
                'label' => "Status",
                'headerOptions' => ['style' => 'width:20%'],
                'enableSorting' => true,
                'value' => 'Status',
                /*'content' =>function ($model) {
                    return '<div class="pull-left break-word"><p>'.$model->Topic.'</p></div>';
                },*/
            ],
            [
                'label' => "Your rating",
                //'headerOptions' => ['style' => 'width:20%'],
                'enableSorting' => true,
                'value' => 'feedback.Rate',
                'content' =>function ($model) {
                    return $model->feedback?$model->feedback->Rate:'<div class="pull-left "><p>'."No rating".'</p></div>';
                    //return $model->feedback?$model->feedback->Rate:"<div class=''>"."<a href=".Url::toRoute(['my-order','id'=>$model->id])." title='click for rating'".">"."Click for rating"."</a>"."</div>";
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template' => '{view} {rewrite}',
                'buttons' => [

                    //view button
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-search"></span>View', $url, [
                            'title' => Yii::t('app', 'View post'),
                            'class'=>'btn btn-primary btn-xs',
                        ]);
                    },
                    'rewrite' => function ($url, $model) {
                        return $model->Status =='Completed'?Html::a('<span class="fa fa-check"></span>Rewrite', $url, [
                            'title' => Yii::t('app', 'Rewrite post'),
                            'class'=>'btn btn-primary btn-xs',
                        ]):'';
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        //$url =Url::to(['manage-editor/view/token/'.$model->Order_Code]);
                        $url =Url::to(['my-order','id'=>$model->id]);
                        return $url;
                    }
                    elseif ($action === 'rewrite') {
                        $url =Url::to(['my-order/id/'.$model->id.'#rewrite']);
                        return $url;
                    }
                }
            ],


        ],
    ])?>
    </div>
</div>

