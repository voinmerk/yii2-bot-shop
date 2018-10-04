<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

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
        return $this->render('add-bot');
    }

    public function actionSetting()
    {
        return $this->render('setting');
    }
}
