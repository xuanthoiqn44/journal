<?php
/**
 * Created by PhpStorm.
 * User: xuanthoi
 * Date: 12/12/2018
 * Time: 22:41
 */

namespace app\commands;

use app\models\Post;
use app\models\TmpPost;
use yii;
use yii\base\BaseObject;


class Verify_Order extends BaseObject implements \yii\queue\JobInterface
{
    public $token ;
    public function execute($queue)
    {
        $responseData = Yii::$app->NLGateway->queryDR([
            'token' => $this->token
        ]);
        if ($responseData->error_code == "00") {
            // code thêm vào đây tùy theo mục đích của bạn.
            //check xem order da duoc them hay chua
            $insert_order = new Post();
            $get_order = Post::findOne(['Token_Order'=>$this->token]);
            //get order trong table tmp post
            $get_order_tmp = TmpPost::findOne(['Token_Order'=>$this->token]);
            //neu chua them thi them vao
            if($get_order == null && $get_order_tmp != null)
            {
                $insert_order->SavePost($get_order_tmp->Topic,$get_order_tmp->Id_Author,$get_order_tmp->Type_of_services,$get_order_tmp->Type_of_paper,$get_order_tmp->Subject_area,$get_order_tmp->Type_of_writer,$get_order_tmp->PageNumbers,$get_order_tmp->File_Name,$get_order_tmp->Date_Create,$get_order_tmp->Deadline,$get_order_tmp->Id_Editor,$get_order_tmp->Price,$get_order_tmp->Status,$get_order_tmp->Payment_Method,$get_order_tmp->Status_Order);
                $get_order_tmp->delete();
            }
        }
        else if ($responseData->error_code == "81"){
            $get_order = TmpPost::findOne(['Token_Order'=>$this->token]);
            $get_order->delete();
        }
    }
}