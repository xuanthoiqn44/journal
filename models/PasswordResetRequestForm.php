<?php

namespace app\models;

use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $EmailID;
    const IS_EMAIL_VERIFIED = 1;
    const EMAIL_VERIFIED_EXPIRED = 1;
    const EMAIL_VERIFIED = 0;
    private $_user = false;

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
            ['EmailID', 'validateEmail'],
        ];
        return array_merge(parent::rules(),$rules);
    }
    /**
     * Validates the email.
     * This method serves as the inline validation for email.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if ($user)
            {
                if (!$user->getActive())
                {
                    $this->addError($attribute, \Yii::t('app', 'Please verify email first.'));
                }
            }
            else
            {
                $this->addError($attribute, \Yii::t('app', 'Incorrect email.'));
            }
        }
    }
    /**
     * Finds account by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmailID($this->EmailID);
        }

        return $this->_user;
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return object|false whether the email was send
     */
    public function resetPassword()
    {
        /* @var $user User */
        $user = User::findOne([
            'EmailID' => $this->EmailID,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->Password_reset_token)) {
            $user->generatePasswordResetToken();
            return $user->save() ? $user : false;
        }
        return false;
    }
    public function attributeLabels()
    {
        $attribute = [
            'EmailID' => \Yii::t('app', 'Email ID'),
        ];
        return array_merge(parent::attributeLabels(), $attribute);   
    }

}