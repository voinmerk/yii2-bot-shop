<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-botshop-public',
    'name' => '🙃 BotSpy',
    'basePath' => dirname(__DIR__),
    'sourceLanguage' => 'en',
    'bootstrap' => ['log', 'languages'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-public',
            'baseUrl' => '',
            'class' => 'common\components\Request'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-public', 'httpOnly' => true],
            'loginUrl' => ['auth/login'],
        ],
        'session' => [
            'name' => 'botshop-public',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'common\components\UrlManager',
            'enableDefaultLanguageUrlCode' => true,

            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'languages' => 'languages/default/index',

                'catalog/search' => 'bot/search',
                'catalog/<category:[\w_-]+>/<bot:[\w_-]+>' => 'bot/view',
                'catalog/<category:[\w_-]+>' => 'bot/category',
                'catalog' => 'bot/index',
                '' => 'bot/index',

                'language/<id:\w+>' => 'site/language',
            ],
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => \Yii::$app->language,
                ],
            ],
        ],
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
