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
            <?php echo $modelSettings->getContactText(); ?>
        </div>
        <div class="page-title-wrap content-bg contact">

            <h1 class="page-title">
                <span>Свяжитесь с нами:</span>
            </h1>

        </div>
        <div class="row sc contact">

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($modelContact, 'name') ?>
            <?= $form->field($modelContact, 'email') ?>
            <?= $form->field($modelContact, 'subject') ?>
            <?= $form->field($modelContact, 'body')->textArea(['rows' => 6]) ?>
            <?= $form->field($modelContact, 'verifyCode')->widget(Captcha::className(), [
                'captchaAction' => '/main/contact/captcha',
                'template'      => '<div class="row"><div class="col-lg-3 yiiCaptcha">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

