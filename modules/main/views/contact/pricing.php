<?php
use app\commons\Alert;
use app\modules\admin\models\Settings;
use app\modules\main\models\ContactForm;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model ContactForm */
/* @var Settings $modelSettings */

$this->title = 'Котакты';
?>

<div class="message" style="margin-left: 30px; margin-right: 30px">
    <?php echo Alert::widget(); ?>
</div>

<div class="excerpts-grid-wrap content-bg">
    <div class="grid grid-type-excerpts grid-style-img_rollover_text grid-format-cropped sc" id="grid-excerpts">
        <div class="row sc">
            <?php echo $modelSettings->getPricingText(); ?>
        </div>
    </div>
</div>

