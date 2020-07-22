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
                        <h4 class="card-title ">All Editor</h4>
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
                                'id' => 'grid-editor',

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
                                        //'attribute'=>'Author_Id',
                                        'label' => "Name Editor",
                                        'value' => "user.LastName",
                                        'headerOptions' => ['style' => 'width:10%'],
                                    ],
                                    [
                                        //'attribute'=>'Author_Id',
                                        'label' => "Email",
                                        'value' => "user.EmailID",
                                        'headerOptions' => ['style' => 'width:10%'],
                                    ],
                                    [
                                        //'attribute'=>'Author_Id',
                                        'label' => "Phone number",
                                        'value' => "user.Phone_Number",
                                        'headerOptions' => ['style' => 'width:10%'],
                                    ],
                                    [
                                        'label' => 'Status',
                                        'attribute'=>'Status',
                                        'enableSorting' => true,
                                        'content' =>function ($model) {
                                        if ($model->Status == '2') {
                                            return "<a class='text-primary'>Active</a>";
                                        }
                                        elseif ($model->Status == '1')
                                        {
                                            return "<a class='text-completed'>Block</a>";
                                        }
                                        else
                                        {
                                            return "<a class='text-process'>Request to editor</a>";
                                        }
                                            //return $model->Status=='1'?"<span style='color:green;'>Open to suggestions</span>":"<span style='color: #99A3BF;'>Searching for orders</span>";

                                        },
                                        //'filter'=> Html::activeDropDownList($searchModel,'Status',app\models\Post::getStatusOrder(),['class' => 'form-control']),
                                        //'filter'=> Html::dropDownList('WritersSearch[Status]','',app\models\Editor::getStatus(),['prompt'=>'All','class' => 'form-control']),
                                    ],
                                    [
                                        'attribute'=>'Id',
                                        'label' => "ID",
                                        //'value' => "id",
                                        'headerOptions' => ['style' => 'width:10%'],
                                        'content' =>function ($model) {
                                            //return "<div class='pull-left break-word'><a href=".Url::to('all-post/id/'.$model->id)." title='click for details Post'>$model->Topic</a></div>";
                                            return "<div class='pull-left break-word'><a href=".Url::toRoute(['all-editor','id'=>$model->id])." title='click for details Post'>$model->id</a></div>";
                                            //return "<a href=".Yii::$app->urlManager->createAbsoluteUrl('admid/all-post?id='.$model->id).">$model->Topic</a>";
                                            //return "<span >".$model->Rating."/5</span>";
                                        },
                                    ],
                                    /*[
                                        'class' => 'yii\grid\ActionColumn',
                                        //'header' => 'Actions',
                                        //'headerOptions' => [],
                                        'template' => '{order}',
                                        'buttons' => [
                                            'order' => function ($url, $model) {
                                                return Html::a('<button class="btn _writer_order">Request this writer</button>', $url, [
                                                    'title' => Yii::t('app', 'Order'),
                                                ]);
                                            },
                                        ],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                            if ($action === 'order') {
                                                $url ='order?writer_id='.$model->id;
                                                return $url;
                                            }


                                        }
                                    ],*/

                                ],
                            ])?>



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    <?php
    $script = <<< JS
$(function () {
         $('#delete-editor').click(function(){
          Handle('editor','delete');
  });
         $('#active-editor').click(function(){
          Handle('editor','active');
  });
         $('#block-editor').click(function(){
          Handle('editor','block');
  });
         function Handle(type,action) {
            var keys = $('#grid-editor').yiiGridView('getSelectedRows');
            $.post({
           url: 'handle?type='+type+'&action='+action, 
            method: 'post',
           dataType: 'json',
           data: {listkey: keys},
        
           success: function(data) {
           },
});        
         }
});

JS;
    $this->registerJs($script);
    ?>
