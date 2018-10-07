<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%bot_tag}}".
 *
 * @property int $id
 * @property string $content
 */
class BotTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bot_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string', 'max' => 255],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBots()
    {
        return $this->hasMany(Bot::className(), ['id' => 'bot_id'])->viaTable('bot_to_bot_tag', ['tag_id' => 'id']);
    }
}
