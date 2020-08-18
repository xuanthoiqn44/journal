<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $account This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        $rules = [
            [['email','password'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'trim'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
        return array_merge(parent::rules(),$rules);
    }
    public function attributeLabels()
    {
        $attribute = [
            'password' => \Yii::t('app', 'Password'),
            'email' => \Yii::t('app', 'Email ID'),
            'rememberMe' => \Yii::t('app', 'remember me'),
        ];
        return array_merge(parent::attributeLabels(), $attribute);   
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password) || $user->getRole() != 4)
            {
                $this->addError($attribute, \Yii::t('app', 'Incorrect email or password.'));
            }
            else if (!$user->getActive())
            {
                $this->addError($attribute, \Yii::t('app', 'Please verify email first.'));
            }
            else if ($user->Status==0)
            {
                $this->addError($attribute, \Yii::t('app', 'Your account has been blocked by admin please contact admin to unlock.'));
            }
        }
    }

    /**
     * Logs in a account using the provided username and password.
     * @return bool whether the account is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);

        }
        return false;
    }

    /**
     * Finds account by [[username]]
     *
     * @return User|bool
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmailID($this->email);
        }

        return $this->_user;
    }

}
