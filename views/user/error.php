<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'VietYoung';
?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <div></div>
            <h1>Error</h1>
        </div>
        <h2>Error to process</h2>
        <p><?= $message?$message:'The page you are looking for might have been removed had its name changed or is temporarily unavailable.'?></p>
        <!--<a href="#">home page</a>-->
    </div>
</div>

