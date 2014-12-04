<?php

namespace app\modules\main\controllers;

use app\commons\TinnaController;
use yii\web\Controller;

/**
 * Class CategoryController
 * @package app\modules\main\controllers
 */
class CategoryController extends TinnaController
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
