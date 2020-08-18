<?php

namespace app\models;

use Yii;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * Signup form
 */
class RegisterForm extends Model
{
    //public $username;
    public $EmailID;
    public $Password;
    public $ConfirmPassword;
    public $FirstName;
    public $LastName;
    public $Phone_Number;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['EmailID','FirstName','LastName','Password','ConfirmPassword','Phone_Number'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            ['EmailID', 'trim'],
            [['FirstName'],'required'],
            [['LastName'],'required'],
            [['EmailID'],'required'],
            [['Password'],'required'],
            [['ConfirmPassword'],'required'],
            [['Phone_Number'], 'required'],
            ['FirstName','string','max'=>30],
            ['LastName','string','max'=>30],
            ['EmailID', 'email'],
            ['EmailID', 'string', 'max' => 50],
            ['EmailID', 'unique', 'targetClass' => '\app\models\User'],
            ['Phone_Number', 'unique', 'targetClass' => '\app\models\User'],
            ['Password', 'string', 'min' => 6],
            ['ConfirmPassword', 'compare', 'compareAttribute'=>'Password'],
            ['Password','match', 'pattern'=>"/^([a-zA-Z0-9]+)$/"],
            ['Password','match', 'pattern'=>"/^(?=.*[0-9])(?=.*[A-Z])/", 'message'=>\Yii::t('app', 'Passwords must have at least one upper-case letter and at least one digit')],
            [['Phone_Number'], 'integer'],
            [['Phone_Number'], 'string', 'min' => 10,'max'=>15],
            //[['Phone_Number'], PhoneInputValidator::className(),'message'=>"The format of Phone Number is invalid."],
            //[['Phone_Number'], 'udokmeci\yii2PhoneValidator\PhoneValidator'],
        ];
        return array_merge(parent::rules(),$rules);
    }
    public function attributeLabels()
    {
        $attribute = [
            'EmailID' => \Yii::t('app', 'Email ID'),
            'FirstName' => \Yii::t('app', 'First Name'),
            'LastName' => \Yii::t('app', 'Last Name'),
            'Password' => \Yii::t('app', 'Password'),
            'Phone_Number' => \Yii::t('app', 'Phone Number'),
            'ConfirmPassword' => \Yii::t('app', 'Confirm Password'),
        ];
        return array_merge(parent::attributeLabels(), $attribute);   
    }

    /**
     * Signs account up.
     *
     * @return User the saved model or null if saving fails
     */
    public function Register()
    {

        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->EmailID = $this->EmailID;
        $user->setPassword($this->Password);
        $user->FirstName = $this->FirstName;
        $user->LastName = $this->LastName;
        $user->Phone_Number = $this->Phone_Number;
        $user->Role = 4;
        $user->generateAuthKey();
        $user->Date_Create = date('Y-m-d H:i:s');
        return $user->save() ? $user : null;
    }

}
