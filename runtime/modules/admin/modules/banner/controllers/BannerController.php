<?php

class BannerController extends Controller
{
	public function actionIndex()
	{
	    
        $criteria = new CDbCriteria; 
        $criteria->compare('banner_approve_status !',2);
        $criteria->order = 'banner_id desc';       
        
        $bannerId = Yii::app()->request->getParam('bannerid');
        
	 
        $total = Banner::model()->count($criteria);       
        if(isset($_REQUEST['rows'])){
        	$count = $_REQUEST['rows'];
        }else {
        	$count = 6;
        }      
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  // the trick is here!
	 
        $posts = Banner::model()->findAll($criteria);
     
        $this->render('index',array(
    		'list'=>$posts,
    		'pages' => $pages,
    		'item_count'=>$total,
    		'page_size'=>Yii::app()->params['listPerPage'],        
        )) ; 
	
    }
    
    public function actionPublish(){ 
        $request = Yii::app()->getRequest();
        if($request->getPost('publis')){
            
             $bannersId = $request->getPost('activebanner');
             
             foreach($bannersId as $id){            
               
               $banner = Banner::model()->findByPk($id);
               
               $banner->banner_approve_status = 2;
               
               $banner->banner_adate = date('Y-m-d');
               
               if($banner->save()){ 
                    
                
               }  
               
             } 
             
        }
        $this->redirect(Yii::app()->request->urlReferrer);        
    }
    
