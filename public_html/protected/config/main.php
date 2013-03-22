<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Kruto.if.ua',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.vendors.*',
        'application.extensions.*',
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool

        'posts',

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123pass',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'clientScript'=>array(
            'scriptMap'=>array(
              //'jquery.ba-bbq.js' => false,
             //   'jquery.yiilistview.js' => false
                ),
            'enableJavaScript'=>true,    // Эта опция отключает любую генерацию javascript'а фреймворком
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'cache' => array(
            'class' => 'system.caching.CDbCache',
            'connectionID' => 'db',
        ),
        
        'dynamicRes' => array(
            'class' => 'application.extensions.DynamicRes.DynamicRes',
            'urlConfig' => array(// Its fix Css, and convert Url to RealName 
                'baseUrl' => '/', // Url of your Site (ending with /), modify it if you use subdomain
                'basePath' => dirname(__FILE__) . '/../../', // path of your site (ending with /) (No Change This)
            )
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'caseSensitive' => false,
            'rules' => array(
                'login' => 'site/login',
                'page/<view:>'=>'site/page',
                '/sitemap.xml' => 'site/sitemapxml',
                '/id<key:\d+>' => 'user/view/id',
                '/@<key:\w+>' => 'user/view/username',
                'user/id<key:\d+>' => 'user/view/id',
                'user/@<key:\w+>' => 'user/view/username',                         
                'music/graber(/p<page:\d+>)?' => 'music/graber',
                'music/ajax/<id:\d>' => 'music/ajax',
                'music/<style:\w+>/p<page:\d+>' => 'music/index',
                'music/p<page:\d+>' => 'music/index',
                
                'music/<id:\d+>/<track_alias>' => 'music/view',
                'music/<id:\d+>' => 'music/view',
                //'music/do/<action:\w+>/<id:\d+>' => 'music/<action>',
                //'music/do/<action:\w+>' => 'music/<action>',
                'music/<style:\w+>' => 'music/index',
                'posts/<q:[\w\/]+>' => 'posts/default/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',                             
                                
                
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=mysql.hostinger.com.ua;dbname=u569030126_site',
            'emulatePrepare' => true,
            'username' => 'u569030126_super',
            'password' => 'fb2584',
            'charset' => 'utf8',
            'schemaCachingDuration' => 1000,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'super@kruto.if.ua',
        'langArray' => array('ru', 'uk', 'en', ),
    ),
    'sourceLanguage' => 'en',
    'language' => 'ru',
    'charset' => 'utf-8',
);