<?php

use app\modules\admin\models\Category;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список категорий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index" >

    <h1 ><?= Html::encode($this->title) ?></h1 >
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p >
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p >

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
                'attribute' => 'parent_id',
                'filter' => $searchModel->getParentsToDropDownList(),
                'value' => function ($model) {
                    /** @var \app\modules\admin\models\Category $model */
                    /** @var \app\modules\admin\models\Category $parent */
                    $parent = $model->getParent();

                    return is_object($parent) ? $parent->getTitle() : '';
                },
            ],
            [
                'attribute' => 'status',
                'filter'    => $searchModel->getStatusValues(false),
                'format'    => 'raw',
                'value'     => function ($model) {
                    /** @var \app\modules\admin\models\Category $model */
                    return $model->getStatusValues();
                }
            ],
            [
                'attribute' => 'Галлерея',
                'format'    => 'raw',
                'value'     => function ($model) {
                    /** @var \app\modules\admin\models\Category $model */
                    return $model->getParentId() ? Html::a('Редактировать', Url::to('/admin/gallery/update/' . $model->getId())) : '';
                }
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>

</div >
