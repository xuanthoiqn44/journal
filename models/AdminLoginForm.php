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
class AdminLoginForm extends Model
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
        /*return [
            // username and password are both required
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'trim'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            //['password','match', 'pattern'=>"/^([a-zA-Z0-9_-]*)$/"],
            ['password', 'validatePassword'],

        ];*/
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

            if ($user)
            {
                if (!$user->validatePassword($this->password))
                {
                    $this->addError($attribute, 'Incorrect email or password.');
                }
                else if ($user->getRole() != 1){
                    $this->addError($attribute, 'Incorrect email or password.');
                }
                else if ($user->getActive()===0)
                {
                    $this->addError($attribute, 'Please verify email first.');
                }
            }
            else
            {
                $this->addError($attribute, "Incorrect email or password.");
            }
            /*if (!$user || !$user->validatePassword($this->password) || $user->Role != 4) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
            else if ($user->getActive()===0)
            {
                $this->addError($attribute, 'Please verify email first.');
            }*/
        }
    }

    /**
     * Logs in a account using the provided username and password.
     * @return bool whether the account is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            //if (User::)
            {
                return Yii::$app->user->login($this->getUser(), 30,true,true);
            }

        }
        return false;
    }

    /**
     * Finds account by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmailID($this->email);
            //$this->_user = User::findOne(['EmailID'=>$this->email,'Role'=>4]);
        }

        return $this->_user;
    }

}
