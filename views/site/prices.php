<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 3:37 PM
 */
use yii\helpers\Html;

date_default_timezone_set('Asia/Ho_Chi_Minh');

use yii\bootstrap\ActiveForm;

$this->title = 'Prices';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
    <div class="row">
        <div class="col-md-8">
            <div class="page-content">
                <h3>Prices</h3><hr>
                <div>
                    <?php $form = ActiveForm::begin([
                        'id' => 'price-order',
                        //'enableAjaxValidation' => true,
                        'enableClientValidation'=>true,
                    ]); ?>
                    <div class="_ct">
                        <div class="_title _pr">
                            <label>Select currency:</label>
                        </div>
                    <?php echo $form->field($model, 'type_of_writer')->inline()->radioList($type_of_writer,[
                        'item' => function($index, $label, $name, $checked, $value) {
                            if ($checked)
                            {
                                $return = '<label class="writer-radio paper-active">';
                                $return .= '<input type="radio" class ="wr-radio" name="'.$name.'" value="' . $value . '" data-name='.$label.' checked>';
                                $return .= '<i></i>';
                                $return .=  '<span >'.ucwords($label).'<span>';
                                $return .= '</label>';
                            }
                            else {
                                $return = '<label class="writer-radio">';
                                $return .= '<input type="radio" class ="wr-radio" name="'.$name.'" value="' . $value . '" data-name='.$label.'>';
                                $return .= '<i></i>';
                                $return .=  '<span>'.ucwords($label).'<span>';
                                $return .= '</label>';
                            }
                            return $return;
                        }
                    ])->label(false) ?>
                </div>
                    <div class="_ct">
                        <div class="_title _pr">
                            <label>Type of service:</label>
                        </div>

                        <div class="form-group _option _op">
                            <select class="form-control" id="type_of_service">
                                <option value="1">Math/Physic/Economic/Statistic Problems</option>
                                <option value="2">Rewriting</option>
                                <option value="3">Proofreading</option>
                                <option value="4">Editing</option>
                                <option value="5">Copywriting</option>
                                <option value="6">Admission Services</option>
                            </select>

                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_title _pr">
                            <label>Type of paper:</label>
                        </div>
                        <div class="form-group _option _op">
                            <select class="form-control" id="type_of_paper">
                                <option value="7">Essay</option>
                                <option value="8">Term Paper</option>
                                <option value="9">Research Paper</option>
                                <option value="10">Coursework</option>
                                <option value="11">Book report</option>
                                <option value="12">Book review</option>
                            </select>
                        </div>
                    </div>
                    <div class="_ct">
                        <div class="_title _pr">
                            <label>Subject area:</label>
                        </div>
                        <div class="form-group _option _op">
                            <select class="form-control" id="subject_area">
                                <option value="13">Architecture</option>
                                <option value="14">Movies</option>
                                <option value="15">Research Paper</option>
                                <option value="16">Music</option>
                                <option value="17">Paintings</option>
                            </select>
                        </div>
                    </div>
                    <div class="_ct">
                        <?php
                        $check = true;
                        foreach ($list_urgency as $urgency) {?>
                            <!-- Group of default radios - option 1 -->
                            <div class="_custom-radio <?= $check?"active":"";?>">
                                <div class="_rd">
                                    <input type="radio" class="custom-control-input" value=<?= $urgency->Id?> name="groupOfDefaultRadios" data-name=<?= $urgency->Name_Service_Price?> <?= $check?"checked":"";$check = false;?>>
                                </div>
                                <div class="_price-day"><?= $urgency->Name_Service_Price?> days</div>
                                <div class="_price-pages">
                                    <span class="_prs" data-name=<?= $urgency->Name_Service_Price?>>$<?= $urgency->Price_USA?>.00</span><span>/page</span>
                                </div>
                                <div class="_price-date "><?php
                                    $date = new DateTime();
                                    $date->modify('+'.$urgency->Name_Service_Price.'day');
                                    if ($urgency->Name_Service_Price < 7){
                                        echo $date->format('l').' at '.$date->format('H:m A');
                                    }
                                    else{
                                        echo  $date->format('d/m/Y');
                                    }
                                    ?></div>
                            </div>
                        <?php }?>
                        <?php //echo $this->render('_prices-urgency',['list_urgency'=>$list_urgency]); ?>
                    </div>


                    <div class="_ct _total-prs">
                        <!--<div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="_total-prices _total-pr">
                            <p class="_total-p">Total price:</p>
                            <span id="_total-prices">$12.99</span>
                        </div>
                        </div>-->
                        <div class="price_btn">
                            <div class="_pr-order">
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('order?service_id=1&paper_id=1&subject_id=1&urgency_type_id=17&currency=30');?>" id="_prices-order">Order Now</a>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <!--<div class="col-md-12 col-sm-6 col-xs-12 widget ">
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
            </div>-->
        </div>
    </div>

