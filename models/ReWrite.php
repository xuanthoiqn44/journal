<?php
/**
 * Created by PhpStorm.
 * User: xuanthoiqn44
 * Date: 14/02/2019
 * Time: 21:24
 */

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class ReWrite extends ActiveRecord
{
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'Id_Order']);
    }
}