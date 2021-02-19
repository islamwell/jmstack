<?php
define('DS', DIRECTORY_SEPARATOR);
define ('SONG_DIR', "song");
define ('BANNER_DIR', "banner");
define ('CATEGORY_DIR', "category");
define ('ALBUM_DIR', "album");
define ('IMAGES_DIR', "images");
define ('UPLOADS_DIR', "upload");

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
//          This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'MP3 Online',
    // 'defaultController' => 'site/login',
    // preloading ?'log' component
    // 'theme'=>'blackboot',
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.EAjaxUpload.*',
		
		'application.extensions.*',
        'application.extensions.select2.*',
        'application.extensions.behaviors.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'fruity',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'widgetFactory'=>array(
            'widgets'=>array(
                'CGridView'=>array(
                    'cssFile' => 'no-file.css',
                ),
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'application.components.WebUser',
            'loginUrl'=>array('site/login'),
        ),
        'showScriptName' => false,
        // uncomment the following to enable URLs in path-format
         'urlManager'=>array(
             //'enablePrettyUrl' => true,
             'urlFormat'=>'path',
             //'showScriptName' => false,
             //'caseSensitive'=>false,
             'rules'=>array(
             '<controller:\w+>/<id:\d+>'=>'<controller>/view',
             '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
             '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
             ),
         ),

        /* 'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ), */


        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=172.31.0.29;dbname=nqappdb',
            'emulatePrepare' => true,
            'username' => 'nqappdbuser',
            'password' => 'CHANGEME',
            'charset' => 'utf8',
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
        'adminEmail' => 'webmaster@example.com',
    ),
);
