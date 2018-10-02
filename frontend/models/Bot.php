<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%bot}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $name
 * @property string $image
 * @property int $voices
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
            [['title', 'content', 'name', 'image', 'voices', 'views', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['voices', 'views', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'name', 'image'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
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
            'name' => Yii::t('frontend', 'Name'),
            'image' => Yii::t('frontend', 'Image'),
            'voices' => Yii::t('frontend', 'Voices'),
            'views' => Yii::t('frontend', 'Views'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
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
    public function getBotCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('bot_to_category', ['bot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotComments()
    {
        return $this->hasMany(Comment::className(), ['id' => 'comment_id'])->viaTable('bot_to_comment', ['bot_id' => 'id']);
    }
}