<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$frontend = require(__DIR__ . '/../../frontend/config/main.php');
$comsole = [
    'components' => [
        'urlManager' => [
            'class' => 'common\components\UrlManager',
            'enableDefaultLanguageUrlCode' => true,

            'baseUrl' => $params['frontendHostName'],
        ]
    ]
];

$urlManager = \yii\helpers\ArrayHelper::merge($comsole['components']['urlManager'], $frontend['components']['urlManager']);

/*var_dump($urlManager);
exit;*/

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'sourceLanguage' => 'en',
    'bootstrap' => ['log', 'languages'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
        'sitemap' => [
            'class' => 'demi\sitemap\SitemapController',
            'modelsPath' => '@console/models/sitemap',
            'modelsNamespace' => 'console\models\sitemap',
            'savePathAlias' => '@frontend/web',
            'sitemapFileName' => 'sitemap.xml',
        ],
    ],
    'components' => [
        'request' => [
            'class' => 'common\components\Request',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => $urlManager,
    ],
    'modules' => [
        'languages' => [
            'class' => 'common\modules\languages\Module',

            'default_language' => 'en', //основной язык (по-умолчанию)
            'show_default' => false, //true - показывать в URL основной язык, false - нет
        ],
    ],
    'params' => $params,
];
