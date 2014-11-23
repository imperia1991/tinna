<?php

use app\modules\admin\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SubCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список подкатегорий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить подкатегорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'attribute' => 'title',
            ],
            [
                'attribute' => 'category_id',
                'filter'    => Category::getAllToDropDownList(),
                'format'    => 'raw',
                'value'     => function ($model) {
                    /** @var \app\modules\admin\models\SubCategory $model */
                    return $model->getCategory()->one()->getTitle();
                }
            ],
            [
                'attribute' => 'status',
                'filter'    => false,
                'format'    => 'raw',
                'value'     => function ($model) {
                    /** @var Category $model */
                    return $model->getStatusValues();
                }
            ],

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>

</div>
