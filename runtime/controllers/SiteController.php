<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.	 
	 */	 
        public function actionVideo_tutorials()	
		
	 {	
	 
             $this->pageTitle='Video Tutorials - Business Supermarket';
			 
             $this->render('video_tutorials',array('model' =>$model));
			 
	 }		

 public function actionConfirm_identity()
 
	 {
	 
	 $id = Yii::app()->request->getParam('id');  
	 
	 if($id!="")
	 {
	 
	 $connection = Yii::app()->db;
	 
	 $command = $connection->createCommand("select * from `drg_user` where `drg_id`='$id'");

	 $myresult = $command->queryRow();

	 $dd=$myresult['drg_status'];
	 
	 if($dd=="n")
	 
	 {
	 
	         $this->pageTitle='Confirm Your Identity - Business Supermarket';
			 
             $this->render('confirm_identity',array('model' =>$model));
			 
	 }	

     else
	 
	 {
	 
	 $this->redirect(array('index'));	 
	 
	 }	
			 
     }
	 
	 else
	 {
	 
	 $this->redirect(array('index'));	 
	 
	 }
			 
	 }
	 
	  public function actionFileupload()
	 {
	     
        Yii::import("ext.EAjaxUpload.qqFileUploader"); 
         
        $big = 'upload/attachments/';       
        
        $allowedExtensions = array("jpg",'png','pdf','doc');//array("jpg","jpeg","gif","exe","mov" and etc...
        
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        
        $uploader = new qqFileUploader($allowedExtensions);
                       
        $result = $uploader->handleUpload($big);
        
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize = filesize($big.$result['filename']);//GETTING FILE SIZE
        
        $fileName = $result['filename'];//GETTING FILE NAME   
                
        echo $return;// it's array
	 }
	 
	   public function actionDelete_file()
	   
	 {
	      $filename = $_POST['attachment'];
		  
		  $path =  $_SERVER['DOCUMENT_ROOT'].'/';
		  
          $cvidpath1= $path."upload/attachments/".$filename;
		  
          unlink($cvidpath1);
		  
		  echo 'success';
	 }

	 
	/* public function actionContact()
	   
	 {
	 
	 if(isset($_POST['contactus']))
	 
	 {

	     $fname = $_POST['attachment'];
		 
         $ffname=$_SERVER['DOCUMENT_ROOT']."/upload/attachments/".$fname;
  
	     $dept_email=$_POST['dept_email'];
		 
		 $uemail=$_POST['email'];
		 
		 $template =  MailTemplate::getTemplate('contact_us_admin');

   	     $string = array(
                        '{{#USERNAME#}}'=>ucwords($_POST['username']),
						'{{#EMAIL#}}'=>ucwords($_POST['email']),
                        '{{#SUBJECT#}}'=>ucwords($_POST['subject']),
						'{{#MSG#}}'=>ucwords($_POST['msg']),
                    );
					
		 $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
         $result =  SharedFunctions::app()->sendmail($dept_email,$template->template_subject,$body,$ffname); 
					
		 if($_POST['memail']=="yes")
         
		 {
					
		  $template1 =  MailTemplate::getTemplate('contact_us_user');
					 
		  $body1 = SharedFunctions::app()->mailStringReplace($template1->template_body,$string);
                    
          $result1 =  SharedFunctions::app()->sendmail($uemail,$template->template_subject,$body1,$ffname); 
			
		}
      
	     $this->render('success',array('model'=>$uemail));
	 
	 //$this->redirect(array('index'));
	 }
	 
	 else
	 
	 {
	 
	 
		 $this->render('contactus',array('model'=>$uemail));
		 
     }

	 } */
	 
	   public function actionIdentity_process()
	   
	 {

	     $fname = $_POST['attachment'];
		 
         $ffname=$_SERVER['DOCUMENT_ROOT']."/upload/attachments/".$fname;
  
	     $dept_email=Yii::app()->params['company_email'];
		 
		 $uemail=$_POST['email'];
		 
		 $template =  MailTemplate::getTemplate('user_identity_admin');

   	     $string = array(
                        '{{#USERNAME#}}'=>ucwords($_POST['username']),
						'{{#EMAIL#}}'=>ucwords($_POST['email']),
                        '{{#SUBJECT#}}'=>ucwords($_POST['subject']),
						'{{#MSG#}}'=>ucwords($_POST['msg']),
                    );
					
		 $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
         $result =  SharedFunctions::app()->sendmail($dept_email,$template->template_subject,$body,$ffname); 
					
		 if($_POST['memail']=="yes")
         
		 {
					
		  $template1 =  MailTemplate::getTemplate('user_identity_user');
					 
		  $body1 = SharedFunctions::app()->mailStringReplace($template1->template_body,$string);
                    
          $result1 =  SharedFunctions::app()->sendmail($uemail,$template->template_subject,$body1,$ffname); 
			
		}
      
	     //$this->render('contact-success',array('model'=>$uemail));
	 
	 $this->redirect(array('index'));
	 
	 }

	 
