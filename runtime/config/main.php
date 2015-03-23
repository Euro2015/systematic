<?php

define("APP_PATH",dirname(__FILE__));
define("IMG_LOGO_PATH",'/upload/logo/');
if($_SERVER['HTTP_HOST'] == "localhost"){
	$con_string = 'mysql:host=localhost;dbname=businessmarketdb';
	$user = 'root';
	$pass = '';
	$giiPass = '[c6"jjqF}:UaRn[';
}else{
	$con_string = 'mysql:host=localhost;dbname=businessmarketdb';
	$user = 'business01';
	$pass = 'Nb4jhwvgSczC3?M';
	$giiPass = '[c6"jjqF}:UaRn[';
}
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Business Supermarket',
	'theme'=>'business',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helper.SharedFunctions',
		'ext.YiiMailer.YiiMailer', 
		'application.helper.file_upload',
		'application.helper.Video.*',
        'application.helper.EDownloadHelper', 
        'application.helper.*',
        'application.extensions.easyPaypal.*',
		'application.extensions.currencyconverter.*',
		'application.components.EGMap.*',
	),

	'modules'=>array(
		'user',
        'banner',
		'business',
		'page',
        'listing', 
        'feedback',
        'Users',
		'businesslisting',
        'managefinancials',
		'admin'=>array("modules"=>array('listings','blisting','banner','slider')),
		// uncomment the following to enable the Gii tool
	   	'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>$giiPass,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','210.211.251.140'),
		),
	'forum'
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/'),
		),
		'fusioncharts' => array(
            'class' => 'application.modules.admin.extensions.fusioncharts.fusionCharts',
        ),
		
		// uncomment the following to enable URLs in path-format
		'swiftMailer' => array(
    'class' => 'ext.swiftMailer.SwiftMailer',
),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'baseUrl' => 'http://www.dragonsnet.co',
            'showScriptName'=>false,
            'caseSensitive'=>false, 
			'rules'=>array(
				//'' =>'front/site/index',
				'admin'=>'admin/login',
				'admin/logout'=>'admin/login/logout', 
            	'admin/<controller:\w+>'=>'admin/<controller>', 
                'admin/<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',
                
                /* Banner Rule*/
                //'admin/banner/<controller:\w+>'=>'admin/banner/<controller>/',
                'admin/banner/active'=>'admin/banner/<action>',  
                 
			    'banner/<action:\w+>'=>'banner/banner/<action>',
                'banner/<action:\w+>/listid/<listid:\d+>'=>'banner/banner/<action>',
                'banner/reject/<code:\d+>' =>'banner/banner/<action>',
                 
                 'admin/listings/<controller:\w+>'=>'admin/listings/<controller>/',
				 'admin/listings/<controller:\w+>/<action:\w+>'=>'admin/listings/<controller>/<action>', 
                 'admin/listings/<controller:\w+>/<action:\w+>/id/<id:\d+>'=>'admin/listings/<controller>/<action>',
                 'admin/listings/<controller:\w+>/<action:\w+>/page/<page:\d+>'=>'admin/listings/<controller>/<action>', 
				 'admin/listings/<controller:\w+>/<action:\w+>/rows/<rows:\d+>'=>'admin/listings/<controller>/<action>',  
                
                
                'admin/slider/<controller:\w+>'=>'admin/slider/<controller>/',
                'admin/slider/<controller:\w+>/<action:\w+>'=>'admin/slider/<controller>/<action>',  
                'admin/slider/<controller:\w+>/<action:\w+>/id/<id:\d+>'=>'admin/slider/<controller>/<action>', 
                'admin/slider/<controller:\w+>/<action:\w+>/page/<page:\d+>'=>'admin/slider/<controller>/<action>',                
                'admin/slider/<controller:\w+>/<action:\w+>/rows/<rows:\d+>'=>'admin/slider/<controller>/<action>', 
                
                
                
                'admin/blisting/<controller:\w+>/<action:\w+>/id/<id:\d+>'=>'admin/blisting/<controller>/<action>',                 
                'admin/blisting/<controller:\w+>/<action:\w+>/page/<page:\d+>'=>'admin/blisting/<controller>/<action>',
				'admin/blisting/<controller:\w+>/<action:\w+>/rows/<rows:\d+>'=>'admin/blisting/<controller>/<action>',
                'admin/blisting/<controller:\w+>/<action:\w+>'=>'admin/blisting/<controller>/<action>',
                'admin/blisting/<controller:\w+>'=>'admin/blisting/<controller>/',
                  
                 
                'listing/business-ideas'=>'listing/listing/business_ideas',
				'listing/science-and-technology'=>'listing/listing/science_and_technology',
				//'listing/business-services'=>'listing/listing/business_services',
				'listing/<action:\w+>'=>'listing/listing/<action>',
                'listing/<action:\w+>/listid/<listid:\d+>'=>'listing/listing/<action>',
                
                'businesslisting/business-services'=>'businesslisting/businesslisting/business_services',
                 
                 
                'businesslisting/<action:\w+>'=>'businesslisting/businesslisting/<action>',                
                'businesslisting/<action:\w+>/blistid/<blistid:\d+>'=>'businesslisting/businesslisting/<action>',  
                
                // Module forum urls
		'forum' =>'forum/forum',
                'forum/downloadAttachement/<commentId:\d+>'=>'forum/forum/downloadAttachement',
                'forum/<controller:\w+>'=>'forum/<controller>',
                'forum/<controller:\w+>/<action:\w+>' =>'forum/<controller>/<action>',
                  
				'page/<slug:[\w\-]+>'=>'page/page/index/slug/<slug>',
				'user' =>'user/user',								
				'video_tutorials' =>'site/video_tutorials',
				'confirm_identity/id/<id:\d+>' =>'site/confirm_identity',				
				'login' =>'site/login',
				'logout' =>'site/logout',
				'forget' =>'site/forget',
				'user/<controller:\w+>'=>'user/<controller>',
				'user/<controller:\w+>/<action:\w+>' =>'user/<controller>/<action>',
				'business/<controller:\w+>'=>'business/<controller>',
				'business/<controller:\w+>/<action:\w+>' =>'business/<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>', 
                'admin/blisting/blisting/downloadvideo'=>'admin/blisting/blisting/downloadvideo',                
                //'<controller:\w+>/<action:\w+>/<city:\w+>/*'=>'<controller>/<action>',     
			),
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => $con_string,
			'emulatePrepare' => true,
			'username' => $user,
			'password' => $pass,
			'charset' => 'utf8',
			'tablePrefix' => 'drg_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'/site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
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
	'params'=>array(
                // this is used in contact page
                'adminEmail'=>'support@business-supermarket.com',
                'domain'=>'business-supermarket.com',
                'signature'=>'Sincerely,{{BR}}Business Supermarket Accounts Team',
                'company_name'=>'Business Supermarket',
                'noreply_email'=>'no-reply@business-supermarket.com',
                'company_email'=>'support@business-supermarket.com', 
                'company_account_email'=>'accounts@business-supermarket.com',
                'company_cc_mail' =>'dsp7@blueyonder.co.uk',

                'valid_image'=>array("jpg,png,jpeg,gif"),
                'valid_doc'=>array("doc,docx,pdf"),
                'valid_video'=>array("mp4,flv,wmv"),
                'PAYPAL_API_USERNAME'=>'sm004b6095_api1.blueyonder.co.uk',

                'PAYPAL_API_PASSWORD'=>'J5M8ERDGANWWRNJF',

                'PAYPAL_API_SIGNATURE'=>'AqrGSLLg.RM1.zYa3DPLLAPI8zD1AJ4KELcC6UpxtkAEZ5tCogqYmGIO',

                'PAYPAL_MODE'=>'live'   // sandbox/live  default=sandbox
	),
);
