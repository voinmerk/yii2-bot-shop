<?php
namespace frontend\models\forms;

use Yii;
use yii\base\Model;

class SearchForm extends Model
{
    public $q;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['q', 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'q' => '',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function search()
    {

    }
}
