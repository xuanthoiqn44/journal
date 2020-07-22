<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\console\widgets\Table;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'My Feedback';
?>
<div class="col-md-9 col-sm-9 col-xs-12">
<h3>My feedback</h3>
<hr>
<div  class="table table-bordered table-responsive">
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
                    return "<div class='break-word'>"."<a href=".Url::toRoute(['my-order','id'=>$model->id])." title='click for details Post'".">".$model->Topic."</a>"."</div>";
                },
            ],
            [
                'label' => 'Date time',
                'headerOptions' => ['style' => 'width:20%'],
                'enableSorting' => true,
                'value' => 'feedback.Date_Time',
                /*'content' =>function ($model) {
                    return '<div class="pull-left break-word"><p>'.$model->Topic.'</p></div>';
                },*/
            ],
            [
                'label' => 'Feedback',
                'headerOptions' => ['style' => 'width:20%'],
                'enableSorting' => true,
                'value' => 'feedback.Feedbacks',
                /*'content' =>function ($model) {
                    return '<div class="pull-left break-word"><p>'.$model->Topic.'</p></div>';
                },*/
            ],
            [
                'label' => 'Rate',
                'headerOptions' => ['style' => 'width:20%'],
                'enableSorting' => true,
                'value' => 'feedback.Rate',
                /*'content' =>function ($model) {
                    return '<div class="pull-left break-word"><p>'.$model->Topic.'</p></div>';
                },*/
            ],


        ],
    ])?>



</div>
</div>
