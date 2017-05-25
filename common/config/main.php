<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
    	// 配置缓存
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        "authManager" => [        
        "class" => 'yii\rbac\DbManager',
        ],
        // 配置数据库
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 24*3600,
            'schemaCache' => 'cache',
        ],
    ],
     // 配置语言
    'language'=>'zh-CN',
    // 配置时区
    'timeZone'=>'Asia/Chongqing',
];
