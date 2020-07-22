<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/1/2018
 * Time: 12:03 PM
 */
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="col-md-8 col-sm-12 col-xs-12 form-order">
    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'step2',
        //'enableAjaxValidation' => true,
    ]); ?>
    <ul id="section-tabs">
        <li class="col-md-4 col-sm-4 col-xs-4"><span>1.</span> Paper details</li>
        <li class="col-md-4 col-sm-4 col-xs-4 current active"><span>2.</span> Order preferences</li>
        <li class="col-md-4 col-sm-4 col-xs-4"><span>3.</span> Contact information</li>
    </ul>
    <div id="fieldsets">
        <fieldset class="current active">
            <?= $form->field($model, 'writer_level')->inline()->radioList(['Free' => 'Free BASIC', '+25%Premium' => '+25% Premium', '+30%Top' => '+30% Top 10'])->label(false) ?>
            <?= $form->field($model, 'customer_service')->inline()->radioList(['Free' => 'Free', '+$5.99ADVANCED' => '+$5.99 ADVANCED', '+$9.99%PREMIUM' => '+$9.99% PREMIUM'])->label(false) ?>
            <div class="_total-prices">
                <label>TOTAL PRICE: <span>$23.99</span></label>
            </div>
            <?= Html::submitButton('Next Section', ['class' => 'btnnext', 'name' => 'submit-button','id'=>'nextstep1']) ?>

        </fieldset>
        <!--<fieldset class="next">
            <label for="interests">Basic Interests:</label>
            <textarea name="bio"></textarea>
            <p>Receive newsletter?<br>
                <input type="radio" name="newsletter" value="yes"><label for="newsletter">yes</label>
                <input type="radio" name="newsletter" value="no"><label for="newsletter">no</label>
            </p>
        </fieldset>-->

        <?php //Html::submitButton('submit', ['class' => 'btnnext', 'name' => 'submit-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
<div class="col-md-4 col-sm-12 col-xs-12">
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