public function actionCron_nonactive_user()

{
	
$date=date('Y-m-d');

$connection = Yii::app()->db;

$cronsql = $connection->createCommand("select * from `drg_user` where `drg_active_link`!=''");

$cronresult = $cronsql->queryAll();

foreach($cronresult as $data )

{

$deldate=$data['drg_rdate'];

$dd="14 days";

$newtime = strtotime($deldate . ' + '.$dd);

$ddate = date('Y-m-d', $newtime);

if($ddate==$date)

{

$to=$data['drg_email'];

$template =  MailTemplate::getTemplate('Nonactivated_Account');

$subjectcc="Your account is dormant";

$string = array(        
						'{{#USERNAME#}}'=>ucwords($data['drg_name'].' '.$data['drg_surname'])

						);

$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

$result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);



}

}

$this->redirect(array('index'));

		}
		
public function actionPermanent_delete_user()

{
		
$date=date('Y-m-d');

$connection = Yii::app()->db;

$cronsql = $connection->createCommand("select * from `drg_user` where `drg_active_link`!=''");

$cronresult = $cronsql->queryAll();

foreach($cronresult as $data )

{

$deldate=$data['drg_rdate'];

$dd="21 days";

$newtime = strtotime($deldate . ' + '.$dd);

$ddate = date('Y-m-d', $newtime);

if($ddate==$date)

{

$to=$data['drg_email'];

$template =  MailTemplate::getTemplate('Account_permanent_delete');

$subjectcc="Your account is dormant";

$string = array(        
						'{{#USERNAME#}}'=>ucwords($data['drg_name'].' '.$data['drg_surname'])

						);

$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

$result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);



}

}


