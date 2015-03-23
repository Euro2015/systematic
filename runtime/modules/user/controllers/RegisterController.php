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
                'users'=>array('@'),
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
    
    /* First time register page check validation and save the data */
    
	public function actionIndex()
	{
        $this->pageTitle='User Registration - Business Supermarket';        
        $this->metaDesc='Crate user account for Business Supermarket.';
        $this->metaKeys='user account, business supermarket';        

        $model = new User;
        $activecode =  SharedFunctions::app()->randvalue();         
        
        if(isset($_POST['User']))
        {     
            $model->attributes=$_POST['User']; 
            
            if($model->validate())
            {  
                              
               $post = $_POST['User'];
               $model->drg_uid =substr(md5(time()),0,9); 
               $model->drg_name = $post['drg_name']; 
               $model->drg_surname = $post['drg_surname']; 
               list($day, $month, $year) = explode("/", $post['drg_dob']);
               $dob = "$year-$month-$day";
               $model->drg_dob = $dob;
               $model->drg_username =  $post['drg_username']; 
               $model->drg_email = $post['drg_email']; 
               $model->drg_pass = SharedFunctions::app()->encrypt_code($post['drg_pass']); 
               $model->drg_gender = $post['drg_gender']; 
               $model->co_title = $post['co_title']; 
               $model->drg_country = $post['drg_country']; 
               //$model->drg_verifycode = $post['drg_verifycode'];  
               $model->drg_rdate = date('Y-m-d');
               $model->drg_ltime = date('Y-m-d h:i:s');
               $model->drg_ip = Yii::app()->request->getUserHostAddress();
               $model->drg_status = 'n';
               $model->drg_currency = 1;
               $model->drg_pstatus = 0;
               $model->drg_verifycode = $post['drg_verifycode'];
               $model->drg_active_link = $activecode;
               $model->drg_user_type = 'user';
                 
               if($model->save()){
                    
                    // Yii::app()->user->setFlash('success', "Your Account Activation link will be sent to");
                                    
                    $template =  MailTemplate::getTemplate('User_Activate_Account');
                    
                    $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/user/register/activation',array('code'=>$activecode)).'" target="_blank" >Click to active your account</a>';//CHtml::link('',);
       
                    $string = array(
                        '{{#ACCOUNT_ACTIVATION_LINK#}}'=>$activelink,
                        '{{#USERNAME#}}'=>ucwords($model->drg_name .' '.$model->drg_surname),
                        '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                        '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                        '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                    );
        
                    $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body);  
                         
                   if($result){
                          
                           $logdata = array('member_id'=>Yii::app()->user->getId(),'log_id'=>1,'description'=>Yii::app()->user->name.' has been registered successfully');                                           
                           SharedFunctions::app()->insert_log($logdata); 
                           $this->render('pending',array('model'=>$model));die;
                           //$this->redirect(Yii::app()->createUrl('/user/register/resendactive',array('code'=>$activecode)));
                   }else {
                         echo CJSON::encode(array('success'=>false,'message'=>"User not registered !"));
                         Yii::app()->end();
                   } 
                     
               }  
               unset($_POST['USER']);                             
            }
         
   }      
               $this->render('index',array('model'=>$model)); 

	}     
    
     /* Resend activation link if your not received any activation mail */
    
    public function actionResendactive(){
        
        $codeActive =  Yii::app()->getRequest()->getParam('code');         
         if(isset($codeActive)){
                  
                   $userData =  User::model()->findByAttributes(array('drg_active_link'=>$codeActive));
                  $activecode =  SharedFunctions::app()->randvalue(); 
                   $postRecord = User::model()->findByPk($userData['drg_id']);   
                   $activecode = $codeActive;                
                    if(!empty($userData)){ 
                           
                            
                           $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/user/register/activation',array('code'=>$activecode)).'" target="_blank" >Click to activate your account</a>';
                    
                           $template =  MailTemplate::getTemplate('User_Activate_Account');
                           
                           $string = array(
                                    '{{#ACCOUNT_ACTIVATION_LINK#}}'=>$activelink,
                                    '{{#USERNAME#}}'=>ucwords($postRecord->drg_name .' '.$postRecord->drg_surname),
                                    '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                                    '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                                    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                            );
                            $postRecord->drg_active_link = $activecode;
                            $postRecord->save();
           
                           //die; 
                        $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
                          
                        $res = SharedFunctions::app()->sendmail($userData['drg_email'],$template->template_subject,$body);  
                        
                        $this->render('pending',array('model'=>$userData));
                    
                    }else{                    
                        //Yii::app()->user->setFlash('error', "Opps ! something missing ....");                        
                        $this->redirect('/');                    
                    }
         
           
         }else{
            
               // Yii::app()->user->setFlash('error', "Opps ! something missing ....");
                
                $this->redirect('/');
         } 
    }
    
   /* After get activation mail. click on activation link that time this function called */       
     
    public function actionActivation(){
        
     $codeActive =  Yii::app()->getRequest()->getParam('code');

     if(isset($codeActive)){

       $userData =  User::model()->findByAttributes(array('drg_active_link'=>$codeActive));
       
       if(!empty($userData)){
         
               $template =  MailTemplate::getTemplate('User_Registration_Completed');
               //$postRecord = User::model()->findByPk($userData['drg_id']);
              
              if($userData['drg_pstatus']!='1' && $userData['drg_status']!='y'){                
                      
                   //$postRecord->drg_active_link='';
                   $userData->drg_pstatus='1';
                   $userData->drg_status='y';
                   $userData->drg_active_link='';
                   $userData->save(); 
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
                    
                    $this->render('active',array('model'=>$userData));
                
                
                }else {
                    
                    $this->render('alreadyactive',array('model'=>$userData));
                    
                }
                
                
            
        }else {
           
            $this->redirect('/');
        
        }        
        
     }   
     
     $this->redirect('/'); 
                
    } 

   /* Resend activation link if your not received any activation mail */   
   public function actionCheckmail(){
    
    $email =  Yii::app()->getRequest()->getParam('eml');
    
    if(SharedFunctions::app()->validateEmail($email)){
        
        $userData =  User::model()->findAllByAttributes(array('drg_email'=>$email));
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
            $userData =  User::model()->findAllByAttributes(array('drg_username'=>$username));
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
	 
}
