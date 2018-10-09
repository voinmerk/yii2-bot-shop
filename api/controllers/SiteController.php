<?php
namespace api\modules\v1\controllers;

use use yii\rest\Controller;

/**
 * Site Controller API
 *
 * @author Evgeniy Voyt <kremniov96@gmail.com>
 */
class SiteController extends Controller
{
    public function actionIndex(): array
    {
        return [
            'version' => '1.0.0',
        ];
    }
}
