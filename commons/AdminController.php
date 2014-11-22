<?php


namespace app\commons;


use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class AdminController
 * @package app\commons
 */
class AdminController extends Controller
{
    public $layout = "//admin";

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ]
        ];
    }
} 