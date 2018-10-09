<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\helpers\ArrayHelper;

/**
 * Bot Controller API
 *
 * @author Evgeniy Voyt <kremniov96@gmail.com>
 */
class BotController extends Controller
{
    public $modelClass = 'api\models\Bot';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['index'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'languages' => [
                    'en',
                    'ru',
                ],
            ],
        ]);
    }

    public function actionIndex() : array
    {
        return $this->modelClass::getBotList();
    }

    /**
     * @inheritdoc
     */
    protected function verbs() : array
    {
        return [
            'index' => ['GET', 'HEAD'],
        ];
    }
}