</div>
<?php
$script = <<< JS
$(document).ready(function () {
    
    
    //change form attribute
    $('#price-order').on('change', function () {
        RefreshUrl();
    });
    //click list prices
    $('._custom-radio').click(function () {
        $('.active').removeClass('active');
        $(this).addClass('active').find('input').prop('checked', true);
        RefreshUrl();

    });
    //click Type Of Currency page price
$('.writer-radio').click(function () {
    $('.writer-radio.paper-active').removeClass('paper-active');
    $(this).addClass('paper-active').find('input').prop('checked', true);
    Setprice();
    RefreshUrl();
});
    function Setprice() {
        var formData = new FormData($("#price-order")[0]);
        $.ajax({
            url: 'site/prices',
            type: 'POST',
            data: formData,
            datatype: 'json',

            'success': function (response) {
                var get_name_currency = $('input[class=wr-radio]:checked').attr('data-name');
                $("._prs").each(function() {
                    var x = $(this).attr('data-name');
                    if (get_name_currency == "VND"){
                    $(this).text(response.data[0][x].toLocaleString('en-US', {
                                style: 'currency',
                                currency: 'VND'
                            }));
                } 
                else if (get_name_currency == "USD"){
                    $(this).text(response.data[0][x].toLocaleString('en-US', {
                                style: 'currency',
                                currency: 'USD'
                            }));
                } 
                });
                
                
                
                
                /*var radios = $('._custom-radio').find("input[type=radio]");
                var x = radios.attr('data-name');
                var y = response.data[0][x];
                alert(y);
                $('._custom-radio').each(function () {                                                                
                var radios = $(this).find("input[type=radio]");
                if (radios.length > 0) {
                //var randomnumber = Math.floor(Math.random() * radios.length);
                //$(radios[randomnumber]).prop("checked", true);
                var x = radios.attr('data-name');
                var y = response.data[0].x;
                if (get_name_currency == "VND"){
                    document.getElementById('_price-urgency').innerText()
                        radios.setAttribute('data-prices',radios.attr('data-prices'));
                } 
                else if (get_name_currency == "USD"){
                    radios.setAttribute('data-prices',radios.attr('data-prices'));
                } 
            }});*/
                // on success do some validation or refresh the content div to display the uploaded images
                /*try {
                    if (!isNaN(response.data[0])) {
                        //if ($('.level-radio.paper-active').find('span').text() === 'VN') {
                            $('#_price_total_order').text(response.data[0].toLocaleString('it-IT', {
                                style: 'currency',
                                currency: 'VND'
                            }));*/
                        /*} else {
                            $('#_price_total_order').text(response.data[0].toLocaleString('it-IT', {
                                style: 'currency',
                                currency: 'USD'
                            }));
                        }*/
                        /*$('#_page-of-file').text(response.data[1]);
                    }
                }
                    catch (e) {
                        $('#w3-error-0').removeClass('_out');
                        $('#w3-error-0').addClass('_in');
                        $('#w3-error-0').append('Lỗi trong quá trình xử lý');
                    }*/
            },


            'error': function () {

            },
            cache: false,
            contentType: false,
            processData: false
        });
        /*var get_name_currency = $('input[class=wr-radio]:checked').attr('data-name');
        $('._custom-radio').each(function () {                                                                
            var radios = $(this).find("input[type=radio]");
            if (radios.length > 0) {
                //var randomnumber = Math.floor(Math.random() * radios.length);
                //$(radios[randomnumber]).prop("checked", true);
                if (get_name_currency == "VND"){
                        radios.setAttribute('data-prices',radios.attr('data-prices'));
                } 
                else if (get_name_currency == "USD"){
                    radios.setAttribute('data-prices',radios.attr('data-prices'));
                } 
            }
        });
        */
    }
    function RefreshUrl() {
        var type_pf_service = document.getElementById("type_of_service");
        var id_type_pf_service = type_pf_service.options[type_pf_service.selectedIndex].value;
        var type_of_paper = document.getElementById("type_of_paper");
        var id_type_of_paper = type_of_paper.options[type_of_paper.selectedIndex].value;
        var subject_area = document.getElementById("subject_area");
        var id_subject_area = subject_area.options[subject_area.selectedIndex].value;
        var x = $('input[class=wr-radio]:checked').val();
        var link = 'order?service_id=' + id_type_pf_service + '&paper_id=' + id_type_of_paper+ '&subject_id=' +id_subject_area+ '&urgency_type_id=' + $('input[name=groupOfDefaultRadios]:checked').val()+'&currency='+$('input[class=wr-radio]:checked').val();
        document.getElementById("_prices-order").href = link;
    }
});
JS;
$this->registerJs($script);
?>