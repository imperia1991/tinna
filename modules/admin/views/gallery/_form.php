<?php

use app\modules\admin\models\Category;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form" >

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>


    <?php
    echo $form->field($model, 'category_id')->dropDownList(Category::getAllToDropDownList(), [
        'prompt' => 'Выберите категорию',
        'id'=>'cat-id'
    ]);

    // Dependent Dropdown
    echo $form->field($model, 'sub_category_id')->widget(DepDrop::classname(), [
        'options' => ['id'=>'subcat-id'],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder' => 'Выберите подкатегорию',
            'loadingText' => 'Загрузка...',
            'url' => Url::to(['/admin/sub-category/category'])
        ]
    ]);
    ?>


<?php //   // With model & without ActiveForm
//    echo FileInput::widget([
//        'model'     => $model,
//        'attribute' => 'photo',
//        'options'   => ['multiple' => true]
//    ]);
//    ?>

    <!--    --><? //= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <!--    --><? //= $form->field($model, 'photo')->textInput(['maxlength' => 255]) ?>

    <!--    --><? //= $form->field($model, 'status')->textInput() ?>

    <!--    --><? //= $form->field($model, 'category_id')->textInput() ?>

    <!--    --><? //= $form->field($model, 'created_at')->textInput() ?>

    <!--    --><? //= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group" >
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div >

    <?php ActiveForm::end(); ?>

</div >
