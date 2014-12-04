<?php


namespace app\commons;


use yii\filters\AccessControl;
use yii\helpers\Json;
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
                'only'  => ['index', 'view', 'create', 'update', 'delete', 'category'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'category'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ]
        ];
    }


    /**
     * @return array
     */
    protected function respondJSON($data = [])
    {
        \Yii::$app->response->format = 'json';

        return $data;
    }
} 