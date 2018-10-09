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

$urlManager = \yii\helpers\ArrayHelper::merge($frontend['components']['urlManager'], $comsole['components']['urlManager']);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
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
    'params' => $params,
];
