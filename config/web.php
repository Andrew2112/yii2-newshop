<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$smtp = is_file(__DIR__ . '/mailer-local.php') ? require __DIR__ . '/mailer-local.php' : null;

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'home/index',
    'language' => 'ru-RU',
    'name' => 'Grocery Store',
    'layout' => 'grocery',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',
            'defaultRoute' => 'main/index',
        ],
    ],
    'components' => [
        'formatter' => [
            'datetimeFormat' => 'php:d F Y H:i:s',

        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // не опубликовывать комплект
                    'js' => [
                        'js/jquery-1.11.1.min.js',
                    ]
                ],
            ],

        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bdF5HUrHiOuaw1fwoH_B3T_Zd3eCwZ8i',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'loginUrl' => '/admin/auth/login',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // SMTP-доступы берутся из config/mailer-local.php (не в git).
        // Если файла нет — письма пишутся в runtime/mail.
        'mailer' => $smtp === null
            ? ['class' => 'yii\symfonymailer\Mailer', 'useFileTransport' => true]
            : ['class' => 'yii\symfonymailer\Mailer', 'useFileTransport' => false, 'transport' => $smtp],
        // Почтовые уведомления: заказы, подписки и т.д. (отправитель и admin email — из params.php)
        'notifier' => [
            'class' => 'app\components\Notifier',
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            /* 'rules' => [
                 'category/<id:\d+>/page/<page:\d+>' => 'category/view',
                 'category/<id:\d+>' => 'category/view',
                 'product/<id:\d+>' => 'product/view',
 //                'hotoffers/<id:\d+>' => 'hotoffers/offers',
                 'search' => 'category/search',
             ],*/
            'rules' => [
                'search' => 'category/search',

                // Служебные контроллеры — чтобы правило товара их не перехватывало: /cart/add, /site/login ...
                'cart/<action:[\w\-]+>' => 'cart/<action>',
                'site/<action:[\w\-]+>' => 'site/<action>',
                'home/<action:[\w\-]+>' => 'home/<action>',
                'elfinder/<action:[\w\-]+>' => 'elfinder/<action>',

                // AJAX-подгрузка товаров категории (должно быть ВЫШЕ правила товара)
                'category/load-more' => 'category/load-more',

                // Админка
                'admin' => 'admin/main/index',
                'admin/<controller:[\w\-]+>/<action:[\w\-]+>' => 'admin/<controller>/<action>',
                'admin/<controller:[\w\-]+>' => 'admin/<controller>/index',

                // Товар внутри категории: /<категория>/<товар>
                '<category:[\w\-]+>/<alias:[\w\-]+>' => 'product/view',

                // Категория с пагинацией, hotoffers и сама категория
                '<alias:[\w\-]+>/page/<page:\d+>' => 'category/view',
                'hotoffers' => 'hotoffers/offers',
                '<alias:[\w\-]+>' => 'category/view',
            ],
        ],

    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'path' => 'upload/files',
                'name' => 'Files'
            ],

        ]
    ],
    'params' => $params,

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

}

return $config;
