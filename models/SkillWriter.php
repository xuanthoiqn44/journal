<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/24/2018
 * Time: 11:36 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class SkillWriter extends ActiveRecord
{
    public function getEditor()
    {
        return $this->hasMany(Editor::className(),['Chuyen_Nganh'=>'Id']);
    }
}