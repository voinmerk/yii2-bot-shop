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
 * @property int $author_by ~ Автор бота
 * @property int $added_by ~ Пользователь который добавил бота
 * @property int $moderated_by ~ Админ который модерировал бота
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $updatedBy
 * @property User $createdBy
 */
class Bot extends \yii\db\ActiveRecord
{
    const STATUS_REJECTED = 0;
    const STATUS_APPROVED = 1;
    const STATUS_PANDING_APPROVED = 2;
    const STATUS_BANNED = 3;

    const UNPUBLISHED = 0;
    const PUBLISHED = 1;

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
            [['title', 'content', 'meta_title', 'username', 'image'], 'required'],
            [['content', 'meta_keywords', 'meta_description'], 'string'],
            [['title', 'meta_title', 'username', 'token', 'image', 'start_param'], 'string', 'max' => 255],
            [['views', 'status', 'published', 'author_by', 'added_by', 'moderated_by', 'created_at', 'updated_at', 'default_category_id'], 'integer'],
            ['start_param', 'default', 'value' => self::START_PARAM],
            [['username', 'token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_PANDING_APPROVED],
            ['status', 'in', 'range' => [self::STATUS_PANDING_APPROVED, self::STATUS_REJECTED, self::STATUS_APPROVED, self::STATUS_BANNED]],
            ['published', 'default', 'value' => self::PUBLISHED],
            ['published', 'in', 'range' => [self::PUBLISHED, self::UNPUBLISHED]],
            [['default_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['default_category_id' => 'id']],
            [['author_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_by' => 'id']],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
            [['moderated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['moderated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
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
            'author_by' => Yii::t('frontend', 'Author By'),
            'added_by' => Yii::t('frontend', 'Added By'),
            'moderated_by' => Yii::t('frontend', 'Moderated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
            'status' => Yii::t('frontend', 'Status'),
            'published' => Yii::t('frontend', 'Published'),

            'category_ids' => Yii::t('frontend', 'Категория бота'),
            'language_ids' => Yii::t('frontend', 'Языки бота'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getBotById($id)
    {
        $query = self::find()->with(['comments', 'botLanguages', 'botsRating'])->where(['username' => $id, 'status' => self::STATUS_APPROVED, 'published' => self::PUBLISHED]);

        return $query->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function getListAll()
    {
        $query = self::find()->with(['botsRating'])->where(['status' => self::STATUS_APPROVED, 'published' => self::PUBLISHED]);

        return $query->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getBotBySearchText($q)
    {
        return self::find()
                    ->with(['botsRating'])
                    ->where(['status' => self::STATUS_APPROVED, 'published' => self::PUBLISHED])
                    ->andWhere(['or', ['like', 'meta_title', $q], ['like', 'title', $q], ['like', 'content', $q]])
                    ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorBy()
    {
        return $this->hasOne(User::className(), ['id' => 'author_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModeratedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'moderated_by']);
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
        return $this->hasMany(Comment::className(), ['bot_id' => 'id'])->orderBy(['created_at' => SORT_DESC]);
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
    public function getBotTags()
    {
        return $this->hasMany(BotTag::className(), ['id' => 'tag_id'])->viaTable('bot_to_bot_tag', ['bot_id' => 'id']);
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

    public function getStatusList()
    {
        return [
            Yii::t('frontend', 'Rejected'),
            Yii::t('frontend', 'Approved'),
            Yii::t('frontend', 'Panding approved'),
            Yii::t('frontend', 'Banned'),
        ];
    }

    public function getStatusName()
    {
        $statusList = $this->getStatusList();

        return $statusList[$this->status];
    }

    public function getPublishedList()
    {
        return [
            Yii::t('frontend', 'Unpublished'),
            Yii::t('frontend', 'Published'),
        ];
    }

    public function getPublishedName()
    {
        $publishedList = $this->getPublishedList();

        return $publishedList[$this->published];
    }
}
