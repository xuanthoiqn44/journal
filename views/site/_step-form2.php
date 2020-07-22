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
use yii\bootstrap\Button;

?>
    <?php $form = ActiveForm::begin([
        'id' => 'order',
        //'enableAjaxValidation' => true,
    ]); ?>
    <ul id="section-tabs">
        <li class="col-md-4 col-sm-4 col-xs-4" id ='_step-form1' > <span>1.</span> Paper details </li>
        <li class="col-md-4 col-sm-4 col-xs-4 current active" id ='_step-form2' > <span>2.</span> Order preferences </li>
        <li class="col-md-4 col-sm-4 col-xs-4" id ='_step-form3' > <span>3.</span> Contact information </li>
    </ul>
    <div id="fieldsets">
        <fieldset class="current active">
            <?= $form->field($model, 'writer_level')->inline()->radioList(['Free' => 'Free BASIC', '+25%Premium' => '+25% Premium', '+30%Top' => '+30% Top 10'])->label(false) ?>
            <?= $form->field($model, 'customer_service')->inline()->radioList(['Free' => 'Free', '+$5.99ADVANCED' => '+$5.99 ADVANCED', '+$9.99%PREMIUM' => '+$9.99% PREMIUM'])->label(false) ?>
            <div class="_total-prices">
                <label>TOTAL PRICE: <span>$23.99</span></label>
            </div>
            <?php
            echo Button::widget([
                'label' => '_step-form1',
                'options' => ['class' => 'btn'],
            ]);
            ?>
            <div class="btnnext"> Next step</div>
            <?php //Html::submitButton('Next Section', ['class' => 'btnnext', 'name' => 'submit-button','id'=>'nextstep1']) ?>

        </fieldset>

    </div>
    <?php ActiveForm::end(); ?>

