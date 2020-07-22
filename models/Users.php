<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Users extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    public static function findByEmail($email)
    {
        return static::findOne(['Email' => $email, 'status' => self::STATUS_ACTIVE]);
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getActivationCode()
    {
        return $this->ActivationCode;
    }
    public function validateActivationCode($activationcode)
    {
        return $this->getActivationCode() === $activationcode;
    }
    /*
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current account
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /*
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->Password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->ActivationCode = Yii::$app->security->generateRandomString();
    }
    public function getAuthKey()
    {
        return $this->IsEmailVerified;
    }
    public function setEmail($email)
    {
        $this->EmailID = $email;
    }
}
?>