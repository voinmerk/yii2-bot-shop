<?php
namespace frontend\models\forms;

use Yii;
use yii\base\Model;
// use yii\web\UploadedFile;
use frontend\models\Bot;
use frontend\models\BotLanguage;
use frontend\models\Category;

class UpdateBotForm extends Model
{
    public $meta_title;
    public $title;
    public $content;
    public $published;
    public $image;
    public $default_category_id;
    public $category_ids;
    public $language_ids;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meta_title', 'title', 'content', 'category_ids', 'language_ids', 'default_category_id'], 'required'], // Обязательные поля
            [['meta_title', 'title'], 'string', 'max' => 255], // Тип - string, макс. длина - 255
            [['default_category_id'], 'integer'], // Тип - integer
            [['category_ids', 'language_ids'], 'safe'], // Тип - array
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 1], // Тип файл, разрешины только png и jpg
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'meta_title' => Yii::t('frontend', 'Bot page title'),
            'title' => Yii::t('frontend', 'Bot name'),
            'content' => Yii::t('frontend', 'Description'),
            'image' => Yii::t('frontend', 'Avatar'),
            'default_category_id' => Yii::t('frontend', 'Default category'),
            'category_ids' => Yii::t('frontend', 'Bot categories'),
            'language_ids' => Yii::t('frontend', 'Bot languages'),
            'published' => Yii::t('frontend', 'Published'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function validateUsername($attribute, $params) {
        if ($this->username[0] == '@')
            $this->username = substr($this->username, 1);

        $pos = strripos($this->username, 'bot');

        if (!$pos) {
            $this->addError($attribute, 'Sorry, this username is invalid.');
        } else {
            $rest = substr($this->username, $pos);

            if (strtolower($rest) != 'bot')
                $this->addError($attribute, 'Sorry, this username is invalid.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateBot()
    {
        /*if (!$this->validate()) {
            return false;
        }*/

        $model = new Bot;

        if ($this->image) {
            $model->meta_title = $this->meta_title;
            $model->title = $this->title;
            $model->username = $this->username;
            $model->content = $this->content;
            $model->default_category_id = $this->default_category_id;
            $model->image = $this->image;
            $model->token = $this->token ? $this->token : null;
            $model->added_by = Yii::$app->user->identity->id;

            if($model->save()) {
                foreach ($this->category_ids as $category_id) {
                    $model->link('categories', Category::findOne($category_id));
                }

                foreach ($this->language_ids as $language_id) {
                    $model->link('botLanguages', BotLanguage::findOne($language_id));
                }

                return true;
            }
        }

        return false;
    }
}
