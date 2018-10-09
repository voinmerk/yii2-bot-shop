<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%post_tag}}".
 *
 * @property int $id
 * @property string $content
 */
class PostTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'content' => Yii::t('frontend', 'Content'),
        ];
    }
}
