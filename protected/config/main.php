<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    /*
      'controllerMap' => array(
      'api' => array(
      'class' => 'ext.json_api.JsonApiController',
      'modelName' => 'Post',
      ),
      ),
     */
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    //'runtimePath'=>"/home/ranvir/runtime",
    'name' => 'My Web Application',
    'language' => 'hi',
    // preloading 'log' component
    'theme' => 'abound',
    'preload' => array('log'),
    'defaultController' => 'site/',
    'aliases' => array(
        // yiistrap configuration
        'bootstrap' => realpath(__DIR__ . '/../extensions/yiistrap-bs3'), // change if necessary
        // yiiwheels configuration
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels-bs3'),
        //If you manually installed it
        'xupload' => realpath(__DIR__ . '/../extensions/xupload-0.5.1'),
        'basicupload' => realpath(__DIR__ . '/../extensions/basicJqueryUpload'),
        'RestfullYii' => realpath(__DIR__ . '/../extensions/RestfullYii'),
        //'rights'=>'auth.filters.AuthFilter',
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.widgets.*',
        'application.controllers.UtilityController',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.modules.Basedata.models.*',
        'application.modules.Basedata.components.*',
        
        'bootstrap.helpers.*',
        'bootstrap.widgets.*',
        'bootstrap.behaviors.*',
        'ext.AttachmentBehavior.AttachmentBehavior.*',
        'application.extensions.phpexcel.PHPExcel',
        'application.vendors.mpdf.*',
        'ext.yiireport.*',
        'ext.yii-select2.Select2',
    ),
    'modules' => array(
        'rights',
        'backup',
        'importModels',
        'Basedata',
        'rdp',
        'School' => array(
            'modules' => array('LearningLevel'),
        ),
        'user' => array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
        //Modules Rights
        'rights' => array(
            'superuserName' => 'Admin', // Name of the role with super user privileges. 
            'authenticatedName' => 'Authenticated', // Name of the authenticated user role. 
            'userIdColumn' => 'id', // Name of the user id column in the database. 
            'userNameColumn' => 'username', // Name of the user name column in the database. 
            'enableBizRule' => true, // Whether to enable authorization item business rules. 
            'enableBizRuleData' => true, // Whether to enable data for business rules. 
            'displayDescription' => false, // Whether to use item description instead of name. 
            'flashSuccessKey' => 'RightsSuccess', // Key to use for setting success flash messages. 
            'flashErrorKey' => 'RightsError', // Key to use for setting error flash messages. 
            'baseUrl' => '/rights', // Base URL for Rights. Change if module is nested. 
            'layout' => 'rights.views.layouts.main', // Layout to use for displaying Rights. 
            'appLayout' => 'application.views.layouts.main', // Application layout. 
            'cssFile' => 'rights.css', // Style sheet file to use for Rights. 
            'install' => false, // Whether to enable installer. 
            'debug' => false,
        ),
        // uncomment the following to enable the Gii tool
        
    ),
    // application components
    //'components'=>array(
    'components' => array(
        //...
        'SendSMS'=>array('class'=>'application.components.SendSMSComponent','sendsms'=>true),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                /* 'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                  'mode'              => '', //  This parameter specifies the mode of the new document.
                  'format'            => 'A4', // format A4, A5, ...
                  'default_font_size' => 0, // Sets the default document font size in points (pt)
                  'default_font'      => '', // Sets the default font-family for the new document.
                  'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                  'mgr'               => 15, // margin_right
                  'mgt'               => 16, // margin_top
                  'mgb'               => 16, // margin_bottom
                  'mgh'               => 9, // margin_header
                  'mgf'               => 9, // margin_footer
                  'orientation'       => 'P', // landscape or portrait orientation
                  ) */
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                /* 'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                  'orientation' => 'P', // landscape or portrait orientation
                  'format'      => 'A4', // format A4, A5, ...
                  'language'    => 'en', // language: fr, en, it ...
                  'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                  'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                  'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                  ) */
                )
            ),
        ),
        //...
        'messages' => array(
            'extensionPaths' => array(
                'AweCrud' => 'ext.AweCrud.messages', // AweCrud messages directory.
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'user' => array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            // 'absoluteAuthTimeout'=>3600,
            'loginUrl' => array('/user/login'),
           
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'authitem',
            'itemChildTable' => 'authitemchild',
            'assignmentTable' => 'authassignment',
            'rightsTable' => 'rights',
            'defaultRoles' => array('authenticated', 'guest'),
        ),
      
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            //http://www.yiiframework.com/wiki/214/url-hide-index-php/
            'showScriptName' => false,
            'rules' => require(dirname(__FILE__) . '/../extensions/RestfullYii/config/routes.php'),
        /*
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
         * */
        ),
        'clientScript'=>array(
                      'scriptMap'=>array(
                          'jquery.js'=>'/js/jquery-1.11.1.js',
                          'jquery.min.js'=>'/js/jquery-1.11.1.min.js',
                         // 'login.js'=>'site.min.js',
                      ),
                ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=mydb',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix' => '',
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
                    'levels' => 'error',
                ),
            
              array(
              'class'=>'CWebLogRoute',
              ),
             
            ),
        ),
        // yiistrap configuration
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        // yiiwheels configuration
        'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'filesAlias' => 'application.data.files',
    ),
);
