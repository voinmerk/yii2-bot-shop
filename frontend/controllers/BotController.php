<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\Bot;
use frontend\models\BotRating;
use frontend\models\Category;
use frontend\models\Comment;
use frontend\models\BotLanguage;
use frontend\models\Language;

class BotController extends Controller
{
    public function actionIndex()
    {
    	$data = [];

        $data['language_id'] = Language::getLanguageIdByCode(Yii::$app->language);
        $data['categories'] = Category::getList();
        $data['bots'] = Bot::findAll(['status' => Bot::STATUS_ACTIVE]);

        return $this->render('index', $data);
    }

    public function actionCategory($category)
    {
    	$data = [];

        $data['language_id'] = Language::getLanguageIdByCode(Yii::$app->language);
        $data['category'] = Category::findOne(['slug' => $category]);
        $data['categories'] = Category::getList();
        $data['dataProvider'] = Bot::getListByCategory($category); //Bot::findAll(['status' => Bot::STATUS_ACTIVE]);//

    	return $this->render('category', $data);
    }

    public function actionView($category, $bot)
    {
    	$data = [];

        $data['category'] = Category::findOne(['slug' => $category, 'status' => Category::STATUS_ACTIVE]);
        $data['bot'] = Bot::findOne(['username' => $bot, 'status' => Bot::STATUS_ACTIVE]);

    	return $this->render('view', $data);
    }
}
