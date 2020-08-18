<?php

namespace app\models;

use yii;
use yii\base\Model;
use yii\base\InvalidParamException;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{

    public $password;
    public $confirmPassword;
    public $isReset = true;

    /**
     * @var \app\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            $this->isReset = false;
            // throw new \yii\web\HttpException(404, 'Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['password'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            ['password', 'required'],
            [['confirmPassword'],'required','message'=>"Confirm Password cannot be blank"],
            ['password','match', 'pattern'=>"/^([a-zA-Z0-9]+)$/", 'message'=>"Passwords is invalid"],
            ['password','match', 'pattern'=>"/^(?=.*[0-9])(?=.*[A-Z])/", 'message'=>"Passwords must have at least one upper-case letter and at least one digit"],
            ['password', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
        ];
        return array_merge(parent::rules(),$rules);
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->IsEmailVerified = 1;
        $user->removePasswordResetToken();
        return $user->save(false);
    }

}