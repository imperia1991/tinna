<?php

namespace app\modules\admin\controllers;

use app\commons\AdminController;
use yii\helpers\Url;

/**
 * Class DefaultController
 * @package app\modules\admin\controllers
 */
class DefaultController extends AdminController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(Url::to('/admin/category'));
    }
}
