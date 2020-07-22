<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 3:37 PM
 */
use yii\helpers\Html;
use yii\base\view;

$this->title = 'Rewriting';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
    <div class="row">
        <div class="col-md-8">
            <div class="page-content">
                <h3>Rewriting</h3><hr>
                <p>Are you a confident writer who can make the words on the page come alive and paint the picture you have in your head? Can you take a reader and convince them you are an expert in your field by your written words alone?</p><br>
                <h4>Features of the Rewriting</h4>
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
        <!--<div class="col-md-4">
            <div class="col-md-12 col-sm-6 col-xs-12 widget">
                <div class="_title-prices">
                    <span>Get Prices</span>
                </div>
                <div class="_content">
                    <div class="_ct">
                        <div class="_title">
                            <label>Select currency:</label>
                        </div>
                        <div class="_prices">
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn _active" data-toggle="prices" data-title="USD">USD</a>
                                    <a class="btn _notActive" data-toggle="prices" data-title="VND">VND</a>
                                </div>
                                <input type="hidden" name="prices" id="prices">
                            </div>
                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_title">
                            <label>Type of service:</label>
                        </div>
                        <div class="form-group _option">
                            <select class="form-control" id="gender1">
                                <option>Writing</option>
                                <option>Rewriting</option>
                                <option>Proofreading</option>
                                <option>Editing</option>
                                <option>Math/Science</option>
                            </select>

                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_title">
                            <label>Type of paper:</label>
                        </div>
                        <div class="form-group _option">
                            <select class="form-control" id="gender1">
                                <option>Essay</option>
                                <option>Term Paper</option>
                                <option>Research Paper</option>
                                <option>Coursework</option>
                                <option>Book report</option>
                                <option>Book review</option>
                                <option>Movie review</option>
                                <option>Case study</option>
                                <option>Lab report</option>
                                <option>Power Point presentation</option>
                                <option>Article</option>
                                <option>Article critique</option>
                            </select>
                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_title">
                            <label>Number of pages:</label>
                        </div>
                        <div class="form-group _option">
                            <div class="number-input">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                                <input class="quantity" min="1" name="quantity" value="1" placeholder="1" type="number">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                            </div>

                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_title">
                            <label>Academic level:</label>
                        </div>
                        <div class="form-group _option">
                            <select class="form-control" id="gender1">
                                <option>High School</option>
                                <option>Freshman (College 1st year)</option>
                                <option>Sophomore (College 2nd year)</option>
                                <option>Junior (College 3rd year)</option>
                                <option>Senior (College 4th year)</option>
                                <option>Master`s</option>
                                <option>Doctoral</option>

                            </select>

                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_title">
                            <label>Urgency:</label>
                        </div>
                        <div class="form-group _option">
                            <select class="form-control" id="gender1">
                                <option>Male</option>
                                <option>Female</option>
                            </select>

                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_title">
                            <label>Prices:</label>
                        </div>
                        <div class="_total-prices">
                            <span>$23.99</span>
                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_pr-order">
                            <a href="#">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-6 col-xs-12 widget ">
                <div class="_title-prices">
                    <span>Free Features</span>
                </div>
                <div class="_content">
                    <div class="_ct">
                        <div class="_feature">
                            <div class="_lb">
                                <p>Limitless Amendments</p>
                            </div>
                            <span><i>for </i><strong class="global-currency-price" data-price="23.99">$23.99</strong> </span>
                            <b>Free</b>
                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_feature">
                            <div class="_lb">
                                <p>Bibliography</p>
                            </div>
                            <span><i>for </i><strong class="global-currency-price" data-price="13.99">$13.99</strong> </span>
                            <b>Free</b>
                        </div>

                    </div>
                    <div class="_ct">
                        <div class="_feature">
                            <div class="_lb">
                                <p>Outline</p>
                            </div>
                            <span><i>for </i><strong class="global-currency-price" data-price="33.99">$33.99</strong> </span>
                            <b>Free</b>
                        </div>

                    </div>
                    <div class="_ct">
                        <div class="_feature">
                            <div class="_lb">
                                <p>Formatting</p>
                            </div>
                            <span><i>for </i><strong class="global-currency-price" data-price="33.99">$33.99</strong> </span>
                            <b>Free</b>
                        </div>

                    </div>

                    <div class="_ct">
                        <div class="_pr-order">
                            <a href="#">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
    <div class="row _service">
        <?php //echo $this->render('_delivery-free-ratings'); ?>
    </div>
    <div class="row">
        <?= Yii::$app->controller->renderPartial('_slide-show'); ?>
    </div>
</div>
