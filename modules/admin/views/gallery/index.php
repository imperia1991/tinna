<?php

use app\modules\admin\models\Gallery;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Галереи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить галерею', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'photo',
                'filter' => false,
                'enableSorting' => false,
                'format'    => 'raw',
                'value' => function ($model) {
                    /**@var Gallery $model */
                    return Html::img($model->getPhoto(), [
                        'width' => 80,
                        'height' => 80,
                    ]);
                }
            ],
            [
                'attribute' => 'category_id',
                'filter' => $searchModel->getCategoriesToDropDownList(),
                'value' => 'category.title',
            ],
            [
                'attribute' => 'status',
                'filter'    => $searchModel->getStatusValues(false),
                'format'    => 'raw',
                'value'     => function ($model) {
                    /** @var \app\modules\admin\models\Gallery $model */
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
