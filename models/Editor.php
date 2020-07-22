<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/20/2018
 * Time: 11:13 PM
 */

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Editor extends ActiveRecord
{
    //get status
    const STATUS_OPEN = 1;
    const STATUS_SEARCHING = 0;
    const STATUS_ALL = '';
    //get status active
    const STATUS_ACTIVE = 2;
    const STATUS_BLOCK = 1;
    const STATUS_REQUEST = 0;
    const STATUS_ACTIVE_ALL = '';

    const ORDER_ALL = '';
    const ORDER_10PLUS = 10;
    const ORDER_20PLUS = 20;
    const ORDER_50PLUS = 50;
    const ORDER_100PLUS = 100;
    public static function getEditorById($id)
    {
        return static::findOne(['id'=>$id]);
    }
    public function getPost()
    {
        return $this->hasMany(Post::className(), ['Id_User' => 'id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_User']);
    }
    public static function getStatus()
    {
        return array(self::STATUS_ALL=>'All',self::STATUS_OPEN =>'Open to suggestions',self::STATUS_SEARCHING=>'Searching for orders');
    }
    public static function getStatusActive()
    {
        return array(self::STATUS_ACTIVE_ALL=>'All',self::STATUS_ACTIVE =>'Active',self::STATUS_BLOCK=>'Block',self::STATUS_REQUEST=>'Request');
    }
    public static function getOrderPlus()
    {
        return array(self::ORDER_ALL=>'All',self::ORDER_10PLUS=>'10+ orders',self::ORDER_20PLUS=>'20+ orders',self::ORDER_50PLUS=>'50+ orders',self::ORDER_100PLUS=>'100+ orders');
    }
    public function getSkillWriter()
    {
        return $this->hasOne(SkillWriter::className(),['Id'=>'Chuyen_Nganh']);
    }
    public static  function  get_SkillWriter(){
        $cat = SkillWriter::find()->all();
        $cat = ArrayHelper::map($cat, 'Id', 'NameSkill');
        return $cat;
    }
    //public static function getS
}