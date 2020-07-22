<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$asset =  AppAsset::register($this);
$baseUrl = $asset->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="header-area">

        <div class="order-login">
        <a href= "<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/order'); ?>" class="btn _order">Order</a>
            <?php  if (Yii::$app->user->isGuest){ ?>
        <!--<a href= "<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/login'); ?>" class="btn _login">Login</a>-->
                <a href="javascript:void(0);" class="btn _login" onclick="login();return false;">Login</a>
            <?php }else { ?>
                <div class="_usname">
                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('user/profile');?>">Hi,<?php echo Yii::$app->user->identity->username ?></a>
                </div>
            <?php }?>
        </div>
<?php
    NavBar::begin([
            'renderInnerContainer'=>false ,
        'brandLabel' => 'Academic Writing Service',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar container _navmenu',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left menu'],
        'items' => [
            [
                'label' => 'Services',
                'options'=>['class'=>'dropdown'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',
                'items' => [
                    ['label' => 'Writing services', 'url' => ['site/writing-service']],
                    ['label' => 'Proofreading', 'url' => ['site/proofreading']],
                    ['label' => 'Math/Science', 'url' => ['site/math-science']],
                    ['label' => 'Copywriting', 'url' => ['site/copywriting']],
                    ['label' => 'Rewriting', 'url' => ['site/rewriting']],
                    ['label' => 'Editing', 'url' => ['site/editing']],
                ]
            ],
            ['label' => 'Prices', 'url' => ['site/prices']],
            //['label' => 'Samples', 'url' => ['/sample']],
            ['label' => 'Reviews', 'url' => ['site/reviews']],
            ['label' => 'Discount', 'url' => ['site/discounts']],
            ['label' => 'Our writers', 'url' => ['site/writers']],
            ['label' => 'About us','url' => ['site/about-us']],
        ],
    ]);
    NavBar::end();?>
    </div>


    <div class="container">
        <?php //echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
        <?= Alert::widget() ?>
        <div id="w3-error-0" class="alert-danger alert fade _out">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
        <?= Yii::$app->session->getFlash('error'); ?>
        <?= Yii::$app->session->getFlash('success'); ?>
        <?= $content?>
    </div>
</div>

<footer class="footer-area">
    <div class="container">
        <!-- Contact Info -->
        <div class="row">
            <center><p style="color: #666666">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p></center>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
