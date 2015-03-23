<?php

class RegisterController extends Controller
{
   public function init(){
		// register class paths for extension captcha extended
		Yii::$classMap = array_merge( Yii::$classMap, array(
			'CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
			'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
		));
	} 
   
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to perform any action
                'actions'=>array(''),
                'users'=>array('*'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }    

    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CaptchaExtendedAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
   
      
   public function actionIndex(){
    
    $model= new Business;
    
    if(isset($_POST['Business']))
    {
        $model->attributes=$_POST['Business'];
        
		$activecode =  SharedFunctions::app()->randvalue(); 
        
        if($model->validate())
        {
            $post = $_POST['Business'];
            $model->drg_uid =substr(md5(time()),0,9); 
            $model->co_name = $post['co_name'];
            $model->co_slogon = $post['co_slogon'];
            $model->drg_name = $post['drg_name']; 
            $model->drg_surname = $post['drg_surname']; 
            $model->co_title = $post['co_title'];
            list($day, $month, $year) = explode("/", $post['drg_dob']);
            $dob = "$year-$month-$day";
            $model->drg_dob = $dob;
            $model->drg_username =  $post['drg_username']; 
            $model->drg_email = $post['drg_email']; 
            $model->drg_pass = SharedFunctions::app()->encrypt_code($post['drg_pass']); 
            $model->drg_addr1 = $post['drg_addr1'];
            $model->drg_addr2 = $post['drg_addr2'];
            $model->drg_addr3 = $post['drg_addr3'];
            $model->drg_town = $post['drg_town'];
            $model->drg_county = $post['drg_county'];
            $model->drg_zip = $post['drg_zip'];
            $model->drg_country = $post['drg_country']; 
            $model->drg_phone = $post['drg_phone'];
            $model->co_fax = $post['co_fax'];
            $model->co_website = $post['co_website'];                
            $model->drg_verifycode = $post['drg_verifycode'];  
            $model->drg_pstatus = 0;
            $model->drg_ip = Yii::app()->request->getUserHostAddress();
            $model->drg_status = 'y';
            $model->drg_currency = 1; 
            $model->drg_active_link = $activecode;
            $model->drg_user_type = 'business';   
            $model->drg_rdate = date('Y-m-d');
            $model->drg_ltime = date('Y-m-d h:i:s');
            // $uploadedFile = CUploadedFile::getInstance($model, 'drg_image');
            // $validfile = Yii::app()->params['valid_image']; 
            // if ($uploadedFile != null && $validfile) {

            //   $fileName = SharedFunctions::app()->encrypt_code(rand(0,999999).time())."{$uploadedFile}";  // random number + Timestamp + file name

            //   $model->drg_image = $fileName;
            //   if (!empty($uploadedFile)) {
            //       $uploadedFile -> saveAs('./upload/logo/'. $fileName); // save images in given destination folder
            //   }

            // }  

               if($model->save())
			   {
				    // Yii::app()->user->setFlash('success', "Your Account Activation link will be sent to");
                                    
                    $template = MailTemplate::getTemplate('Business_Activate_Account');
                    
                    $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/business/register/activation',array('code'=>$activecode)).'" target="_blank" >Click to active your account</a>'; 
       
                    $string = array(
                        '{{#ACCOUNT_ACTIVATION_LINK#}}'=>$activelink,
                        '{{#USERNAME#}}'=>ucwords($model->drg_name .' '.$model->drg_surname),
                        '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                        '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                        '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                    );
        
                   $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                   SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body); 
                   
                  
                   $this->render('pending',array('model'=>$model));die;
			   }
			   
		   
		    // form inputs are valid, do something here
            return;
        }
    }
    
    $this->render('index',array('model'=>$model));   
     
   }
   
   
   
