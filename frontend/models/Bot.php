<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%bot}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $username
 * @property string $token
 * @property string $start_param
 * @property string $image
 * @property int $views
 * @property int $status
 * @property int $published
 * @property int $default_category_id
 * @property int $author_by
 * @property int $added_by
 * @property int $moderated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BotCategory $defaultCategory
 * @property User $addedBy
 * @property User $authorBy
 * @property User $moderatedBy
 * @property BotComment[] $botComments
 * @property BotRating[] $botRatings
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
            [['views', 'status', 'published', 'default_category_id', 'author_by', 'added_by', 'moderated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'meta_title', 'username', 'token', 'start_param', 'image'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['token'], 'unique'],
            ['start_param', 'default', 'value' => self::START_PARAM],
            ['status', 'default', 'value' => self::STATUS_PANDING_APPROVED],
            ['status', 'in', 'range' => [self::STATUS_PANDING_APPROVED, self::STATUS_REJECTED, self::STATUS_APPROVED, self::STATUS_BANNED]],
            ['published', 'default', 'value' => self::PUBLISHED],
            ['published', 'in', 'range' => [self::PUBLISHED, self::UNPUBLISHED]],
            [['default_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BotCategory::className(), 'targetAttribute' => ['default_category_id' => 'id']],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
            [['author_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_by' => 'id']],
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
            'title' => Yii::t('frontend', 'Title'),
            'content' => Yii::t('frontend', 'Content'),
            'meta_title' => Yii::t('frontend', 'Meta Title'),
            'meta_keywords' => Yii::t('frontend', 'Meta Keywords'),
            'meta_description' => Yii::t('frontend', 'Meta Description'),
            'username' => Yii::t('frontend', 'Username'),
            'token' => Yii::t('frontend', 'Token'),
            'start_param' => Yii::t('frontend', 'Start Param'),
            'image' => Yii::t('frontend', 'Image'),
            'views' => Yii::t('frontend', 'Views'),
            'status' => Yii::t('frontend', 'Status'),
            'published' => Yii::t('frontend', 'Published'),
            'default_category_id' => Yii::t('frontend', 'Default Category ID'),
            'author_by' => Yii::t('frontend', 'Author By'),
            'added_by' => Yii::t('frontend', 'Added By'),
            'moderated_by' => Yii::t('frontend', 'Moderated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getBotById($id)
    {
        $query = self::find()->with(['botComments', 'botLanguages', 'botRatings'])->where(['username' => $id, 'status' => self::STATUS_APPROVED, 'published' => self::PUBLISHED]);

        return $query->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function getListAll()
    {
        $query = self::find()->with(['botRatings'])->where(['status' => self::STATUS_APPROVED, 'published' => self::PUBLISHED]);

        return $query->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getBotBySearchText($q)
    {
        return self::find()
                    ->with(['botRatings'])
                    ->where(['status' => self::STATUS_APPROVED, 'published' => self::PUBLISHED])
                    ->andWhere(['or', ['like', 'meta_title', $q], ['like', 'title', $q], ['like', 'content', $q]])
                    ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotCategories()
    {
        return $this->hasMany(BotCategory::className(), ['id' => 'category_id'])->viaTable('bot_to_bot_category', ['bot_id' => 'id']);
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
        return $this->hasOne(BotCategory::className(), ['id' => 'default_category_id'])->inverseOf('botsByDefCategory');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by'])->inverseOf('bots');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorBy()
    {
        return $this->hasOne(User::className(), ['id' => 'author_by'])->inverseOf('bots0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModeratedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'moderated_by'])->inverseOf('bots1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotComments()
    {
        return $this->hasMany(BotComment::className(), ['bot_id' => 'id'])->inverseOf('bot');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotRatings()
    {
        return $this->hasMany(BotRating::className(), ['bot_id' => 'id'])->inverseOf('bot');
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
