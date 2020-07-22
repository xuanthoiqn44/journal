<?php
/**
 * Created by PhpStorm.
 * User: xuanthoiqn44
 * Date: 12/02/2019
 * Time: 21:40
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\bootstrap\Modal;
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add Editor</h4>
                        <p class="card-category">Complete your profile</p>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['id' => 'form-add-editor']); ?>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label>Select Skill</label>
                            <?php echo Html::activeDropDownList($model_add_editor,'skill',app\models\Editor::get_SkillWriter(),['class' => 'form-control']);?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                            <?php  echo $form->field($model_add_editor, 'upload_file_editor',[
                                'template' => '<div class="order-form-group"><div class="">{label}</div><div class="col-md-9">{input}{error}</div></div>'])->fileInput();?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= Html::submitButton('Add Editor', ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
