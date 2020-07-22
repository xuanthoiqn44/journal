<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 4:44 PM
 */
use yii\widgets\LinkPager;
use kartik\rating\StarRating;


$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
    <div class="row">
        <div class="col-md-8">
            <div class="page-content">
                <h1>Reviews</h1><hr>
                <p>Turn over which academic writing service to use and want to know more about Academized's reputation? Read our reviews below to see what our customers enjoyed about our writing. If you have used our service before, leave your own review and share your experience to help out a fellow student. </p><br>
                <?php foreach ($reviews as $review){?>
                <div class="review_item">
                    <div class="_name">
                    <a><strong><?php echo $review->post->user->FirstName.' '.$review->post->user->LastName ?></strong></a>
                        <div class="_rating" >
                            <?php
                            echo StarRating::widget([
                                'name' => 'rating',
                                'value' => $review->Rate,
                                'pluginOptions' => ['disabled' => true, 'showClear' => false,'showCaption' => false]
                            ]);
                            ?>

                        </div>
                    </div>
                    <p class="text-secondary"><?php echo $review->Date_Time ?></p>
                    <div class="_cmt">
                        <p><?php echo $review->Feedbacks ?></p>
                    </div>
                </div>
                <?php }?>
            </div>
            <?php echo LinkPager::widget([
                'pagination' => $pagination_reviews,
            ]);?>
        </div>

        <div class="col-md-4">
            <?php //echo $this->render('_right-price-free'); ?>
        </div>
    </div>
</div>
