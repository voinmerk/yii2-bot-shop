<?php
namespace frontend\models\forms;

use Yii;
use yii\base\Model;
// use yii\web\UploadedFile;
use frontend\models\Comment;

class CommentForm extends Model
{
    public $bot_id;
    public $comment;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'max' => 360],
            [['bot_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bot_id' => Yii::t('frontend', 'Bot ID'),
            'comment' => Yii::t('frontend', 'Comment'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function addComment()
    {
        if (!$this->validate()) {
            return false;
        }

        $model = new Comment;

        $model->content = $this->comment;
        $model->bot_id = $this->bot_id;
        $model->created_by = Yii::$app->user->identity->id;

        if($model->save()) {
            return $model;
        }

        return false;
    }
}
