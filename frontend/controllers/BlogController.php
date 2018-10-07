<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class BlogController extends Controller
{
    public function actionPost()
    {
        $data = [];

        return $this->render('index', $data);
    }

    public function actionCategory($category)
    {
        $data = [];

        return $this->render('category', $data);
    }

    public function actionView($category, $post)
    {
        $data = [];

        return $this->render('view', $data);
    }
}
