<?php
namespace frontend\models\forms;

use Yii;
use yii\base\Model;

use frontend\models\Bot;
use frontend\models\BotLanguage;
use frontend\models\BotCategory;

class AddBotForm extends Model
{
    public $meta_title;
    public $title;
    public $username;
    public $content;
    public $image;
    public $default_category_id;
    public $category_ids;
    public $language_ids;
    public $token;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meta_title', 'title', 'username', 'content', 'category_ids', 'language_ids', 'image', 'default_category_id'], 'required'], // Обязательные поля
            [['meta_title', 'title', 'username', 'token'], 'string', 'max' => 255], // Тип - string, макс. длина - 255
            [['default_category_id'], 'integer'], // Тип - integer
            [['username', 'token'], 'trim'], // Без пробелов
            ['username', 'validateUsername'], // Проверка на валидность введённго имени
            [['category_ids', 'language_ids'], 'safe'], // Тип - array
            ['username', 'unique', 'targetClass' => '\frontend\models\Bot', 'message' => 'This bot\'s name is already taken.'], // Уникальное значение
            ['token', 'unique', 'targetClass' => '\frontend\models\Bot', 'message' => 'This token is already being used by another bot.'], // Уникальное значение
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 1], // Тип файл, разрешины только png и jpg
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'meta_title' => Yii::t('frontend', 'Заголовок страницы бота'),
            'title' => Yii::t('frontend', 'Имя бота'),
            'username' => Yii::t('frontend', 'Логин бота'),
            'content' => Yii::t('frontend', 'Описание'),
            'image' => Yii::t('frontend', 'Изображение (аватар)'),
            'default_category_id' => Yii::t('frontend', 'Категория по умолчанию'),
            'category_ids' => Yii::t('frontend', 'Категория бота'),
            'language_ids' => Yii::t('frontend', 'Языки бота'),
            'token' => Yii::t('frontend', 'Токен'),
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
    public function addBot()
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
                    $model->link('categories', BotCategory::findOne($category_id));
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