    public function actionReject(){ 
        
        $request = Yii::app()->getRequest();
      
        if($request){ 
           
            $bannersId = $request->getPost('bannerid');
            $message = $request->getPost('admincomment');
            
            
            $banner = Banner::model()->findByPk($bannersId);
            
            $banner->banner_approve_status = 3;
            
            $banner->banner_adate = date('Y-m-d');
            
            $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/banner/reject/',array('code'=>$bannersId)).'" target="_blank" >here </a>';
            
            
            $template =  MailTemplate::model()->findByAttributes(array("template_module"=>'banner_rejection'));
            
            
            $bannerImage = "<img src='".Yii::app()->baseUrl.'/upload/'.$banner->banner_path."' title='".$banner->banner_link."'/>";
            
            $model = User::model()->findByPk($banner->drg_user_id);
            
          
            if($banner->save()){                
                
                $string = array(
                    '{{#ADMINMESSAGE#}}'=>$message,
                    '{{#BANNERIMAGE#}}'=>$bannerImage,
                    '{{#BANNERLINK#}}'=>$banner->banner_link,
                    '{{#SUBMISSIONDATE#}}'=>$banner->banner_subdate,
                    '{{#TITLE#}}'=>$banner->banner_link,
                    '{{#LINK#}}'=>'You may click '.$activelink.' to log into your account and update / amend your banner so that it complies.',
                    '{{#DURATION#}}'=>$banner->banner_duration,
                    '{{#COST#}}'=>$banner->banner_cost,
                    '{{#STATUS#}}'=>'Rejected',  
                    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email'],                       
                ); 
                 
             }
            
          
            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string); 
                            
            $result =  SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body);  
            SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body);  
            
            if($result){
                echo 'mail sent';
            }else {
                echo 'mail not sent';
            }
               
        }
        //$this->redirect(Yii::app()->request->requestUri);
        $this->redirect(Yii::app()->createUrl('admin/banner'));
                
    }
    
    
    public function actionActive(){
        
        $criteria = new CDbCriteria; 
        $criteria->compare('banner_approve_status',2);
        
        $request = Yii::app()->getRequest();
        $username = $request->getPost('username');
        $keyword = $request->getPost('Keyword');
        if($username){
            $Data = User::model()->findAll("LOWER(drg_username) like '%".$username."%'"); 
            if($Data){
            
                foreach($Data as $rsData){
            
                   $ids[]= $rsData->drg_id;                      
            
                }        
                       
                $criteria->addInCondition('drg_user_id',$ids);
            } 
        }
        
        if($keyword){
           
            $criteria->compare('banner_path',$keyword,true);
            $criteria->compare('banner_cost',$keyword,true,'or');
            $criteria->compare('banner_link',$keyword,true,'or');
        }
        
        $criteria->order = 'banner_id desc';    
      
     
        $total = Banner::model()->count($criteria);       
        if(isset($_REQUEST['rows'])){
        	$count = $_REQUEST['rows'];
        }else {
        	$count = 6;
        }      
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  // the trick is here!
	 
        $posts = Banner::model()->findAll($criteria);
     
        $this->render('active',array(
    		'list'=>$posts,
    		'pages' => $pages,
    		'item_count'=>$total,
    		'page_size'=>Yii::app()->params['listPerPage'],        
        )) ;  
        
    }
    
    public function actionAjax(){
        
        $request = Yii::app()->getRequest();
        $bannerid = $request->getPost('bannerid');        
        $banner = Banner::model()->findByPk($bannerid);
        $this->renderPartial('ajax',array('model'=>$banner));
    }
    
     public function actionUpdatelink(){
         $request = Yii::app()->getRequest();
         if($request){           
            $bannersId = $request->getPost('bannerid');
            $bannerlink = $request->getPost('bannerlink');
            
           $model =  Banner::model()->findByPk($bannersId);
           $model->banner_link = $bannerlink;
           if($model->save()){
                die(json_encode(array('success'=>true)));
           } 
           
        }
    }
    
    
    public function actionAjaxbanner(){
       
       $request = Yii::app()->getRequest();
       
       if($request){ 
            $action = $request->getPost('action');
            $bannersId = $request->getPost('bannerid');
            $banner = Banner::model()->findByPk($bannersId); 
            if(strtolower($action)=='delete'){
                $banner->banner_approve_status = 4;
            }else if(strtolower($action)=='suspend'){
                $banner->banner_approve_status = 3;
            }
            $banner->banner_adate = date('Y-m-d');
            $banner->save();
               
        }
         $this->redirect(Yii::app()->createUrl('admin/banner/banner/active'));    
    }
    
    public function actionMessage(){
        
        $request = Yii::app()->getRequest();
      
        if($request){  
             
            $bannersId = $request->getPost('bannerid');
            $message = $request->getPost('admincomment');
            
            
            $banner = Banner::model()->findByPk($bannersId); 
            
            
            $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/banner/reject/',array('code'=>$bannersId)).'" target="_blank" >here </a>';
            
            
            $template =  MailTemplate::model()->findByAttributes(array("template_module"=>'banner_advertisment_support_team'));
            
            
            $bannerImage = "<img src='".Yii::app()->baseUrl.'/upload/'.$banner->banner_path."' title='".$banner->banner_link."'/>";
            
            $model = User::model()->findByPk($banner->drg_user_id);                          
            
            if($banner->banner_approve_status=='1'){
                $status = 'waiting admin approval';
            }else if($banner->banner_approve_status=='2')
            {
                $status = 'approve';
            }else if($banner->banner_approve_status=='3') {
                 $status = 'rejection';
            }else if($banner->banner_approve_status=='4') {
                $status = 'delete';
            }
                
            $string = array(
                '{{#ADMINMESSAGE#}}'=>$message,
                '{{#BANNERIMAGE#}}'=>$bannerImage,
                '{{#SUBMISSIONDATE#}}'=>$banner->banner_subdate,
                '{{#LINK#}}'=>'You may click '.$activelink.' to log into your account and update / amend your banner so that it complies.',
                '{{#TITLE#}}'=>$banner->banner_link,
                '{{#DURATION#}}'=>$banner->banner_duration,
                '{{#COST#}}'=>$banner->banner_cost,
                '{{#STATUS#}}'=>$status,                         
            );  
                       
          
            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string); 
                            
            $result =  SharedFunctions::app()->sendmail($model->drg_email,$template->template_subject,$body);  
            if($result){
                
            } 
            
        }
         $this->redirect(Yii::app()->createUrl('admin/banner/banner/active'));    
        
    }
    
    public function actionView(){
       
       if(Yii::app()->user->isGuest){
            
            $this->renderPartial('login');
        
       }else { 
          
            $bannerId = Yii::app()->request->getParam('bannerid'); 
            
            $criteria = new CDbCriteria; 
            $criteria->compare('banner_id',$bannerId);
            
            $criteria->order = 'banner_id desc';    
            
    	 
            $total = Banner::model()->count($criteria);       
            if(isset($_REQUEST['rows'])){
            	$count = $_REQUEST['rows'];
            }else {
            	$count = 6;
            }      
            $pages = new CPagination($total);
            $pages->setPageSize($count);
            $pages->applyLimit($criteria);  // the trick is here!
    	 
            $posts = Banner::model()->findAll($criteria);
         
            $this->render('view',array(
        		'list'=>$posts,
        		'pages' => $pages,
        		'item_count'=>$total,
        		'page_size'=>Yii::app()->params['listPerPage'],        
            )) ; 
        
       } 
        
    }
    
   
}