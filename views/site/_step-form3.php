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
use yii\bootstrap\Tabs;

?>

    <?php $form = ActiveForm::begin([
        'id' => 'order',
        //'enableAjaxValidation' => true,
    ]); ?>
    <ul id="section-tabs">
        <li class="col-md-4 col-sm-4 col-xs-4" id ='_step-form1' > <span>1.</span> Paper details </li>
        <li class="col-md-4 col-sm-4 col-xs-4 " id ='_step-form2' > <span>2.</span> Order preferences </li>
        <li class="col-md-4 col-sm-4 col-xs-4 current active" id ='_step-form3' > <span>3.</span> Contact information </li>
    </ul>
    <div id="fieldsets">
        <fieldset class="current active">
           <?php echo Tabs::widget([
            'items' => [
            [
            'label' => 'Login',
                'content' => $this->render('order-login', ['model' => $modellogin, 'form' => $form]),
            'active' => true
            ],
            [
            'label' => 'Register',
                'content' => $this->render('order-register', ['model' => $modelregister, 'form' => $form]),
            'headerOptions' => [],
            'options' => ['id' => 'register'],
            ],

            ],
            ]);?>
            <div class="_total-prices">
                <label>TOTAL PRICE: <span>$23.99</span></label>
            </div>
            <?php echo \yii\helpers\Html::a( 'Previous', Yii::$app->request->referrer); ?>
            <?= Html::submitButton('Next Section', ['class' => 'btnnext', 'name' => 'submit-button','id'=>'nextstep1']) ?>

        </fieldset>

        <?php //Html::submitButton('submit', ['class' => 'btnnext', 'name' => 'submit-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>