   public function actionActivation(){ 
    
    
     $codeActive =  Yii::app()->getRequest()->getParam('code');
    
     if(isset($codeActive)){
              
       $userData =  User::model()->findByAttributes(array('drg_active_link'=>$codeActive));
       
       if(!empty($userData)){
         
               $template =  MailTemplate::getTemplate('Business_Registration_Completed');
               $postRecord = Business::model()->findByPk($userData['drg_id']);
               $postRecord->drg_active_link='';
               $postRecord->drg_pstatus=1;
               $postRecord->save(); 
               $string = array(
                        '{{#USERNAME#}}'=>ucwords($userData['drg_name'] .' '.$userData['drg_surname']),
                        '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                        '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                        '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
               );
                
                $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
                  
                SharedFunctions::app()->sendmail($userData['drg_email'],$template->template_subject,$body); 
                
                $user_dirname = strtolower($userData['drg_username'])."_".$userData['drg_id'];
                
                $user_dir = Yii::app()->basePath.'/../www/upload/users/'.$user_dirname;
                
                if(!is_dir($user_dir))
                {
                    mkdir($user_dir,0777,true);	
                }
                
                $user_imagedir= Yii::app()->basePath.'/../www/upload/users/'.$user_dirname.'/images';
                if(!is_dir($user_imagedir))
                {
                    mkdir($user_imagedir,0777,true);	
                }
                
                $user_videodir=$user_imagedir= Yii::app()->basePath.'/../www/upload/users/'.$user_dirname.'/videos';
                if(!is_dir($user_videodir))
                {
                    mkdir($user_videodir,0777,true);	
                } 
                
                $logdata = array('member_id'=>$userData['drg_id'],'log_id'=>1,'description'=>ucwords($userData['drg_name'] .' '.$userData['drg_surname']).' has been registered successfully');                               
                
                SharedFunctions::app()->insert_log($logdata);   
                   
                
                $this->render('active',array('model'=>$userData));
            
        }else {
           
            $this->redirect('/');
        
        }        
        
     }else {
        $this->redirect('/');
     } 
   }
   
   /* Resend activation link if your not received any activation mail */
    
    public function actionResendactive(){
        
        $codeActive =  Yii::app()->getRequest()->getParam('code'); 
        
         if(isset($codeActive)){
                  
                   $userData =  User::model()->findByAttributes(array('drg_active_link'=>$codeActive));
                   $activecode =  $codeActive;//SharedFunctions::app()->randvalue(); 
                   $postRecord = User::model()->findByPk($userData['drg_id']);                   
                    if(!empty($userData)){  
                            
                           $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/business/register/activation',array('code'=>$activecode)).'" target="_blank" >Click to activate your account</a>';
                    
                           $template =  MailTemplate::getTemplate('Business_Activate_Account');
                           
                           $string = array(
                                    '{{#ACCOUNT_ACTIVATION_LINK#}}'=>$activelink,
                                    '{{#USERNAME#}}'=>ucwords($postRecord->drg_name .' '.$postRecord->drg_surname),
                                    '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                                    '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                                    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                            );
                            $postRecord->drg_active_link = $activecode;
                            
                            $postRecord->save();
           
                           
                        $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
                          
                        $res = SharedFunctions::app()->sendmail($userData['drg_email'],$template->template_subject,$body);  
                        
                        $this->render('pending',array('model'=>$postRecord));
                    
                    }else{
                    
                        //Yii::app()->user->setFlash('error', "Opps ! something missing ....");
                        
                        $this->redirect('/');
                    
                    } 
         
           
         }else{
            
                //Yii::app()->user->setFlash('error', "Opps ! something missing ....");
                
                $this->redirect('/');
         } 
    }
   
   public function actionCheckmail(){
    
    $email =  Yii::app()->getRequest()->getParam('eml');
    
    if(SharedFunctions::app()->validateEmail($email)){
        
        $userData =  User::model()->findByAttributes(array('drg_email'=>$email));
        if($userData){
            $msg = array('success'=>false,'message'=>"Email address already registered");            
        }else {
             $msg = array('success'=>true,'message'=>"Email address not registered");   
        }
        
    }else {
        
         $msg = array('success'=>false,'message'=>"Please enter valid email !");
          
    }
    if(!empty($msg)){
        echo CJSON::encode($msg);
        Yii::app()->end();
    }
    
   }
   
   public function actionCheckuser(){
        $username =  Yii::app()->getRequest()->getParam('uname');
        if($username){            
            $userData =  User::model()->findByAttributes(array('drg_username'=>$username));
            if($userData){
                $msg = array('success'=>false,'message'=>"Username already taken");            
            }else {
                 $msg = array('success'=>true,'message'=>"Username not taken");   
            }
            
        }else {
            
             $msg = array('success'=>false,'message'=>"Please enter valid username !");
              
        }
        if(!empty($msg)){
            echo CJSON::encode($msg);
            Yii::app()->end();
        }
   }
   
   public function actionUploadprofileimage(){       
       Yii::import("ext.EAjaxUpload.qqFileUploader");        
       $folder = Yii::app()->basePath.'/../www/upload/logo/';// folder for uploaded files                
       if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
       }
       
       $allowedExtensions = array("jpg",'png','gif');//array("jpg","jpeg","gif","exe","mov" and etc...       
       $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes       
       $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);       
              
       $result = $uploader->handleUpload($folder);          
       echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);                      
       exit;
   }
}
