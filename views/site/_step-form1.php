<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/9/2018
 * Time: 6:40 PM
 */
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
?>


<ul id="section-tabs">
    <li class="current active col-md-4 col-sm-4 col-xs-4" id ='_step-form1'><span>1.</span> Paper details</li>
    <li class="col-md-4 col-sm-4 col-xs-4" id ='_step-form2' ><span>2.</span> Order preferences</li>
    <li class="col-md-4 col-sm-4 col-xs-4" id ='_step-form3' ><span>3.</span> Contact information</li>
</ul>
<?php $form = ActiveForm::begin([
    'id' => 'order',
    'enableAjaxValidation' => false,
]); ?>
<div id="fieldsets">
    <fieldset class="current active">
        <?= $form->field($model, 'type_of_service')->dropDownList(['1' => 'Math/Physic/Economic/Statistic Problems', '2' => 'Rewriting','3'=>'Proofreading','4'=>'Editing','5'=>'Copywriting','6'=>'Admission Services']);?>
        <?= $form->field($model, 'type_of_paper' )->dropDownList(['1' => 'Essay', '2' => 'Term Paper','3'=>'Research Paper','4'=>'Coursework','5'=>'Book report','6'=>'Book review']);?>

        <?= $form->field($model, 'subject_area')->dropDownList(['1' => 'Art', '2' => 'Architecture','4' => 'Movies','5' => 'Music','6' => 'Paintings']); ?>
        <?= $form->field($model, 'topic'); ?>
        <?= $form->field($model, 'paper_details') ; ?>
        <?= $form->field($model, 'additional_materials')->fileInput() ; ?>
        <label>Type of writer:</label>
        <?= $form->field($model, 'type_of_writer')->inline()->radioList(['1' => 'I want US writer', '2' => 'I want UK writer (+10% to the order total)'])->label(false) ?>
        <label>Paper format:</label>
        <?= $form->field($model, 'paper_format')->inline()->radioList(['1' => 'MLA', '2' => 'APA','Chic3ago' => 'Chicago','4' => 'Harvard','5'=>'Turabian with footnotes'])->label(false) ?>
        <?= $form->field($model, 'number_of_page') ; ?>
        <?= $form->field($model, 'currency')->inline()->radioList(['USD' => 'USD', 'VND' => 'VND'])->label(false) ?>
        <?= $form->field($model, 'urgency')->dropDownList(['1' => '14 days','2' => '10 days','3' => '7 days','4' => '5 days', '5' => '3 days']); ?>
        <?= $form->field($model, 'id_writer') ; ?>
        <?= $form->field($model, 'discount_code') ; ?>
        <div class="_total-prices">
            <label>TOTAL PRICE: <span>$23.99</span></label>
        </div>
        <div class="btnnext"> Next step</div>
        <?php //Html::submitButton('Next Section', ['class' => 'btnnext', 'name' => 'submit-button','id'=>'nextstep1']) ?>

    </fieldset>


</div>
<?php ActiveForm::end(); ?>
