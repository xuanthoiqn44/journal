<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\console\widgets\Table;
use yii\widgets\LinkPager;
use kartik\rating\StarRating;

$this->title = 'My Order';
?>
<div class="col-md-9 col-sm-9 col-xs-12">
    <div class="block-progres">
        <?php if (!$post->feedback && $post->Status == "Completed"){?>
        <div class="col-md-3 time">
            <div>
                <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'rating')->widget(StarRating::classname(), [
                'pluginOptions' => [
                    'showClear' => false,
                    'showCaption' => false,
                    'step' => 1,
                    'min' => 0,
                    'max' => 5
                    //'displayOnly' => true
                ]
            ]); ?>

                <?= Html::submitButton('Submit',['class'=>'btn btn-success']); ?>
            <?php ActiveForm::end();?>
            </div>
        </div>
        <?php }?>
    <div class="<?php echo $post->Status=="Completed"&& !$post->feedback?'col-md-9':'col-md-12'?> data">
        <div class="title">
            <?php echo $post->Status?>
            <div class="rating">
                <?php if ($post->feedback) {
                    echo StarRating::widget([
                        'model' => $model,
                        'name' => 'rating',
                        'value' => $post->feedback->Rate,
                        'pluginOptions' => ['disabled' => true, 'showClear' => false,'showCaption' => false,'size' => 'xs']
                    ]);
                }
                ?>
            </div>
        </div>

        <div class="for-circle-loader" style="min-height: 111px; margin-top: -10px;"><div>
            </div>
            <table>
                <tbody>
                <tr>
                    <td class="dedline">Deadline:</td>
                    <td><?php echo $post->Deadline?$post->Deadline:'----' ?></td>
                </tr>
                <tr>
                    <td class="price">Price:</td>
                    <td>$<?php echo $post->Price?$post->Price:'----' ?></td>
                </tr>
                <tr>
                    <td class="writes">Writer's ID:</td>
                    <td><div class="break-word"><a href='<?php echo  $post->Id_Editor?\yii\helpers\Url::to(['site/writers','id'=>$post->Id_Editor]):'#'?>'><?php echo $post->Id_Editor?$post->Id_Editor:'No writer yet' ?></a></div> </td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>
