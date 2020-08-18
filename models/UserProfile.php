<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/24/2018
 * Time: 9:30 PM
 */

namespace app\models;

use yii;
use yii\base\Model;

class UserProfile extends Model
{
    public $FirstName;
    public $id;
    public $Image;
    public $EmailID;
    public $Phone_Number;
    public $LastName;
    public $Password;
    public $ConfirmPassword;
    public $skill;
    private $_user;
    public function rules()
    {
        $rules = [
            [['FirstName','LastName','Password','ConfirmPassword','EmailID','Phone_Number'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['FirstName','LastName','Phone_Number'], 'required'],
            ['Password', 'string', 'min' => 6],
            ['ConfirmPassword', 'compare', 'compareAttribute'=>'Password', 'message'=>"Passwords don't match" ],
            ['Password','match', 'pattern'=>"/^([a-zA-Z0-9]+)$/", 'message'=>"Passwords is invalid"],
            ['Password','match', 'pattern'=>"/^(?=.*[0-9])(?=.*[A-Z])/", 'message'=>"Passwords must have at least one upper-case letter and at least one digit"],
            ['Password','validatePassword'],
        ];
        return array_merge(parent::rules(),$rules);
    }
    public function attributeLabels()
    {
        $attribute = [
            'FirstName' => \Yii::t('app', 'First Name'),
            'LastName' => \Yii::t('app', 'Last Name'),
            'Password' => \Yii::t('app', 'Password'),
            'ConfirmPassword' => \Yii::t('app', 'Confirm Password'),
            'EmailID' => \Yii::t('app', 'Email ID'),
            'Phone_Number' => \Yii::t('app', 'Phone Number'),
        ];
        return array_merge(parent::attributeLabels(), $attribute);   
    }

    public function getUser($id)
    {
        $this->_user = User::findIdentity($id);
        $this->id = $this->_user->id;
        $this->FirstName = $this->_user->FirstName;
        $this->LastName = $this->_user->LastName;
        $this->Phone_Number = $this->_user->Phone_Number;
        $this->EmailID = $this->_user->EmailID;
        $this->Image = $this->_user->Image;
    }
    public function getUserEditor($id)
    {
        $this->_user = User::find()
            ->with(['editors.skillWriter'])
            ->where(['id'=>$id])
            ->limit(1)
            ->one();
        $this->FirstName = $this->_user->FirstName;
        $this->LastName = $this->_user->LastName;
        $this->Phone_Number = $this->_user->Phone_Number;
        $this->EmailID = $this->_user->EmailID;
        $this->Image = $this->_user->Image;
        $this->skill = $this->_user->editors->skillWriter->NameSkill;
    }
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if ($this->Password!=$this->ConfirmPassword) {
                $this->addError($attribute, 'Confirm Password cannot be blank. ');
                //$this->validate(['Password','ConfirmPassword']);
            }
        }
    }
    public function saveData()
    {
        $user = $this->_user;
        $user->FirstName = $this->FirstName;
        $user->LastName = $this->LastName;
        $user->EmailID = $this->EmailID;
        $user->Phone_Number = $this->Phone_Number;
        if ($this->Password != null && $this->Password == $this->ConfirmPassword) {
            $user->Password_hash = Yii::$app->security->generatePasswordHash($this->Password);
        }
        return $user->save() ? true : false;
    }
}