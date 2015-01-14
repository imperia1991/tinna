<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Привет, я профессиональный Свадебный фотограф Tinna Tihonenko. Свадебный фотограф Черкассы, фотограф Черкассы, Свадебная фотосъемка Черкассы и Украина, Черкассы фотограф, Свадебная фотосъемка в Черкассах. Консультации, Свадебный фотограф Украина, Свадебный фотограф Киев, Профессиональный фотограф Черкассы, лучшие свадебные фотографы, фотограф черкассы цены, фотографы черкасс. "/>
    <meta name="keywords"
          content="свадебный фотограф, свадебный фотограф Черкассы, фотограф, фотограф Черкассы, Tinna Tihonenko, фотограф Тинна Тихоненко, фотосессии в Черкассах, Свадебный фотограф Черкассы, фотограф Черкассы, Свадебная фотосъемка Черкассы и Украина, Черкассы фотограф, Свадебная фотосъемка в Черкассах, Свадебный фотограф Черкассы, фотограф Черкассы, фотограф черкассы цены, свадебный фотограф черкассы, фотографы черкасс, лучшие свадебные фотографы."/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['mainTitle'] . '-' . $this->title) ?></title>
    <?php $this->head() ?>
    <!--    <link rel="stylesheet" href="/css/style.css" type="text/css"/>-->
    <link rel="icon" type="image/png" href="<?php echo Yii::$app->params['homeUrl']; ?>img/favicon.ico"/>
    <base href="<?php echo Yii::$app->params['homeUrl']; ?>">

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-27053474-2']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
</head>
<body id="body" class="archive category category-- category-1 not-mobile excerpted-posts">
<?php $this->beginBody() ?>
<div id="inner-body">
    <div id="outer-wrap-centered">
        <div id="main-wrap-outer">
            <div id="main-wrap-inner">
                <div id="inner-wrap">
                    <header class="sc">
                        <div id="logo-wrap">
                            <div id="logo">
                                <a href="/"
                                   title="<?php echo Yii::$app->params['homeUrl']; ?>"
                                   rel="home"
                                   id="logo-img-a">
                                    <img id="logo-img"
                                         src="<?php echo Yii::$app->params['homeUrl'] . 'img/logo.jpg'; ?>"
                                         width="630"
                                         height="396"
                                         alt="<?php echo Yii::$app->params['homeUrl']; ?> logo"/>
                                </a>

                                <h1>
                                    <a href="index.html"
                                       title="<?php echo Yii::$app->params['homeUrl']; ?>"
                                       rel="home"><?php echo Yii::$app->params['homeUrl']; ?></a>
                                </h1>

                                <p>
                                    Фотограф Тинна Тихоненко
                                </p>
                            </div>
                        </div>
                        <nav id="primary-nav" class="centered sc">
                            <ul class="primary-nav-menu suckerfish sc">
                                <?php /**@var \app\modules\admin\models\Category category */ ?>
                                <?php foreach (Yii::$app->controller->categories as $category): ?>
                                    <li class="text-about-me mi-type-internal mi-page mi-anchor-text">
                                        <a href="<?php echo Url::to('/category/' . $category->getAlias()) ?>"
                                           class="text-about-me mi-type-internal mi-page mi-anchor-text">
                                            <?php echo $category->getTitle(); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                                <li class="text-about-me mi-type-internal mi-page mi-anchor-text">
                                    <a href="javascript:void(0);"
                                       class="text-about-me mi-type-internal mi-page mi-anchor-text">
                                        contacts
                                    </a>
                                    <ul style="opacity: 1;">
                                        <li class="text-vkcom mi-type-manual mi-anchor-text"
                                            id="primary_nav_menu_item_12">

                                            <a class="text-vkcom mi-type-manual mi-anchor-text"
                                               href="<?php echo Url::to('/contact') ?>">contacts</a>

                                        </li>
                                        <li class="text-instagram mi-type-manual mi-anchor-text"
                                            id="primary_nav_menu_item_14">

                                            <a class="text-instagram mi-type-manual mi-anchor-text"
                                               href="<?php echo Url::to('/pricing') ?>">pricing</a>

                                        </li>
                                        <li class="text-facebook mi-type-manual mi-anchor-text"
                                            id="primary_nav_menu_item_15">

                                            <a class="text-facebook mi-type-manual mi-anchor-text"
                                               href="<?php echo Url::to('/about') ?>">about me</a>

                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </header>
                    <div id="content-wrap" class="sc">
                        <div id="content">
                            <?= $content ?>
                        </div>
                    </div>
                    <div id="copyright-footer" class="content-bg">
                        <p id="user-copyright">
                            &copy; <?= date('Y') ?> Все права защищены
                            <span class="pipe">|</span>
                            <?php echo Html::a('www.tinna.com.ua', Yii::$app->params['homeUrl']); ?>
                        </p>

                        <div id="wp-footer-action-output"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="scroller" class="b-top" style="display: none;"><span class="b-top-but">наверх</span></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
