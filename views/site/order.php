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
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInput;


?>
<div class="col-md-8 col-sm-12 col-xs-12 form-order">


    <div class="wizard">

        <?php if (Yii::$app->user->isGuest){?>
            <?php $form = ActiveForm::begin([
                'id' => 'order-creacnt',
                //'enableAjaxValidation' => true,
                'enableClientValidation'=>true,
            ]); ?>
            <div class="wizard-inner">
                <div class="connecting-line <?= Yii::$app->user->isGuest?'acnt':''?>"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <?php if (Yii::$app->user->isGuest){?>
                        <li role="presentation" class="<?= Yii::$app->user->isGuest?'active pre-order':'disabled'?>">
                            <a href="#step-login" class="tabs-order" data-toggle="tab" aria-controls="step-login" role="tab" title="Contact Information">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                            </a>
                        </li>
                    <?php }?>
                    <li role="presentation" class="<?= Yii::$app->user->isGuest?'disabled pre-order':'active'?>">
                        <a href="#step1" class="tabs-order" data-toggle="tab" aria-controls="step1" role="tab" title="Paper details">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="<?= Yii::$app->user->isGuest?'disabled pre-order':'disabled'?>">
                        <a href="#step2" class="tabs-order" data-toggle="tab" aria-controls="step2" role="tab" title="Order preferences">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-gift"></i>
                            </span>
                        </a>
                    </li>


                    <li role="presentation" class="<?= Yii::$app->user->isGuest?'disabled pre-order':'disabled'?>">
                        <a href="#step3" class="tabs-order" data-toggle="tab" aria-controls="complete" role="tab" title="Contact information">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        <div class="tab-content tab-order">
            <div class="tab-pane active" role="tabpanel" id="step-login">
                <?= $form->field($model_register, 'FirstName')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model_register, 'LastName')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model_register, 'EmailID')->textInput(['autofocus' => true]) ?>
                <label class="control-label" for="registerform-phone_number">Phone  Number</label>
                <?= $form->field($model_register, 'Phone_Number')->widget(PhoneInput::className(), [
                    'jsOptions' => [
                        'preferredCountries' => ['vn', 'us'],
                        'nationalMode' => false
                    ]
                ])->label(false);?>
                <?= $form->field($model_register, 'Password')->passwordInput() ?>
                <?= $form->field($model_register, 'ConfirmPassword')->passwordInput() ?>
                <div class="_total-prices">
                    <div class="_field_total_price">
                        <!--<label class="col-sm-4">TOTAL PRICE: <span>$23.99</span></label>-->
                        <div class="_ct">
                            <div class="_pr-order">

                                <?= Html::tag('a','Next step', ['id'=>'submit-register', 'name' => 'submit']) ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
            <?php ActiveForm::end(); ?>
        <?php }else{?>
        <?php $form = ActiveForm::begin([
            'id' => 'order',
            //'enableAjaxValidation' => true,
            'enableClientValidation'=>true,
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

        <div class="wizard-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active">
                    <a href="#step1" class="tabs-order" data-toggle="tab" aria-controls="step1" role="tab" title="Paper details">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                    </a>
                </li>

                <li role="presentation" class="disabled">
                    <a href="#step2" class="tabs-order" data-toggle="tab" aria-controls="step2" role="tab" title="Order preferences">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-gift"></i>
                            </span>
                    </a>
                </li>


                <li role="presentation" class="disabled">
                    <a href="#step3" class="tabs-order" data-toggle="tab" aria-controls="complete" role="tab" title="Contact information">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                    </a>
                </li>
            </ul>
        </div>
            <div class="tab-content tab-order">

                <div class="tab-pane <?= Yii::$app->user->isGuest?'':'active'?>" role="tabpanel" id="step1">
                    <?= $form->field($model, 'type_of_service',[
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>'])->dropDownList(ArrayHelper::map(app\models\ServicePrice::findByServiceId('1'), 'Id', 'Name_Service_Price'))?>
                    <?= $form->field($model, 'type_of_paper',[
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>'] )->dropDownList(ArrayHelper::map(app\models\ServicePrice::findByServiceId('2'), 'Id', 'Name_Service_Price'))?>
                    <?= $form->field($model, 'subject_area',[
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>'])->textInput(['name'=>'subject_area'])->dropDownList(ArrayHelper::map(app\models\ServicePrice::findByServiceId('3'), 'Id', 'Name_Service_Price')) ?>
                    <?= $form->field($model, 'topic',[
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>'])?>
                    <?= $form->field($model, 'paper_details',[
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>']) ?>
                    <?= $form->field($model, 'upload_file',[
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>'])->fileInput() ?>
                    <div class="order-form-group">
                    <div class="col-md-12">
                    <p><i>
                            <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý :</span><ul><li>- Chỉ chấp nhận file MS Word (.doc,.docx).</li> <li>- Tài liệu phải được định dạng theo cỡ chữ 13 và kiểu chữ 'Times New Roman'.</li>  </ul></i></p>
                    </div>
                    </div>
                    <?= $form->field($model, 'Type_of_currency')->inline()->radioList(ArrayHelper::map(app\models\ServicePrice::findByServiceId('4'), 'Id', 'Name_Service_Price'),[
                            'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>',
                        'item' => function($index, $label, $name, $checked, $value) {
                            if ($checked)
                            {
                                $return = '<label class="level-radio paper-active">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '"  checked>';
                                $return .= '<i></i>';
                                $return .=  '<span>'.ucwords($label).'<span>';
                                $return .= '</label>';
                            }
                            else {
                                $return = '<label class="level-radio">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" >';
                                $return .= '<i></i>';
                                $return .=  '<span>'.ucwords($label).'<span>';
                                $return .= '</label>';
                            }
                            return $return;
                        }
                    ])?>


                    <?php /* $form->field($model, 'paper_format')->inline()->radioList(['1' => 'MLA', '2' => 'APA','3' => 'Chicago','4' => 'Harvard','5'=>'Turabian with footnotes'],[
                        'item' => function($index, $label, $name, $checked, $value) {
                            if ($checked)
                            {
                                $return = '<label class="modal-radio paper-active">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '"  checked>';
                                $return .= '<i></i>';
                                $return .=  ucwords($label);
                                $return .= '</label>';
                            }
                            else {
                                $return = '<label class="modal-radio">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" >';
                                $return .= '<i></i>';
                                $return .= ucwords($label);
                                $return .= '</label>';
                            }
                            return $return;
                        }
                    ])->label(false) */?>

                    <?php /* $form->field($model, 'academic_level')->inline()->radioList(['1' => 'High School', '2' => 'Freshman ','3' => 'Sophomore ','4' => 'Junior ','5'=>'Senior '],[
                        'item' => function($index, $label, $name, $checked, $value) {

                            if ($checked)
                            {
                                $return = '<label class="level-radio paper-active">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '"  checked>';
                                $return .= '<i></i>';
                                $return .=  ucwords($label);
                                $return .= '</label>';
                            }
                            else {
                                $return = '<label class="level-radio">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '">';
                                $return .= '<i></i>';
                                $return .= ucwords($label);
                                $return .= '</label>';
                            }


                            return $return;
                        }
                    ])->label(false) */?>
                    <!--<label>Number Of Page:</label>-->
                    <?php /* $form->field($model, 'number_of_page',[
                            'inputOptions'=>['class'=>'','min'=>'1','id'=>'page-number'],
                            'template'=>'<div class="_option">
                                    
                                <div class="number-input">
                                    <span class="stepDown"><i class="glyphicon glyphicon-minus"></i></span>
                                    {input}
                                    <span class="stepUp"><i class="glyphicon glyphicon-plus"></i></span>
                                </div>
                                 {error}
                            </div>'
                    ])->textInput([
                        'type' => 'number','autofocus' => true
                    ]) ; */?>
                    <!--<label>Select currency:</label>-->

                    <?php /*echo $form->field($model, 'currency')->inline(true)->radioList(['USD' => 'USD', 'VND' => 'VND'],[
                        'item' => function($index, $label, $name, $checked, $value) {
                            if ($checked)
                            {
                                $return = '<label class="currency-radio paper-active">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '"  checked>';
                                $return .= '<i></i>';
                                $return .=  ucwords($label);
                                $return .= '</label>';
                            }
                            else {
                                $return = '<label class="currency-radio">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '">';
                                $return .= '<i></i>';
                                $return .= ucwords($label);
                                $return .= '</label>';
                            }


                            return $return;
                        }
                    ])->label(true)*/?>

                    <?= $form->field($model, 'urgency',[
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>'])->dropDownList(ArrayHelper::map(app\models\ServicePrice::findByServiceId('7'), 'Id', 'Name_Service_Price')) ?>
                    <?= $form->field($model, 'id_writer',['enableAjaxValidation' => true,
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>'])?>
                    <?= $form->field($model, 'discount_code',[
                        'template' => '<div class="order-form-group"><div class="col-md-3">{label}</div><div class="col-md-9">{input}{error}</div></div>']) ; ?>
                    <div class="_total-prices">
                        <div class="_field_total_price">
                            <!--<label class="col-sm-4">TOTAL PRICE: <span>$23.99</span></label>-->
                            <div class="_ct">
                                <div class="_pr-order">
                                    <?= Html::tag('a','Next step', ['class' => 'next-step ', 'name' => 'submit']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane" role="tabpanel" id="step2">
                    <label>Writer level:</label>
                    <?= $form->field($model, 'writer_level')->inline()->radioList(ArrayHelper::map(app\models\ServicePrice::findByServiceId('8'), 'Id', 'Name_Service_Price'),[
                        'item' => function($index, $label, $name, $checked, $value) {
                            if ($checked)
                            {
                                $return = '<label class="writer-level-radio active">';
                                $return .= '<div class="writer_level_title"><span>' . ucwords($label) . '</span></div>';
                                $return .= '<div class="_radio"><input type="radio" name="' . $name . '" value="' . $value . '" checked></div>';
                                $return .= '</label>';
                            }
                            else {
                                $return = '<label class="writer-level-radio">';
                                $return .= '<div class="writer_level_title"><span>' . ucwords($label) . '</span></div>';
                                $return .= '<div class="_radio"><input type="radio" name="' . $name . '" value="' . $value . '" ></div>';
                                $return .= '</label>';
                            }
                            return $return;
                        }
                    ])->label(false) ?>
                    <label>Customer service:</label>
                    <?= $form->field($model, 'customer_service')->inline()->radioList(ArrayHelper::map(app\models\ServicePrice::findByServiceId('9'), 'Id', 'Name_Service_Price'),[
                        'item' => function($index, $label, $name, $checked, $value) {
                            if ($checked){
                                $return = '<label class="customer-service-radio active">';
                                $return .= '<div class="customer_service_title"><span>' . ucwords($label) . '</span></div>';
                                $return .= '<div class="_radio"><input type="radio" name="' . $name . '" value="' . $value . '" checked></div>';
                                $return .= '</label>';
                            }
                            else
                            {
                                $return = '<label class="customer-service-radio">';
                                $return .= '<div class="customer_service_title"><span>' . ucwords($label) . '</span></div>';
                                $return .= '<div class="_radio"><input type="radio" name="' . $name . '" value="' . $value . '"></div>';
                                $return .= '</label>';
                            }


                            return $return;
                        }
                    ])->label(false) ?>
                    <div class="_total-prices">
                        <div class="_field_total_price">
                            <!--<label class="col-sm-4">TOTAL PRICE: <span>$23.99</span></label>-->
                            <div class="_ct">
                                <div class="_pr-order">
                                    <?= Html::tag('a','Next step', ['class' => 'next-step', 'name' => 'submit']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" role="tabpanel" id="step3">
                    <?php  if (Yii::$app->user->isGuest){ ?>
                        Vui lòng <a href="javascript:void(0);" class="_order-login" onclick="login();return false;">đăng nhập</a> trước khi tiến hành order
                    <?php }?>

                    <h3>Payment method</h3>
                    <?= $form->field($model, 'method')->inline(true)->radioList(['ngan_luong' => 'Ngân lượng', 'ngan_hang_noi_dia' => 'Ngân hàng nội địa'],[
                            //'name'=>'order-method',
                        'item' => function($index, $label, $name, $checked, $value) {
                            if ($checked)
                            {
                                $return = '<label class="method-radio paper-active '.$value.'">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '"  checked>';
                                $return .= '';
                                $return .=  ucwords($label);
                                $return .= '</label>';
                            }
                            else {
                                $return = '<label class="method-radio '.$value.'">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '">';
                                $return .= '<i></i>';
                                $return .= ucwords($label);
                                $return .= '</label>';
                            }
                            return $return;
                        }
                    ]) ?>
                    <div class="boxContent">
                        <p><i>
                                <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>: Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước khi thực hiện.</i></p>

                        <ul class="cardList clearfix">
                            <li class="bank-online-methods ">
                                <label for="vcb_ck_on">
                                    <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam" deluminate_imagetype="png"></i>
                                    <input type="radio" value="BIDV" name="bankcode">

                                </label></li>
                            <li class="bank-online-methods ">
                                <label for="vcb_ck_on">
                                    <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam" deluminate_imagetype="png"></i>
                                    <input type="radio" value="VCB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="vnbc_ck_on">
                                    <i class="DAB" title="Ngân hàng Đông Á" deluminate_imagetype="png"></i>
                                    <input type="radio" value="DAB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="tcb_ck_on">
                                    <i class="TCB" title="Ngân hàng Kỹ Thương" deluminate_imagetype="png"></i>
                                    <input type="radio" value="TCB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_mb_ck_on">
                                    <i class="MB" title="Ngân hàng Quân Đội" deluminate_imagetype="png"></i>
                                    <input type="radio" value="MB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_vib_ck_on">
                                    <i class="VIB" title="Ngân hàng Quốc tế" deluminate_imagetype="png"></i>
                                    <input type="radio" value="VIB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_vtb_ck_on">
                                    <i class="ICB" title="Ngân hàng Công Thương Việt Nam" deluminate_imagetype="png"></i>
                                    <input type="radio" value="ICB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_exb_ck_on">
                                    <i class="EXB" title="Ngân hàng Xuất Nhập Khẩu" deluminate_imagetype="png"></i>
                                    <input type="radio" value="EXB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_acb_ck_on">
                                    <i class="ACB" title="Ngân hàng Á Châu" deluminate_imagetype="png"></i>
                                    <input type="radio" value="ACB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_hdb_ck_on">
                                    <i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM" deluminate_imagetype="png"></i>
                                    <input type="radio" value="HDB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_msb_ck_on">
                                    <i class="MSB" title="Ngân hàng Hàng Hải" deluminate_imagetype="png"></i>
                                    <input type="radio" value="MSB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_nvb_ck_on">
                                    <i class="NVB" title="Ngân hàng Nam Việt" deluminate_imagetype="png"></i>
                                    <input type="radio" value="NVB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_vab_ck_on">
                                    <i class="VAB" title="Ngân hàng Việt Á" deluminate_imagetype="png"></i>
                                    <input type="radio" value="VAB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_vpb_ck_on">
                                    <i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng" deluminate_imagetype="png"></i>
                                    <input type="radio" value="VPB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_scb_ck_on">
                                    <i class="SCB" title="Ngân hàng Sài Gòn Thương tín" deluminate_imagetype="png"></i>
                                    <input type="radio" value="SCB" name="bankcode">

                                </label></li>



                            <li class="bank-online-methods ">
                                <label for="bnt_atm_pgb_ck_on">
                                    <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex" deluminate_imagetype="png"></i>
                                    <input type="radio" value="PGB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="bnt_atm_gpb_ck_on">
                                    <i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu" deluminate_imagetype="png"></i>
                                    <input type="radio" value="GPB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="bnt_atm_agb_ck_on">
                                    <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn" deluminate_imagetype="png"></i>
                                    <input type="radio" value="AGB" name="bankcode">

                                </label></li>

                            <li class="bank-online-methods ">
                                <label for="bnt_atm_sgb_ck_on">
                                    <i class="SGB" title="Ngân hàng Sài Gòn Công Thương" deluminate_imagetype="png"></i>
                                    <input type="radio" value="SGB" name="bankcode">

                                </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="BAB" title="Ngân hàng Bắc Á" deluminate_imagetype="png"></i>
                                    <input type="radio" value="BAB" name="bankcode">

                                </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="TPB" title="Tền phong bank" deluminate_imagetype="png"></i>
                                    <input type="radio" value="TPB" name="bankcode">

                                </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="NAB" title="Ngân hàng Nam Á" deluminate_imagetype="png"></i>
                                    <input type="radio" value="NAB" name="bankcode">

                                </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)" deluminate_imagetype="png"></i>
                                    <input type="radio" value="SHB" name="bankcode">

                                </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)" deluminate_imagetype="png"></i>
                                    <input type="radio" value="OJB" name="bankcode">
                                </label></li>
                        </ul>
                    </div>
                    <div class="_total-prices">
                        <div class="_field_total_price">
                            <!--<label class="col-sm-4">TOTAL PRICE: <span>$23.99</span></label>-->
                            <div class="_ct">

                                <div class="_pr-order">
                                    <?= Html::tag('a','Process to order', ['id'=>'submit-order', 'name' => 'submit']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
            <?php ActiveForm::end(); ?>
<?php }?>
    </div>

</div>
<div class="col-md-4 col-sm-12 col-xs-12">
    <div id="get_price">

        <div class="_completed_order">
            <div class="_ct">
                <label>Topic:</label>
                <div class="_order-summary">
                    <h5 id="topic"></h5>
                </div>
            </div>
            <div class="_ct">
                <label>Type of service:</label>
                <div class="_order-summary">
                    <p id="type_of_service">Math/Physic/Economic/Statistic Problems</p>
                </div>
            </div>
            <div class="_ct">
                <label>Type of paper:</label>
                <div class="_order-summary">
                    <p id="type_of_paper">Essay</p>
                </div>
            </div>
            <div class="_ct">
                <label>Subject area:</label>
                <div class="_order-summary">
                    <p id="subject_area">Architecture</p>
                </div>
            </div>
            <div class="_ct">
                <label>Total page :</label>
                <div class=" _order-summary">
                    <p id="_page-of-file"></p>
                </div>
            </div>
            <!--<div class="_ct">
                <label>Giá gốc:</label>
                <div class="_order-summary">
                    <p>0</p>
                </div>
            </div>-->
            <div class="_ct">
                <label>Writer level: </label>
                <div class=" _order-summary">
                    <p id="_id-writer-level">Free BASIC</p>
                </div>
            </div>
            <div class="_ct">
                <label>Customer service:  </label>
                <div class=" _order-summary">
                    <p id="_id-customer-service">Free</p>
                </div>
            </div>
            <div class="_ct">
                <label>Currency: </label>
                <div class=" _order-summary">
                    <p id="_order_type_of_writer">USD</p>
                </div>
            </div>
            <div class="_ct">
                <label>Deadline: </label>
                <div class=" _order-summary">
                    <p id="_order_urgency">14 days</p>
                </div>
            </div>

            <div class="_ct">
                <div class="title">
                    <label>Total price:</label>
                    <div class="" id="loader"></div>
                    <span id="_price_total_order"></span>
                </div>
            </div>
            <?= Html::button('Process money', ['id' => 'process_prices','class'=>'btn btn-primary']) ?>
        </div>
    </div>
    </div>
</div>
<?php
$script = <<< JS
$(document).ready(function () {
    //auto load type_of_currency right bar
    document.getElementById('_order_type_of_writer').innerHTML = $('.level-radio.paper-active').find('span').text();
    $('.level-radio').click(function () {
        $('.level-radio.paper-active').removeClass('paper-active');
        $(this).addClass('paper-active').find('input').prop('checked', true);
        document.getElementById('_order_type_of_writer').innerHTML = $(this).find('span').text();
    });
    //$('#type_of_service').text($(this).find(':selected').text());
$('#_order_urgency').text(adddays($('#orderpost-urgency').find(':selected').text()))});
//click type of service
    $('#orderpost-type_of_service').change(function () {
        $('#type_of_service').text($(this).find(':selected').text());
    });
    //change toppic
   $('#orderpost-topic').on('input',function(e){
    $('#topic').text($(this).val());
    });
    //click type of paper
    $('#orderpost-type_of_paper').change(function () {
        $('#type_of_paper').text($(this).find(':selected').text());
    });
    //click subject area
    $('#orderpost-subject_area').change(function () {
        $('#subject_area').text($(this).find(':selected').text());
    });
    //click urgency
    $('#orderpost-urgency').change(function () {
        //$('#_order_urgency').text($(this).find(':selected').text());
        $('#_order_urgency').text(adddays($(this).find(':selected').text()));
    });
    //show list ngan hang noi dia
    $('.method-radio').click(function () {
        var checked = $(this).find('input').prop('checked', true);
        //if ($('input[name=order-method]:checked').val() === "Ngan_hang_noi_dia"){
        if (checked[0].defaultValue === "ngan_hang_noi_dia"){
            $('.boxContent').css('display', 'block');
        }
        else {
            $('.boxContent').css('display', 'none');
        }
    })
    //click button prices order
    $("#process_prices").click(function() {
    if (Validate_Tabs()) {
        $('#_price_total_order').text('');
        $('#loader').addClass('loader');
        var formData = new FormData($("#order")[0]);
        $.ajax({
            url: 'site/order',
            type: 'POST',
            data: formData,
            datatype: 'json',

            'success': function (response) {
                // on success do some validation or refresh the content div to display the uploaded images
                $('#loader').removeClass('loader');
                try {
                    if (!isNaN(response.data[0])) {
                        if ($("input[name='OrderPost[Type_of_currency]']:checked").val() === '31') {
                            $('#_price_total_order').text(response.data[0].toLocaleString('en-US', {
                                style: 'currency',
                                currency: 'VND'
                            }));
                        } else {
                            $('#_price_total_order').text(response.data[0].toLocaleString('en-US', {
                                style: 'currency',
                                currency: 'USD'
                            }));
                        }
                        $('#_page-of-file').text(response.data[1]);
                    }
                }
                    catch (e) {
                        $('#w3-error-0').removeClass('_out');
                        $('#w3-error-0').addClass('_in');
                        $('#w3-error-0').append('Lỗi trong quá trình xử lý');
                    }
            },


            'error': function () {

            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    }

});

    
    $('.btnnext').on('click', function () {
        $('#order').yiiActiveForm('validate', true);
    });
    //click paper format
    $('.modal-radio').click(function () {
        $('.modal-radio.paper-active').removeClass('paper-active');
        $(this).addClass('paper-active').find('input').prop('checked', true);
    });
//click Type Of Currency
    $('.level-radio').click(function () {
        $('.level-radio.paper-active').removeClass('paper-active');
        $(this).addClass('paper-active').find('input').prop('checked', true);
        document.getElementById('_order_type_of_writer').innerHTML = $(this).find('span').text();
    });

//click currency
    $('.currency-radio').click(function () {
        $('.currency-radio.paper-active').removeClass('paper-active');
        $(this).addClass('paper-active').find('input').prop('checked', true);
    });
//click writer level
    $('.writer-level-radio').click(function () {
        $('.writer-level-radio.active').removeClass('active');
        $(this).addClass('active').find('input').prop('checked', true);
        /*change value details order*/
        document.getElementById('_id-writer-level').innerHTML = $(this).find('span').text();
    });
//click customer service
    $('.customer-service-radio').click(function () {
        $('.customer-service-radio.active').removeClass('active');
        $(this).addClass('active').find('input').prop('checked', true);
        /*change value details order*/
        document.getElementById('_id-customer-service').innerHTML = $(this).find('span').text();
    });
    //click method payment
    $('.method-radio').click(function () {
        $('.method-radio.paper-active').removeClass('paper-active');
        $(this).addClass('paper-active').find('input').prop('checked', true);
    });
    //add date deadline
function adddays(days) {
    days = days.split(' ');
    var date = new Date(Date.now() + days[0] * 24*60*60*1000);
    //date.setDate(date.now() + days* 24*60*60*1000);
    //date.format('dd-mm-yyyy');
    //return date.toString('dd-MMM-yyyy');
    var monthNames = [
        "01", "02", "03",
        "04", "05", "06", "07",
        "08", "09", "10",
        "11", "12"
    ];
    day = date.getDate();
    monthIndex = date.getMonth();
    year = date.getFullYear();
    month = monthNames[monthIndex];
    return day +'/'+month+'/'+year;
}
 $("#submit-order").click(function () {
        document.getElementById('order').submit();
    });
$("#submit-register").click(function () {
        document.getElementById('order-creacnt').submit();
    });



JS;
$this->registerJs($script);
?>

