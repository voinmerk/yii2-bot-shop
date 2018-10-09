<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\Bot;
use frontend\models\BotRating;
use frontend\models\BotCategory;
use frontend\models\BotComment;
use frontend\models\BotLanguage;
use frontend\models\Language;

use \frontend\models\forms\CommentForm;

class BotController extends Controller
{
    public function beforeAction($action)
    {
        $model = new \frontend\models\forms\SearchForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $q = \yii\helpers\Html::encode($model->q);

            return $this->redirect(['bot/search', 'q' => $q]);
        }

        return true;
    }

    public function actionIndex()
    {
    	$data = [];

        $data['language_id'] = Language::getLanguageIdByCode(Yii::$app->language);
        $data['categories'] = BotCategory::getList();
        $data['bots'] = Bot::findAll(['published' => Bot::PUBLISHED, 'status' => Bot::STATUS_APPROVED]);

        return $this->render('index', $data);
    }

    public function actionCategory($category)
    {
    	$data = [];

        $data['language_id'] = Language::getLanguageIdByCode(Yii::$app->language);

        $modelCategory = BotCategory::getCategoryById($category);

        if(!$modelCategory) {
            throw new BadRequestHttpException(Yii::t('frontend', 'This category does not exist!'));
        }

        $data['category'] = $modelCategory;
        $data['categories'] = BotCategory::getList();
        $data['bots'] = BotCategory::find()->where(['slug' => $category])->with('bots')->one()->bots;

    	return $this->render('category', $data);
    }

    public function actionView($category, $bot)
    {
    	$data = [];

        $request = Yii::$app->request;
        $session = Yii::$app->session;

        $modelCategory = BotCategory::getCategoryById($category);
        $modelBot = Bot::getBotById($bot);

        if(!$modelCategory) {
            throw new BadRequestHttpException(Yii::t('frontend', 'This category does not exist!'));
        }

        if(!$modelBot) {
            throw new BadRequestHttpException(Yii::t('frontend', 'This bot does not exist!'));
        }

        if (!$session->isActive) $session->open();

        if($session->hasFlash('comment_success')) {
            $data['comment_success'] = $session->getFlash('comment_error');
        }

        if($session->hasFlash('comment_error')) {
            $data['comment_error'] = $session->getFlash('comment_error');
        }

        $commentForm = new CommentForm;

        $commentForm->bot_id = $bot->id;

        if($request->isPost) {
            if(!Yii::$app->user->isGuest) {
                if($commentForm->load($request->post())) {
                    if($commentForm->addComment()) {
                        $session->setFlash('comment_success', Yii::t('frontend', 'Comment successfully added!'));

                        return $this->redirect(['bot/view', 'category' => $category, 'bot' => $bot, '#' => 'comments']);
                    } else {
                        $session->setFlash('comment_error', Yii::t('frontend', 'Unprocessed error!'));
                    }
                }
            } else {
                $session->setFlash('comment_error', Yii::t('frontend', 'You must be logged in!'));
            }
        }

        $data['category'] = $modelCategory;
        $data['bot'] = $modelBot;
        $data['commentForm'] = $commentForm;

    	return $this->render('view', $data);
    }

    public function actionSearch($q)
    {
        $data = [];

        //$q = Yii::$app->request->get('q');

        $data['search'] = $q;
        $data['language_id'] = Language::getLanguageIdByCode(Yii::$app->language);
        $data['categories'] = BotCategory::getList();
        $data['bots'] = Bot::getBotBySearchText($q);

        return $this->render('search', $data);
    }

    /*public function actionComment()
    {
        $request = Yii::$app->request;

        $commentForm = new CommentForm;

        if($requst->isPost) {
            if($commentForm->load($request->post())) {
                $comment = $commentForm->addComment();

                if($comment) {
                    $session->setFlash('comment_success', Yii::t('frontend', 'Comment successfully added!'));
                } else {
                    $session->setFlash('comment_error', Yii::t('frontend', 'Error send comment'));
                }

                return $this->redirect(['bot/view', 'category' => $comment->bot->defCategory->slug, 'bot' => $comment->bot->username]);
            }
        }

        return $this->redirect(['bot/index']);
    }*/
}
