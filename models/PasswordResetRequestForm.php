<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $EmailID;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['EmailID'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            ['EmailID', 'trim'],
            ['EmailID', 'required'],
            ['EmailID', 'email'],
        ];
        return array_merge(parent::rules(),$rules);
        /*return [
            ['EmailID', 'trim'],
            ['EmailID', 'required'],
            ['EmailID', 'email'],
            ['EmailID', 'exist',
                'targetClass' => '\app\models\User',
                //'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];*/
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            //'status' => User::STATUS_ACTIVE,
            'EmailID' => $this->EmailID,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->Password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'VietYoung support'])
            ->setTo($this->EmailID)
            ->setSubject('Password reset ')
            ->send();
    }

}