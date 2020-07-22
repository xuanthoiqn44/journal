<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/22/2018
 * Time: 3:37 PM
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\Editor;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;

//$models = $dataProvider->getModels();
$this->title = 'Our writers';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="regular-page-area">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="page-content">
                <h3>Our writers </h3><hr>
                <h4>Get Acquainted with Our Writers</h4><br>
                <p>If a writer wants to work with us, first of all s/he should present all the academic information about studies. After the confirmation about the graduation and achieved results while studying there comes a time of professional verification. Each participant receives a writing task to complete in 24 hours. Usually those are small essays on various up-to-date topics. If the task is completed correctly – there will come the final grammar/composition exam together with an original piece of writing on the assigned topic. If s/he meets all the requirements, that candidate is being hired for a 90-day probation, during which easier orders are being assigned to s/he, as well, as a skilled writer is carefully observing the work done. After the probationary period only those will be left, who can stand up to our high expectations/requirements and be able to meet the deadline while providing highly qualified piece of custom writing.</p><br>
                <h4>Show writers who:</h4><br>

                <div class="table-responsive">

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel'=>$searchModel,
                    //'filterPosition' => \yii\grid\GridView::FILTER_POS_HEADER,
                    //'layout'=>"{pager}\n{summary}\n{items}",
                    'summary'=> "",
                    'id' => 'table',

                    'columns' => [
                        [
                                'class' => 'yii\grid\SerialColumn',
                                //'value'=>'N0',
                        ],
                        [
                            'attribute'=>'Image',
                            'label'=>'Picture',
                            'contentOptions' =>function ($model, $key, $index, $column){
                                return ['class' => '_image'];
                            },
                            'content'=>function($data){
                                return "<div class='_image_user'><img src=".Url::to('@web/assets/img/bg-img/writer-3d087f6f2bb692adca3616965214164cf8ad9d4f2ce8c50f2c8196144270c941.png')."></div>"."<a href=".Yii::$app->urlManager->createAbsoluteUrl('writers/id/'.$data->id).">View profile</a>";
                            }
                        ],

                        [
                            'attribute'=>'Writer_id',
                            'label' => "Writer's ID",
                            'value' => 'id',
                            'headerOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'label' => 'Rating',
                            'attribute'=>'Rating',
                            'enableSorting' => false,
                            //'value' => 'Score',
                            'content' =>function ($model) {
                                return "<span >".$model->Rating."/5</span>";
                            },
                            //'filter'=>Html::activeDropDownList($searchModel,'Skill_Writer',app\models\Editor::get_SkillWriter(),['prompt'=>'All','class' => 'form-control']),
                            //'filterInputOptions' => ['class' => 'form-control', 'id' => null],
                        ],
                        [
                            'label' => 'Skill',
                            'enableSorting' => false,
                            'attribute'=>'Skill_Writer',
                            'value' => 'skillWriter.NameSkill',
                            //'content' =>function ($model) {
                              //  return "<span >".$model->Chuyen_Nganh."</span>";
                            //},
                            'filter'=>Html::activeDropDownList($searchModel,'Skill_Writer',app\models\Editor::get_SkillWriter(),['prompt'=>'All','class' => 'form-control']),
                        ],
                        [
                            'label' => 'Completed orders',
                            'attribute'=>'Completed_order',
                            'value' => 'Completed_order',
                            'enableSorting' => false,
                            'filter'=> Html::activeDropDownList($searchModel,'Completed_order',app\models\Editor::getOrderPlus(),['class' => 'form-control']),
                        ],
                        [
                            'label' => 'Status',
                            'attribute'=>'Status',
                            'enableSorting' => false,
                            'content' =>function ($model) {

                                return $model->Status=='1'?"<span style='color:green;'>Open to suggestions</span>":"<span style='color: #99A3BF;'>Searching for orders</span>";

                            },
                            'filter'=> Html::activeDropDownList($searchModel,'Status',app\models\Editor::getStatus(),['class' => 'form-control']),
                            //'filter'=> Html::dropDownList('WritersSearch[Status]','',app\models\Editor::getStatus(),['prompt'=>'All','class' => 'form-control']),
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            //'header' => 'Actions',
                            //'headerOptions' => [],
                            'template' => '{order}',
                            'buttons' => [
                                'order' => function ($url, $model) {
                                    return Html::a('<button class="btn _writer_order">Request this writer</button>', $url, [
                                        'title' => Yii::t('app', 'Order'),
                                    ]);
                                },
                            ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'order') {
                                    $url ='order/writer_id/'.$model->id;
                                    return $url;
                                }


                            }
                        ],

                    ],
                ])?>

                </div>
            </div>

        </div>
    </div>


</div>
