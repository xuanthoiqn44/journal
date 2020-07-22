<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\console\widgets\Table;
use yii\widgets\LinkPager;

$this->title = 'My Order';
?>
<div class="col-md-9 col-sm-9 col-xs-12">
<h3>Completed(<?php echo $count_completed ?>)</h3>
<hr>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Topic</th>
        <th scope="col">Deadline</th>
        <th scope="col">Status</th>
        <th scope="col">Progress</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($order as $orders){?>
    <tr>
        <th scope="row"><a href="<?php echo \yii\helpers\Url::to(['my-order-completed','id'=>$orders->id]) ?>"><?php echo $orders->id ?></a></th>
        <td><?php echo $orders->Topic ?></td>
        <td><?php echo $orders->Deadline ?></td>
        <td><?php echo $orders->Status ?></td>
        <td></td>
    </tr>
    <?php }?>
    <!--<tr>
        <th scope="row">1</th>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
    </tr>-->
    </tbody>
</table>

<?php //echo LinkPager::widget(['pagination' => $pagination_tb_active,]);?>
</div>

