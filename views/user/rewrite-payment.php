<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 3:37 PM
 */
use yii\helpers\Html;
use yii\base\view;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

$this->title = 'Academy writing service - Payment';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
    <div class="row">
        <?php
            $form = ActiveForm::begin(['id'=>'form-rewrite']);
            ?>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div id="get_price">

                <div class="_completed_order">
                    <div class="_ct">
                        <label>Topic:</label>
                        <div class="_order-summary">
                            <h5 id="topic"><?= $post->Topic?></h5>
                        </div>
                    </div>
                    <div class="_ct">
                        <label>Type of service:</label>
                        <div class="_order-summary">
                            <p id="type_of_service"><?= \app\models\Post::getNameService($post->Type_of_services)?></p>
                        </div>
                    </div>
                    <div class="_ct">
                        <label>Type of paper:</label>
                        <div class="_order-summary">
                            <p id="type_of_paper"><?= \app\models\Post::getNameService($post->Type_of_paper)?></p>
                        </div>
                    </div>
                    <div class="_ct">
                        <label>Subject area:</label>
                        <div class="_order-summary">
                            <p id="subject_area"><?= \app\models\Post::getNameService($post->Subject_area)?></p>
                        </div>
                    </div>
                    <div class="_ct">
                        <label>Total page :</label>
                        <div class=" _order-summary">
                            <p id="_page-of-file"><?= $post->PageNumbers?> trang</p>
                        </div>
                    </div>

                    <div class="_ct">
                        <label>Currency: </label>
                        <div class=" _order-summary">
                            <p id="_order_type_of_writer"><?= \app\models\Post::getNameService($post->Type_of_currency)?></p>
                        </div>
                    </div>
                    <div class="_ct">
                        <label>Deadline: </label>
                        <div class=" _order-summary">
                            <p id="_order_urgency"><?= $post->Deadline?></p>
                        </div>
                    </div>
                    <div class="_ct">
                        <div class="title">
                            <label>Sale:</label>
                            <span id="_order_sale">0%</span>
                        </div>
                    </div>
                    <div class="_ct">
                        <div class="title">
                            <label>Total price:</label>
                            <div class="" id="loader"></div>
                            <span id="_price_total_order">$<?= $post->Price?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--<div class="col-md-3">
            <div class="page-content">

            </div>

        </div>-->
        <div class="col-md-8">

            <div class="col-xs-12 col-md-6 col-atm">
                <div class="online_payment_card atm_card" id="atm_card">
                    <div class="card_image_nganluong">
                        <?= Html::img('../assets/img/bg-img/safe-pay-1.png')?>
                    </div>
                    <div class="card_title">
                        <h4>Thanh toán bằng tài khoản Ngân Lượng</h4>
                    </div>

                    <div class="card_submit">
                        <div class="text-center">
                        <?= Html::submitButton('Chọn',['name'=>'nganluong','class'=>'btn btn-primary button_payment_submit'])?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-atm">
                <div class="online_payment_card atm_card" id="atm_card">
                    <div class="card_image">
                        <?= Html::img('../assets/img/bg-img/img_atm.png')?>
                    </div>
                    <div class="card_title">
                        <h4>Thanh toán bằng thẻ ATM</h4>
                    </div>

                    <div class="card_submit text-center">
                        <?php
                        Modal::begin([
                            'size' => 'modal-lg',
                            'header' => '<div class="text-center"><h4>Select your credit card</h4></div>',
                            'toggleButton' => [
                                'label' => '<i class="glyphicon"></i> Chọn',
                                'class'=>'btn btn-primary text-center button_payment_submit'
                            ],
                        ]);
                        ?>
                        <div class="">
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
                        <div class="text-center">
                        <?= Html::submitButton('Payment',['name'=>'atm-online','class'=>'btn btn-success'])?>
                        </div>
                        <?php Modal::end();?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end();?>

    </div>


</div>
