<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/12/2018
 * Time: 22:27
 */

namespace app\models;


use yii\base\Model;

class SaveTmpPost extends Model
{

    public  function Save_Post($Id_Author,$Type_of_services,$Type_of_paper,$Subject_area,$Type_of_writer,$File_Name,$Topic,$PageNumbers,$Date_Create,$Deadline,$Id_Editor,$Decription,$Price)
    {
        $tmp_post = new TmpPost();
        $tmp_post->Id_Author = $Id_Author;
        $tmp_post->Type_of_services = $Type_of_services;
        $tmp_post->Type_of_paper = $Type_of_paper;
        $tmp_post->Subject_area = $Subject_area;
        $tmp_post->Type_of_writer = $Type_of_writer;
        $tmp_post->File_Name = $File_Name;
        $tmp_post->Topic = $Topic;
        $tmp_post->PageNumbers = $PageNumbers;
        $tmp_post->Date_Create = $Date_Create;
        $tmp_post->Deadline = $Deadline;
        if ($Id_Editor != null) {
            $tmp_post->Id_Editor = $Id_Editor;
        }
        if ($Decription!= null)
        {
            $tmp_post->Decription = $Decription;
        }
        $tmp_post->Price = $Price;
        return $tmp_post->save() ? $tmp_post : null;
    }
}