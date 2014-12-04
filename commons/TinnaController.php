<?php


namespace app\commons;


use app\modules\admin\models\Category;
use yii\web\Controller;

/**
 * Class TinnaController
 * @package app\commons
 */
class TinnaController extends Controller {
    public $categories;

    public function init()
    {
        parent::init();


        $this->categories = Category::getParents();
    }


} 