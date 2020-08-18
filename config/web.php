<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
//use \yii\web\Request;
//$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','queue'],
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'q6PvrM7fl6xs7PiFw7tTe4oNKKg9QZOc',
            //'baseUrl' => $baseUrl,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'vietyoung2018@gmail.com',
                'password' => 'iloveVN2018',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'error', 'warning'],
                    'logFile' => '@app/runtime/logs/journal.log',
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['vi', 'en'],
            'enableDefaultLanguageUrlCode' => false,
            //'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'suffix' => '.html',
            'enableStrictParsing' => false,
            'rules' => [
                'writers/page/<page:\d+>' => 'site/writers',
                'reviews/page/<page:\d+>' => 'site/reviews',
                'writers/id/<id:\d+>' => 'site/writers',
                'language/hl/<hl:\d+>' => 'site/language',
                'order/writer_id/<writer_id:\d+>' => 'site/order',

                'my-order/page/<page:\d+>' => 'user/my-order',
                'my-order/id/<id:\d+>' => 'user/my-order',
                'my-order-completed/<id:\d+>' => 'user/my-order-completed',
                'feedbacks/page/<page:\d+>' => 'user/feedbacks',
                
                'admin/all-post/id/<id:\d+>' => 'admin/all-post',
                //'admin/all-post/id/<id:\d+>' => 'admin/all-post',
                'admin/all-post/page/<page:\d+>' => 'admin/all-post',
                'admin/editor/id/<id:\d+>' => 'admin/editor',
                'admin/editor/page/<page:\d+>' => 'admin/editor',
                'admin/file-editor/file/<file:\d+>' => 'admin/file-editor',
                'admin/manage-user/page/<page:\d+>' => 'admin/manage-user',
                'admin/manage-user/id/<id:\d+>' => 'admin/manage-user',
                'admin/add-editor/id/<id:\d+>' => 'admin/add-editor',
                'admin/salary-editor/post_id/<id:\d+>' => 'admin/salary-editor',
                'admin/detail-salary-post/<id:\d+>' => 'admin/detail-salary-post',

                'manage-editor/request-post/page/<page:\d+>' => 'manage-editor/request-post',
                'manage-editor/view/token/<token:\d+>' => 'manage-editor/view',
                'manage-editor/accept/token/<token:\d+>' => 'manage-editor/accept',
                'manage-editor/manage-post/id/<id:\d+>' => 'manage-editor/manage-post',

                '<alias:index|about|contact|writing-service|review|order|step-form2|proofreading|math-science|copywriting|rewriting|editing|reviews|prices|discounts|writers|completed>' => 'site/<alias>',
                '<alias:register|login|request-password-reset|reset-password|verify-account>' => 'account/<alias>',
                '<alias:profile|manage-post|my-order|feedbacks|my-order-completed>' => 'user/<alias>',
                'admin/<alias:index|all-post|editor|info-editor|file-editor|all-editor|login|manage-user|salary-editor|detail-salary-post>' => 'admin/<alias>',
                '<alias:index>' => 'sample/<alias>',
                'manage-editor/<alias:index|login|File>' => 'manage-editor/<alias>',
            ],
        ],
        'NLGateway' => [
            'class' => 'yiiviet\payment\nganluong\PaymentGateway',
            'seamless' => FALSE, // Sử dụng phương thức thanh toán redirect về Ngân Lượng (FALSE) hoặc khách thanh toán trực tiếp trên trang của bạn không cần `redirect` (TRUE).
            'client' => [
                'email' => 'xuanthoiqn44@gmail.com',
                'merchantId' => '57305',
                'merchantPassword' => '6ff28bc99bfa603318cd71525cb72e53',
            ],
            'sandbox' => false
        ],
        'queue' => [
            'class' => yii\queue\file\Queue::className(),
            'strictJobType' => false,
            'serializer' => \yii\queue\serializers\JsonSerializer::class,
            'path' => '@runtime/queues',
            'as log' => \yii\queue\LogBehavior::className(),
            'ttr' => 5 * 60, // Max time for anything job handling 
            'attempts' => 3, // Max number of attempts
            // 'class' => \yii\queue\sync\Queue::className(),
            // 'handle' => true, // whether tasks should be executed immediately,
            /*'commandOptions' => [
                'isolate' => false,
            ],*/
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translation',
                    'fileMap' => [
                         'app' => 'app.php',
                    ],
                ],
            ],
         ],

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