$this->redirect(array('index'));

		}
	 
	public function actionIndex()
	{		
		$model=Contents::model()->find(array('condition'=>"page_seo='home' AND status=1"));
		if($model)     
		{
			$this->pageTitle=$model->meta_title. ' - Business Supermarket';        
			$this->metaDesc=$model->meta_desc;
			$this->metaKeys=$model->meta_keywords;        
		}
		$this->render('index',array('model' =>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin()
	{	    
	      $model = new LoginForm;
	          // if it is ajax validation request
	      if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
	      {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	      } 
	 
	      if(isset($_POST['LoginForm']))
	      {     
	        $model->attributes=$_POST['LoginForm'];
	              
	              if($model->validate() && $model->login()){ 	                  
	                 $log = new Logtransaction(); 
	                 $log->member_id   = Yii::app()->user->Id;
	                 $log->log_id = 2;
	                 $log->transaction_description =  Yii::app()->user->name.' has been login successfully';
	                 $log->transaction_date = date('Y-m-d h:i:s'); 
	                 $log->save();                   
	                 $msg = array('success'=>'true','redirect'=>Yii::app()->user->returnUrl); 
	                 
	              }else {
	                  $msg = array('success'=>'false','redirect'=>Yii::app()->user->returnUrl);
	              }
	      }
	          if(!empty($msg)){
	              echo CJSON::encode($msg);
	              Yii::app()->end();
	          }else {
	              $this->redirect(Yii::app()->homeUrl);
	          }
	       
	}
	  
	  public function actionForget(){	      
	  if(isset($_POST['drg_lost_email']))
	{
	            $codeActive =  Yii::app()->getRequest()->getParam('drg_lost_email');	              
	           if(isset($codeActive)){	                    
	             $postRecord =  User::model()->findByAttributes(array('drg_email'=>$codeActive));	             
	                 if($postRecord){ 
	                         $activecode =  SharedFunctions::app()->randvalue();      
	                         $template =  MailTemplate::getTemplate('Password_Reset_Link');
	                         $postRecord->drg_active_link=$activecode;
	                         $postRecord->drg_pstatus='1';
	                         //$postRecord->drg_pass=SharedFunctions::app()->encrypt_code($newpass); ;
	                         $postRecord->save(); 
	                         
	                         $string = array(
	                                  '{{#USERNAME#}}'=>ucwords($postRecord['drg_name'] .' '.$postRecord['drg_surname']),
	                                  '{{#LINK#}}'=> $this->createAbsoluteUrl('/updatepassword?code='.$activecode),  
	                                  '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
	                                  '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email'] 
	                                  
	                                  /*
	                                  '{{#USEREMAIL#}}'=>ucwords($userData['drg_name'] .' '.$userData['drg_surname']),
	                                  '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
	                                  */
	                         );
	                          
	                          $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
	                            
	                          SharedFunctions::app()->sendmail($postRecord['drg_email'],$template->template_subject,$body); 
	                             $msg = array('success'=>'true','redirect'=>Yii::app()->user->returnUrl); 	                              
	                          
	                          //$this->render('active',array('model'=>$userData));   
	                      
	                  } else {	                      
	                      $msg = array('success'=>'false','redirect'=>Yii::app()->user->returnUrl);	                      
	                  } 
	           } 
	   }
	      if(!empty($msg)){
	          echo CJSON::encode($msg);
	          Yii::app()->end();
	      }else {
	          $this->redirect('/');
	      }
	  }
	  
	  public function actionLogout()
	{
	      if(!Yii::app()->user->isGuest) { 
	         $log = new Logtransaction(); 
	         $log->member_id   = Yii::app()->user->Id;
	         $log->log_id = 3;
	         $log->transaction_description =  Yii::app()->user->name.' has been logout successfully';
	         $log->transaction_date = date('Y-m-d h:i:s'); 
	         $log->save();    
	    Yii::app()->user->logout(false);
	      }
	  $this->redirect('/');
	}

	public function actionUpdatepassword()
	{
		if(!Yii::app()->user->isGuest)
			$this->redirect('/');
		$codeActive =  Yii::app()->getRequest()->getParam('code'); 
		$model = User::model()->findByAttributes(array('drg_active_link'=>$codeActive));
		if(!$model)
			$this->redirect(Yii::app()->homeUrl);
		if(isset($_POST) && !empty($_POST))
		{
			$new_password = $_POST['drg_npass'];
			$confirm_password = $_POST['drg_cpass'];
			if($new_password == $confirm_password)
			{
				$model->drg_pass = SharedFunctions::app()->encrypt_code($new_password);        
				//$model->drg_pstatus=0;
				$model->drg_active_link='';
				if($model->save())
				{
					$template =  MailTemplate::getTemplate('Password_Reset_Successful');                     	
					$string = array(
					    '{{#USERNAME#}}'=>ucwords($model->drg_name .' '.$model->drg_surname),
					    '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
					    '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
					    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
					);                    	
					$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);                    	
					$result =  SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body);                          
					$this->redirect(array('/'));
				}				
			}
		}
		$this->render('updatepassword',array('model'=>$model));
	}
}