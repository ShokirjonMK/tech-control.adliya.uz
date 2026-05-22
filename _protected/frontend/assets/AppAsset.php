<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * -----------------------------------------------------------------------------
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 * -----------------------------------------------------------------------------
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';
    
    public $css = [
     'lib/bootstrap/css/bootstrap.min.css',
     'lib/font-awesome/css/font-awesome.min.css',
     'lib/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css',
     'lib/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css',
     'css/media.css',
     'css/style.css',
     'css/husni.css',
     'https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900  ',

         
    ];
    public $js = [
       'lib/jquery/jquery.min.js',
       'lib/bootstrap/js/bootstrap.min.js',
       'lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js',
       'lib/knob/jquery.knob.js',
       'lib/jquery.inview-master/jquery.inview.min.js',
       'js/script.js',

    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

