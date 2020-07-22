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
            [['FirstName'],'required','message'=>"First Name cannot be blank"],
            [['LastName'],'required','message'=>"Last Name cannot be blank"],
            [['EmailID'],'required','message'=>"Email cannot be blank"],
            [['Password'],'required','message'=>"Password cannot be blank"],
            [['ConfirmPassword'],'required','message'=>"Confirm Password cannot be blank"],
            [['Phone_Number'], 'required','message'=>"Phone Number cannot be blank"],
            ['FirstName','string','max'=>30],
            ['LastName','string','max'=>30],
            ['EmailID', 'email','message'=>"Email is not a valid email address."],
            ['EmailID', 'string', 'max' => 50],
            ['EmailID', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['Phone_Number', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This phone number has already been taken.'],
            ['Password', 'string', 'min' => 6],
            ['ConfirmPassword', 'compare', 'compareAttribute'=>'Password', 'message'=>"Passwords don't match" ],
            ['Password','match', 'pattern'=>"/^([a-zA-Z0-9]+)$/", 'message'=>"Passwords is invalid"],
            ['Password','match', 'pattern'=>"/^(?=.*[0-9])(?=.*[A-Z])/", 'message'=>"Passwords must have at least one upper-case letter and at least one digit"],
            [['Phone_Number'], 'integer','message'=>'Phone Number must be an integer.'],
            [['Phone_Number'], 'string', 'min' => 10,'max'=>15],
            //[['Phone_Number'], PhoneInputValidator::className(),'message'=>"The format of Phone Number is invalid."],
            //[['Phone_Number'], 'udokmeci\yii2PhoneValidator\PhoneValidator'],
        ];
        return array_merge(parent::rules(),$rules);
        /*return [

            ['EmailID', 'trim'],
            [['FirstName','LastName','EmailID','Password','ConfirmPassword'], 'required'],
            ['FirstName','string','max'=>255],
            ['LastName','string','max'=>255],
            ['EmailID', 'email'],
            ['EmailID', 'string', 'max' => 255],
            ['EmailID', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['Password', 'string', 'min' => 6],
            ['ConfirmPassword', 'compare', 'compareAttribute'=>'Password', 'message'=>"Passwords don't match" ],
            ['Password','match', 'pattern'=>"/^([a-zA-Z0-9]+)$/", 'message'=>"Passwords is invalid"],
            ['Password','match', 'pattern'=>"/^(?=.*[0-9])(?=.*[A-Z])/", 'message'=>"Passwords must have at least one upper-case letter and at least one digit"],
        ];*/
    }
    public function attributeLabels()
    {
        return [
            'EmailID' => "Email *",
            'FirstName' => "First Name *",
            'LastName' => "Last Name *",
            'Password' => "Password *",
            'Phone_Number' => "Phone Number *",
            'ConfirmPassword' => "Confirm Password *",
        ];
    }

    /**
     * Signs account up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function Register()
    {

        if (!$this->validate()) {
            return null;
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

    /*send code authen */
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

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'verifyAccount-html', 'text' => 'verifyAccount-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'VietYoung support'])
            ->setTo($this->EmailID)
            ->setSubject('Verify Account ')
            ->send();
    }


}
