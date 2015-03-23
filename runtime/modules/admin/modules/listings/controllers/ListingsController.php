<?php
class ListingsController extends Controller
{
	  
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index,update,create,delete,rdelete,publish,rejection,suspension,restore,downloadvideo'),
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
			$model->drg_fprojections=$data;						 if($id!="")		     {               Userlistingimages::model()->deleteAll("drg_lid  ='".$id."'");             }                        $i=0;                        for($i=0;$i<6;$i++){                       if($_POST['img_name'][$i]!=""){                                         $Userlistingimages = new Userlistingimages;                     $Userlistingimages->drg_listing_image = $_POST['img_name'][$i];                     $Userlistingimages->drg_imgdesc = $_POST['drg_imgdesc'][$i];					 $Userlistingimages->drg_sitelink = $_POST['drg_sitelink'][$i];					 $Userlistingimages->drg_videolink = $_POST['drg_videolink'][$i];                     $Userlistingimages->drg_lid =  $id;                     $Userlistingimages->save();                 }                                               }
			if($_POST['Listings']['drg_video1']!="")
			{
			$model->drg_video1=$_POST['Listings']['drg_video1']; 
			}
			if($_POST['Listings']['drg_video2']!="")
			{
			$model->drg_video2=$_POST['Listings']['drg_video2']; 
			}
		
			if($model->save())
			{
			
			if($_POST['update'])
			{
	$vid1=$_POST['Listings']['drg_video1'];
			$cvid1=$_POST['drg_vid_1'];
$tvid1=str_replace('flv','mp4',$cvid1);
			$vid2=$_POST['Listings']['drg_video2'];
			$cvid2=$_POST['drg_vid_2'];
$tvid2=str_replace('flv','mp4',$cvid2);
			$lid=$model->drg_lid;
			$command = Yii::app()->db->createCommand();

$ppath2=$model->drg_uid;
$connection = Yii::app()->db;
$command = $connection->createCommand("select * from `drg_user` where `drg_uid`='$ppath2'");
$myresult = $command->queryRow();
$ppath3=$myresult['drg_id'];
$ppath1=$myresult['drg_username'];
$upath=$ppath1."_".$ppath3;
$path =  $_SERVER['DOCUMENT_ROOT'].'/'; 
$temp_dir=$path."temp/";
$cvidpath1= $path."upload/users/".$upath."/videos/".$cvid1;
$cvidpath2= $path."upload/users/".$upath."/videos/".$cvid2;  
$tvidpath1=$path."temp/".$tvid1;
$tvidpath2=$path."temp/".$tvid2;  
if($vid1!="")
{
unlink($cvidpath1);
unlink($tvidpath1);
}
if($vid2!="")
{
unlink($cvidpath2);
unlink($tvidpath2);
}
			
		$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
				$to = $user_details[0]['drg_email'];
				$subject = "User listing update notification";
				$controller = Yii::app()->controller->action->id; 
			
				$yii_user_request_id1 = Yii::app()->getBaseUrl(true)."/"."listing"."/"."fupdate"."/listid/".$model->drg_lid;
				$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."fupdate"."/listid/".$model->drg_lid.'" target="_blank" >here >> </a>';
			
						
						$template =  MailTemplate::getTemplate('Listing_update');
								$subjectcc=$model['drg_title']." update notification";
  $sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >here >> </a>';
    $adminmsg="<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>".$_POST['changes']."</p>";


	   $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model['drg_title']),
						'{{#USERNAME#}}'=>ucwords($user_details[0]['drg_name'] .' '. $user_details[0]['drg_surname']),
                        '{{#MESSAGE#}}'=>ucwords($adminmsg),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id)
                    );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body); 
					
				

				
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
	   
        $model= new Listings('search');  
        $criteria = new CDbCriteria;  
      
        if(isset($_REQUEST['username']) && $_REQUEST['username'] !="" ){ 
            
            $Data = User::model()->findAll("LOWER(drg_username) like '%".addslashes(strtolower($_REQUEST['username']))."%'"); 
             
            if($Data){
            
                foreach($Data as $rsData){
            
                   $ids[]= $rsData->drg_uid;                      
            
                } 
                //$ids1 = array(rtrim($ids,','));
                $criteria->addInCondition('drg_uid',$ids);
            }    
        } 
         if(isset($_REQUEST['drg_categorys']) && $_REQUEST['drg_categorys'] !="" ){          
                  
              $criteria->compare('drg_category',addslashes($_REQUEST['drg_categorys']),true);           
        }         
        
         if(isset($_REQUEST['drg_profession']) && $_REQUEST['drg_profession'] !="" ){ 
            
            $criteria->compare('drg_profession',addslashes($_REQUEST['drg_profession']),true); 
        } 
        
        
         if(isset($_REQUEST['drg_viewlimit']) && $_REQUEST['drg_viewlimit'] !="" ){ 
            
            $criteria->compare('drg_viewlimit',addslashes($_REQUEST['drg_viewlimit']),true); 
        } 
        
        
         if(isset($_REQUEST['drg_title']) && $_REQUEST['drg_title'] !="" ){ 
            $criteria->compare('drg_title',addslashes($_REQUEST['drg_title']),true); 
          
        } 
        
        
         if(isset($_REQUEST['Keyword']) && $_REQUEST['Keyword'] !="" ){ 
             $criteria->compare('drg_keyword',addslashes($_REQUEST['Keyword']),true); 
        
        } 
        
        $criteria->order = 'drg_lid desc';
         
         
        
        
        $total = Listings::model()->count($criteria); 
    
        if(isset($_REQUEST['rows'])){
        	$count = $_REQUEST['rows'];
        }else {
        	$count = 5;
        } 
        
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  // the trick is here!
	 
       $posts = Listings::model()->findAll($criteria);

       $this->render('index',array('model'=>$model,
		'list'=>$posts,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size'=>Yii::app()->params['listPerPage'],
        
        )) ;
		
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
			$model->drg_deletedate = date('Y-m-d H:i:s');
			if($model->save()){ 
			
			if($_POST['delete'])
			{
			
			$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));
			
			$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."rdelete"."/listid/".$model->drg_lid.'" target="_blank" >here >> </a>';

			$to = $user_details[0]['drg_email'];
			$subject = "User listing deletion notification";
			
							$template =  MailTemplate::getTemplate('Listing_mark_delete');
								$subjectcc="Listing ".$model['drg_title']." has been marked for deletion ";
   $adminmsg="<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>".$_POST['deletionval']."</p>";
  $sitelink='<a href="'.Yii::app()->getBaseUrl(true)."/page/faq".'" target="_blank" >here >> </a>';

	   $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model['drg_title']),
						'{{#USERNAME#}}'=>ucwords($user_details[0]['drg_name'] .' '. $user_details[0]['drg_surname']),
						'{{#MESSAGE#}}'=>ucwords($adminmsg),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
						'{{#SITELINK#}}'=>ucwords($sitelink),
                                            );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body); 
					
			      	    
			}$this->redirect(array('index'));
                //$this->render('update',array('model'=>$model,));
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
			
			$controller = Yii::app()->controller->action->id; 
			$status="Published";
			$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."view?id=".$model->drg_lid.'" target="_blank" >here >> </a>';
			
				$template =  MailTemplate::getTemplate('user_listing_publish');
								$subjectcc=$model['drg_title']." has been successfully published";
  $sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >here >> </a>';
     $llink='<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."selectlisting"."/"."listid"."/".$model->drg_lid.'" target="_blank" >here >> </a>';
	   	$ltitle="<font color='orange'><i>".$model['drg_title']."</i></font>";
	   		        $ldate="<font color='orange'><i>".$model['drg_date']."</i></font>";
			        $lstatus="<font color='#15c'><i>".$status."</i></font>";

	   $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($ltitle),
						'{{#USERNAME#}}'=>ucwords($user_details[0]['drg_name'] .' '. $user_details[0]['drg_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($ldate),
						'{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
						'{{#SITELINK#}}'=>ucwords($sitelink),
						'{{#LLINK#}}'=>ucwords($llink)                       
                    );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);  
		
		
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
		$this->redirect(array('index'));
		
			
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
			
						$template =  MailTemplate::getTemplate('Listing_rejection');
								$subjectcc=$model['drg_title']." rejection notification";
  $sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >here >> </a>';
    $rmessage="<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>".$_POST['rejectval']."</p>";

	   $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model['drg_title']),
						'{{#USERNAME#}}'=>ucwords($user_details[0]['drg_name'] .' '. $user_details[0]['drg_surname']),
                        '{{#MESSAGE#}}'=>ucwords($rmessage),
						'{{#SITELINK#}}'=>ucwords($sitelink)
                    );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);  
			
							
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
		 	$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."suspensed"."/listid/".$model->drg_lid.'" target="_blank" >here >> </a>';
			