</div>
    <div class="block-information">
        <div class="information collapse-info border-box">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading" id="headingOne">
                        <h4 class="panel-title">
                            <a class="down-arrow" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Information</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="number-box">

                                <ul class="cc col-md-3 col-xs-3 col-sm-3">
                                    <li>
                                        <span>Type of service</span>
                                    </li>
                                    <li><?php echo \app\models\Post::getNameService($post->Type_of_services)?></li>
                                </ul>
                                <ul class="col-md-3 col-xs-3 col-sm-3">
                                    <li>
                                        <span>Type of pages</span>
                                    </li>
                                    <li><?php echo \app\models\Post::getNameService($post->Type_of_paper)?></li>
                                </ul>
                                    <ul class="col-md-3 col-xs-3 col-sm-3">
                                    <li>
                                        <span>Subject Area</span>
                                    </li>
                                    <li><?php echo \app\models\Post::getNameService($post->Subject_area)?></li>
                                </ul>
                                <ul class="col-md-3 col-xs-3 col-sm-3">
                                    <li>
                                        <span>Page number</span>
                                    </li>
                                    <li><?php echo $post->PageNumbers?$post->PageNumbers:'0' ?></li>
                                </ul>

                            </div>
                            <div class="theme-box">
                                <ul class="col-md-3 col-xs-3 col-sm-3 theme">
                                    <li>
                                        <span>Type of Order</span>
                                    </li>
                                    <li><?php //if ($post->){}?></li>
                                </ul>
                                <ul class="col-md-3 col-xs-3 col-sm-3 theme">
                                    <li>
                                        <span>Topic</span>
                                    </li>
                                    <li><?php echo $post->Topic?></li>
                                </ul>
                                <div class="clear">

                                </div>
                            </div>
                            <div class="theme-box">
                                <ul class="theme">
                                    <li>
                                        <span>Paper details</span>
                                    </li>
                                    <li><?php echo $post->Decription?$post->Decription:'--------------------' ?></li>
                                </ul>

                                <div class="clear">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <div class="block-information">
        <div class="information collapse-info border-box">
            <div class="panel-group" id="accordion-your-file">
                <div class="panel panel-default">
                    <div class="panel-heading" id="heading2">
                        <h4 class="panel-title">
                            <a class="down-arrow" data-toggle="collapse" data-parent="#accordion-your-file" href="#your-file" aria-expanded="true" aria-controls="your-file">Your File</a>
                        </h4>
                    </div>
                    <div id="your-file" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="number-box">
                                <ul class="col-md-6 col-xs-6 col-sm-6">
                                    <div class="read-messages">
                                        <div>
                                            <div class="file-docx" style="display: inline-block;">

                                            </div>
                                            <div class="suport" style="display: inline-block;">
                                                <p><span>ME → WRITER</span></p>
                                                <p><span class="data-day"><?php echo $post->Date_Create?></span></p>
                                            </div>
                                        </div>
                                        <div style="padding-top: 10px;">
                                            <a href='<?php echo \yii\helpers\Url::to(['user/file','file'=>$post->File_Name,'type'=>'post'])?>'>
                                                <button class="btn btn-primary" data-file-id="164908">
                                                    <span class="glyphicon glyphicon-download">

                                                    </span>
                                                    Download
                                                    </button>

                                            </a>
                                        </div>
                                    </div>
                                </ul>
                                <?php if ($post->Status == 'Completed'){?>
                                <ul class="col-md-6 col-xs-6 col-sm-6">
                                    <div class="read-messages">
                                        <div>
                                            <div class="file-docx" style="display: inline-block;">

                                            </div>
                                            <div class="suport" style="display: inline-block;">
                                                <p><span>WRITER → ME</span></p>
                                                <p><span class="data-day"><?php echo $post->Date_Finish?></span></p>
                                            </div>
                                        </div>
                                        <div style="padding-top: 10px;">
                                            <a href='<?php echo \yii\helpers\Url::to(['user/file','file'=>$post->File_Editor_Completed,'type'=>'editor_completed'])?>'>
                                                <button class="btn btn-primary" data-file-id="164908">
                                                    <span class="glyphicon glyphicon-download">
                                                    </span>
                                                    Download
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </ul>
                                <?php }?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($post->Status == 'Completed'){?>
    <div class="block-information">
        <div class="information collapse-info border-box">
            <div class="panel-group" id="accordion-rewrite">
                <div class="panel panel-default">
                    <div class="panel-heading" id="heading3">
                        <h4 class="panel-title">
                            <a class="down-arrow" data-toggle="collapse" data-parent="#accordion-rewrite" href="#rewrite" aria-expanded="true" aria-controls="rewrite">Rewrite</a>
                        </h4>
                    </div>
                    <div id="rewrite" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="number-box">
                                <?php

                                    $form = ActiveForm::begin(['id'=>'form-rewrite']);?>
                                <div class="row">
                                    <div class="col-md-5">
                                        <?=$form->field($model_rewrite, 'upload_file_rewrite')->fileInput()->label()?>
                                    </div>
                                    <?php $model_rewrite->select_rewrite = 1;?>
                                <div class="col-md-7">
                                    <div class="col-md-6">
                                    <?=$form->field($model_rewrite, 'select_rewrite')->radioList([1 => 'Current editor', 0 => 'Another editor'],[])->label(false);?>
                                    </div>
                                <div class="box-rewrite">
                                    <div class="editor">
                                        <div class="id_editor">
                                            <?= $form->field($model_rewrite, 'id_editor',[
                                                'template' => '<div class="order-form-group"><div class="id-editor">{label}</div><div class="col-md-6 col-sm-6 col-xs-6">{input}{error}</div></div>']) ; ?>
                                            <div class="more_editor"><a href=<?=\yii\helpers\Url::to(['site/writers']);?>>our writer</a>
                                        </div>

                                </div>
                                </div>

                                </div>
                                <?php //Html::submitButton('Process to Payment',['class'=>'btn btn-success submit-form']);?>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 ">
                                        <?=$form->field($model_rewrite, 'description')->textarea(['rows' => '4']);?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-4 col-atm">
                                        <?=Html::submitButton('Process to payment',['id'=>'payment_ng','class'=>'btn btn-primary'])?>
                                    </div>

                                </div>
                                    <?php ActiveForm::end();
                                    //echo Html::a('Process to payment',['rewrite','token'=>$post->Token_Order,'type'=>'payment'],['class'=>'btn btn-success submit-form'])
                                ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php }?>
</div>
<?php
$script = <<< JS

    $('.radio').click(function () {
        var checked = $(this).find('input').prop('checked', true);
        if (checked[0].defaultValue === "0"){
            $('.box-rewrite').css('display', 'block');
        }
        else {
            $('.box-rewrite').css('display', 'none');
        }
    })
    

JS;
$this->registerJs($script);
?>
