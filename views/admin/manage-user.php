<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="button-submit col-md-12">
                    <?= Html::a('Add User',['admin/add-user'], ['class' => 'btn btn-primary pull-left']) ?>
                    <?= Html::submitButton('Delete User', ['class' => 'btn btn-primary pull-left','name' => 'delete','confirm' => 'Are you sure to save','id'=>'delete-user']) ?>
                    <?= Html::submitButton('Active User', ['class' => 'btn btn-primary pull-left','name' => 'active','id'=>'active-user']) ?>
                    <?= Html::submitButton('Block User', ['class' => 'btn btn-primary pull-left','name' => 'block','id'=>'block-user']) ?>

                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">User</h4>

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
                                'id' => 'grid-user',

                                'columns' => [
                                    [
                                        'class' => 'yii\grid\SerialColumn',
                                        'headerOptions' => ['style' => 'width:5%'],
                                    ],
                                    ['class' => 'yii\grid\CheckboxColumn'],
                                    [

                                        //'attribute'=>'Author_Id',
                                        'label' => "Full Name",
                                        //'value' => "user.LastName",
                                        //'headerOptions' => ['style' => 'width:10%'],
                                        'content' =>function ($model, $key, $index, $column) {
                                            //return "<div class='pull-left break-word'><a href=".Url::toRoute(['request-editor','id'=>$model->id])." title='click for details Post'>$model->user->LastName</a></div>";
                                            return "<div class='break-word'>"."<a href=".Url::toRoute(['manage-user','id'=>$model->id])." title='click for details Post'".">".$model->FirstName.' '.$model->LastName."</a>"."</div>";
                                        },
                                    ],
                                    [
                                        'attribute'=>'Email',
                                        'label' => "Email",
                                        'value' => "EmailID",
                                        //'headerOptions' => ['style' => 'width:10%'],
                                    ],
                                    [
                                        'attribute'=>'Phone_Number',
                                        'label' => "Phone number",
                                        'value' => "Phone_Number",
                                        //'headerOptions' => ['style' => 'width:10%'],
                                    ],
                                    [
                                        'attribute'=>'Date_Create',
                                        'label' => "Date create",
                                        'value' => "Date_Create",
                                        //'headerOptions' => ['style' => 'width:10%'],
                                    ],
                                    [
                                        'attribute'=>'Role',
                                        'label' => "Role",
                                        'value' => "Role",
                                        //'headerOptions' => ['style' => 'width:10%'],
                                    ],
                                    [
                                        'label' => 'Status',
                                        'attribute'=>'Status',
                                        'value'=> 'Status',
                                        //'enableSorting' => false,
                                        'headerOptions' => ['style' => 'width:15%'],
                                        'content' =>function ($model) {
                                            if ($model->Status == '1') {
                                                return "<a class='text-completed'>Active</a>";
                                            }
                                            else
                                            {
                                                return "<a class='text-block'>Block</a>";
                                            }

                                        },
                                        'filter'=>array("1"=>"Active","0"=>"Block"),
                                    ],
                                    [
                                        'attribute'=>'id',
                                        'label' => "ID",
                                        'value' => "id",
                                        //'headerOptions' => ['style' => 'width:5%'],

                                    ],

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
         $('#delete-user').click(function(){
          Handle('user','delete');
  });
         $('#active-user').click(function(){
          Handle('user','active');
  });
         $('#block-user').click(function(){
          Handle('user','block');
  });
         function Handle(type,action) {
            var keys = $('#grid-user').yiiGridView('getSelectedRows');
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
