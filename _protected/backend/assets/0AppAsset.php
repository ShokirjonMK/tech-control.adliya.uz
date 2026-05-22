<?php

/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace backend\assets;

use yii\web\AssetBundle;
use Yii;
use yii\web\AssetManager;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 *
 * Customized by Nenad Živković
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        "demo.css",
        "plugins/fontawesome-free/css/all.min.css",
        "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
        'plugins/daterangepicker/daterangepicker.css',
        'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',

        '',
        'bootstrap4-glyphicons-master\bootstrap4-glyphicons\css\bootstrap-glyphicons.min.css',
        "plugins/select2/css/select2.min.css",
        "plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css",
        'plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',
        "dist/css/adminlte.min.css",


        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700'
    ];
    public $js = [
        "plugins/bootstrap/js/bootstrap.bundle.min.js",
        "plugins/select2/js/select2.full.min.js",
        "plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js",
        "plugins/inputmask/jquery.inputmask.bundle.js",
        "plugins/moment/moment.min.js",
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/datatables/jquery.dataTables.js',
        'plugins/datatables-bs4/js/dataTables.bootstrap4.js',
        'https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2014-11-29/FileSaver.js',
        "dist/js/adminlte.min.js",
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js',
        'https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.12.13/xlsx.full.min.js',
        "demo.js",
        "dist/js/demo.js",
        "build/js/main.js",
        //"jquery.min.js",
//        "qrcode.js",

    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}