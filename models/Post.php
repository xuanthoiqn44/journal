<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/25/2018
 * Time: 12:22 AM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Post extends ActiveRecord
{

    const STATUS_NEW = "New";
    const STATUS_ALL = "";
    const STATUS_PROCESS = "Process";
    const STATUS_COMPLETED = "Completed";
    const STATUS_WaitEditor = "Waiting editor";
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_Author']);
    }
    public function getFeedback()
    {
        return $this->hasOne(Feedback::className(), ['Id_Order' => 'id']);
        //return $this->hasOne(Feedback::className(), ['Id_Order' => 'id']);
    }
    public function getReWrite()
    {
        return $this->hasMany(ReWrite::className(), ['Id_Order' => 'id']);
        //return $this->hasOne(Feedback::className(), ['Id_Order' => 'id']);
    }
    public function getEditors()
    {
        return $this->hasOne(Editor::className(), ['id' => 'Id_Editor']);
    }

    public static function getNameService($id)
    {
        return ServicePrice::findOne(['Id'=>$id])->Name_Service_Price;
    }
    public static function findPostByUserIDCreate($id)
    {
        return static::findAll(['Id_Author'=>$id]);
    }
    public  static function FindActivePostByUserIDCreate($id)
    {
        return static::findAll(['Id_Author'=>$id,'Status'=>'Active']);
    }
    public  static function FindCompletedPostByUserIDCreate($id)
    {
        return static::findAll(['Id_Author'=>$id,'Status'=>'Completed']);
    }
    public function getStatusOrder()
    {
        return array(self::STATUS_ALL=>'All',self::STATUS_WaitEditor=>'Waiting editor',self::STATUS_NEW=>'New',self::STATUS_PROCESS =>'Process',self::STATUS_COMPLETED=>'Completed');
    }
}