<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%language_message_translate}}".
 *
 * @property int $id
 * @property string $language
 * @property string $translation
 *
 * @property LanguageMessage $id0
 */
class LanguageMessageTranslate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language_message_translate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id', 'language'], 'unique', 'targetAttribute' => ['id', 'language']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageMessage::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'language' => Yii::t('frontend', 'Language'),
            'translation' => Yii::t('frontend', 'Translation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(LanguageMessage::className(), ['id' => 'id'])->inverseOf('languageMessageTranslates');
    }
}
