<?php
namespace frontend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class AddBotForm extends Model
{
    public $meta_title;
    public $title;
    public $username;
    public $content;
    public $category_ids;
    public $language_ids;
    public $default_category_id;
    public $image;
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
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'], // Тип файл, разрешины только png и jpg
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
            'content' => Yii::t('frontend', 'Описание'),
            'username' => Yii::t('frontend', 'Логин бота'),
            'token' => Yii::t('frontend', 'Токен'),
            'image' => Yii::t('frontend', 'Изображение (аватар)'),
            'default_category_id' => Yii::t('frontend', 'Категория по умолчанию'),
            'category_ids' => Yii::t('frontend', 'Категория бота'),
            'language_ids' => Yii::t('frontend', 'Языки бота'),
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
        if (!$this->validate()) {
            return false;
        }

        $model = new \frontend\models\Bot();

        //$model->scenario($model::SCENARIO_CREATE);

        $this->image->saveAs('uploads/bots/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);

        $model->username = $this->username;
        $model->username = $this->username;
        $model->username = $this->username;
        $model->username = $this->username;
        
        $model->image = $this->image;

        return $model->save();
    }
}
