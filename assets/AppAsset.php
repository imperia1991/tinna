<?php
namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends MainAsset
{
    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/vivus.min.js',
        'js/up.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
