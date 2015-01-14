<?php
namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends MainAsset {
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/gallery.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}