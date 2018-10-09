<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%post_trasnlate}}".
 *
 * @property int $post_id
 * @property int $language_id
 * @property string $title
 * @property string $content
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 *
 * @property Post $post
 * @property Language $language
 */
class PostTrasnlate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_trasnlate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'language_id', 'title', 'content', 'meta_title'], 'required'],
            [['post_id', 'language_id'], 'integer'],
            [['content', 'meta_keywords', 'meta_description'], 'string'],
            [['title', 'meta_title'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('frontend', 'Post ID'),
            'language_id' => Yii::t('frontend', 'Language ID'),
            'title' => Yii::t('frontend', 'Title'),
            'content' => Yii::t('frontend', 'Content'),
            'meta_title' => Yii::t('frontend', 'Meta Title'),
            'meta_keywords' => Yii::t('frontend', 'Meta Keywords'),
            'meta_description' => Yii::t('frontend', 'Meta Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id'])->inverseOf('postTrasnlates');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id'])->inverseOf('postTrasnlates');
    }
}
