<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [ // RBAC权限控制
            'class' => 'yii\rbac\DbManager',
        ],
    ],
];
