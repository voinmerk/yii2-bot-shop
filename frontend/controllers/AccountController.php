<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use frontend\models\Bot;
use frontend\models\Category;
use frontend\models\BotLanguage;

class AccountController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBots()
    {
        return $this->render('bots');
    }

    public function actionAddBot()
    {
        $model = new Bot();

        $categories = Category::find()->select(['id', 'slug'])->where(['status' => Category::STATUS_ACTIVE])->all();
        $languages = BotLanguage::find()->all();

        $categoryList = \yii\helpers\ArrayHelper::map($categories, 'id', 'slug');
        $botLanguageList = \yii\helpers\ArrayHelper::map($languages, 'id', 'name');

        return $this->render('add-bot', [
            'model' => $model,
            'categoryList' => $categoryList,
            'botLanguageList' => $botLanguageList,
        ]);
    }

    public function actionSetting()
    {
        return $this->render('setting');
    }
}
