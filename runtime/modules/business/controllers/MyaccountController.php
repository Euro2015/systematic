<?php
class MyaccountController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		 );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$business=$this->loadModel(Yii::app()->user->getId());       
        if(isset($_POST['Business']))
		{
			$business->attributes=$_POST['Business'];                
            $oldimage = Yii::app()->request->getParam('oldimage');                
            $business->drg_image = $oldimage;
            $business->drg_dob = date('Y-m-d',strtotime($_POST['Business']['drg_dob']));                                
            $business->save();				
            /*$uploadedFile = CUploadedFile::getInstance($bussiness,'drg_image'); 
             
            if($uploadedFile==""){
               
                $bussiness -> drg_image = $oldimage;
            }*/
            /*else { 
                $validfile = Yii::app()->params['valid_image']; 
                
                
                if ($uploadedFile != null && $validfile) {
                     
                    $fileName = SharedFunctions::app()->encrypt_code(rand(0,999999).time())."{$uploadedFile}";  // random number + Timestamp + file name
                   
                    $bussiness -> drg_image = $fileName;
                    
                    if (!empty($uploadedFile)) {
                        
                        $uploadedFile -> saveAs('./upload/logo/'. $fileName); // save images in given destination folder
                    }
                     
                 } 
             }*/              
			
		}            
       	$this->render('update',array('model'=>$business));
	}
    
    
    public function actionUploadprofileimage(){
        
        Yii::import("ext.EAjaxUpload.qqFileUploader"); 
          
        $model = $this->loadModel(Yii::app()->user->getId()); 

        $folder = Yii::app()->basePath.'/../www/upload/logo/';// folder for uploaded files                
        
        $allowedExtensions = array("jpg",'png','gif');//array("jpg","jpeg","gif","exe","mov" and etc...
        
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        
               
        $result = $uploader->handleUpload($folder); 
          
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize = filesize($folder.$result['filename']); 
        
        $fileName = $result['filename'];  
        
        $model->drg_image = $fileName;
        $model->save();
                
        echo $return; 
        
        
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest)
			$this->redirect('/');
		else
			$this->redirect('/business/myaccount/update');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Business('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Business']))
			$model->attributes=$_GET['Business'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Business the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Business::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Business $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='Business-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionUpdatecurrency(){
       
      	if(Yii::app()->request->isAjaxRequest)
      	{
	        $curreny = Yii::app()->request->getParam('Myaccount_drg_currency');
	        if(intval($curreny))
	        {
	        	$model = Business::model()->findByPk(Yii::app()->user->getId());        
		       	if($curreny){
		            $model->drg_currency = $curreny;
		            if($model->save())
		            {
		                $template =  MailTemplate::getTemplate('Currency_Update');                     	
		                $string = array(
		                    '{{#USERNAME#}}'=>ucwords($model->drg_name .' '.$model->drg_surname),
		                    '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
		                    '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
		                    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
		                );                    	
		                $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);                    	
		                $result =  SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body);                          
		                $msg = array('success'=>'true','message'=>'Your currency was updated sucessfully.');
		            }else {
		                $msg = array('success'=>'false','message'=>'Currency Code Not Updated !');
		            }
		       }else {
		            $msg = array('success'=>'false','message'=>'Currency Not Found !');
		       }
		      }else
		        $msg = array('success'=>'false','message'=>'Currency Code Not Updated !');
		         
	       echo CJSON::encode($msg);
	       Yii::app()->end();
	   }else
	   	throw new CHttpException(404,'The requested page does not exist.');
    }
	
	public function actionUpdatepassword()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			$model = Business::model()->findByPk(Yii::app()->user->getId());		
	        $drf_opass = Yii::app()->request->getParam('drg_opass');
	        $drf_npass = Yii::app()->request->getParam('drg_npass');        
	        $drf_cpass = Yii::app()->request->getParam('drg_cpass'); 
	        if($model->drg_pass == SharedFunctions::app()->encrypt_code($drf_opass)){
	        	if($drf_npass == $drf_cpass)
	        	{
	        		$model->drg_pass = SharedFunctions::app()->encrypt_code($drf_npass);        
	        		if($model->save())
	        		{
	        		    $template =  MailTemplate::getTemplate('Password_Update');                     	
	        		    $string = array(
	        		        '{{#USERNAME#}}'=>ucwords($model->drg_name .' '.$model->drg_surname),
	        		        '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
	        		        '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
	        		        '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
	        		    );                    	
	        		    $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);    
	        		    $result =  SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body);                          
        		      	$msg = array('success'=>true,'message'=>'Your password was updated sucessfully');
	        		}else {
	        		    $msg = array('success'=>false,'message'=>'Password Not Updated !','referto' =>'f');
	        		}	        		
	        	}else
	        	$msg = array('success'=>false,'message'=>'Confirm Password Not Matched !','referto' => 'c');
	        } 
	       else {
	            $msg = array('success'=>false,'message'=>'Old Password Not Matched !','referto' => 'o');
	       }       
	       echo CJSON::encode($msg);
	       Yii::app()->end();
	    }else
	    	throw new CHttpException(404,'The requested page does not exist.');
	}
    
    public function actionChangeemail(){
        $newEmail = Yii::app()->request->getParam('drg_nemail');        
        $oldEmail = Yii::app()->request->getParam('drg_email');        
        $newmode = Business::model()->find("drg_email= '".$newEmail."'");        
        if(SharedFunctions::app()->validateEmail($newEmail) && SharedFunctions::app()->validateEmail($oldEmail)){
        if(!$newmode ){    
               $model = Business::model()->find("drg_id=".Yii::app()->user->getId()." and drg_email= '".$oldEmail."'");
               if($model){                 
                    $model->drg_email = $newEmail; 
                    if($model->save())
                    {
                        $template =  MailTemplate::getTemplate('Email_Update');                     	
                        $string = array(
                        	'{{#OLD_EMAIL#}}' => $oldEmail,
                        	'{{#NEW_EMAIL#}}' => $model->drg_email,
                            '{{#USERNAME#}}'=>ucwords($model->drg_name .' '.$model->drg_surname),
                            '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                            '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                            '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                        );                    	
                        $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);                    	
                        $result =  SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body);                          
                        $msg = array('success'=>true,'message'=>'Email Updated Sucessfully');
                    }else {
                        $msg = array('success'=>false,'message'=>'Email Not Updated !');
                    } 
               }else {
                
                $msg = array('success'=>false,'message'=>'Current Email Not Valid !');
                
               } 
           
        }else {
            $msg = array('success'=>false,'message'=>'Email Already In Use!');
       }  
          
       }else {
            $msg = array('success'=>false,'message'=>'Invalid Email !');
       }
        
       echo CJSON::encode($msg);
       Yii::app()->end();
    }

    
     public function actionUpdateSlogan(){
       
          $model = Business::model()->findByPk(Yii::app()->user->getId());        
          $slogan = Yii::app()->request->getParam('Myaccount_slogan');
       if($slogan){
            $model->co_slogon  = $slogan;
            if($model->save())
            {
                $msg = array('success'=>'true','message'=>'Slogan Updated Sucessfully');
            }else {
                $msg = array('success'=>'false','message'=>'Slogan Not Updated !');
            }
       }else {
            $msg = array('success'=>'false','message'=>'Slogan Not Found !');
       }       
       echo CJSON::encode($msg);
       Yii::app()->end();
    }
	
    public function actionCheckmail(){    
    	if(Yii::app()->request->isAjaxRequest)
    	{
		     $email =  Yii::app()->getRequest()->getParam('eml');	     
		     if(SharedFunctions::app()->validateEmail($email)){	         
		         $userData =  Business::model()->findByAttributes(array('drg_email'=>$email));
		         if($userData){
		             $msg = array('success'=>true,'message'=>"Old email address matched.");            
		         }else {
		              $msg = array('success'=>false,'message'=>"Old email address not matched");   
		         }	         
		     }else {	         
		          $msg = array('success'=>false,'message'=>"Please enter valid email !");
		           }
		     if(!empty($msg)){
		         echo CJSON::encode($msg);
		         Yii::app()->end();
		     }
		 }else
		 	throw new CHttpException(404,'The requested page does not exist.');
		 	
 	}

    public function actionCheckoldpwd(){    
    	if(Yii::app()->request->isAjaxRequest)
    	{
		     $drf_opass =  Yii::app()->getRequest()->getParam('eml');
		     $model = $this->loadModel(Yii::app()->user->getId()); 	            
	         if($model->drg_pass == SharedFunctions::app()->encrypt_code($drf_opass)){
		             $msg = array('success'=>true,'message'=>"Old password matched.");            
	         }else {
	              $msg = array('success'=>false,'message'=>"Old password does not match!");   
	         }	         
		     if(!empty($msg)){
		         echo CJSON::encode($msg);
		         Yii::app()->end();
		     }
		 }else
		 	throw new CHttpException(404,'The requested page does not exist.');
		 	
 	}
    
}
