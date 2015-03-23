<?php

class BannerController extends Controller
{
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
    
    public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('reject','updatehit'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','active','makepayment','uploadbaneer','payment','update'),
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
    

	public function actionIndex()
	{	
	    
    	$this->render('index');	
    }
    
    public function actionMakepayment(){
        
         $model = new Banner; 
         $drg_category = Yii::app()->request->getParam('drg_category');
         $banner_link = Yii::app()->request->getParam('banner_link');
         $banner_path = Yii::app()->request->getParam('banner_path');
         $totalWeeks = Yii::app()->request->getParam('totalWeeks');
         $cost = Yii::app()->request->getParam('cost');
         $listid = Yii::app()->request->getParam('listid');  
         $model->banner_list_id = $listid;
         $model->banner_path = $banner_path;
         $model->banner_duration = $totalWeeks;
         $model->banner_cost = $cost;
         $model->banner_approve_status = 1;
         $model->drg_user_id = Yii::app()->user->getId();
         $model->banner_subdate = date('Y-m-d');
         $model->banner_clicks = 0;
         $model->banner_link = $banner_link;         
         $imagename = explode('/',$banner_path);
         $newimagename = array_reverse($imagename);
         
         if($model->validate()){ 
            
            
             $userModel = User::model()->findByPk(Yii::app()->user->getId());
            
             $result = move_uploaded_file($_FILES['bannerImage']['tmp_name'],getcwd().'/upload/banner-images/'.$newimagename[0]); 
                         
             if($model->save()){ 
                
                /* Mail code */            
                    
                    $template =  MailTemplate::model()->findByAttributes(array("template_module"=>'banner_submission_notice'));
                    
                    
                    $bannerImage = "<img src='".Yii::app()->baseUrl.'/upload/'.$model->banner_path."' title='".$model->banner_link."'/>"; 
                    
                    
                    $string = array(
                            '{{#BANNER_IMAGE#}}'=>$bannerImage,
                            '{{#IMAGE_NAME#}}'=>$model->banner_link,
                            '{{#BANNER_SUBMITTED_DATE#}}'=>$model->banner_subdate,
                            '{{#BANNER_LINK#}}'=>$model->banner_link,
                            '{{#BANNER_DURATION#}}'=>$model->banner_duration,
                            '{{#AMOUNT_PAID#}}'=>$model->banner_cost,
                            '{{#STATUS#}}'=>'waiting admin approval', 
                            '{{#USER_NAME#}}'=>$userModel->drg_name . ' ' . $userModel->drg_surname, 
                            '{{#COMPANY_EMAIL#}}'  => Yii::app()->params['company_email']        
                        );  
                    
                    $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string); 
                           
                    $result =  SharedFunctions::app()->sendmail($userModel->drg_email,$template->template_subject,$body);  
                    
                    // Admin mail sent code 
                     
                    $template =  MailTemplate::model()->findByAttributes(array("template_module"=>'banner_submission_notice_admin'));
                    
                    
                    $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/admin/banner/banner/view',array('bannerid'=>$model->banner_id)).'" target="_blank" >here </a>';
            
                               
                    $string = array(
                        '{{#HERE#}}'=>$activelink,
                        '{{#COMPANY_EMAIL#}}'  => Yii::app()->params['company_email']        
                    );  
                    
                    $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string); 
                           
                    $result =  SharedFunctions::app()->sendmail('jitendra@artifex-online.com',$template->template_subject,$body); 
                    
                    
                    
                    $this->render('makepayment',array("model"=>$model));
                     
             }else { 
               
                 $this->redirect(Yii::app()->createUrl('listing'));    
             }
                           
         }else {
           $this->redirect(Yii::app()->createUrl('listing'));    
         }  
         
         
    }
    
     
    public function actionPayment(){
        
        $listid = Yii::app()->request->getParam('listid');  
        
        $this->render('index',array('payment'=>'confirm'));	
    }
    
    public function actionReject(){
        
        $listid = Yii::app()->request->getParam('code');
        
        if(Yii::app()->user->isGuest)
		{
			$this->render('login');
		}
		else
		{
		    $modelReject = Banner::model()->findAllByPk($listid);   
            $this->render('rejcted',array("model"=>$modelReject));	
		} 
        
    }    
    
    public function actionUpdate(){
       
        $id = Yii::app()->request->getParam('banner_id');        
        $listid = Yii::app()->request->getParam('banner_list_id'); 
        $banner_path = Yii::app()->request->getParam('banner_link'); 
        $imagename = explode('/',$banner_path);
        $newimagename = array_reverse($imagename);
        $modelReject = Banner::model()->findByPk($id); 
        $modelReject->banner_path = $banner_path; 
        $modelReject->banner_approve_status = 1;
        $modelReject->drg_user_id = Yii::app()->user->getId();
        $modelReject->banner_subdate = date('Y-m-d');
        if($modelReject->validate()){ 
            $result = move_uploaded_file($_FILES['bannerImage']['tmp_name'],getcwd().'/upload/banner-images/'.$newimagename[0]); 
            if($modelReject->save()){ 
                $this->redirect(Yii::app()->createUrl('listing'));    
            }
        }else {
           $this->redirect(Yii::app()->request->urlReferrer);  
        } 
        
        
    }
    
    
    public function actionUpdatehit(){
         
          $id = Yii::app()->request->getParam('banner_id');    
          $model = Banner::model()->findByPk($id);
          if($model){
            $model->banner_clicks = ($model->banner_clicks+1);
            $model->save();
          }
           
    }
    
    
    public function actionUploadbaneer(){
       
        
    }
    
    
    public function actionActive(){
    
    }
    
    
}