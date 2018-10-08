<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
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
        $data = [];

        $data['bots'] = Bot::find()->where(['added_by' => Yii::$app->user->identity->id])->all();

        //die(var_dump($data['bots']));

        return $this->render('bots', $data);
    }

    public function actionAddBot()
    {
        $model = new \frontend\models\forms\AddBotForm();

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

    public function actionBotUpdate($bot)
    {
        $data = [];

        $data['bot'] = Bot::findOne(['username' => $bot]);

        if(!$data['bot']) {
            throw new BadRequestHttpException(Yii::t('frontend', 'This bot does not exist!'));
        }

        return $this->render('bot-update', $data);
    }
}
