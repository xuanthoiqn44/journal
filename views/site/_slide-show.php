<?php
use kartik\rating\StarRating;
?>
<?php if ($reviews != null){?>
    <div class="_slide">
    <h2>What our customers say:</h2><br>
    </div>
        <div class="_sl-cmt">
            <div class="MultiCarousel" data-items="1,2" data-slide="1" id="MultiCarousel"  data-interval="false">
                <div class="MultiCarousel-inner">
                    <?php foreach ($reviews as $review){?>
                    <div class="item">
                        <div class="review_item">
                            <div class="_name">
                                <a><strong><?php echo $review->post->user->FirstName.' '.$review->post->user->LastName ?></strong></a>
                                <div class="_rating" >
                                    <?php
                                    echo StarRating::widget([
                                        'name' => 'rating',
                                        'value' => $review->Rate,
                                        'pluginOptions' => ['disabled' => true, 'showClear' => false,'showCaption' => false,'size' => 'xs',]
                                    ]);
                                    ?>

                                </div>
                            </div>
                            <p class="text-secondary"><?php echo $review->Date_Time ?></p>
                            <div class="_cmt">
                                <p><?php echo $review->Feedbacks ?></p>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <button class="btn btn-primary leftLst"><</button>
                <button class="btn btn-primary rightLst">></button>
            </div>
    </div>
<?php }?>