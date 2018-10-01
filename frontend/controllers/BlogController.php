<?php
namespace frontend\controllers;

class BlogController extends \yii\web\Controller
{
    public function actionPost()
    {
        return $this->render('index');
    }

    public function actionArticle()
    {
        return $this->render('article');
    }

    public function actionView()
    {
        return $this->render('view');
    }
}
