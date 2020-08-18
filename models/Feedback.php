<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/11/2018
 * Time: 12:29 AM
 */

namespace app\models;

use yii\db\ActiveRecord;

class Feedback extends ActiveRecord
{
    public static function FindFeedbackByIdOrder($id)
    {
        return static::findAll(['Id_order'=>$id]);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_User']);
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'Id_Order']);
    }
    public function getAll() {
        return static::find();
    }
    public static function Pagination($model, $paginate, $with = array(), $where = array()) {
        return $model
                ->with($with)
                ->where($where)
                ->offset($paginate->offset)
                ->limit($paginate->limit)
                ->all();
    }
}