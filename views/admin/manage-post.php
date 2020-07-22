<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">New Post</h4>
                        <!--<p class="card-category"> Here is a subtitle for this table</p>-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Topic
                                    </th>
                                    <th>
                                        Id User
                                    </th>
                                    <th>
                                        Date Create
                                    </th>
                                    <th>
                                        Dead Line
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr></thead>
                                <tbody>

                                    <?php
                                    foreach ($neworder as $order){
                                        echo "<tr><td><a href=".Yii::$app->urlManager->createAbsoluteUrl(['admin/manage-post','id'=>$order->id]).">$order->id</a></td>";
                                        echo "<td>$order->Topic</td>";
                                        echo "<td>$order->Id_Author</td>";
                                        echo "<td>$order->Date_Create</td>";
                                        echo "<td>$order->Deadline</td>";
                                        echo "<td class=\"text-primary\">$order->Status</td></tr>";
                                    }
                                    ?>
                                    <!--<td class="text-primary">
                                        $36,738
                                    </td>-->


                                </tbody>
                            </table>
                            <?php echo LinkPager::widget([
                                'pagination' => $pagination_tb_active,
                            ]);?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> All Post</h4>
                        <!--<p class="card-category"> Here is a subtitle for this table</p>-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                <tr><th>
                                        ID
                                    </th>
                                    <th>
                                        Topic
                                    </th>
                                    <th>
                                        Id User
                                    </th>
                                    <th>
                                        Date Create
                                    </th>
                                    <th>
                                        Dead Line
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr></thead>
                                <tbody>
                                <?php
                                foreach ($allorder as $order){
                                    echo "<tr><td>$order->id</td>";
                                    echo "<td>$order->Topic</td>";
                                    echo "<td>$order->Id_Author</td>";
                                    echo "<td>$order->Date_Create</td>";
                                    echo "<td>$order->Deadline</td>";
                                    echo "<td>$order->Status</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php echo LinkPager::widget([
                                'pagination' => $pagination_tb_active,
                            ]);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
