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

        $modelCategory = Category::getCategoryById($category);

        if(!$modelCategory) {
            throw new BadRequestHttpException(Yii::t('frontend', 'This category does not exist!'));
        }

        $data['category'] = $modelCategory;
        $data['categories'] = Category::getList();
        $data['bots'] = Category::find()->where(['slug' => $category])->with('bots')->one()->bots;

    	return $this->render('category', $data);
    }

    public function actionView($category, $bot)
    {
    	$data = [];

        $category = Category::getCategoryById($category);
        $bot = Bot::getBotById($bot);

        if(!$category) {
            throw new BadRequestHttpException(Yii::t('frontend', 'This category does not exist!'));
        }

        if(!$bot) {
            throw new BadRequestHttpException(Yii::t('frontend', 'This bot does not exist!'));
        }

        $data['category'] = $category;
        $data['bot'] = $bot;

    	return $this->render('view', $data);
    }
}
