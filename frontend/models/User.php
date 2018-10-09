<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Bot[] $bots
 * @property Bot[] $bots0
 * @property Bot[] $bots1
 * @property BotCategory[] $botCategories
 * @property BotCategory[] $botCategories0
 * @property BotComment[] $botComments
 * @property BotComment[] $botComments0
 * @property BotRating[] $botRatings
 * @property Post[] $posts
 * @property Post[] $posts0
 * @property PostCategory[] $postCategories
 * @property PostCategory[] $postCategories0
 * @property PostComment[] $postComments
 * @property PostComment[] $postComments0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'first_name', 'last_name', 'avatar', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'first_name', 'last_name', 'avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'username' => Yii::t('frontend', 'Username'),
            'auth_key' => Yii::t('frontend', 'Auth Key'),
            'first_name' => Yii::t('frontend', 'First Name'),
            'last_name' => Yii::t('frontend', 'Last Name'),
            'avatar' => Yii::t('frontend', 'Avatar'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBots()
    {
        return $this->hasMany(Bot::className(), ['added_by' => 'id'])->inverseOf('addedBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBots0()
    {
        return $this->hasMany(Bot::className(), ['author_by' => 'id'])->inverseOf('authorBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBots1()
    {
        return $this->hasMany(Bot::className(), ['moderated_by' => 'id'])->inverseOf('moderatedBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotCategories()
    {
        return $this->hasMany(BotCategory::className(), ['created_by' => 'id'])->inverseOf('createdBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotCategories0()
    {
        return $this->hasMany(BotCategory::className(), ['updated_by' => 'id'])->inverseOf('updatedBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotComments()
    {
        return $this->hasMany(BotComment::className(), ['created_by' => 'id'])->inverseOf('createdBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotComments0()
    {
        return $this->hasMany(BotComment::className(), ['updated_by' => 'id'])->inverseOf('updatedBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBotRatings()
    {
        return $this->hasMany(BotRating::className(), ['user_id' => 'id'])->inverseOf('user');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['created_by' => 'id'])->inverseOf('createdBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts0()
    {
        return $this->hasMany(Post::className(), ['updated_by' => 'id'])->inverseOf('updatedBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategories()
    {
        return $this->hasMany(PostCategory::className(), ['created_by' => 'id'])->inverseOf('createdBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategories0()
    {
        return $this->hasMany(PostCategory::className(), ['updated_by' => 'id'])->inverseOf('updatedBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComment::className(), ['created_by' => 'id'])->inverseOf('createdBy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments0()
    {
        return $this->hasMany(PostComment::className(), ['updated_by' => 'id'])->inverseOf('updatedBy');
    }
}
