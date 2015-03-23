<?php

$connection = Yii::app()->db;
$cronsql = $connection->createCommand("select * from `drg_user_listing` where `drg_listingstatus`='1' and drg_reporttime='day'");
$cronresult = $cronsql->queryAll();

foreach($cronresult as $data )
{

$lid=$data['drg_lid'];

$command1 = $connection->createCommand("select * from `drg_comments` where `listing_id`='$lid'");
$count_val2=count($command1);

$uid=$data['drg_uid'];
$command2 = $connection->createCommand("select * from `drg_banner_ads` where `drg_user_id`='$uid'");
$count_val22=count($command2);

$command = $connection->createCommand("select * from `drg_user` where `drg_uid`='$uid'");
$myresult = $command->queryRow();
$to=$myresult['drg_email'];


$command3 = $connection->createCommand("select * from `drg_like_comment` where `user_id`='$uid'");
$count_val33=count($command3);


$from1=date_create(date('Y-m-d'));
                            $to1=date_create($data['drg_approvedate']);
                            $diff=date_diff($to1,$from1);
                            $da = $diff->format('%R%a days');
							
				//$url = $_SERVER['HTTP_REFERER'];

$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."view?id=".$lid.'" target="_blank" >here >> </a>';
			

								$template =  MailTemplate::getTemplate('user_listing_report');
								$subjectcc=" Listing ".$data['drg_title']." daily update report ";

   $st="daily";
    $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($data['drg_title']),
                        '{{#USERNAME#}}'=>ucwords($myresult['drg_name'].' '.$myresult['drg_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($data['drg_date']),
						'{{#LISTINGSTATUS#}}'=>ucwords($data['drg_listingstatus']),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
						 '{{#DA#}}'=>ucwords($da),
                        '{{#PV#}}'=>ucwords($count_val2),
						'{{#VOTES#}}'=>ucwords($count_val33),
						'{{#COMMENTS#}}'=>ucwords($count_val2),
						'{{#MESSAGES#}}'=>ucwords($count_val22),
						'{{#STATUS#}}'=>ucwords($st)
						
                        
                    );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
								 
								                    
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body); 
					
					}
					
					?>