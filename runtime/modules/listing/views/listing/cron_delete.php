<?php
$date=date('Y-m-d');

$connection = Yii::app()->db;
$cronsql = $connection->createCommand("select * from `drg_user_listing` where `drg_listingstatus`='3'");
$cronresult = $cronsql->queryAll();

foreach($cronresult as $data )
{
$lid=$data['drg_lid'];
$deldate=$date['drg_deletedate'];
$dd="7 days";
$newtime = strtotime($deldate . ' + '.$dd);
$ddate = date('Y-m-d', $newtime);
if($ddate==$date)
{
$command = $connection->createCommand("select * from `drg_user` where `drg_uid`='$uid'");
$myresult = $command->queryRow();
$to=$myresult['drg_email'];
$template =  MailTemplate::getTemplate('Listing_deletion');
$subjectcc="Listing ".$model['drg_title']." has been deleted ";
$string = array(        '{{#LISTINGTITLE#}}'=>ucwords($data['drg_title']),
						'{{#USERNAME#}}'=>ucwords($myresult['drg_name'].' '.$myresult['drg_surname'])
						);
$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
$result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);

$query = "delete from `drg_user_listing` where `drg_lid`='$lid'";
$query->queryAll($query);

 
}
}
?>