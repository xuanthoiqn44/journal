<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','queue'],
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'scriptUrl' => 'http://journal.test/'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'error', 'warning'],
                    'logFile' => '@app/runtime/logs/journal.log',
                ],
            ],
        ],
        'db' => $db,
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
            'as log' => \yii\queue\LogBehavior::className(),
            'path' => '@runtime/queues',
            'strictJobType' => false,
            'serializer' => \yii\queue\serializers\JsonSerializer::class,
            'ttr' => 5 * 60, // Max time for anything job handling 
            'attempts' => 3, // Max number of attempts
            // 'class' => \yii\queue\sync\Queue::className(),
            // 'handle' => true, // whether tasks should be executed immediately,
            /*'commandOptions' => [
                'isolate' => false,
            ],*/
        ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
