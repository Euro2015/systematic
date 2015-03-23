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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		 );
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel(Yii::app()->user->getId());
                
                $accountStats = array();
                
		if(isset($_POST['Myaccount']))
		{
			$model->attributes=$_POST['Myaccount'];               
            $oldimage = Yii::app()->request->getParam('oldimage');                 
            $model->drg_image = $oldimage;               
            //$model->drg_dob = date('Y-m-d',strtotime($_POST['Myaccount']['drg_dob']));                
            $model->save();
            /*$uploadedFile = CUploadedFile::getInstance($model,'drg_image');                 
            if($uploadedFile==""){
               
                $model->drg_image = $oldimage;
            }*/
            /*else { 
                $validfile = Yii::app()->params['valid_image']; 
                
                if ($uploadedFile != null && $validfile) {
                    
                    
                    $fileName = SharedFunctions::app()->encrypt_code(rand(0,999999).time())."{$uploadedFile}";  // random number + Timestamp + file name
                
                    $model -> drg_image = $fileName;
                    
                    if (!empty($uploadedFile)) {
                        $uploadedFile -> saveAs('./upload/logo/'. $fileName); // save images in given destination folder
                    }
                     
                 } 
             }*/
            			
				// $address = new Useraddress; 					
				// $address1 = $_POST['Myaccount']['drg_addr1']; // [drg_addr1]'
				// $address2 = $_POST['Myaccount']['drg_addr2']; // [drg_addr1]'
				// $address3 = $_POST['Myaccount']['drg_addr3']; // [drg_addr1]'
				// $town = $_POST['Myaccount']['drg_town']; // [drg_addr1]'
				// $zip = $_POST['Myaccount']['drg_zip'];
				// $country = $_POST['Myaccount']['drg_country_old'];
 //                $county = $_POST['Myaccount']['drg_county'];
 //                $phone = $_POST['Myaccount']['drg_phone'];
				// $ip_address = CHttpRequest::getUserHostAddress();
				// $create_date = date('Y-m-d H:i:s'); 
				// $address->drg_addr1 = $address1;
				// $address->drg_addr2 =$address2;
				// $address->drg_addr3 = $address3;
				// $address->drg_town = $town;
				// $address->drg_zip = $zip;
				// $address->drg_country = $country;
 //                $address->drg_county = $county;
				// $address->drg_phone = $phone;
				// $address->drg_ipaddress = $ip_address;
				// $address->drg_createdate = $create_date; 
                
 //                if($address1 !="" && $country !="" && $county !="" )                    
				// $address->save();
            
				
		}
                
                $userId = Yii::app()->user->getId();
            
                $sql = "SELECT count(*) as count_active_listing, Z.count_banner, Z.user_reputation, Z.drg_id, Z.drg_uid";
                $sql .= " FROM drg_user_listing l";
                $sql .= "     INNER JOIN (";
                $sql .= "       SELECT count(*) as count_banner, Z.user_reputation, Z.drg_id, Z.drg_uid";
                $sql .= "       FROM drg_banner_ads b";
                $sql .= " 	INNER JOIN (";
                $sql .= " 	  SELECT u.drg_id, u.drg_uid, IFNULL((sum(likes_total) - sum(dislikes_total)), 0) as user_reputation";
                $sql .= " 	  FROM drg_user u";
                $sql .= " 	  LEFT JOIN drg_comments c";
                $sql .= " 	  ON c.user_id = u.drg_id";
                $sql .= " 	  WHERE u.drg_id = {$userId} ) Z";
                $sql .= "       ON Z.drg_id = b.drg_user_id ) Z";
                $sql .= " ON Z.drg_uid = l.drg_uid";
                $sql .= " WHERE l.drg_listingstatus = 1";

                $accountStats = Yii::app()->db->createCommand($sql)->queryAll();
                
                $this->render('update',array('model'=>$model, 'accountStats' => $accountStats));
	}
    
    
    public function actionUploadprofileimage(){
        
        Yii::import("ext.EAjaxUpload.qqFileUploader"); 
          
        $model = $this->loadModel(Yii::app()->user->getId()); 
        
        $folder = User::getUserImgDir();        
        if (!file_exists($folder)) {
		  mkdir($folder, 0777, true);
        }
 
        
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
			$this->redirect(array('myaccount/update'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Myaccount('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Myaccount']))
			$model->attributes=$_GET['Myaccount'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Myaccount the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Myaccount::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Myaccount $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='myaccount-form')
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
	        	$model = Myaccount::model()->findByPk(Yii::app()->user->getId());        
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
		                $msg = array('success'=>'true','message'=>'Currency Code Updated Sucessfully');
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
			$model = Myaccount::model()->findByPk(Yii::app()->user->getId());		
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
        		       	$msg = array('success'=>true,'message'=>'Password Updated Sucessfully');
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
        
        $newmode = Myaccount::model()->find("drg_email= '".$newEmail."'");
        
        if(SharedFunctions::app()->validateEmail($newEmail) && SharedFunctions::app()->validateEmail($oldEmail)){
        if(!$newmode ){   
               $model = Myaccount::model()->find("drg_id=".Yii::app()->user->getId()." and drg_email= '".$oldEmail."'");
                
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
                        $msg = array('success'=>true,'message'=>'Email Updated Sucessfully');                    }else {
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
       
          $model = Myaccount::model()->findByPk(Yii::app()->user->getId());        
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
		         $userData =  User::model()->findByAttributes(array('drg_email'=>$email));
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