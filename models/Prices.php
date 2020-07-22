<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 11/22/2018
 * Time: 9:17 PM
 */

namespace app\models;
use Yii;
use yii\base\Model;


class Prices extends Model
{

    public $type_of_writer;
    public function rules()
    {
        $rules = [
            [['type_of_writer'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process'],
            [['type_of_writer'], 'required'],
        ];
        return array_merge(parent::rules(), $rules);
    }
}