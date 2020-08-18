<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class EditorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/admin_zone';
    public $css = [
        'css/material-dashboard.css',
    ];
    public $js = [
        'js/material-dashboard.js',
        'js/plugins/bootstrap-notify.js',
        'js/core/popper.min.js',
        'js/core/bootstrap-material-design.min.js',
        'js/plugins/moment.min.js',
        'js/plugins/sweetalert2.js',
        'js/plugins/jasny-bootstrap.min.js'
    ];
    public $depends = [
    ];

}

