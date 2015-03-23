<?php
//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_NOTICE  ^ E_WARNING);
// change the following paths if necessary
$yii='../framework/yii.php';
$config='../runtime/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
