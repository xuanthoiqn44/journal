

<div class="MultiCarousel" data-items="1,1" data-slide="1" id="MultiCarousel"  data-interval="1000">
    <div class="MultiCarousel-inner" id="_slide">
        <?php foreach ($reviews as $review){?>
            <div class="item">
                <div class="review_item">
                    <div class="_name">
                        <a><strong><?php echo $review->post->user->FirstName.' '.$review->post->user->LastName ?></strong></a>
                        <div class="_rating" >
                            <input type="hidden" class="rating" data-readonly value="<?php echo $review->Rate ?>"/>
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
</div>