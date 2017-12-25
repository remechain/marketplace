<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ''
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => False,
        ],
        'urlManager' => [

            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/1' => 'site/index',
                'metals' => 'site/metals',
                'for-business' => 'site/for-business',
                'for-scrapper' => 'site/for-scrapper',
                'blog1' => 'site/blog',
                'blog-detail' => 'site/blog-detail',
                'metals-detail' => 'site/metals-detail',

                'request' => 'request/index',
                'request-active' => 'request/requests-active-pjax',
                'request-finished' => 'request/requests-finished-pjax',
                'setting-user' => 'standart-user-account/standart-user-account-setting',

                'request-business' => 'request-business/index',
                'requests-incoming' => 'request-business/requests-business-incoming-pjax',
                'requests-booked' => 'request-business/requests-business-booked-pjax',
                'requests-renounced' => 'request-business/requests-business-renounced-pjax',
                'requests-completed' => 'request-business/requests-business-completed-pjax',

                'company' => 'company/index',
                'company-create' => 'company/create',

                'object-create' => 'object/create'
            ],
        ],

    ],
    'params' => $params,
];
