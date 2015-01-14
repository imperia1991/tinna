<?php
use app\modules\admin\models\Category;
use app\modules\admin\models\Gallery;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var Category $category */
$this->title = $category->getTitle();
?>

<div class="page-title-wrap content-bg">

    <h2 class="page-title">
        Раздел: <span><?php echo $category->getTitle(); ?></span>
    </h2>

</div>
<!-- .page-title-wrap  -->

<!-- grid markup served from cache -->
<div class="excerpts-grid-wrap content-bg">
    <div class="grid grid-type-excerpts grid-style-img_rollover_text grid-format-cropped sc" id="grid-excerpts">
        <div class="row sc">
            <?php /**@var Category $childCategory */ ?>
            <?php foreach ($category->getCategories() as $childCategory): ?>
                <?php /**@var Gallery $gallery */ ?>
                <?php $photo = $childCategory->getOnePhoto(); ?>
                <?php if ($photo): ?>
                    <div data-img-border-width="0"
                         data-item-height="186"
                         style="width:280px;height:186px;"
                         class="grid-item grid-row-1 grid-col-1">

                        <a href="<?php echo Url::to('/category/view/' . $childCategory->getAlias()); ?>">
                            <img width="280"
                                 height="186"
                                 alt=""
                                 class="grid-img ov-done"
                                 src="<?php echo $photo; ?>">
                        </a>

                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>

</div>
<div class="article-footer parent-gallery">
    <?php echo $category->getAllTags(); ?>
</div>