<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%bot_comment}}".
 *
 * @property int $id
 * @property string $content
 * @property int $bot_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Bot $bot
 * @property User $createdBy
 * @property User $updatedBy
 */
class BotComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bot_comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['bot_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['bot_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bot::className(), 'targetAttribute' => ['bot_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
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
            'bot_id' => Yii::t('frontend', 'Bot ID'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBot()
    {
        return $this->hasOne(Bot::className(), ['id' => 'bot_id'])->inverseOf('botComments');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by'])->inverseOf('botComments');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by'])->inverseOf('botComments0');
    }
}
