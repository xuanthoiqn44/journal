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
        <div class="container">
            <?= Yii\helpers\Html::a(Html::img('@web/img/language/vi_lang.png', ['class' => '']), '/vi'); ?>
            <?= Yii\helpers\Html::a(Html::img('@web/img/language/en_lang.png', ['class' => '']), '/en'); ?>
        </div>
        <div class="order-login">
        <a href= "<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/order'); ?>" class="btn _order"><?php echo \Yii::t('app', 'Order')?></a>
            <?php  if (Yii::$app->user->isGuest){ ?>
        <!--<a href= "<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/login'); ?>" class="btn _login">Login</a>-->
                <a href="javascript:void(0);" class="btn _login" onclick="login();return false;"><?=\Yii::t('app', 'Login')?></a>
            <?php }else { ?>
            <div class="_usname">
                <?php
                echo Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        \Yii::t('app', 'Logout'),['class'=>'btn _login']
                    )
                    . Html::endForm()
                ?>
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
                'label' => \Yii::t('app', 'Services'),
                'options'=>['class'=>'dropdown'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',
                'items' => [
                    ['label' => \Yii::t('app', 'Writing services'), 'url' => ['site/writing-service']],
                    ['label' => \Yii::t('app', 'Proofreading'), 'url' => ['site/proofreading']],
                    ['label' => \Yii::t('app', 'Math/Science'), 'url' => ['site/math-science']],
                    ['label' => \Yii::t('app', 'Copywriting'), 'url' => ['site/copywriting']],
                    ['label' => \Yii::t('app', 'Rewriting'), 'url' => ['site/rewriting']],
                    ['label' => \Yii::t('app', 'Editing'), 'url' => ['site/editing']],
                ]
            ],
            ['label' => \Yii::t('app', 'Prices'), 'url' => ['site/prices']],
            //['label' => 'Samples', 'url' => ['/sample']],
            ['label' => \Yii::t('app', 'Reviews'), 'url' => ['site/reviews']],
            ['label' => \Yii::t('app', 'Discount'), 'url' => ['site/discounts']],
            ['label' => \Yii::t('app', 'Our writers'), 'url' => ['site/writers']],
            ['label' => \Yii::t('app', 'About us'),'url' => ['site/about-us']],
        ],
    ]);
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left menu','id'=>'nav-user'],
        'items' => [
        ['label' => \Yii::t('app', 'Profile'), 'url' => ['user/profile']],
        ['label' => \Yii::t('app', 'My Orders'), 'url' => ['user/my-order']],
        ['label' => \Yii::t('app', 'My Feedbacks'), 'url' => ['user/feedbacks']],
        ],
        ]);
        NavBar::end();?>
    </div>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= Yii::$app->session->getFlash('error'); ?>
        <?= Yii::$app->session->getFlash('success'); ?>
        <!--menu user-->
        <?= Yii::$app->controller->renderPartial('_MenuUser'); ?>
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
