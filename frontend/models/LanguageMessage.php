<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%language_message}}".
 *
 * @property int $id
 * @property string $category
 * @property string $message
 *
 * @property LanguageMessageTranslate[] $languageMessageTranslates
 */
class LanguageMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language_message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'category' => Yii::t('frontend', 'Category'),
            'message' => Yii::t('frontend', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageMessageTranslates()
    {
        return $this->hasMany(LanguageMessageTranslate::className(), ['id' => 'id'])->inverseOf('id0');
    }
}
