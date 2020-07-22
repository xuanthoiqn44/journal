<?php
/**
 * Created by PhpStorm.
 * User: xuanthoiqn44
 * Date: 11/02/2019
 * Time: 20:35
 */

namespace app\models;


use yii\base\Model;
use yii\bootstrap\Modal;

class RatingForm extends Model
{
    public $rating;
    public function rules()
    {
        $rules = [
            [['rating'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],

            [['rating'], 'integer'],
        ];
        return array_merge(parent::rules(),$rules);

    }
    public function attributeLabels()
    {
        return [
            'rating' => "Rating for editor",
        ];
    }
}