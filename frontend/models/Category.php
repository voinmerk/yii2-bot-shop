<?php
namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;

use common\models\User;

use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property int $sort_order
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property CategoryTranslate[] $categoryTranslates
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $title;
    public $content;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'sort_order', 'created_at', 'updated_at'], 'required'],
            [['sort_order', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['image', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
		    ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        /*$defLang = Language::getDefaultLanguage();

        $languages = Language::find()->all();

        $langList = yii\helpers\ArrayHelper::map($languages, 'id', 'name');*/

        return [
            /*'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => $langList,
                'languageField' => 'language_id',
                //'localizedPrefix' => '',
                //'requireTranslations' => false',
                //'dynamicLangClass' => true',
                'langClassName' => CategoryTranslate::className(), // or namespace/for/a/class/PostLang
                'defaultLanguage' => $defLang->id, // $defLang
                'langForeignKey' => 'category_id',
                'tableName' => CategoryTranslate::tableName(),
                'attributes' => [
                    'title', 'content', 'meta_title', 'meta_keywords', 'meta_description'
                ]
            ],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            /*'id' => Yii::t('frontend', 'ID'),
            'image' => Yii::t('frontend', 'Image'),
            'slug' => Yii::t('frontend', 'Slug'),
            'sort_order' => Yii::t('frontend', 'Sort Order'),
            'status' => Yii::t('frontend', 'Status'),
            'default_category_id' => Yii::t('frontend', 'Default Category Id'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),*/

            'id' => Yii::t('frontend', 'ID'),
            'image' => Yii::t('frontend', 'Image'),
            'slug' => Yii::t('frontend', 'Slug'),
            'sort_order' => Yii::t('frontend', 'Sort Order'),
            'status' => Yii::t('frontend', 'Status'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),

            // functions or query
            'title' => Yii::t('frontend', 'Title'),
            'content' => Yii::t('frontend', 'Content'),

            // functions AQ
            'metaTitle' => Yii::t('frontend', 'Meta Title'),
            'metaKeywords' => Yii::t('frontend', 'Meta Keywords'),
            'metaDescription' => Yii::t('frontend', 'Meta Description'),

            // query AQ
            'meta_title' => Yii::t('frontend', 'Meta Title'),
            'meta_keywords' => Yii::t('frontend', 'Meta Keywords'),
            'meta_description' => Yii::t('frontend', 'Meta Description'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getCategoryById($id)
    {
        $language = Language::getLanguageIdByCode(Yii::$app->language);

        return self::find()
                    ->select(['category.*', 'ct.title AS title', 'ct.meta_title AS meta_title', 'ct.content AS content', 'ct.meta_keywords AS meta_keywords', 'ct.meta_description AS meta_description'])
                    ->joinWith([
                        'categoryTranslates' => function($query) {
                            return $query->from(['ct' => CategoryTranslate::tableName()]);
                        }
                    ])
                    ->where(['slug' => $id, 'status' => self::STATUS_ACTIVE, 'ct.language_id' => $language])
                    ->orderBy(['sort_order' => SORT_ASC])
                    ->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function getList()
    {
        $language = Language::getLanguageIdByCode(Yii::$app->language);

        return self::find()
                    ->select(['category.*', 'ct.title AS title', 'ct.meta_title AS meta_title'])
                    ->joinWith([
                        'categoryTranslates' => function($query) {
                            return $query->from(['ct' => CategoryTranslate::tableName()]);
                        }
                    ])
                    ->where(['status' => self::STATUS_ACTIVE, 'ct.language_id' => $language])
                    ->orderBy(['sort_order' => SORT_ASC])
                    ->all();

        // SELECT `category`.* FROM `category` LEFT JOIN `category_translate` `ct` ON `category`.`id` = `ct`.`category_id` WHERE (`status`=1) AND (`ct`.`language_id`=1) ORDER BY `sort_order`
        // SELECT `category`.*, `ct`.`title` AS `title` FROM `category` LEFT JOIN `category_translate` `ct` ON `category`.`id` = `ct`.`category_id` WHERE (`status`=1) AND (`ct`.`language_id`=1) ORDER BY `sort_order`
    }

     /**
      * @return \yii\db\ActiveQuery
      */
     public function getBots()
     {
         return $this->hasMany(Bot::className(), ['id' => 'bot_id'])->viaTable('bot_to_category', ['category_id' => 'id']);
     }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTranslates()
    {
        return $this->hasMany(CategoryTranslate::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getTitle()
    {
        return $this->categoryTranslates[0]->title;
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getContent()
    {
        return $this->categoryTranslates[0]->content;
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getMetaTitle()
    {
        return $this->categoryTranslates[0]->meta_title;
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getMetaKeywords()
    {
        return $this->categoryTranslates[0]->meta_keywords;
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getMetaDescription()
    {
        return $this->categoryTranslates[0]->meta_desctiption;
    }*/

    /**
     * @return \omgdef\multilingual\MultilingualQuery
     */
    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }
}
