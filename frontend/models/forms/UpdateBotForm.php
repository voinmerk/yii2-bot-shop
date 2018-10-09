<?php
namespace frontend\models\forms;

use Yii;
use yii\base\Model;

use frontend\models\Bot;
use frontend\models\BotLanguage;
use frontend\models\BotCategory;

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
    public function updateBot()
    {
        /*if (!$this->validate()) {
            return false;
        }*/

        $model = new Bot;

        if ($this->image) {
            $model->meta_title = $this->meta_title;
            $model->title = $this->title;
            $model->content = $this->content;
            $model->default_category_id = $this->default_category_id;
            $model->image = $this->image;

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
