<?php
namespace console\models\sitemap;

use Yii;
use yii\helpers\Url;
// use yii\helpers\ArrayHelper;
use frontend\models\Bot;
use frontend\models\Language;
use demi\sitemap\interfaces\Basic;
use demi\sitemap\interfaces\GoogleAlternateLang;
use demi\sitemap\interfaces\GoogleImage;

class SitemapBot extends Bot implements Basic, GoogleImage, GoogleAlternateLang
{
    /**
     * Handle materials by selecting batch of elements.
     * Increase this value and got more handling speed but more memory usage.
     *
     * @var int
     */
    public $sitemapBatchSize = 10;
    /**
     * List of available site languages
     *
     * @var array [langId => langCode]
     */
    public $sitemapLanguages = [
        'en',
        'ru',
    ];
    /**
     * If TRUE - Yii::$app->language will be switched for each sitemapLanguages and restored after.
     *
     * @var bool
     */
    public $sitemapSwithLanguages = true;

    /* BEGIN OF Basic INTERFACE */

    private function getLanguages()
    {
        return Language::find()->select(['id', 'code'])->orderBy(['default' => SORT_DESC, 'id' => SORT_DESC])->asArray()->all();
    }

    private function getLanguageLink($url)
    {
        $links = [];

        $languageList = $this->getLanguages();

        foreach ($languageList as $language) {
            $links[$language['code']] = Url::to([$url, 'lang' => $language['code']]);
        }

        return $links;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapItems($lang = null)
    {
        Yii::$app->language = $lang;

        // Add to sitemap.xml links to regular pages
        return [
            // post/index
            [
                'loc' => Url::to(['/bot/index']),
                'lastmod' => time(),
                'changefreq' => static::CHANGEFREQ_DAILY,
                'priority' => static::PRIORITY_10,
                'alternateLinks' => $this->getLanguageLink('/bot/index'),
            ],
            // post/index
            [
                'loc' => Url::to(['/bot/category']),
                'lastmod' => time(),
                'changefreq' => static::CHANGEFREQ_DAILY,
                'priority' => static::PRIORITY_10,
                'alternateLinks' => $this->getLanguageLink('/bot/category'),
            ],
            // ... you can add more regular pages if needed, but I recommend
            // separate pages related only for current model class
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSitemapItemsQuery($lang = null)
    {
        $language = Language::getLanguageIdByCode($lang);

        return static::find()
            ->where(['status' => Bot::STATUS_APPROVED, 'published' => Bot::PUBLISHED])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        // Base select query for current model
        /*return static::find()
            ->select(['id', 'title', 'slug', 'created_at', 'updated_at'])
            ->where(['status' => Post::STATUS_ACTIVE])
            ->orderBy(['created_at' => SORT_DESC]);*/
    }

    /**
     * @inheritdoc
     */
    public function getSitemapLoc($lang = null)
    {
        // Return absolute url to Post model view page
        return Url::to(['/bot/view', 'lang' => $lang, 'category' => $this->defCategory->slug, 'bot' => $this->slug], true);
    }

    /**
     * @inheritdoc
     */
    public function getSitemapLastmod($lang = null)
    {
        return $this->updated_at;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapChangefreq($lang = null)
    {
        return static::CHANGEFREQ_MONTHLY;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapPriority($lang = null)
    {
        return static::PRIORITY_8;
    }

    /* END OF Basic INTERFACE */
    /* BEGIN OF GoogleImage INTERFACE */

    /**
     * @inheritdoc
     *
     * @param self $material
     */
    public function getSitemapMaterialImages($material, $lang = null)
    {
        // List of Post related images without scheme (news logo eg.)
        $images = [];
        // "/uploads/post/1.jpg"
        $images[] = $this->image;
        // You can add more images (if Post have a photo gallery etc.)

        // !important! You can return array of any elements(Objects eg. $this->images relation), because its elements
        // will be foreached and become as $image argument for $this->getSitemapImageLoc($image)

        return $images;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapImageLoc($image, $lang = null)
    {
        // Return absolute url to each Post image
        // @see $image argument becomes from $this->getSitemapMaterialImages()
        return Yii::$app->urlManager->baseUrl . '/uploads/post/' . $image;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapImageGeoLocation($image, $lang = null)
    {
        // Location name string, for example: "Limerick, Ireland"
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapImageCaption($image, $lang = null)
    {
        // Image caption, simply use Post title
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapImageTitle($image, $lang = null)
    {
        // Image title, simply use Post title
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapImageLicense($image, $lang = null)
    {
        return null;
    }

    /* END OF GoogleImage INTERFACE */
    /* BEGIN OF GoogleAlternateLang INTERFACE */

    /**
     * @inheritdoc
     */
    public function getSitemapAlternateLinks()
    {
        // Generate altername links for all site language versions for this Post
        $buffer = [];

        foreach ($this->sitemapLanguages as $langCode) {
            $buffer[$langCode] = $this->getSitemapLoc($langCode);
            // or eg.: $buffer[$langCode] = Url::to(['post/view', 'id' => $this->id, 'lang' => $langCode]);
        }

        return $buffer;
    }

    /* END OF GoogleAlternateLang INTERFACE */
}
