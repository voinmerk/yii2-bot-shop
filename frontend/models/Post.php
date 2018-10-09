<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string $title
 * @property string $preview_content
 * @property string $content
 * @property string $image
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property PostComment[] $postComments
 * @property PostTrasnlate[] $postTrasnlates
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'preview_content', 'content', 'slug', 'meta_title', 'meta_keywords', 'meta_description', 'created_at', 'updated_at'], 'required'],
            [['preview_content', 'content', 'meta_keywords', 'meta_description'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'slug', 'meta_title'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'title' => Yii::t('frontend', 'Title'),
            'preview_content' => Yii::t('frontend', 'Preview Content'),
            'content' => Yii::t('frontend', 'Content'),
            'image' => Yii::t('frontend', 'Image'),
            'slug' => Yii::t('frontend', 'Slug'),
            'meta_title' => Yii::t('frontend', 'Meta Title'),
            'meta_keywords' => Yii::t('frontend', 'Meta Keywords'),
            'meta_description' => Yii::t('frontend', 'Meta Description'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by'])->inverseOf('posts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by'])->inverseOf('posts0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComment::className(), ['post_id' => 'id'])->inverseOf('post');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTrasnlates()
    {
        return $this->hasMany(PostTrasnlate::className(), ['post_id' => 'id'])->inverseOf('post');
    }
}
