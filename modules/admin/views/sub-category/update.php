<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SubCategory */

$this->title = 'Редактирование подкатегории: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список подкатегорий', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="sub-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
