<?php
/**
 * Created by PhpStorm.
 * User: xuanthoiqn44
 * Date: 10/02/2019
 * Time: 16:47
 */

namespace app\models;
use yii;


class GetFile
{
    public function GetFile($file = null,$type = null)
    {
        if ($file != null && $type != null) {
            $path = '';
            if ($type ==  'editor') {
                $path = Yii::getAlias('@webroot') . '/upload_file_info_editor/';
            }
            elseif ($type == 'post') {
                $path = Yii::getAlias('@webroot') . '/uploads_post/';
            }
            elseif ($type == 'editor_completed')
            {
                $path = Yii::getAlias('@webroot') . '/upload_post_editor_completed/';
            }
            $file = $path . $file;
            if (file_exists($file)) {
                Yii::$app->response->sendFile($file);
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}