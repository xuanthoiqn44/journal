<?php

namespace app\models;

use yii;
use yii\base\Model;
use yii\base\InvalidParamException;

/**
 * Password reset form
 */
class VerifyAccount extends Model
{


    /**
     * @var \app\models\User
     */
    private $_user;
    public $isVerified = true;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        $this->_user = User::findByAccountToken($token);
        if (!$this->_user) {
            $this->isVerified = false;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
*/
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function AcceptVerify()
    {
        $user = $this->_user;
        $user->setActive();
        $user->Auth_key = '';
        return $user->save(false);
    }

}