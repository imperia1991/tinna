<?php
use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" >
<head >
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <?= Html::csrfMetaTags() ?>
    <title ><?= Html::encode($this->title) ?></title >
    <?php $this->head() ?>
</head >
<body >

<?php $this->beginBody() ?>
<div class="wrap" >
    <?php
    NavBar::begin([
        'brandLabel' => 'tinna.com.ua',
        'brandUrl'   => Yii::$app->homeUrl,
        'options'    => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items'   => [
            [
                'label' => 'Категории',
                'url' => ['/admin/category/index'],
                'items' => [
                    [
                        'label' => 'Все',
                        'url' => ['/admin/category/index'],
                    ],
                    [
                        'label' => 'Добавить',
                        'url' => ['/admin/category/create'],
                    ],
                ],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' => 'Подкатегории',
                'url' => ['/admin/sub-category/index'],
                'items' => [
                    [
                        'label' => 'Все',
                        'url' => ['/admin/sub-category/index'],
                    ],
                    [
                        'label' => 'Добавить',
                        'url' => ['/admin/sub-category/create'],
                    ],
                ],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' => 'Галереи',
                'url' => ['/admin/gallery/index'],
                'items' => [
                    [
                        'label' => 'Все',
                        'url' => ['/admin/gallery/index'],
                    ],
                    [
                        'label' => 'Добавить',
                        'url' => ['/admin/gallery/create'],
                    ],
                ],
                'visible' => !Yii::$app->user->isGuest
            ],
            Yii::$app->user->isGuest ?
                ['label' => 'Авторизация', 'url' => ['/user/default/login']] :
                ['label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                 'url'   => ['/user/default/logout']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" >
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => 'Главная',
                'url' => \yii\helpers\Url::to('/admin')
            ]
        ]) ?>
        <?= $content ?>
    </div >
</div >

<footer class="footer" >
    <div class="container" >
        <p class="pull-left" >&copy; My Company <?= date('Y') ?></p >

        <p class="pull-right" ><?= Yii::powered() ?></p >
    </div >
</footer >

<?php $this->endBody() ?>
</body >
</html >
<?php $this->endPage() ?>
