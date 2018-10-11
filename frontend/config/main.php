<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$params = require __DIR__ . '/../../common/config/params.php';

return [
    'id' => 'app-botshop-public',
    'name' => '🙃 BotSpy',
    'basePath' => dirname(__DIR__),
    'sourceLanguage' => 'en',
    'bootstrap' => ['log', 'languages'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'bot' => [
            'class' => 'SonkoDmitry\Yii\TelegramBot\Component',
            'apiToken' => '460767342:AAH19VjZoIIO7OWB53P7SI93w6rFPjKyKrc',
        ],
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
                // site/index
                'home' => 'site/index',

                // Language module (changes)
                'languages/<lang:[\w_-]+>' => 'languages/default/index',
                'languages' => 'languages/default/index',

                // Post controller
                //'post/search' => 'post/search',
                'post/<category:[\w_\/-]+>/<post:[\w_-]+>' => 'post/view',
                'post/<category:[\w_\/-]+>' => 'post/category',
                'posts' => 'post/index',

                // Catalog - bot controller
                'catalog/search' => 'bot/search',
                'catalog/<category:[\w_\/-]+>/<bot:[\w_-]+>' => 'bot/view',
                'catalog/<category:[\w_\/-]+>' => 'bot/category',
                'catalog' => 'bot/index',
                '' => 'bot/index',

                // Account controller
                'account/bot-update/<bot:[\w_-]+>' => 'account/bot-update',

                //'http://<lang:\w+>.botshop.loc/<controller>/<action>' => '<controller>/<action>',
            ],
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => \Yii::$app->language,

                    'sourceMessageTable' => '{{%language_message}}',
                    'messageTable' => '{{%language_message_translate}}',
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
