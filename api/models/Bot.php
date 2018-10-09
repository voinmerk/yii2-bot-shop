<?php
namespace api\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Bot Model Class
 */
class Bot extends ActiveRecord
{
    const STATUS_REJECTED = 0;
    const STATUS_APPROVED = 1;
    const STATUS_PANDING_APPROVED = 2;
    const STATUS_BANNED = 3;

    const UNPUBLISHED = 0;
    const PUBLISHED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bot}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    public static function getBotList()
    {
        $result = [];

        $bots = self::find()->where(['published' => self::PUBLISHED, 'status' => self::STATUS_APPROVED])->all();

        foreach($bots as $bot) {
            $result[] = [
                'id' => $bot->id,
                'name' => $bot->title,
                'username' => $bot->username,
                'description' => $bot->content,
                'avatar' => 'http://' . Yii::$app->getRequest()->serverName . '/uploads/bots/' . $bot->image,
            ];
        }

        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('bot_to_category', ['bot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['bot_id' => 'id'])->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotLanguages()
    {
        return $this->hasMany(BotLanguage::className(), ['id' => 'bot_language_id'])->viaTable('bot_to_bot_language', ['bot_id' => 'id']);
    }
}
