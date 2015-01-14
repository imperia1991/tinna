<?php
namespace app\modules\admin\controllers;

use app\commons\AdminController;
use app\modules\admin\models\Category;
use app\modules\admin\models\Settings;
use DOMDocument;
use Yii;
use yii\helpers\Url;
use yii\web\UrlManager;

class SitemapController extends AdminController
{
    /**
     *
     */
    public function actionIndex()
    {
        $urls = [];
        
        $parentCategories = Category::getParents();

        /** @var Category $category */
        foreach ($parentCategories as $category) {
            $date = $category->getUpdatedAt() ? $category->getUpdatedAt() : $category->getCreatedAt();
            $date = date('c', $date);

            $urls[] = [
                Yii::$app->urlManager->createAbsoluteUrl('category/' . $category->getAlias()),
                $date
            ];
        }

        $childCategories = Category::findAll([
            'status'    => Category::STATUS_SHOW,
            'parent_id' => null,
        ]);

        /** @var Category[] $childCategories */
        foreach ($childCategories as $item) {
            $date = $item->getCreatedAt();
            $date = date('c', $date);

            $urls[] = [
                Yii::$app->urlManager->createAbsoluteUrl(Url::to('category/view/' . $item->getAlias())),
                $date
            ];
        }

        $settings = Settings::find()->one();
        $urls[] = [
            Yii::$app->urlManager->createAbsoluteUrl(Url::to('contact')),
            date('c', $settings->getUpdatedAt() ?: $settings->getCreatedAt())
        ];
        $urls[] = [
            Yii::$app->urlManager->createAbsoluteUrl(Url::to('pricing')),
            date('c', $settings->getUpdatedAt() ?: $settings->getCreatedAt())
        ];
        $urls[] = [
            Yii::$app->urlManager->createAbsoluteUrl(Url::to('about')),
            date('c', $settings->getUpdatedAt() ?: $settings->getCreatedAt())
        ];

        if ($this->create($urls)) {
            Yii::$app->getSession()->setFlash('success', 'sitemap.xml сформирован');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Ошибка. sitemap.xml не сформирован. Попробуйте позже.');
        }

        $this->redirect(Url::to('/admin/settings'));
    }

    /** @var [] $urls */
    private function create($urls)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');

        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach($urls as $item) {
            $url = $dom->createElement('url');
            $loc = $dom->createElement('loc');
            $lastmod = $dom->createElement('lastmod');
            $changefreq = $dom->createElement('changefreq');
            $priority = $dom->createElement('priority');

            $loc->appendChild($dom->createTextNode($item[0]));
            $lastmod->appendChild($dom->createTextNode($item[1]));
            $changefreq->appendChild($dom->createTextNode('weekly'));
            $priority->appendChild($dom->createTextNode('0.8'));

            $url->appendChild($loc);
            $url->appendChild($lastmod);
            $url->appendChild($changefreq);
            $url->appendChild($priority);

            $urlset->appendChild($url);
        }

        $dom->appendChild($urlset);

        return $dom->save(Yii::getAlias('@webroot') . '/sitemap.xml');
    }


}