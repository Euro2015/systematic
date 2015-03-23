<?php

class BlistingController extends Controller
{
	
	 public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index,update,create,delete,rdelete,publish,rejection,suspension,restore,downloadvideo'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionCreate()
	{
		$model = new Blisting;
		if(isset($_POST['Blisting']))
		{
			$model->attributes = $_POST['Blisting'];
			if($model->save())
			{
				$this->redirect(array('view', 'id'=>$model->drg_blid));	
			}
		}	
	}
	
	public function actionIndex()
	{
		//$this->render('index');
         $model = new Blisting('search');
        $criteria = new CDbCriteria;

        if (isset($_POST['username']) && $_POST['username'] != "") {

            $Data = User::model()->findAll("drg_username like '%" . addslashes($_POST['username']) .
                "%'");
            //print_r($Data);
            if ($Data) {

                foreach ($Data as $rsData) {

                    $ids = $rsData->drg_uid . ',';

                }

                $ids1 = rtrim($ids, ',');

                $criteria->addInCondition('drg_uid', array($ids1));
            }
        }
        if (isset($_POST['drg_categorys']) && $_POST['drg_categorys'] != "") {

            // echo   $_POST['drg_categorys'];
            $criteria->compare('drg_category', addslashes($_POST['drg_categorys']), true);

        }


        if (isset($_POST['drg_profession']) && $_POST['drg_profession'] != "") {

            $criteria->compare('drg_profession', addslashes($_POST['drg_profession']), true);
        }


        if (isset($_POST['drg_viewlimit']) && $_POST['drg_viewlimit'] != "") {

            $criteria->compare('drg_viewlimit', addslashes($_POST['drg_viewlimit']), true);
        }


        if (isset($_POST['drg_slogon']) && $_POST['drg_slogon'] != "") {
            $criteria->compare('drg_slogon', addslashes($_POST['drg_slogon']), true);

        }


        if (isset($_POST['Keyword']) && $_POST['Keyword'] != "") {
            $criteria->compare('drg_keyword', addslashes($_POST['Keyword']), true);

        }

        $criteria->order = 'drg_blid desc';

        $total = Blisting::model()->count($criteria);

        if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 5;
        }


        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria); // the trick is here!
        $posts = Blisting::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'list' => $posts,
            'pages' => $pages,
            'item_count' => $total,
            'page_size' => Yii::app()->params['listPerPage'],

            ));
	}
	
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		if(isset($_POST['Blisting']))
		{
			$model->attributes=$_POST['Blisting'];
			$vid11=$_POST['Blisting']['drg_video1'];
			if($vid11!="")
			{
			$model->drg_video1=$vid11;
			}
			$vid22=$_POST['Blisting']['drg_video2'];
			if($vid22!="")
			{
			$model->drg_video2=$vid22;
			}
		if($model->save())
		{
			
				if($_POST['update'])
				{
				
				$vid1=$_POST['Blisting']['drg_video1'];
			$cvid1=$_POST['drg_vid_1'];
$tvid1=str_replace('flv','mp4',$cvid1);
			$vid2=$_POST['Blisting']['drg_video2'];
			$cvid2=$_POST['drg_vid_2'];
$tvid2=str_replace('flv','mp4',$cvid2);
			$lid=$model->drg_blid;
			$command = Yii::app()->db->createCommand();

$ppath2=$model->drg_uid;
$connection = Yii::app()->db;
$command = $connection->createCommand("select * from `drg_user` where `drg_uid`='$ppath2'");
$myresult = $command->queryRow();
$ppath3=$myresult['drg_id'];
$ppath1=$myresult['drg_username'];
$upath=$ppath1."_".$ppath3;
$path =  $_SERVER['DOCUMENT_ROOT'].'/'; 
$temp_dir=$path."temp/";
$cvidpath1= $path."upload/users/".$upath."/videos/".$cvid1;
$cvidpath2= $path."upload/users/".$upath."/videos/".$cvid2;  
$tvidpath1=$path."temp/".$tvid1;
$tvidpath2=$path."temp/".$tvid2;  
if($vid1!="")
{
unlink($cvidpath1);
unlink($tvidpath1);
}
if($vid2!="")
{
unlink($cvidpath2);
unlink($tvidpath2);
}


					$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
					$to = $user_details[0]['drg_email'];
					$subject = "User listing update notification";
					//$url = $_SERVER['HTTP_REFERER'];
					$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."listing"."/"."fupdate"."/blistid/".$model->drg_blid;
					$message = "
							   <table style='font-size:14px; font-family:arial;'>
								<tr><td style='padding-bottom:10px;'>Dear ".$user_details[0]['drg_name']."</td></tr>
								<tr><td style='padding-bottom:10px;'>Your listing was modified to conform with our terms and conditions. Details of the modification / changes are give below:-</td></tr>
								<td style='padding-bottom:10px;'>Listing title:&nbsp;".$model['drg_slogon']."<br/>
									What is it:&nbsp;".$model['drg_slogon']."<br/>
									
								</td></tr>
								<tr><td style='padding-bottom:10px;'>You may view your listing &nbsp;&nbsp;<a href=".$yii_user_request_id.">here>></a></td></tr>
								<tr><td style='padding-bottom:10px;'>If the link does not work then please copy and paste the link below into your browser</td></tr>
								<tr><td style='padding-bottom:10px;'>".$yii_user_request_id."</td></tr>
								<tr><td style='padding-bottom:10px;'>If you do not agree with the changes then please contact listingsupportteam@business-supemarket.com to help resolve this matter</td></tr>
								<tr><td style='padding-bottom:10px;'>Sincerely<br/>
								Business Supermarket Listing Submission Team</td></tr>
								<tr><td style='padding-bottom:10px;'>Note: <span style='font-size:12px;'>This email address cannot accept replies.</span><br/>
								<i style='font-size:12px;'>Should you wish to contact us, then you may do so via the support@business-supermarket.com</i></td></tr>
								
							   </table>
								
								";
								$headers = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
								
								$headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
								mail($to,$subject,$message,$headers);
								
				}
			Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
            //$this->redirect(array('index'));
            $this->redirect(Yii::app()->createUrl('admin/blisting/blisting'));
		}
		
		}
		$this->render('update', array('model' => $model, ));
	}
	
	public function loadModel($id)
	{
		$model = Blisting::model()->findByPk($id);
		if($model=== null)
		
			throw new CHttpException(404, 'The requested page does not exist.');
       		return $model;	
				
	}
	
	public function actionDelete($id)
	{ 
		$this->loadModel($id)->delete();  
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	
	public function actionRdelete($id)
	{
		$model = $this->loadModel($id);
		
		
		if(isset($model))
		{
			$model->drg_blistingstatus = 3;
			$model->drg_bdeletedate = date('Y-m-d H:i:s');
			if($model->save()){ 
			
			if($_POST['delete'])
			{
			
			$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
			$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."businesslisting"."/"."rdelete"."/blistid/".$model->drg_blid;
			$to = $user_details[0]['drg_email'];
			$subject = "User listing deletion notification";
			$message = "
						  <table style='font-size:14px; font-family:arial;'>
						   	<tr><td style='padding-bottom:10px;'>Dear ".$user_details[0]['drg_name']."</td></tr>
							<tr><td style='padding-bottom:10px;'>Your listing has been marked for deletion for the following reason.</td></tr>
							<tr><td style='padding-bottom:10px;'>&nbsp;".$_POST['deletionval']."<br/></td></tr>
							<tr><td style='padding-bottom:10px;'>If you wish to re-activate your listing for a further 7 days then please <a href='".$yii_user_request_id."'>Click here >></a></td></tr>
							<tr><td style='padding-bottom:10px;'>If the link does not work then please copy and paste the link below into your browser</td></tr>
							<tr><td style='padding-bottom:10px;'>".$yii_user_request_id."</td></tr>
							<tr><td style='padding-bottom:10px;'>Your listing will be re-activated for 7 days during which time you may download your listing or generate interest to remove it from <br/>the deletion list. <a href='".$yii_user_request_id."'>To find out more click here>></td></p></tr>
							<tr><p>Please note after 7 days your listing will be deleted off our servers. YOU CANNOT RENEW THIS PERIOD.</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Listing Submission Team</p></tr>
							<tr><td style='padding-bottom:10px;'>Note: <span style='font-size:12px;'>This email address cannot accept replies.</span><br/>
							<i style='font-size:12px;'>Should you wish to contact us, then you may do so via the support@business-supermarket.com</i></td></tr>
							
						   </table>
							
							";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							
                            $headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							mail($to,$subject,$message,$headers);          	    
			}
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
				
		}
	}

	public function actionPublish($id)
	{
		 	$model=$this->loadModel($id);
		 	$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
			$to = $user_details[0]['drg_email'];		           			   $statuss=$model['drg_status'];if($statuss=="0"){$stat ="Waiting admin approval and publication";}else if($statuss=="1"){$stat ="Published";}else if($statuss=="2"){$stat ="Suspended";}else if($statuss=="3"){$stat ="Deleted";}else if($statuss=="4"){$stat ="Restored";}else if($statuss=="4"){$stat ="Permenant Deleted";}			   		$template =  MailTemplate::getTemplate('blisting_publication'); $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."businesslisting/fupdate/blistid/".$model->drg_blid.'" target="_blank" >here >> </a>';			  $ltitle="<font color='orange'><i>".$model_user['co_title']."</i></font>";	   		        $ldate="<font color='orange'><i>".$model['drg_datetime']."</i></font>";			        $lstatus="<font color='#15c'><i>".$stat."</i></font>";    $string = array(                        '{{#LISTINGTITLE#}}'=>ucwords($ltitle),                       '{{#USERNAME#}}'=>ucwords($model_user['drg_name'].' '.$model_user['drg_surname']),                        '{{#LISTINGDATE#}}'=>ucwords($ldate),						'{{#LISTINGSTATUS#}}'=>ucwords($lstatus),						'{{#LINK#}}'=>ucwords($yii_user_request_id)                    );										$subject="Your Business listing ".$model_user['co_title']." has now been published";										             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);                                        $result =  SharedFunctions::app()->sendmail($to,$subject,$body); 					
		
		if(isset($model))
		{
			$model->drg_blistingstatus = 1;
			$model->drg_datetime = date('Y-m-d');
			if($model->save()){           	    
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
		}
	}
	
	public function actionRejection($id)
	{
		$model = $this->loadModel($id);	
		
		
		if($_POST['rejection'])
		{
			$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
			$to = $user_details[0]['drg_email'];
			
			$subject = "User listing rejection notification";
			$controller = Yii::app()->controller->action->id; 
			$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."businesslisting"."/"."rejection"."/blistid/".$model->drg_blid;
			
			 $message = "
						   <table style='font-size:14px; font-family:arial;'>
						   	<tr><td style='padding-bottom:10px;'>Dear ".$user_details[0]['drg_name']."</td></tr>
							<tr><td style='padding-bottom:10px;'>Your listing has been rejected for the following reason.</td></tr>
							<tr><td style='padding-bottom:10px;'>".$_POST['rejectval']."<br/>
								</td></tr>
							<tr><td style='padding-bottom:10px;'>Please access your account and make the requested alterations&nbsp;&nbsp;<a href='".$yii_user_request_id."'>here>></a></td></tr>
							<tr><td style='padding-bottom:10px;'>If the link does not work then please copy and paste the link below into your browser</td></tr>
							<tr><td style='padding-bottom:10px;'><a href='".$yii_user_request_id."'>".$yii_user_request_id."</a></td></tr>
							<tr><td style='padding-bottom:10px;'>If you do not agree with the changes then please contact listingsupportteam@business-supemarket.com to help resolve this matter</td></tr>
							<tr><td style='padding-bottom:10px;'>Sincerely<br/>
							Business Supermarket Listing Submission Team</td></tr>
							<tr><td style='padding-bottom:10px;'>Note: <span style='font-size:12px;'>This email address cannot accept replies.</span><br/>
							<i style='font-size:12px;'>Should you wish to contact us, then you may do so via the support@business-supermarket.com</i></td></tr>
							
						   </table>
							
							";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							
                            $headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							mail($to,$subject,$message,$headers);
							
		}
		if(isset($model))
		{
			$model->drg_breject_list =1;
			
			if($model->save()){           	    
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
		}
	}
	
	public function actionSuspension($id)
	{
		
		 $model=$this->loadModel($id);
		 
		if($_POST['suspension'])
		{			
				
			$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
			$to = $user_details[0]['drg_email'];
			$subject = "User listing suspension notification";
			$controller = Yii::app()->controller->action->id; 
		 	
			$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."businesslisting"."/"."suspensed"."/blistid/".$model->drg_blid;
			
			
			 $message = "
						   <table style='font-size:14px; font-family:arial;'>
						   	<tr><td style='padding-bottom:10px;'>Dear ".$user_details[0]['drg_name']."</td></tr>
							<tr><td style='padding-bottom:10px;'>Your listing  ".$_POST['listing_title']." was suspended. Details of the suspension are give below:-</td></tr>
							<tr><td style='padding-bottom:10px;'>".$_POST['suspensionval']."<br/></td></tr>
							<tr><td style='padding-bottom:10px;'>The listing has been moved to manage my listings under 'Listing waiting for publication' where you may update and or make
the relevant changes and re-submit the listing for publication. You may access the listing  <a href='".$yii_user_request_id."'>here >></a>. </td><br/></tr>
							<tr><td style='padding-bottom:10px;'>If the link does not work then please copy and paste the link below into your browser</td></tr>
							<tr><td style='padding-bottom:10px;'><a herf='".$yii_user_request_id."'>".$yii_user_request_id."</a></td></tr>
							<tr><td style='padding-bottom:10px;'>If you do not agree with the changes then please contact listingsupportteam@business-supemarket.com to help resolve this matter</p></tr>
							<tr><td style='padding-bottom:10px;'>Sincerely<br/>
							Business Supermarket Listing Submission Team</td></tr>
							<tr><td style='padding-bottom:10px;'>Note: <span style='font-size:12px;'>This email address cannot accept replies.</span><br/>
							<i style='font-size:12px;'>Should you wish to contact us, then you may do so via the support@business-supermarket.com</i></td></tr>
							
						   </table>
							
							";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							
                            $headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							mail($to,$subject,$message,$headers);
						
		}
		
		if(isset($model))
		{
			$model->drg_blistingstatus =0;
			$model->drg_bapprovedate = date('Y-m-d');
			if($model->save()){           	    
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
		}
		
	}
	
	public function actionRestore($id)
	{
		$model = $this->loadModel($id);
		if(isset($model))
		{
			$model->drg_blistingstatus = 4;
			if($model->save()){           	    
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
		}	
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
public function actionDownloadvideo(){
   
    $filename = Yii::app()->request->getParam('file');
     
    $fileData = Businesslistingvideos::model()->find("drg_listing_video= '".$filename."'");      
    
    $BlistingData =  Blisting::model()->find("drg_blid= '".$fileData->drg_blid."'");     
   
    $userData = User::model()->find("drg_uid = '" .$BlistingData->drg_uid."'");  
     
   // @EDownloadHelper::download(Yii::getPathOfAlias('webroot.upload.'.$userData->drg_username.'_'.$userData->drg_id).DIRECTORY_SEPARATOR.$filename);
   @EDownloadHelper::download(Yii::getPathOfAlias('webroot.upload.users.'.$userData->drg_username.'_'.$userData->drg_id).'/videos/'.$filename);
    return;
}

}