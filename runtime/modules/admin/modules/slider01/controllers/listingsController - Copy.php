<?php

class listingsController extends Controller
{
	
	
	public function actionCreate()
	{
		$model=new Listings;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Listings']))
		{
			$model->attributes=$_POST['Listings'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
				$this->redirect(array('view','id'=>$model->drg_lid));
			}
		}

		$this->render('create',array('model'=>$model,));
	}
	
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);
		if(isset($_POST['Listings']))
		{
			$data = $_REQUEST['drg_fprojections1'].",".$_REQUEST['drg_fprojections2'].",".$_REQUEST['drg_fprojections3'].",".$_REQUEST['drg_fprojections4'].",".$_REQUEST['drg_fprojections5'].",".$_REQUEST['drg_fprojections6'];
			$model->drg_financial_data=$_REQUEST['drg_financial_data'];
			$model->drg_famount = $_REQUEST['drg_famount'];
			$model->drg_reporttime = $_REQUEST['drg_reporttime'];
			$model->drg_fprojections=$data;
			$model->attributes=$_POST['Listings'];  
			
			if($model->save())
			{
			
			if($_POST['update'])
			{
				$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
				$to = $user_details[0]['drg_email'];
				$subject = "User listing update notification";
				//$url = $_SERVER['HTTP_REFERER'];
				$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."listing"."/"."fupdate"."/listid/".$model->drg_lid;
				$message = "
						   <table>
						   	<tr><p>Dear ".$user_details[0]['drg_name']."</p></tr>
							<tr><p>Your listing was modified to conform with our terms and conditions. Details of the modification / changes are give below:-</p></tr>
							<tr><p>Listing title:&nbsp;".$model['drg_title']."<br/>
								What is it:&nbsp;".$model['drg_desc']."<br/>
								short explanation:&nbsp;".$model['drg_explanation']."<br/>
								What do you want:&nbsp;".$model['drg_want']."<br/>
								Keyword:&nbsp;".$model['drg_keyword']."<br/>
								Marketing:&nbsp;".$model['drg_mktquestion']."<br/>
							</p></tr>
							<tr><p>You may view your listing &nbsp;&nbsp;<a href=".$yii_user_request_id.">here>></a></p></tr>
							<tr><p>If the link does not work then please copy and paste the link below into your browser</p></tr>
							<tr><p>".$yii_user_request_id."</p></tr>
							<tr><p>If you do not agree with the changes then please contact listingsupportteam@business-supemarket.com to help resolve
this matter</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Listing Submission Team</p></tr>
							<tr><p>Note: This email address cannot accept replies.<br/>
							Should you wish to contact us, then you may do so via the support@business-supermarket.com</p></tr>
							
						   </table>
							
							";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							$headers .= 'From: <pavan@artifex-online.com>' . "\r\n";
							//$headers .= 'Cc: testdemo356@gmail.com' . "\r\n";
                            $headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							mail($to,$subject,$message,$headers);
			}
				Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
			    $this->redirect(array('index'));
			}	
		}
		
		
		
		$this->render('update',array(
			'model'=>$model,
		));
	}	
	
	public function loadModel($id)
	{
		$model=Listings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
	public function actionIndex()
	{
		$model=new Listings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_REQUEST['Listings']))
			$model->attributes=$_REQUEST['Listings'];

		$this->render('index',array(
			'model'=>$model,
		));
		
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
			$model->drg_listingstatus = 3;
			
			if($model->save()){ 
			
			if($_POST['delete'])
			{
			
			$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
			$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."listing"."/"."rdelete"."/listid/".$model->drg_lid;
			$to = $user_details[0]['drg_email'];
			$subject = "User listing deletion notification";
			
			 $message = "
						   <table>
						   	<tr><p>Dear ".$user_details[0]['drg_name']."</p></tr>
							<tr><p>Your listing has been marked for deletion for the following reason.</p></tr>
							<tr><p>&nbsp;".$_POST['deletionval']."<br/></p></tr>
							<tr><p>If you wish to re-activate your listing for a further 7 days then please <a href='".$yii_user_request_id."'>Click here >></a></p></tr>
							<tr><p>If the link does not work then please copy and paste the link below into your browser</p></tr>
							<tr><p>".$yii_user_request_id."</p></tr>
							<tr><p>Your listing will be re-activated for 7 days during which time you may download your listing or generate interest to remove it from <br/>the deletion list. <a href='#'>To find out more click here>></a></p></tr>
							<tr><p>Please note after 7 days your listing will be deleted off our servers. YOU CANNOT RENEW THIS PERIOD.</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Listing Submission Team</p></tr>
							<tr><p>Note: This email address cannot accept replies.<br/>
							Should you wish to contact us, then you may do so via the support@business-supermarket.com</p></tr>
							
						   </table>
							
							";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							$headers .= 'From: <pavan@artifex-online.com>' . "\r\n";
							//$headers .= 'Cc: testdemo356@gmail.com' . "\r\n";
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
			$to = $user_details[0]['drg_email'];
			$subject = "Your listing has now been published.";
			$controller = Yii::app()->controller->action->id; 
			$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."listing"."/"."publish"."/listid/".$model->drg_lid;
			
			$message = "
						   <table>
						   	<tr><p>Your listing has now been published.</p></tr>
							<tr><p>Your listing  ".$model['drg_title']." <br/>
							Date of submission: ".$model['drg_date']."<br/>
							Status:".$model['drg_status']."
							</p></tr>
							<tr><p>".$_POST['suspensionval']."<br/>
								
								
								</p></tr>
							<tr><p>Please access your account and market your listing using your marketing tools.
Not sure how to do this? Then watch a short video <a href='".$yii_user_request_id."'>here >></a>. </p><br/></tr>
							<tr><p>If the link does not work then please copy and paste the link below into your browser</p></tr>
							<tr><p><a href=".$yii_user_request_id.">".$yii_user_request_id."</a></p></tr>
							<tr><p>If you do not agree with the changes then please contact listingsupportteam@business-supemarket.com to help resolve
this matter</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Listing Submission Team</p></tr>
							<tr><p>Note: This email address cannot accept replies.<br/>
							Should you wish to contact us, then you may do so via the support@business-supermarket.com</p></tr>
							
						   </table>
							
							";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							$headers .= 'From: <pavan@artifex-online.com>' . "\r\n";
							//$headers .= 'Cc: testdemo356@gmail.com' . "\r\n";
                            $headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							mail($to,$subject,$message,$headers);
		
		if(isset($model))
		{
			$model->drg_listingstatus = 1;
			$model->drg_approvedate = date('Y-m-d');
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
			$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."listing"."/"."rejection"."/listid/".$model->drg_lid;
			
			 $message = "
						   <table>
						   	<tr><p>Dear ".$user_details[0]['drg_name']."</p></tr>
							<tr><p>Your listing has been rejected for the following reason.</p></tr>
							<tr><p>".$_POST['rejectval']."<br/>
								</p></tr>
							<tr><p>Please access your account and make the requested alterations&nbsp;&nbsp;<a href='".$yii_user_request_id."'>here>></a></p></tr>
							<tr><p>If the link does not work then please copy and paste the link below into your browser</p></tr>
							<tr><p><a href='".$yii_user_request_id."'>".$yii_user_request_id."</a></p></tr>
							<tr><p>If you do not agree with the changes then please contact listingsupportteam@business-supemarket.com to help resolve
this matter</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Listing Submission Team</p></tr>
							<tr><p>Note: This email address cannot accept replies.<br/>
							Should you wish to contact us, then you may do so via the support@business-supermarket.com</p></tr>
							
						   </table>
							
							";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							$headers .= 'From: <pavan@artifex-online.com>' . "\r\n";
							//$headers .= 'Cc: testdemo356@gmail.com' . "\r\n";
                            $headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							mail($to,$subject,$message,$headers);
							
		}
		if(isset($model))
		{
			$model->reject_list =1;
			
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
		 	
			$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."listing"."/"."suspensed"."/listid/".$model->drg_lid;
			
			
			 $message = "
						   <table>
						   	<tr><p>Dear ".$user_details[0]['drg_name']."</p></tr>
							<tr><p>Your listing  ".$_POST['listing_title']." was suspended. Details of the suspension are give below:-</p></tr>
							<tr><p>".$_POST['suspensionval']."<br/>
								
								
								</p></tr>
							<tr><p>The listing has been moved to manage my listings under 'Listing waiting for publication' where you may update and or make
the relevant changes and re-submit the listing for publication. You may access the listing  <a href='".$yii_user_request_id."'>here >></a>. </p><br/></tr>
							<tr><p>If the link does not work then please copy and paste the link below into your browser</p></tr>
							<tr><p><a herf='".$yii_user_request_id."'>".$yii_user_request_id."</a></p></tr>
							<tr><p>If you do not agree with the changes then please contact listingsupportteam@business-supemarket.com to help resolve
this matter</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Listing Submission Team</p></tr>
							<tr><p>Note: This email address cannot accept replies.<br/>
							Should you wish to contact us, then you may do so via the support@business-supermarket.com</p></tr>
							
						   </table>
							
							";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							$headers .= 'From: <pavan@artifex-online.com>' . "\r\n";
							//$headers .= 'Cc: testdemo356@gmail.com' . "\r\n";
                            $headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							mail($to,$subject,$message,$headers);
						
		}
		
		if(isset($model))
		{
			$model->drg_listingstatus =0;
			$model->drg_approvedate = date('Y-m-d');
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
			$model->drg_listingstatus = 4;
			if($model->save()){           	    
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
		}	
	}
	
public function userToString()
{
    $targets = $this->drg_user;
	
		
    if ($targets) 
        {
        $string = '';
        foreach($targets as $target) {
            $string .= $targets->drg_name . ', ';
        }
        return substr($string,0,strlen($string)-1);
    }
    return null;
}

public function actionDownloadvideo(){
    
    $filename = Yii::app()->request->getParam('file');
     
    $fileData = Userlistingvideos::model()->find("drg_listing_video= '".$filename."'");  
   
    $ListingData =  Listings::model()->find("drg_lid= '".$fileData->drg_lid."'");     
   
    $userData = User::model()->find("drg_uid = '" .$ListingData->drg_uid."'"); 
   
    @EDownloadHelper::download(Yii::getPathOfAlias('webroot.upload.'.$userData->drg_username.'_'.$userData->drg_id).DIRECTORY_SEPARATOR.$filename);
    return;
}	
	
}