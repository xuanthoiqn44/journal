<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/12/2018
 * Time: 21:50
 */

namespace app\models;


use yii\base\Model;
use Yii;

class SendMail extends Model
{
    public function SendMail($id_user,$html_page,$text_page,$subject)
    {
        $user = User::findOne([
            //'status' => User::STATUS_ACTIVE,
            'id' => $id_user,
        ]);

        if (!$user) {
            return false;
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => $html_page, 'text' => $text_page],
                ['user'=>$user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'VietYoung support'])
            ->setTo($user->EmailID)
            ->setSubject($subject)
            ->send();
    }
}