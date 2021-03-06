<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%post_category_translate}}".
 *
 * @property int $category_id
 * @property int $language_id
 * @property string $title
 * @property string $content
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 *
 * @property PostCategory $category
 * @property Language $language
 */
class PostCategoryTranslate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_category_translate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'language_id', 'title', 'meta_title'], 'required'],
            [['category_id', 'language_id'], 'integer'],
            [['content', 'meta_keywords', 'meta_description'], 'string'],
            [['title', 'meta_title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('frontend', 'Category ID'),
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
    public function getCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'category_id'])->inverseOf('postCategoryTranslates');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id'])->inverseOf('postCategoryTranslates');
    }
}
