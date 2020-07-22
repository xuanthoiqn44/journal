<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 3:37 PM
 */
use yii\helpers\Html;

$this->title = 'Editing';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
    <div class="row">
        <div class="col-md-8">
            <div class="page-content">
                <h3>Editing </h3><hr>
                <p>Are you a confident writer who can make the words on the page come alive and paint the picture you have in your head? Can you take a reader and convince them you are an expert in your field by your written words alone?</p><br>
                <h4>Features of the Editing</h4>
                <br>
                <p>100% Original Product</p><br>
                <p>FREE Amendments </p><br>
                <p>Privacy and Security</p><br>
                <h3>Academic Papers Proofreading Services</h3><br>
                <p>Spelling, punctuation and grammar account for enough marks on your assignments for them to matter. Send us your rough diamond and let us polish it to perfection.</p><br>
                <ul class="_ul">
                    <li>Don’t know where from were from we’re?</li>
                    <li>Don’t know their from there from they’re?</li>
                    <li>Don’t know your from you’re?</li>
                    <li>Don’t know too from to from two?</li>
                </ul><br>
                <p>Don’t worry – our expert proof readers do. And they are waiting to help you.</p><br>
                <p>Often, with your own work, you are too close to the material to do an accurate proofread. Your eyes see what they think they should see rather than what’s actually there.</p><br>
                <h4>Proofread My Academic Papers</h4><br>
                <p>And it’s not just spelling and correct word usage our proof readers can correct; it’s punctuation and grammar too.</p><br>
                <p>You’ve all seen the example about the boy with an Uncle Jack and a horse I’m sure, so you know how important this can be. Do you know when to use a comma as opposed to a semi colon? Do you know the correct way to structure a sentence?</p><br>
                <div class="_btnorder">
                    <div class="_pr-order _btn-order">
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/order'); ?>">Order Writing Services now!</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <?php //echo $this->render('_right-price-free'); ?>
            <?php //echo Yii::$app->controller->renderPartial('_right-price-free'); ?>
        </div>
    </div>
    <div class="row _service">
        <?php //echo $this->render('_delivery-free-ratings'); ?>
        <?php //echo Yii::$app->controller->renderPartial('_delivery-free-ratings'); ?>
    </div>
    <div class="row">
        <?= Yii::$app->controller->renderPartial('_slide-show'); ?>
    </div>
</div>
