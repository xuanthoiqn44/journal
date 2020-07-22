<?php
/**
 * Created by PhpStorm.
 * User: xuanthoiqn44
 * Date: 02/02/2019
 * Time: 12:18
 */

namespace app\models;
use Yii;
use yii\base\Model;
use yii\helpers\Inflector;

class RequestEditorForm extends Model
{
    public $skill ;
    public $file_info;
    public $agree;

    public function rules()
    {
        $rules = [
        [['skill','file_info','agree'],'required'],
            [['file_info'], 'file','message'=>'Chỉ cho phép các tài liệu có định dạng (doc,docx).', 'skipOnEmpty' => false,'extensions' => ['docx','doc']],
        ];
         return array_merge(parent::rules(),$rules);
    }
    public function Save()
    {
        $user = User::find()->with('editors.skillWriter')->where(['id'=>Yii::$app->user->getId()]);
        $user->Request_Editor = 1;
    }
    public function attributeLabels()
    {
        return [
           /* 'topic' => "Topic *",
            'id_writer' => "Writer's ID ",
            'paper_details' => "Paper details *",
            'type_of_service' => 'Type of service *',
            'type_of_paper' => 'Type of paper *',
            'subject_area' => 'Subject area *',
            'discount_code' => 'Discount code',
            'upload_file'=>'Upload file *',
            'urgency'=>'Deadline *',
            'writer_level'=>'Writer level *',
            'customer_service'=>'Customer service *',
            'method'=>'Payment *',
            'Type_of_currency'=>'Currency *',*/
        ];
    }
}