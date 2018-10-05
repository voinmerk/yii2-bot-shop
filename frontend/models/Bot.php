<?php

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;

use common\models\User;

/**
 * This is the model class for table "{{%bot}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string username
 * @property string token
 * @property string $image
 * @property int $views
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $updatedBy
 * @property User $createdBy
 */
class Bot extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const START_PARAM = 'http://botshop.loc';

    public $category_ids = [];
    public $language_ids = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bot}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'meta_title', 'username', 'token', 'image', 'views', 'created_at', 'updated_at'], 'required'],
            [['content', 'meta_keywords', 'meta_description'], 'string'],
            [['views', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'meta_title', 'username', 'token', 'image', 'start_param'], 'string', 'max' => 255],
            ['start_param', 'default', 'value' => self::START_PARAM],
            [['username', 'token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /*[
                'class' => \yiidreamteam\upload\ImageUploadBehavior::className(),
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 500, 'height' => 500],
                ],
                'filePath' => '@webroot/images/[[pk]].[[extension]]',
                'fileUrl' => '/images/[[pk]].[[extension]]',
                'thumbPath' => '@webroot/images/[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/images/[[profile]]_[[pk]].[[extension]]',
            ],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            /*
            'id' => Yii::t('frontend', 'ID'),
            'title' => Yii::t('frontend', 'Title'),
            'content' => Yii::t('frontend', 'Content'),
            'meta_title' => Yii::t('frontend', 'Meta Title'),
            'meta_keywords' => Yii::t('frontend', 'Meta Keywords'),
            'meta_description' => Yii::t('frontend', 'Meta Description'),
            'username' => Yii::t('frontend', 'Username'),
            'image' => Yii::t('frontend', 'Image'),
            'views' => Yii::t('frontend', 'Views'),
            'default_category_id' => Yii::t('frontend', 'Default Category Id'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
            */

            'id' => Yii::t('frontend', 'ID'),
            'title' => Yii::t('frontend', 'Имя бота'),
            'content' => Yii::t('frontend', 'Описание'),
            'meta_title' => Yii::t('frontend', 'Заголовок страницы бота'),
            'meta_keywords' => Yii::t('frontend', 'Meta Keywords'),
            'meta_description' => Yii::t('frontend', 'Meta Description'),
            'username' => Yii::t('frontend', 'Логин бота'),
            'token' => Yii::t('frontend', 'Токен'),
            'image' => Yii::t('frontend', 'Изображение (аватар)'),
            'views' => Yii::t('frontend', 'Views'),
            'default_category_id' => Yii::t('frontend', 'Категория по умолчанию'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),

            'category_ids' => Yii::t('frontend', 'Категория бота'),
            'language_ids' => Yii::t('frontend', 'Языки бота'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getBotById($id)
    {
        $query = self::find()->with(['comments', 'botLanguages', 'botsRating'])->where(['username' => $id, 'status' => self::STATUS_ACTIVE]);

        return $query->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function getListAll()
    {
        $query = self::find()->where(['status' => self::STATUS_ACTIVE]);

        return $query->all();
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('bot_to_category', ['bot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['id' => 'comment_id'])->viaTable('bot_to_comment', ['bot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotLanguages()
    {
        return $this->hasMany(BotLanguage::className(), ['id' => 'bot_language_id'])->viaTable('bot_to_bot_language', ['bot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'default_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotsRating()
    {
        return $this->hasMany(BotRating::className(), ['bot_id' => 'id']);
    }
}
