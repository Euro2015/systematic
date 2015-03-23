<?php

class AjaxController extends Controller
{ 
   
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'list' and 'show' actions
                'actions'=>array('checkdob',),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated users to perform any action
                'actions'=>array('', 'view','active','idle'),
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
    
   public function actionCheckdob(){  
    
    $dob = Yii::app()->request->getParam('dob'); 
   
    if($dob=="undefine" || $dob==""){
         $msg = array('success'=>'false');        
    }else {
    
        /*$dob1 = explode("/",$dob);
        $newdob = array_reverse($dob1);  
        $age = date('Y') - $newdob[0];   */ 
        $age = SharedFunctions::age($dob);         
        if($age>=18){
            $msg = array('success'=>'true','age' =>$age.' '.$dob);
        }else {
            $msg = array('success'=>'false');
        }
    }
   
    echo CJSON::encode($msg);
    Yii::app()->end();  
   }
   
   
   public function actionUploadprofileimage(){
    Yii::import("ext.EAjaxUpload.qqFileUploader");  
        
        $folder = 'upload/logo/';// folder for uploaded files                
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
        
         
                
        echo $return; 
    
    
   }

    public function actionActive(){
        // When a user returns from being idle, DB is updated in ActivityTracker Class
        echo 1;
    }

    public function actionIdle(){
        // When a user becomes idle, DB is updated in ActivityTracker Class
        echo 1;
    }
	 
}