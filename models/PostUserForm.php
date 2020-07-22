<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/25/2018
 * Time: 12:29 AM
 */

namespace app\models;


use yii\base\Model;
use app\models\Post;

class PostUserForm extends Model
{
    public $FileName;
    public $Topic;
    public $PageNumbers;
    public $DateCreate;
    public $Deadline;
}