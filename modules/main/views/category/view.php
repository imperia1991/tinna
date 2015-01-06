<?php
use app\modules\admin\models\Category;
use app\modules\admin\models\Gallery;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var Category $category */
$this->title = $category->getParent()->getTitle();
?>

<div class="page-title-wrap content-bg" style="margin-bottom: 0">

    <h2 class="page-title">
        Раздел: <span><?php echo $this->title; ?></span>
    </h2>

</div>

<article class="post-1043 post type-post status-publish format-standard hentry category-- sc" id="">

    <div class="article-wrap sc content-bg">

        <div class="article-wrap-inner">

            <div data-role="content" class="article-content sc">

                <p>
                    <?php foreach ($category->getGalleries() as $gallery): ?>
                    <img
                        width="840"
                        alt=""
                        class="pp-insert-all size-full aligncenter ov-done"
                        src="<?php echo $gallery->getPhoto(); ?>">
                    <?php endforeach; ?>
                </p>

            </div><!-- .article-content -->


        </div><!-- .article-wrap-inner -->

        <div class="article-footer">
            <?php foreach ($category->getAllTags() as $tag): ?>
            <a href="<?php echo Yii::$app->params['homeUrl']; ?>">
                <?php echo $tag; ?>
            </a>
            <?php endforeach; ?>
        </div>

    </div><!-- .article-wrap -->

</article>