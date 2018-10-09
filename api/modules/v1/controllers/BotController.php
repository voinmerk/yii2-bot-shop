<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

/**
 * Bot Controller API
 *
 * @author Evgeniy Voyt <kremniov96@gmail.com>
 */
class BotController extends ActiveController
{
    //public $modelClass = 'api\modules\v1\models\Bot';

    public $modelClass = 'frontend\models\Bot';
}
