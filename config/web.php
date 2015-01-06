<?php

use yii\helpers\ArrayHelper;

$paramsMain = require(__DIR__ . '/params.php');
$paramsLocal = file_exists(__DIR__ . '/params-local.php') ? require_once(__DIR__ . '/params-local.php') : [];

$params = ArrayHelper::merge(
    $paramsMain,
    $paramsLocal
);

$dbMain = require(__DIR__ . '/db.php');
$dbLocal = file_exists(__DIR__ . '/db-local.php') ? require_once(__DIR__ . '/db-local.php') : [];

$config = [
    'id'             => 'tinna',
    'basePath'       => dirname(__DIR__),
    'defaultRoute'   => 'main/default/index',
    'bootstrap'      => ['log'],
    'language'       => 'ru-RU',
    'sourceLanguage' => 'ru',
    'modules'        => [
        'main'  => [
            'class' => 'app\modules\main\Module',
        ],
        'user'  => [
            'class' => 'app\modules\user\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'components'     => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dfkdsfkdsf676dsfds',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl'        => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'   => 'yii\log\FileTarget',
                    'levels'  => ['error'],
                    'logFile' => '@app/runtime/logs/web-error.log'
                ],
                [
                    'class'   => 'yii\log\FileTarget',
                    'levels'  => ['warning'],
                    'logFile' => '@app/runtime/logs/web-warning.log'
                ],
            ],
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                ''                                                => 'main/default/index',
                'contact'                                         => 'main/contact/index',
                '<_a:error>'                                      => 'main/default/<_a>',
                '<_a:(login|logout)>'                             => 'user/default/<_a>',
                '<_c:(category)>'                                 => 'main/category/index',
                '<_c:(category)>/<alias:[\w\-]+>'                 => 'main/category/index',
                '<_c:(category)>/<_a:(view)>/<alias:[\w\-]+>'     => 'main/category/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>'              => '<_m>/<_c>/view',
                '<_m:[\w\-]+>'                                    => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>'                       => '<_m>/<_c>/index',
            ],
        ],
        'db'           => ArrayHelper::merge(
            $dbMain,
            $dbLocal
        ),
    ],
    'params'         => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
