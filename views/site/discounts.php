<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 3:37 PM
 */
use yii\helpers\Html;


$this->title = 'Discounts';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
    <div class="row">
        <div class="col-md-8">
            <div class="page-content">
                <h3>Discounts</h3><hr>
                <p>We offer a great number of discounts and special offers to our customers. Make sure you have checked them out! For more information contact our support team and they will provide you with needed assistance.</p><br>
                <h4>Life-time discounts</h4>
                <div class="_list_discount ">
                    <div class="_discount_item">
                        <div class="_discount_description">
                            <span>15+ pages</span>
                            <p>You are eligible for 5% life-time discount when you order 15 pages in total</p>
                        </div>
                        <div class="_discount_percent">
                            <span><strong>5%</strong> off</span>
                        </div>
                    </div>
                    <div class="_discount_item">
                        <div class="_discount_description">
                            <span>15+ pages</span>
                            <p>You are eligible for 5% life-time discount when you order 15 pages in total</p>
                        </div>
                        <div class="_discount_percent">
                            <span><strong>5%</strong> off</span>
                        </div>
                    </div>
                    <div class="_discount_item">
                        <div class="_discount_description">
                            <span>15+ pages</span>
                            <p>You are eligible for 5% life-time discount when you order 15 pages in total</p>
                        </div>
                        <div class="_discount_percent">
                            <span><strong>5%</strong> off</span>
                        </div>
                    </div>
                </div>
                <div class="_btnorder">
                    <div class="_pr-order _btn-order">
                        <a href="order">Order Writing Services now!</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <!--<div class="widget widget_attention ">
            <div class="widget_title"><span>Attention!</span></div>
            <div class="widget_content"><p>First time at ?</p>

                <p>Get a <strong>discount of 15%</strong>!</p>
                <div class="attention_discount"><div class="attention_discount_content"><p><span>Do not miss our unique&nbsp;offer! </span></p>

                        <p>Get 15% cut off from the initial price</p>
                    </div></div></div>
        </div>
            <div class="widget">
                <div class="_title-prices">
                    <span>Testimonials</span>
                </div>
                <div class="_content">
                    <?= Yii::$app->controller->renderPartial('_reviews_discount'); ?>
                </div>
            </div>-->
        </div>
    </div>

</div>
