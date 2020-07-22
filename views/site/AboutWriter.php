<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 3:37 PM
 */
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\rating\StarRating;

$this->title = 'About writers';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
    <div class="page-content about_wr">
        <div class="content_title"><h4>Writer's <strong>ID: <?= $AboutEditor->id;?></strong></h4></div>
        <div class="about_writer">
            <div  class="col-md-3 col-sm-3 col-xs-12 writer_if">
                <div class="writer_info">
                    <?php echo Html::img('@web/assets/img/bg-img/writer_avatar.png'); ?>
                    <?= $AboutEditor->Status?"<span style='color:green;'>Open to suggestions</span>":"<span style='color:#99A3BF;'>Searching for orders</span>" ?>
                </div>
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/order?writer_id='.$AboutEditor->Id_User); ?>" class="btn _writer_order">Hire this writer</a>
            </div>
            <div  class="col-md-4 col-sm-4 col-xs-12 writer_d">
                <div class="writer_description">
                    <div class="writer_details_item">
                    <span>Overall ranking: <strong><?= $AboutEditor->Rating?>/5</strong></span>

                    </div>

                    <?php
                    echo StarRating::widget([
                        'name' => 'rating',
                        'value' => $AboutEditor->Rating,
                        'pluginOptions' => ['disabled' => true, 'showClear' => false,'showCaption' => false,'size' => 'xs']
                    ]);
                    ?>

                    <div class="writer_details_item">
                        <span>Completed orders:</span><p><?= $AboutEditor->Completed_order?></p>
                    </div>
                    <div class="writer_details_item">
                        <span>Orders in progress:</span><p><?= $AboutEditor->Order_Process?></p>
                    </div>
                </div>

            </div>
            <div  class="col-md-5 col-sm-5 col-xs-12 writer_d">
                <div class="writer_description">
                    <div class="">
                        <span>Technical/Humanitarian skills: </span>
                    </div>
                    <div class="writer_skill">
                        <ul class="_ul">
                            <li>Business</li>
                            <li>Economics</li>
                            <li>Finance</li>
                            <li>Nursing</li>
                        </ul>
                        <ul class="_ul">
                            <li>Business</li>
                            <li>Economics</li>
                            <li>Finance</li>
                            <li>Nursing</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <h4>See what other clients say about this writer</h4><br>
        <?php foreach ($reviews as $review){
            if ($review->feedback!= null){
            ?>

            <div class="review_item">
                <div class="_name">
                    <a><strong><?php echo $review->user->FirstName.' '.$review->user->LastName ?></strong></a>
                    <div class="_rating" >
                        <?php
                        echo StarRating::widget([
                            'name' => 'rating',
                            'value' => $review->feedback->Rate,
                            'pluginOptions' => ['disabled' => true, 'showClear' => false,'showCaption' => false,'size' => 'xs']
                        ]);
                        ?>

                    </div>
                </div>
                <p class="text-secondary"><?php echo $review->feedback->Date_Time ?></p>
                <div class="_cmt">
                    <p><?php echo $review->feedback->Feedbacks ?></p>
                </div>
            </div>
        <?php }}?>

    </div>


</div>
