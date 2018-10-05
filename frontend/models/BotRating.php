<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%bot_rating}}".
 *
 * @property int $id
 * @property int $bot_id
 * @property int $user_id
 * @property int $rating
 *
 * @property Bot $bot
 * @property User $user
 */
class BotRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bot_rating}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bot_id', 'user_id', 'rating'], 'required'],
            [['bot_id', 'user_id', 'rating'], 'integer'],
            [['bot_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bot::className(), 'targetAttribute' => ['bot_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'bot_id' => Yii::t('frontend', 'Bot ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'rating' => Yii::t('frontend', 'Rating'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBot()
    {
        return $this->hasOne(Bot::className(), ['id' => 'bot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
