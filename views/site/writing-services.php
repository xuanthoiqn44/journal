<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 3:37 PM
 */
use yii\helpers\Html;

$this->title = 'Our Writing Service';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
        <div class="row">
            <div class="col-md-8">
                <div class="page-content">
                    <h3>Writing services</h3><hr>
                    <p>Did you know that here at Academized, we provide a full range of writing services for students just like you?</p><br>
                    <p>We know how hard it can be to fit everything in; studying, working, and socialising. It can get especially tough when you factor in tight deadlines and tons of research. In short, being a student is tough – and we know that!</p><br>
                    <p>Did you know that here at Academized, we provide a full range of writing services for students just like you?</p><br>
                    <h4>Writing Services: Get The Best Writing from The Best Writers!</h4>
                    <p>Which is why we’re here to help you with all aspects of your assignments. Our professional writers can help you with any or all of the following (on any topic):</p><br>
                    <p><strong>Essay Writing</strong>: Need a literary essay? An argumentative essay? A comparison essay? Any essay? We’ve got you covered!</p><br>
                    <p><strong>Thesis Writing</strong>: Sometimes, the hardest part of the essay is generating the right thesis. We can do this for you. Whether you want just the thesis or the full essay behind it, we can do that.</p><br>
                    <p><strong>Dissertation Writing</strong>: A dissertation is arguably the most important essay you will write as a student. Accounting for up to 60% of your final grade, a good dissertation is essential. Give us your thesis, or let us generate one for you!</p><br>

                    <p><strong>Research Papers</strong>: This is perhaps the most time consuming paper. All that research! And of course, there’s the bibliography and citations to worry about. Relax and let us worry for you.</p><br>

                    <p><strong>Admissions Essays</strong>: With the competition to get onto your chosen course so fierce, why risk missing out on the course of your dreams down to a bad admissions essay? Our team know what admissions staff are looking for – and we always deliver.</p><br>

                    <p><strong>Maths and Science Assignments</strong>: We don’t just write papers, although we can write papers on the theories behind mathematical and scientific principles. We can also do your calculations for you.</p><br>

                    <p><strong>Editing</strong>: Editing is one of the most important stages of writing your paper, and it’s something that is often overlooked. Often because it is harder than it seems, and people often have no idea where to start. If you have written your own assignment, we can edit it for you; we will improve the flow and strength any weak points.</p><br>

                    <p><strong>Proofreading</strong>: Have you written and edited your own paper? Don’t forget to proof read it. You can lose crucial marks based on your spelling, punctuation and grammar. Let us fix it for you to really make your work pop.</p><br>

                    <p>Have a browse through our site and find out today how we can help you with all of your assignment writing needs.</p>
                    <div class="_btnorder">
                    <div class="_pr-order _btn-order">
                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/order'); ?>">Order Writing Services now!</a>
                    </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <?php //echo $this->render('_right-price-free'); ?>
            </div>
        </div>
    <div class="row _service">
        <?php //echo $this->render('_delivery-free-ratings'); ?>
    </div>
    <div class="row">
        <?= Yii::$app->controller->renderPartial('_slide-show'); ?>
    </div>
</div>
