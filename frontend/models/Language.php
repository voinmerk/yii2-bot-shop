<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoryTranslite[] $categoryTranslites
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'name' => Yii::t('frontend', 'Name'),
            'code' => Yii::t('frontend', 'Code'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getLanguageIdByCode($code)
    {
     $query = self::find()->select(['id'])->where(['code' => $code])->one();

     return $query->id;
    }

    /**
     * {@inheritdoc}
     */
    public static function getLanguageNameByCode($code)
    {
      $query = self::find()->select(['name'])->where(['code' => $code])->one();

      return $query->name;
    }

    /**
     * {@inheritdoc}
     */
    public static function getLanguages()
    {
        $languages = self::find()
            ->asArray()
            ->all();

        return $languages;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTranslites()
    {
        return $this->hasMany(CategoryTranslite::className(), ['language_id' => 'id']);
    }
}
