<?php

use app\modules\admin\models\Category;
use dosamigos\fileupload\FileUpload;
use kartik\sortable\Sortable;
use kartik\sortinput\SortableInput;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $categoryModel app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?php echo $form->errorSummary($categoryModel); ?>

    <?= FileUpload::widget([
        'model'         => $categoryModel,
        'attribute'     => 'photos',
        'url'           => ['gallery/upload', 'id' => $categoryModel->getId()], // your url, this is just for demo purposes,
        'options'       => [
            'accept'   => 'images/*',
            'multiple' => true,
        ],
        'clientOptions' => [
            'maxFileSize' => 2000000,
            'dataType'    => 'json',
            'done'        => new JsExpression('function(e, data) {
                var responseData = data.response().result;
                var component = "";
                component += "<img class=\"colorbox\" src=\"" + responseData.filePath  + "\" width=\"160\" height=\"160\" />";
                component += "<input type=\"hidden\" name=\"Category[photos][]\" value=\"" + responseData.filePath  + "\" />";
                component += "<a class=\"remove-photo\" data-id=\"" + responseData.filePath + "\">Удалить</a>";

                $("#photos").append("<li data-key=\"" + $(".colorbox").length + "\" draggable=\"true\">" + component + "</li>");

                $("#photos").sortable();
            }'),
        ]
    ]); ?>

    <?php $items = $categoryModel->getGalleriesSortable(); ?>

    <?= Sortable::widget([
        'id' => 'photos',
        'items' => $items
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' =>'btn btn-success']) ?>
        <?php echo Html::a('Отмена', '/admin/gallery', ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
