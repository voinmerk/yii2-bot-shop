<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%bot_category}}".
 *
 * @property int $id
 * @property string $slug
 * @property string $image
 * @property int $sort_order
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Bot[] $botsByDefCategory
 * @property User $createdBy
 * @property User $updatedBy
 * @property BotCategoryTranslate[] $botCategoryTranslates
 */
class BotCategory extends \yii\db\ActiveRecord
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
        return '{{%bot_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'sort_order', 'created_at', 'updated_at'], 'required'],
            [['sort_order', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'image'], 'string', 'max' => 255],
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'slug' => Yii::t('frontend', 'Slug'),
            'image' => Yii::t('frontend', 'Image'),
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
                    ->select(['bot_category.*', 'ct.title AS title', 'ct.meta_title AS meta_title', 'ct.content AS content', 'ct.meta_keywords AS meta_keywords', 'ct.meta_description AS meta_description'])
                    ->joinWith([
                        'botCategoryTranslates' => function($query) {
                            return $query->from(['ct' => BotCategoryTranslate::tableName()]);
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
                    ->select(['bot_category.*', 'ct.title AS title', 'ct.meta_title AS meta_title'])
                    ->joinWith([
                        'botCategoryTranslates' => function($query) {
                            return $query->from(['ct' => BotCategoryTranslate::tableName()]);
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
        return $this->hasMany(Bot::className(), ['id' => 'bot_id'])->viaTable('bot_to_bot_category', ['category_id' => 'id'])->andWhere(['published' => Bot::PUBLISHED, 'status' => Bot::STATUS_APPROVED]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotsByDefCategory()
    {
        return $this->hasMany(Bot::className(), ['default_category_id' => 'id'])->inverseOf('defCategory');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by'])->inverseOf('botCategories');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by'])->inverseOf('botCategories0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotCategoryTranslates()
    {
        return $this->hasMany(BotCategoryTranslate::className(), ['category_id' => 'id'])->inverseOf('category');
    }
}
