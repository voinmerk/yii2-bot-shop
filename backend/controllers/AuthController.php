<?php
namespace backend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

use common\models\User;

class AuthController extends Controller
{
    public $layout = 'auth';
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'telegram', 'login'],
                'rules' => [
                    [
                        'actions' => ['telegram', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $data = [];

        if(Yii::$app->session->hasFlash('error')) {
            $data['error'] = Yii::$app->session->getFlash('error');
        }

        return $this->render('login', $data);
    }

    public function actionTelegram()
    {
        $data = Yii::$app->request->get();

        $user = User::findByUsername($data['username']);

        if(!$user) {
            Yii::$app->session->setFlash('error', 'Сбой аутентификации');

            return $this->redirect(['auth/login']);
        }

        Yii::$app->user->login($user, 3600 * 24 * 30);

        return $this->goHome();
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

