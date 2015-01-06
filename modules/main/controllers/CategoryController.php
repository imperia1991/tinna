<?php

namespace app\modules\main\controllers;

use app\commons\TinnaController;
use app\modules\admin\models\Category;
use yii\web\NotFoundHttpException;

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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @throws NotFoundHttpException
     * @return string
     */
    public function actionIndex()
    {
        /* @var Category $category */

        $category = $this->getCategory();

        return $this->render('index', [
            'category' => $category
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView()
    {
        /* @var Category $category */

        $category = $this->getCategory(true);

        return $this->render('view', [
            'category' => $category
        ]);
    }

    /**
     * @return string|static
     * @throws NotFoundHttpException
     */
    protected function getCategory($isGallery = false)
    {
        /* @var Category $category */

        $alias = \Yii::$app->getRequest()->getQueryParam('alias', '');

        $category = Category::findOne([
            'alias' => $alias
        ]);

        if (!is_object($category)) {
            if ($isGallery) {
                throw new NotFoundHttpException('Галерея не найдена');
            } else {
                if ((empty($alias) && empty($this->categories)) || !empty($alias)) {
                    throw new NotFoundHttpException('Категория не надена');
                } else {
                    return $this->categories[0];
                }
            }
        }

        return $category;
    }
}
