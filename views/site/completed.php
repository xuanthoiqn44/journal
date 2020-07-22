<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 11/21/2018
 * Time: 10:53 PM
 */$this->title = 'Viet Young';
use yii\helpers\Url;

?>
<div class="row text-center">
    <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color:#0fad00">Thành công</h2>
        <p style="font-size:20px;color:#5C5C5C;">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p><br>
        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('user/my-order');?>" class="btn btn-primary" >My Order</a>
        <a href="<?php echo Yii::$app->homeUrl;?>" class="btn btn-primary">Về trang chủ</a>
        <br><br>
    </div>
</div>
