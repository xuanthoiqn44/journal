<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $Password_hash
 * @property string $Password_reset_token
 * @property string $EmailID
 * @property string $Auth_key
 * @property string $status
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    //const STATUS_DELETED = 0;
    //const STATUS_ACTIVE = 1;
    const ROLE_ADMIN = 1;
    const ROLE_EDITOR = 3;
    const ROLE_STATUS_EDITOR_ACTIVE = 2;
    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }*/

    /**
     * @inheritdoc

    public function rules()
    {
        return [
            ['IsEmailVerified', 'default', 'value' => self::STATUS_ACTIVE],
            ['IsEmailVerified', 'int', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id,/* 'IsEmailVerified' => self::STATUS_ACTIVE*/]);
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['Id_Author' => 'id']);
    }
    public function getEditors()
    {
        return $this->hasOne(Editor::className(), ['Id_User' => 'id']);
    }
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['Id_User' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }*/

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->Auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if(is_null($password))
            return false;
        return Yii::$app->security->validatePassword($password, $this->Password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->Password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->Auth_key = Yii::$app->security->generateRandomString(). '_' . time();
    }
    public function getEmail()
    {
        // TODO: Implement getEmail() method.
        return $this->EmailID;
    }
    /*public  static function findByEmailID($email)
    {
        return static::findOne(['EmailID' => $email, 'IsEmailVerified' => 1]);
    }*/
    public  static function findByEmailID($email)
    {
        return static::findOne(['EmailID' => $email]);
    }
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
        return $this->LastName;
    }
    public function getImage()
    {
        return $this->Image;
    }
    public function getIsAdmin()
    {
        return $this->Role == self::ROLE_ADMIN;
    }
    public function getIsEditor()
    {
        // TODO: Implement getIsEditor() method.
        return $this->Role == self::ROLE_EDITOR && (Editor::findOne(['Id_User'=>$this->getId()]))->Status_Active == self::ROLE_STATUS_EDITOR_ACTIVE;
    }
    public function getID_EDITOR()
    {
        return (Editor::findOne(['Id_User'=>$this->getId()]))->id;
    }

    public function getActive()
    {
        // TODO: Implement getActive() method.
        return $this->IsEmailVerified;
    }
    public function getRole()
    {
        // TODO: Implement getActive() method.
        return $this->Role;
    }
    public function setActive()
    {
        $this->IsEmailVerified = 1;
    }
    //reset password
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'Password_reset_token' => $token,
            //'status' => self::STATUS_ACTIVE,
        ]);
    }
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    public function generatePasswordResetToken()
    {
        $this->Password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removePasswordResetToken()
    {
        $this->Password_reset_token = null;
    }
    public function emailVerify($verified = true) {
        $this->IsEmailVerified = $verified ? 1 : 0;
    }
    /*Verify token*/
    public static function findByAccountToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'Auth_key' => $token,
            //'status' => self::STATUS_ACTIVE,
        ]);
    }
    public function getPhoneNumber(){
        return $this->Phone_Number?$this->Phone_Number:'';
    }
    public function getFullName(){
        return $this->FirstName . ' ' . $this->LastName;
    }
}