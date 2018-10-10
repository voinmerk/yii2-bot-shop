<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\Post;
use frontend\models\PostCategory;

class PostController extends Controller
{
    public function actionIndex()
    {
        $data = [];

        // $data['categories'] = PostCategory::find()->where(['status' => PostCategory::STATUS_ACTIVE])->all();

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
