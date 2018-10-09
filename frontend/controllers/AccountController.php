<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use frontend\models\Bot;
use frontend\models\BotCategory;
use frontend\models\BotLanguage;
use frontend\models\forms\AddBotForm;

class AccountController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user']
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBots()
    {
        $data = [];

        if (Yii::$app->session->hasFlash('success')) {
            $data['success'] = Yii::$app->session->getFlash('success');
        }

        $data['bots'] = Bot::find()->where(['added_by' => Yii::$app->user->identity->id])->all();

        return $this->render('bots', $data);
    }

    public function actionAddBot()
    {
        $data = [];

        $request = Yii::$app->request;

        $model = new AddBotForm;

        if ($request->isPost) {
            if ($model->load($request->post())) {
                $model->image = UploadedFile::getInstance($model, 'image');

                $imagePath = 'bot_' . md5($model->image->baseName) . '.' . $model->image->extension;

                if ($model->image->saveAs('uploads/bots/' . $imagePath)) {
                    $model->image = $imagePath;
                }

                if ($model->addBot()) {
                    Yii::$app->session->setFlash('success', Yii::t('frontend', 'The bot has been successfully added!'));

                    return $this->redirect(['account/bots']);
                } else {
                    $data['error_warning'] = implode('<br>', $model->errors);
                }
            }
        }

        $categories = BotCategory::find()->select(['id', 'slug'])->where(['status' => BotCategory::STATUS_ACTIVE])->all();
        $languages = BotLanguage::find()->all();

        $data['model'] = $model;
        $data['categoryList'] = ArrayHelper::map($categories, 'id', 'slug');
        $data['botLanguageList'] = ArrayHelper::map($languages, 'id', 'name');

        return $this->render('add-bot', $data);
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
