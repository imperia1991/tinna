<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $categoryModel app\modules\admin\models\Category */

$this->title = 'Редактирование галереи: ' . ' ' . $categoryModel->title;
$this->params['breadcrumbs'][] = ['label' => 'Список галерей', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="gallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'categoryModel' => $categoryModel,
    ]) ?>

</div>
