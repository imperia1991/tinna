<?php
namespace app\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = [
        'jQuery',
    ];
}