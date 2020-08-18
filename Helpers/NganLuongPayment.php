<?php 

namespace app\Helpers;

use app\models\OrderPost;
use yii;

class NganLuongPayment {

    public $result;
    public $bank_code;
    public $method;

    public function __construct()
    {
        
    }
    public function purchase(OrderPost $model) {
        $this->result = Yii::$app->NLGateway->purchase([
            'payment_method' => $this->method,
            'bank_code' => $this->bank_code,
            'buyer_mobile' => Yii::$app->user->identity->getPhoneNumber(),
            'order_description' => $model->topic,
            'buyer_fullname' => Yii::$app->user->identity->getFullName(),
            'time_limit'=>10,
            'buyer_email' => Yii::$app->user->identity->getEmail(),
            'total_amount' => $model->total_prices,
            //'total_amount' =>5000,
            'order_code' => $model->order_code,
            'cur_code' => $model->id_type_of_currency,
            'cancel_url' => Yii::$app->urlManager->createAbsoluteUrl('order'),
            'return_url' => Yii::$app->urlManager->createAbsoluteUrl('completed')
        ]);
    }
}