<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')

);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
        'class' => 'backend\modules\v1\Api',
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/cerulean/default'],
                'baseUrl' => '@web/themes/default',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\UserIdentity',
            'enableAutoLogin' => true,
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
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName'  => false,
            'class'=>'backend\components\LangUrlManager',
            'rules'  => \backend\modules\v1\Api::$urlRules,
        ],
        'languageId' => [
            'class'=>'backend\components\LanguageId'
        ],
        'request' => [
            'class' => 'backend\components\LangRequest'
        ],
    ],
    'params' => $params,
];
