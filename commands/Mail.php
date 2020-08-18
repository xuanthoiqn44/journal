<?php 

namespace app\commands;

use yii;
use yii\base\BaseObject;

class Mail extends BaseObject implements \yii\queue\JobInterface {

    public $user;
    public $resetLink;
    public $to;
    public $fullName;
    public $view;
    public $text;
    public $subject;

    public function execute($queue)
    {
        Yii::$app
            ->mailer
            ->compose(
                ['html' => $this->view, 'text' => $this->text],
                ['resetLink'=>$this->resetLink, 'fullName' => $this->fullName]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'VietYoung support'])
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->send();
    }
}