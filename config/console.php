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
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
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
            //'class' => \yii\queue\sync\Queue::className(),
            //'handle' => true, // whether tasks should be executed immediately,
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