$template =  MailTemplate::getTemplate('Listing_suspension');
$subjectcc=" Listing ".$data['drg_title']." suspension notice";
 $adminmsg="<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>".$_POST['suspensionval']."</p>";

$string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($data['drg_title']),
                        '{{#USERNAME#}}'=>ucwords($user_details[0]['drg_name'].' '.$user_details[0]['drg_surname']),
                        '{{#MESSAGE#}}'=>ucwords($adminmsg),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id)					
                        );
$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
$result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);
						
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
			if($model->save()){ 						  			$user_details = User::model()->findAllByAttributes(array("drg_uid"=>$model->drg_uid));			$to = $user_details[0]['drg_email'];			$controller = Yii::app()->controller->action->id; 		    $site=Yii::app()->getBaseUrl(true);						$sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >'.$site.'</a>';			            $template =  MailTemplate::getTemplate('Listing_restore');            $subjectcc=" Listing ".$model->drg_title." has been restored";            $string = array(                        '{{#LISTINGTITLE#}}'=>ucwords($model->drg_title),                        '{{#USERNAME#}}'=>ucwords($user_details[0]['drg_name'].' '.$user_details[0]['drg_surname']),                        '{{#SITELINK#}}'=>ucwords($sitelink)					                        );            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);            $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);			
              //$this->render('update',array('model'=>$model,));			  
            }else {
               $this->render('update',array('model'=>$model,));
            } 				 $this->redirect(array('index'));
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
    
    
    
  /*  echo Yii::getPathOfAlias('webroot.upload.users.'.$userData->drg_username.'_'.$userData->drg_id).'/videos/'.$filename;
    die; */
   
    @EDownloadHelper::download(Yii::getPathOfAlias('webroot.upload.users.'.$userData->drg_username.'_'.$userData->drg_id).'/videos/'.$filename);
    return;
}	
	
}