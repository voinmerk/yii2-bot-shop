<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

use common\models\LoginForm;
use common\models\User;

use frontend\models\forms\PasswordResetRequestForm;
use frontend\models\forms\ResetPasswordForm;
use frontend\models\forms\SignupForm;

class AuthController extends Controller
{
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'telegram'],
                'rules' => [
                    [
                        'actions' => ['telegram'],
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
                    //'login' => ['post'],
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionTelegram()
    {
        $data = Yii::$app->request->get();

        $user = User::findByUsername($data['username']);

        if(!$user) {
            $user = new User();

            $user->id = $data['id'];
            $user->username = $data['username'];
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->avatar = $data['photo_url'];
            $user->generateAuthKey();

            $user->save();
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
