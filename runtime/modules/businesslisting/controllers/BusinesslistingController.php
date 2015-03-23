<?php

class BusinesslistingController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('nologin','index','create','update','business_listing_step2','suspensed','publish','view','rejection','rdelete','fupdate','business_services'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','purchaseaccess','selectlisting','view','update','business_listing_step2','business_listing_step3','businesslistingimage','businesslistingvideo','preview_business_listing','add_favourite','remove_favourite'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	// public function actionView($id)
	// {
	// 	$this->render('view',array(
	// 		'model'=>$this->loadModel($id),
	// 	));
	// }

	public function actionView($id)
	{
        $criteria1 = new CDbCriteria;
        $criteria1->select='t.*,tuser.co_name,tuser.co_slogon,tuser.drg_image';
        $criteria1->join = 'LEFT OUTER JOIN `drg_user` tuser on tuser.drg_uid = t.drg_uid';
        $model = Businesslisting::model()->find($criteria1);
        $this->pageTitle=$model->co_name. ' - Business Supermarket';        
        $this->metaDesc=$model->drg_whoweare;
        $this->metaKeys=$model->drg_keyword;
        $this->render('listing_view', array('model'=>$model));
	}

	public function actionBusiness_services(){
	    $model=Contents::model()->find(array('condition'=>"page_seo='business-ideas' AND status=1"));
	    if(!$model)
	          throw new CHttpException(404,'The requested page does not exist.');
	    else{        
	    $this->pageTitle=$model->meta_title. ' - Business Supermarket';        
	    $this->metaDesc=$model->meta_desc;
	    $this->metaKeys=$model->meta_keywords;  

	    $criteria1 = new CDbCriteria;
	    $criteria1->select='t.*,tuser.co_name as co_name,tcountry.country';
	    $criteria1->join = 'LEFT OUTER JOIN `drg_user` tuser on tuser.drg_uid = t.drg_uid LEFT OUTER JOIN `drg_country` tcountry on tcountry.country_id = tuser.drg_country';
	    $criteria1->compare('drg_category',1,true);
	    $criteria1->compare('drg_blistingstatus',1,true);
	    $criteria1->compare('drg_breject_list',0,true);
	    $sort_string = '';
	    if(isset($_REQUEST['date_sort']) && $_REQUEST['date_sort']=='oldest'){
	        $sort_string = 'drg_bapprovedate asc';
	    }else {
	        $sort_string = 'drg_bapprovedate desc';
	    }
	    // $criteria1->order = 'drg_lid desc';

	    if(isset($_REQUEST['name_sort'])){
	        if($_REQUEST['name_sort']=='z_a'){
	            $sort_string= 'tuser.co_name desc';
	        }else {
	            $sort_string= 'tuser.co_name asc';
	        }
	    }

	    if(isset($_REQUEST['origin_sort'])){
	        if($_REQUEST['name_sort']=='z_a'){
	            $sort_string= 'tcountry.country desc';
	        }else {
	            $sort_string= 'tcountry.country asc';
	        }
	    }

	    if(isset($_REQUEST['origin_sort'])){
	        if($_REQUEST['name_sort']=='z_a'){
	            $sort_string= 'tcountry.country desc';
	        }else {
	            $sort_string= 'tcountry.country asc';
	        }
	    }

	    $criteria1->order = $sort_string;

	    if(isset($_REQUEST['looking_for'])){
	        $criteria1->compare('drg_profession',$_REQUEST['looking_for'],true);
	    }


	    $total1 = Businesslisting::model()->count($criteria1); 
	    
	    if(isset($_REQUEST['rows'])){
	        $count1 = $_REQUEST['rows'];
	    }else {
	        $count1 = 12;
	    }
	    
	    $pages1 = new CPagination($total1);
	    $pages1->setPageSize($count1);
	    $pages1->applyLimit($criteria1);  
	    $posts1 = Businesslisting::model()->findAll($criteria1);

	    if(!Yii::app()->user->isGuest){
	        $user_id = Yii::app()->user->id;
	        $criteria1->join.=' LEFT OUTER JOIN `drg_favourite_listing` fl ON fl.listing_id=t.drg_blid';
	        $criteria1->compare('fl.user_id',$user_id);
	        $fav_posts = Businesslisting::model()->findAll($criteria1);
	    }
	    $this->render('business_services',array('model'=>$model,'posts'=>$posts1,'pages'=>$pages1,'total_posts'=>$total1,'fav_posts'=>$fav_posts));
	    }
	}

    public function actionNologin(){
        if(Yii::app()->user->isGuest) {
            $this->render('login');
        }else{
            $this->redirect('index');
        }


    }

	public function actionAdd_favourite()
    {
         $listid = $_REQUEST['blistid'];
        $model = $this->loadModel($listid);
       $user_id = Yii::app()->user->id;
        $fav_exists = Bfavourites::model()->findByAttributes(array('user_id'=>$user_id,'blisting_id'=>$listid));
        if($fav_exists){
            Yii::app()->user->setFlash('info','The listing has already been added to Favourites!');
        }
        else{
		
            $new_fav = new Bfavourites;
            $new_fav->user_id = $user_id;
            $new_fav->blisting_id = $listid;
            if($new_fav->save()){
			
                Yii::app()->user->setFlash('success','The listing has been added to Favourites successfully!');
            }
            else{
			echo $user_id;
                Yii::app()->user->setFlash('error','Sorry! The listing could not be added to Favourites.');
            }
        }
        $this->redirect($this->createUrl('/businesslisting/view?id='.$listid));
    }

    public function actionRemove_favourite()
    {
        $listid = $_REQUEST['blistid'];
        $model = $this->loadModel($listid);
        $user_id = Yii::app()->user->id;
        
        $fav_exists = Bfavourites::model()->findByAttributes(array('user_id'=>$user_id,'blisting_id'=>$listid));
        if(!$fav_exists){
            Yii::app()->user->setFlash('info','The listing has already been removed from Favourites!');
        }
        else{
            if($fav_exists->delete()){
                Yii::app()->user->setFlash('success','The listing has been removed from Favourites successfully!');
            }
            else{
                Yii::app()->user->setFlash('error','Sorry! The listing could not be removed from Favourites. Please try again.');
            }
        }
        $this->redirect($this->createUrl('/businesslisting/view?id='.$listid));
    }

	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

        if(Yii::app()->user->isGuest)
        {
            if(isset($blistid) && $blistid !=""){

                $model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$blistid."'");

            }else {
                $model = new Businesslisting;
            }

            $this->render('login',array('model'=>$model,'user_data'=>$userData));

        }else{
        $user = new User;
        $userData =User::model()->findByPk(Yii::app()->user->getId());

		$blistid = Yii::app()->request->getParam('blistid');

		
		if(isset($blistid) && $blistid !=""){
            
            $model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$blistid."'");    
              
        }else {
           $model= new Businesslisting;
        }

        $model->drg_last_page_visit = date('Y-m-d');
        $model->drg_page_visit = $model->drg_page_visit + 1;
        $model->save();

		if(isset($_POST['Businesslisting']))
		{
			//$model->attributes=$_POST['Businesslisting'];
			$post = $_POST['Businesslisting'];
			$model->drg_category = $post['drg_category'] ;
			$model->drg_profession = $post['drg_profession'] ;
			$model->drg_viewlimit = $post['drg_viewlimit'] ;
			$model->drg_slogon = $post['drg_slogon'] ;
			$model->drg_whoweare = $post['drg_whoweare'] ;
			$model->drg_offer = $post['drg_offer'] ;
			$model->drg_datetime = date('Y-m-d H:i:s'); 
			$model->drg_uid = Yii::app()->user->getState('uid'); 
			$model->drg_status = 0;
            $model->drg_keyword = $post['drg_keyword'];
			$model->attributes=$_POST['Businesslisting']; 
			if($model->validate())
			{
			 	$model->drg_uid = Yii::app()->user->getState('uid');
				if($model->save())
				{	
				    if($_POST['btnsaveforlater']==1){ 
                       $this->redirect(Yii::app()->createUrl('business/myaccount/update'));     
				    }else {                    
                        $this->redirect(Yii::app()->createUrl('businesslisting/business_listing_step2/blistid/'.$model->drg_blid));
					}
                    //$this->redirect(array('view','id'=>$model->drg_blid));
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
            'user_data'=>$userData
		));
        }
	}
	
	public function actionbusiness_listing_step2(){
         
        
        $blistid = Yii::app()->request->getParam('blistid');         
       
        $model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$blistid."'");    
		  //   print_r($_POST); die;
	 	
       if($_POST['drg_imgdesc']){
            
          
           /******************************/
            if(isset($_POST['old_img_name'])){
             
                for($i=0;$i<count($_POST['old_img_name']);$i++){ 
                    
                    if($_POST['old_img_name'][$i]!=""){
                    
                        $whosloggedin = Businesslistingimages::model()->find('drg_listing_image=:imagename',array(':imagename'=>$_POST['old_img_name'][$i]) ); 
                        $whosloggedin->delete();
                        
                    } 
                }
             
             }
          
            
            $i=0;            
            for($i=0;$i<count($_POST['img_name']);$i++){ 
     
                 if($_POST['img_name'][$i]!=""){
                    $businesslistingimages = new Businesslistingimages;
                         $businesslistingimages->drg_listing_image = $_POST['img_name'][$i];
                         $businesslistingimages->drg_imgdesc = $_POST['drg_imgdesc'][$i];
                         $businesslistingimages->drg_blid =  $blistid;
                         $businesslistingimages->save();
                 }                
                   
            }
          
        
          
          /******************************/
            if(isset($_POST['drg_old_videos'])){
                $i=0;
                for($i=0;$i<count($_POST['drg_old_videos']);$i++){ 
                    
                    if($_POST['drg_old_videos'][$i] !="")
                    { 
                        $whosloggedin = Businesslistingvideos::model()->find('drg_listing_video=:videoname',array(':videoname'=>$_POST['drg_old_videos'][$i]) ); 
                        $whosloggedin->delete();
                        
                    }
                     
                }
             
             }
            
            
            $i=0;            
            for($i=0;$i<count($_POST['drg_videos']);$i++){ 
                    
                 if($_POST['drg_videos'][$i] !=""){     	             
                     
                       $Businessvideo = new Businesslistingvideos; 
                     $video =  explode("/",$_POST['drg_videos'][$i]);
                     $video = array_reverse($video);    
                     $videoData = ""; 
                     $Businessvideo->drg_videodesc = $_POST['drg_videodesc'][$i];
                     $Businessvideo->drg_listing_video = $video[0];
                     $Businessvideo->drg_blid =  $blistid;
                     $Businessvideo->save();  
                 }   
            }
          
          
          
          
          
          
		  /*
         
         
            $i=0;            
            for($i=0;$i<=count($_POST['drg_videos']);$i++){
                
           
                 if($_POST['drg_videos'][$i] !=""){ 
                    
                      $Businessvideo = new Businesslistingvideos; 
                     $video =  explode("/",$_POST['drg_videos'][$i]);
                     $video = array_reverse($video);    
                     $videoData = ""; 
                     $Businessvideo->drg_videodesc = $_POST['drg_videodesc'][$i];
                     $Businessvideo->drg_listing_video = $video[0];
                     $Businessvideo->drg_blid =  $blistid;
                     $Businessvideo->save();                     
                 }   
            }
           
           
           
           
           
           
          
          
			$i=0;            
            for($i=0;$i<=count($_POST['drg_imgdesc']);$i++){ 
                 

            if(isset($_POST['old_img_name'])){
             
                for($i=0;$i<count($_POST['old_img_name']);$i++){ 
                    
                    if($_POST['old_img_name'][$i]!=""){
                    
                        $whosloggedin = Businesslistingimages::model()->find('drg_listing_image=:imagename',array(':imagename'=>$_POST['old_img_name'][$i]) ); 
                        $whosloggedin->delete();
                        
                    } 
                }
             
             }
                 	$i=0;  
                 if($_POST['img_name'][$i]!=""){
                    
                      if(isset($_POST['img_name'][$i])){
                        $imageData =  Businesslistingimages::model()->find("drg_listing_image='".$_POST['img_name'][$i]."'");
                     }
                     if(!$imageData){
                         $businesslistingimages = new Businesslistingimages;
                         $businesslistingimages->drg_listing_image = $_POST['img_name'][$i];
                         $businesslistingimages->drg_imgdesc = $_POST['drg_imgdesc'][$i];
                         $businesslistingimages->drg_blid =  $blistid;
                         $businesslistingimages->save();
                     }
                 }                
                   
            }
            
            
            
            */

           if($_POST['saveforlater'])
           {
               $model_user = User::model()->find("drg_uid='".Yii::app()->user->getState('uid')."'");


               $to = $model_user['drg_email'];
               $subject = "User has save for later";

               $message = "
						   <table>
						   	<tr><p>Dear ".$model_user['drg_name']."</p></tr>
							<tr><p>You have successfully submitted your listing.</p></tr>
							<tr><p>Company slogon:&nbsp;".$model['drg_slogon']."<br/>
								Date of submission and Time:&nbsp;".$model['drg_datetime']."<br/>
								Status:&nbsp;".$model['drg_status']."</p></tr>
							<tr><p>You will be notified when your Business listing is published</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Business Listing Submission Team</p></tr>
							<tr><p>Note: This email address cannot accept replies.<br/>
							Should you wish to contact us, then you may do so via the support@business-supermarket.com</p></tr>

						   </table>

							";

               // Always set content-type when sending HTML email
               $headers = "MIME-Version: 1.0" . "\r\n";
               $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

               // More headers
               $headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
               //$headers .= 'Cc: testdemo356@gmail.com' . "\r\n";
               mail($to,$subject,$message,$headers);
               $this->redirect(Yii::app()->createUrl('business/myaccount/update'));
               die;

           }
           else if($_POST['submitlisting'])
           {
               $model_user = User::model()->find("drg_uid='".Yii::app()->user->getState('uid')."'");
               $to = $model_user['drg_email'];
           			   
$statuss=$model['drg_status'];
if($statuss=="0")
{
$stat ="Waiting admin approval and publication";
}
else if($statuss=="1")
{
$stat ="Published";
}
else if($statuss=="2")
{
$stat ="Suspended";
}
else if($statuss=="3")
{
$stat ="Deleted";
}
else if($statuss=="4")
{
$stat ="Restored";
}
else if($statuss=="4")
{
$stat ="Permenant Deleted";
}

			   		$template =  MailTemplate::getTemplate('blisting_submission');
 $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."businesslisting/fupdate/blistid/".$model->drg_blid.'" target="_blank" >here >> </a>';
			  $ltitle="<font color='orange'><i>".$model_user['co_title']."</i></font>";
	   		        $ldate="<font color='orange'><i>".$model['drg_datetime']."</i></font>";
			        $lstatus="<font color='#15c'><i>".$stat."</i></font>";
    $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($ltitle),
                       '{{#USERNAME#}}'=>ucwords($model_user['drg_name'].' '.$model_user['drg_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($ldate),
						'{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
						'{{#LINK#}}'=>ucwords($yii_user_request_id)
                    );
					
					$subject="Listing ".$model_user['co_title']." is waiting publication";
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$subject,$body);  
					
               //$this->redirect(Yii::app()->createUrl('business/myaccount/update'));
                $this->render("successmessage",$model);
			   die;

           }else if($_POST['preview']){
               $this->redirect(Yii::app()->createUrl('businesslisting/preview_business_listing/blistid/'.$blistid));
               die;
           }
           else
           {
               $this->redirect(Yii::app()->createUrl('business/myaccount/update'));
           }


        }
               
        $this->render('business_listing_step2',array('model'=>$model,));
       
    }
	
	public function actionbusiness_listing_step3()
	{
		 
		$blistid = Yii::app()->request->getParam('blistid');
        
		$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$blistid."'");    
		
		if(isset($_POST['Businesslisting'])){
             
            $model->drg_testimonial = $_POST['Businesslisting']['drg_testimonial'];
			$model->drg_status = 0;
            $model->drg_keyword = $_POST['Businesslisting']['drg_keyword'];
            if($model->save()){   
                
					if($_POST['saveforlater'])
					{
						 $model_user = User::model()->find("drg_uid='".Yii::app()->user->getState('uid')."'");
						 
				 			
                            $to = $model_user['drg_email'];
							$subject = "User has save for later";

						   $message = "
						   <table>
						   	<tr><p>Dear ".$model_user['drg_name']."</p></tr>
							<tr><p>You have successfully submitted your listing.</p></tr>
							<tr><p>Company slogon:&nbsp;".$model['drg_slogon']."<br/>
								Date of submission and Time:&nbsp;".$model['drg_datetime']."<br/>
								Status:&nbsp;".$model['drg_status']."</p></tr>
							<tr><p>You will be notified when your Business listing is published</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Business Listing Submission Team</p></tr>
							<tr><p>Note: This email address cannot accept replies.<br/>
							Should you wish to contact us, then you may do so via the support@business-supermarket.com</p></tr>
							
						   </table>
							
							";

							// Always set content-type when sending HTML email
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							$headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							//$headers .= 'Cc: testdemo356@gmail.com' . "\r\n";
							mail($to,$subject,$message,$headers);
                            $this->redirect(Yii::app()->createUrl('business/myaccount/update'));
                            die; 
						
					}
					else if($_POST['submitlisting'])
					{
						 $model_user = User::model()->find("drg_uid='".Yii::app()->user->getState('uid')."'");
						 $to = $model_user['drg_email'];
						 $subject = "User has successfully submitted a Business listing";
						 $message = "
						   <table>
						   	<tr><p>Dear ".$model_user['drg_name']."</p></tr>
							<tr><p>You have successfully submitted your listing.</p></tr>
							<tr><p>Company slogon:&nbsp;".$model['drg_slogon']."<br/>
								Date of submission and Time:&nbsp;".$model['drg_datetime']."<br/>
								Status:&nbsp;".$model['drg_status']."</p></tr>
							<tr><p>You will be notified when your Business listing is published</p></tr>
							<tr><p>Sincerely<br/>
							Business Supermarket Business Listing Submission Team</p></tr>
							<tr><p>Note: This email address cannot accept replies.<br/>
							Should you wish to contact us, then you may do so via the support@business-supermarket.com</p></tr>
							
						   </table>
							
							";
							// Always set content-type when sending HTML email
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							$headers .= 'From: Business Supermarket <no-reply@business-supermarket.com>' . "\r\n";
							//$headers .= 'Cc: testdemo356@gmail.com' . "\r\n";
							mail($to,$subject,$message,$headers);
                            $this->redirect(Yii::app()->createUrl('business/myaccount/update'));
                            die; 
						
					}else if($_POST['preview']){ 
                        $this->redirect(Yii::app()->createUrl('businesslisting/preview_business_listing/blistid/'.$blistid));
                        die; 
					}
					else 
					{
                         $this->redirect(Yii::app()->createUrl('business/myaccount/update'));
                    }
            }
            
        } 
		else 
		{ 
		  $this->render('business_listing_step4',array('model'=>$model,));
        }		
		
	}
	
	function actionbusiness_listing_step4()
	{
	   
        $blistid = Yii::app()->request->getParam('blistid');
        
		$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$blistid."'");    
		
        
		if(isset($_POST['Businesslisting'])){
             
            $model->drg_testimonial = $_POST['Businesslisting']['drg_testimonial'];
			
            $model->drg_keyword = $_POST['Businesslisting']['drg_keyword'];
            if($model->save()){   
                
                    if($_POST['btnsaveforlater']==1){
                        
                        $this->redirect(Yii::app()->createUrl('business/myaccount/update'));   
                          
                    }
                    else { 
                        
                        $this->redirect(Yii::app()->createUrl('myaccount/update')); 
                    }
            }
            
        } 
       
		//$this->render('business_listing_step3',array('model'=>$model,));		
	}
	
	
	public function actionBusinesslistingimage(){  
        
        Yii::import("ext.EAjaxUpload.qqFileUploader"); 
         
        
        $thumb = 'upload/users/'.Yii::app()->user->getState('ufolder').'/listing/thumb/';// folder for uploaded files
                
        if (!file_exists($thumb)) {
		  mkdir($thumb, 0777, true);
        }
        
        $videos = 'upload/users/'.Yii::app()->user->getState('ufolder').'/videos/';// folder for uploaded files
                
        if (!file_exists($videos)) {
		  mkdir($videos, 0777, true);
        }
        
        $big = 'upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/';// folder for uploaded files
                
        if (!file_exists($big)) {
		  mkdir($big, 0777, true);
        }
        
        $folder = 'upload/users/'.Yii::app()->user->getState('ufolder').'/images/';// folder for uploaded files
                
        if (!file_exists($folder)) {
		  mkdir($folder, 0777, true);
        }
 
        
        $allowedExtensions = array("jpg",'png','gif');//array("jpg","jpeg","gif","exe","mov" and etc...
        
        $sizeLimit = 800 * 600;// maximum file size in bytes
        
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        
               
        $result = $uploader->handleUpload($big);
        
        //$uploader->handleUpload($thumb);
        
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize = filesize($big.$result['filename']);//GETTING FILE SIZE
        
        $fileName = $result['filename'];//GETTING FILE NAME   
        
        SharedFunctions::app()->imagethumb($big.$result['filename'], $thumb.$result['filename'], 140); 
        
        
        echo $return;// it's array
        
            
    }
	
	
	 public function actionPreview_business_listing(){
	   
       
        $id = Yii::app()->request->getParam('blistid');         
        
        $model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");
         $userData = User::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."'");
         $this->render('preview_business_listing',array('model'=>$model,'UserData'=>$userData));
        
   	 }
	
	
	
	public function actionBusinesslistingvideo(){  
        
     $time=microtime();

        $time=str_replace(".","",$time);

        $time=str_replace(" ","",$time);

        

        $quality =6000;

        $name=$time; // this will be a new unique name for our video to prevent overwritng  of existing videos -- 

        //note: you can change the way of naming your videos

        $_SESSION['name']=$name;

        

        // setting up max video size - by default php is set to 2 MB

       // $max_upload_size = 600*1024*1024; // size is in MB

        

        

        

        // define a folders to store converted temp and converted vids

       $path = $_SERVER['DOCUMENT_ROOT'].'/';  

        $temp_dir=$path."temp/";

        $log=$path."log/";

        //$converted_vids=$path."converted_vids/";

        $converted_vids = $path."upload/users/".Yii::app()->user->getState('ufolder')."/videos/";

        

        $_SESSION['converted_vids']=$converted_vids;

        $_SESSION['temp_dir']=$temp_dir;

        // if those directotires don't exist - create them and give them read/write permissions

        if(!is_dir($temp_dir)) mkdir($temp_dir, 0777); 

        if(!is_dir($log)) mkdir($log, 0777); 

        

        if(!is_dir($converted_vids)) mkdir($converted_vids, 0777); 

       

        if(isset($_FILES['file_vid']) && !empty($_FILES['file_vid']['name'])) 

        { 

        	// Checking extension of selected video - these extension are suported by ffmpeg

        

        	$allowedExtensions = array("3gp","avi","mpg","mpeg","mpe4","mov","m4a","mj2","flv","wmv","mp4","ogg","webm");

        	foreach ($_FILES as $file) 

        	{

        		if ($file['tmp_name'] > '') 

        		{

        			$ext = @end(@explode(".", $file['name']));

        			if (!in_array($ext,$allowedExtensions)) 

        			{

        				

        				echo "<div class='red'>".$file['name']." is an invalid file type!<br>Supported files are:<br><strong>3gp,avi,mpg,mpeg,mpe4,mov,m4a,mj2,flv,wmv,mp4,ogg,webm</strong><br></div>";

        				echo "<div><br><a class='button black'>Back to upload video</a></div>";		

        				exit;

        			}

        		}			 

        	} 

        		

        	// get file size and convert it to MB's

        	

        	$filesize=$_FILES["file_vid"]["size"];

        	//$filesize = round(($filesize/1048576),2);

        	 

             

            

        	//get extension

        	$file_name=basename( $_FILES['file_vid']['name']) ;

        	$filename=$temp_dir.$file_name;

        	$extension = substr($file_name, strrpos($file_name, "."));

        	$extension = strtolower($extension);

        	

        	// checking the size of uploading video

        		

        /*	if ($filesize > $max_upload_size) 

        	{	

        

        		echo "<div class='red'>Your video is to big(".$filesize." MB)! <br>Max video size is set to ".$max_upload_size." MB<br> Upload failed.<br></div>";

        		echo "<div><br><a class='button black' >Back to upload video</a></div>";

        		exit;

        	}*/

        			 

        	//echo "Size of your video: ".$filesize." MB<br>";

        

        	//everething is OK  -> move uploaded file

        	move_uploaded_file($_FILES["file_vid"]["tmp_name"],$temp_dir . $_FILES["file_vid"]["name"]);

        	

        	// rename our file to microtime name + extension of video - this will make easier for ffmpeg to read this uploaded file before converting(preventing video names with special characters)

        	

        	rename($filename, $temp_dir.$name.$extension); // this is new name for our video, something like 0342731001282903919.avi

        	

        	$video_to_convert=$temp_dir.$name.$extension;

        	$_SESSION['video_to_convert']=$video_to_convert;

        	

        	$type=$_POST['type'];

        	if (isset($_POST['size'])) {$size=$_POST['size'];} 

        	if (isset($_POST['quality'])) {$quality=$_POST['quality'];}

        	if (isset($_POST['audio'])) {$audio=$_POST['audio'];}

        

        	if($type=="webm" && $audio=="11025"){$audio="22050";$type="webm"; }// for webm  audio can not be 11050

        	if($type=="ogg" && $audio=="11025"){$audio="22050"; $type="ogg"; }// for ogg  audio can not be 11050

        

        	$converted_vids=$_SESSION['converted_vids'];

        	$temp_dir=$_SESSION['temp_dir'];

        	$name=$_SESSION['name'];

        	$_SESSION['type']=$type; 

        	

        	//define a settings for converting to specific video format

        	

        	if($type=="flv"){ 

        	   

        	   //$call="ffmpeg/ffmpeg.exe -i ".$_SESSION['video_to_convert']." -vcodec flv -f flv -r 30 -b ".$quality." -ab 128000 -ar ".$audio." -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";

                $call="ffmpeg -i ".$_SESSION['video_to_convert']." -vcodec flv -f flv -r 30 -b ".$quality." -ab 128000 -ar ".$audio." -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";

           

            }

            

        	chmod($converted_vids.$name, 0777); 

        	/* START CONVERTING */

        		

        	$convert = (popen("start /b ".$call , "r")); //for window

        	$convert = (popen($call." >/dev/null &" , "r")); //for the linux

        	

        	

        

        	pclose($convert);

        		

        	// define sessions

        

        	$_SESSION['name']=$name;

        	$_SESSION['dest_file']=$converted_vids.$name; 

        	  

         

        	/*

        	// process to move the file from temp folder to user folder

        	$UPLOAD_PATH_ORG = getcwd().'/';

        	$user_video_path = $UPLOAD_PATH_ORG ."upload/users/".Yii::app()->user->getState('ufolder')."/videos/";

            $user_video_path = str_replace( 'video-upload/','',$user_video_path); 

            

            

            

            $source_file_path=$UPLOAD_PATH_ORG."temp/".$name.$extension;

            $destination_file_path=$user_video_path.$name.$extension;

            

            echo "\nsource :".$source_file_path;

            echo "\n ok :".$destination_file_path;

              

            

            if(copy($UPLOAD_PATH_ORG."temp/".$name.$extension,$destination_file_path))

            {		

        		//unlink($UPLOAD_PATH_ORG."temp/".$name.$extension);		

        	}

          	echo "upload/users/".Yii::app()->user->getState('ufolder')."/videos/".$name.$extension;

            */

           	echo $name.'.'.$type;

        	exit; 

    }

     } 
	
	
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $user = new User;
        $userData =User::model()->findByPk(Yii::app()->user->getId());

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	

		if(isset($_POST['Businesslisting']))
		{
			$model->attributes=$_POST['Businesslisting'];
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->drg_blid));
		}

		$this->render('update',array(
            'model'=>$model,
            'user_data'=>$userData
		));
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
		
        /**
         *  Business listing you wish to manage             
        **/
        $model1= new Businesslisting('search');
        $criteria1 = new CDbCriteria;
     //   $criteria1->compare('approved',1,true);
        $criteria1->compare('drg_uid',Yii::app()->user->getState('uid'),true); 
        $criteria1->order = 'drg_blid desc';
        $total1 = Businesslisting::model()->count($criteria1); 
        
        if(isset($_REQUEST['rows'])){
        	$count1 = $_REQUEST['rows'];
        }else {
        	$count1 = 5;
        }
        
        $pages1 = new CPagination($total1);
        $pages1->setPageSize($count1);
        $pages1->applyLimit($criteria1);  
        $posts1 = Businesslisting::model()->findAll($criteria1);
       // print_r($posts1);
         
        
        /**
         * Business listing waiting for publication 
        **/

        $criteria = new CDbCriteria;
        $criteria->compare('drg_uid',Yii::app()->user->getState('uid'),true); 
        $criteria->order = 'drg_blid desc';
       
        
        $total = Businesslisting::model()->count($criteria);
        
        if(isset($_REQUEST['row'])){
        	$count = $_REQUEST['row'];
        }else {
        	$count = 5;
        }
        
         
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  // the trick is here!
		$posts = Businesslisting::model()->findAll($criteria); 
      

       $this->render('index',array('model'=>$model,
		'list'=>$posts,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size'=>Yii::app()->params['listPerPage'],
        'model1'=>$model1,
        'list1'=>$posts1,
		'pages1' => $pages1,
		'item_count1'=>$total1,
		//'page_size'=>Yii::app()->params['listPerPage'],
        )) ;


	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Businesslisting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Businesslisting']))
			$model->attributes=$_GET['Businesslisting'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Businesslisting the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Businesslisting::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Businesslisting $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='businesslisting-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    
    /**
     * select listing action 
     * 
     *     
    */ 
     
    public function actionSelectlisting(){ 
            
        $id = Yii::app()->request->getParam('blistid');
         
        $model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'"); 
        
        $userData = User::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."'");   
         
		$this->render('select_listing_action',array('model'=>$model,'userData'=>$userData));
    }  
    
    public function actionPurchaseaccess(){ 
            
         
         $id = Yii::app()->request->getParam('blistid');
         
         $model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'"); 
        
         $userData = User::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."'");
          
		$this->render('purchase_access',array('model'=>$model,'userData'=>$userData));
    } 
    
	
	public function actionSuspensed()
	{

		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('blistid');
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");
			$this->render('login',array('model'=>$model));
		}
		else
		{
			$id = Yii::app()->request->getParam('blistid');
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");
        	$this->render('preview_business_listing',array('model'=>$model,));
		}
		
	}
	
	public function actionPublish()
	{
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('blistid');
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");	
			$this->render('login',array('model'=>$model));
		}	
		else
		{
			$id = Yii::app()->request->getParam('blistid');    
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");   
        	$this->render('preview_business_listing',array('model'=>$model,));	
		}
	}
	
	public function actionRejection()
	{
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('blistid');
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");	
			$this->render('login',array('model'=>$model));
		}	
		else
		{
			$id = Yii::app()->request->getParam('blistid');    
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");   
        	$this->render('preview_business_listing',array('model'=>$model,));	
		}
	}
	
	public function actionRdelete()
	{
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('blistid');
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");
			$this->render('login',array('model'=>$model));	
		}
		else
		{
			$id = Yii::app()->request->getParam('blistid');	
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");
			$this->render('preview_business_listing',array('model'=>$model));
		}	
	}
	
	public function actionFupdate()
	{
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('blistid');
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");
			$this->render('login',array('model'=>$model));
		}
		else
		{
			$id = Yii::app()->request->getParam('blistid');
			$model = Businesslisting::model()->find("drg_uid = '".Yii::app()->user->getState('uid')."' and  drg_blid ='".$id."'");
			$this->render('preview_business_listing',array('model'=>$model));	
		}	
	}
    
    
}
