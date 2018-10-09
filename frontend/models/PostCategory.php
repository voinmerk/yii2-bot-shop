<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%post_category}}".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $image
 * @property int $template
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property PostCategoryTranslate[] $postCategoryTranslates
 */
class PostCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'template', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['image'], 'string', 'max' => 255],
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
            'parent_id' => Yii::t('frontend', 'Parent ID'),
            'image' => Yii::t('frontend', 'Image'),
            'template' => Yii::t('frontend', 'Template'),
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
        return $this->hasOne(User::className(), ['id' => 'created_by'])->inverseOf('postCategories');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by'])->inverseOf('postCategories0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategoryTranslates()
    {
        return $this->hasMany(PostCategoryTranslate::className(), ['category_id' => 'id'])->inverseOf('category');
    }
}
