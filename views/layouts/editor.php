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
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <?php echo Html::cssFile($asset->baseUrl.'/assets/admin/demo/demo.css')?>
    <?= Html::cssFile($asset->baseUrl.'/css/site.css')?>
    <?php echo Html::cssFile($asset->baseUrl.'/assets/admin/css/material-dashboard.css')?>

    <!-- CSS Files-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="<?php echo Yii::$app->homeUrl;?>" target="_blank" class="simple-text logo-normal">
                Academy Writing Service
            </a>
        </div>
        <!--menu admin-->
        <?= Yii::$app->controller->renderPartial('_MenuEditor'); ?>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <!--<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="material-icons">dashboard</i>
                                <p class="d-lg-none d-md-block">
                                    Stats
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p class="d-lg-none d-md-block">
                                    Some Actions
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Mike John responded to your email</a>
                                <a class="dropdown-item" href="#">You have 5 new tasks</a>
                                <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                                <a class="dropdown-item" href="#">Another Notification</a>
                                <a class="dropdown-item" href="#">Another One</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>-->
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
    <?= $content?>
        <div class="notification">
            <?= Alert::widget() ?>
        <?php if (Yii::$app->session->hasFlash('success')): ?>

            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <span>
                      <?= Yii::$app->session->getFlash('success') ?></span>
            </div>

        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>

            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <span>
                    <?= Yii::$app->session->getFlash('error') ?>
                </span>
            </div>


        <?php endif; ?>
        </div>
        </div>
    <footer class="footer">
        <div class="container-fluid">

            <div class="copyright ">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a >VietYoung</a>
            </div>
        </div>
    </footer>

    </div>
</div>


<!--   Core JS Files   -->
<?php echo Html::jsFile($asset->baseUrl.'/assets/admin/demo/demo.js')?>
<?php echo Html::jsFile($asset->baseUrl.'/assets/admin/js/material-dashboard.js')?>
<?php echo Html::jsFile($asset->baseUrl.'/assets/admin/js/plugins/bootstrap-notify.js')?>
<?php echo Html::jsFile($asset->baseUrl.'/assets/admin/js/core/popper.min.js')?>
<?php echo Html::jsFile($asset->baseUrl.'/assets/admin/js/core/bootstrap-material-design.min.js')?>
<?php echo Html::jsFile($asset->baseUrl.'/assets/admin/js/plugins/moment.min.js')?>
<?php echo Html::jsFile($asset->baseUrl.'/assets/admin/js/plugins/sweetalert2.js')?>
<?php echo Html::jsFile($asset->baseUrl.'/assets/admin/js/plugins/jasny-bootstrap.min.js')?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
