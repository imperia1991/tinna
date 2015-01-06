<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <p>Общая категория - это категория которая выводится в верхнем меню. Состоит из нескольких подкатегорий.
        Подкатегория - это категория с галереей. Для нее обязательно указать Общую категорию.
    </p>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'parent_id')->dropDownList($model->getParentsToDropDownList(), [
        'prompt' => 'Выберите общую категорию'
    ]); ?>

    <?= $form->field($model, 'status')->checkbox([
        'label' => 'Показывать'
    ]); ?>

    <p>Перечислите теги через запятую без пробелов. Теги будут выводиться внизу соответствующей страницы.
       При этом на странице общей категории будут выводиться теги принадлежащие только ей.
        На странице подкатегории будут выводиться ее теги плюс теги общей категории.
    </p>
    <?= $form->field($model, 'tags')->textarea([
        'row' => 8
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php echo Html::a('Отмена', '/admin', ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
