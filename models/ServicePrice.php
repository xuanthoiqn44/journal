<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 11/14/2018
 * Time: 11:36 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class ServicePrice extends ActiveRecord
{
    public  static function findByServiceId($id)
    {
        return static::findAll(['Id_Service' => $id]);
    }
}