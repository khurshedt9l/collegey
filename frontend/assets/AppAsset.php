<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'css/global.css',
    ];
    public $js = [
       // 'js/jquery-1.9.1.min.js',
        'js/bootstrap.min.js',
        'js/select2.full.min.js',
        'js/jquery.mmenu.min.all.js',
        'js/custom.js',
        'js/owl.carousel.min.js',
        'js/jquery.superslides.min.js',
        'js/gmap3.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
        public $jsOptions = [
    'position' => View::POS_HEAD];
}
