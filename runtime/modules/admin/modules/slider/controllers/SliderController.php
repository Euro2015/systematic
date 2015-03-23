<?php

class SliderController extends Controller
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','update','create','Imageupload','listingimage','ldelete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	  public function actionCreate(){
	  
	  $listid = Yii::app()->request->getParam('id');
        $this->pageTitle='create slider - Business Supermarket';
        if(isset($listid) && $listid !=""){            
            $model = Createsliderlisting::model()->find("slider_id  ='".$listid."'");   
            $model->attributes=$_POST['Createsliderlisting'];           
            
        }else {
            $model = new Createsliderlisting; 
            $model->attributes=$_POST['Createsliderlisting'];
        }
		
		
        
       if(isset($_POST['Createsliderlisting']))
		   {
		   
$title=$_POST['Createsliderlisting']['slider_title'];
$newtitle=str_replace(" ","_",$title);
$my_file = $newtitle.".php";
$_POST['Createsliderlisting']['page_slug']=$my_file ;

            	$model->attributes=$_POST['Createsliderlisting'];
                    
                if($model->save())
    			{    
    		 	
	 					//$this->redirect(Yii::app()->createUrl('admin/slider/slider'));
					

                }
            

$baseurl=Yii::app()->theme->baseUrl;
$surl=Yii::app()->getBaseUrl(true); 
$path1 = $_SERVER['DOCUMENT_ROOT'].''; 
$tpath=Yii::app()->theme->baseUrl;
$me=$path1.$baseurl."/views/slider/";
$newfile=$me.$my_file;

$handle = fopen($newfile, 'w') or die('Cannot open file:  '.$newfile);
$data .="<div class='home-slider-wrap'><div id='carousel-wrapper'><div id='dragongallery' class='stepcarousel'><div class='belt'>";

		   if($_POST['slider_imagedesc']){
           
		   
		   $connection = Yii::app()->db;
$command = $connection->createCommand("select * from `drg_slider_listing` order by slider_id desc limit 1");
$myresult = $command->queryRow();

	
            /****************************/
            if(isset($_POST['old_img_name'])){
             
                for($i=1;$i<count($_POST['old_img_name']);$i++){ 
                    
                    if($_POST['old_img_name'][$i]!=""){
                    
                        $whosloggedin = Sliderlistingimages::model()->find('slider_image=:imagename',array(':imagename'=>$_POST['old_img_name'][$i]) ); 
                        $whosloggedin->delete();
                        
                    } 
                }
             
             }

if($listid!="")
		{
Sliderlistingimages::model()->deleteAll("slider_id  ='".$listid."'");
Sliderbtns::model()->deleteAll("slider_id  ='".$listid."'");

     
		}


if($listid=="")
		{
		$listid=$myresult['slider_id'];
		}
                    
            for($i=0;$i<count($_POST['img_name']);$i++){ 
			
     
                 if($_POST['img_name'][$i]!=""){
                    
                     $Sliderlistingimages = new Sliderlistingimages;
                     $Sliderlistingimages->slider_image = $_POST['img_name'][$i];
                     $Sliderlistingimages->slider_imagedesc = $_POST['slider_imagedesc'][$i];
					  if($_POST['slider_sitelink'][$i]!=""){
		             $Sliderlistingimages->slider_sitelink = $_POST['slider_sitelink'][$i];
					  $Sliderlistingimages->slider_videolink = "";
					 }
					 else  if($_POST['img_name'][$i]!=""){
					 $Sliderlistingimages->slider_sitelink = "";
					  $Sliderlistingimages->slider_videolink = $_POST['slider_videolink'][$i];
					  }
                     $Sliderlistingimages->slider_id = $listid;
                     $Sliderlistingimages->save();
$simg=$_POST['img_name'][$i];
$sdesc=$_POST['slider_imagedesc'][$i];
$slink=$_POST['slider_sitelink'][$i];
$vlink=$_POST['slider_videolink'][$i];


$data .="<div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>$sdesc<br />";

if($_POST['slider_sitelink'][$i]!="")
{
$data .="<a href='$slink'  title='' target='_blank' >Find out more ></a>";
}
else if($_POST['slider_videolink'][$i]!="")
{
$data .="<a href=javascript:void(0) onclick=\"show_video('$vlink');\" title='' >Find out more ></a>";
}
$data .="</p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png'>
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/$simg' alt='$desc' style='float: right;position: relative;overflow: hidden;height: 287px; margin-top: -295px;margin-right: 24px;'/>
                                </div>";					
                 }                
                   
            }
       
         
        } 
		$data .="<!-- /panel -->

                            <!-- End of carousel content -->

                        </div>

                        <!-- /belt -->

                    </div>

                    <p class='hideme'> <b>Current Panel:</b> <span id='statusA'></span> <b style='margin-left: 30px'>Total Panels:</b> <span id='statusC'></span> </p>

                    <div id='gallery-navigation'>

                        <p id='dragongallery-paginate' style='width: 740px'> <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/opencircle.png' alt='Dragonsnet business supermarket navigation buttons' data-over='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/graycircle.png' data-select='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/closedcircle.png' data-moveby='1' /> </p>

                    </div>

                    <!-- /gallery-navigation -->                  <div id='search-tab'>

                        <input type='text' onblur='this.value='Search site...';' onfocus='this.value='';' value='Search site...'>

                        <a href='user_listing_search.php' title='Search the site' >

                            <input type='submit' value=''>

                        </a> </div>

                    <!-- /search-tab -->

                </div>

                <!-- /carousel-wrapper -->

            </div>

            <!-- /slider-wrapper ends here -->          <div class='home-video-wrap' style='display:none'> <!-- slider-wrapper start--->

                <a href='javascript:void(0)' onclick='show_slider();' class='video-close'><img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/close.png' alt='business supermarket close button' width='24' />

                </a>

                <div id='carousel-wrapper'>

                    <div id='dragongallery' class='stepcarousel'>

                        <div id='my-video'></div>

                      <script type='text/javascript'>                      </script>

                    </div>

                    <!-- /dragongallery End -->

                </div>

                <!-- /carousel-wrapper End -->

            </div>
			<script type='text/javascript'>

    function show_video(video)

    {

        $('.home-slider-wrap').fadeOut();

        $('.home-video-wrap').fadeIn('slow');

        jwplayer('my-video').setup({

            file: video,

            image: '<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/robot/defult-video.png',

            width: '640',

            height: '360',

            autostart:'true',

            events: {

                onComplete: function() { window.location='../index.php'; }

            }

        });



    }



    function show_slider()

    {

        $('.home-slider-wrap').fadeIn('slow');

        $('.home-video-wrap').fadeOut('fast');

    }

</script>
";
           fwrite($handle, $data);
		   
		     for($i=0;$i<count($_POST['btn_text']);$i++){ 
			
     
                 if($_POST['btn_text'][$i]!=""){
                    
                     $Sliderbtns = new Sliderbtns;
                     $Sliderbtns->btn_image = $_POST['btn_image'][$i];
                     $Sliderbtns->btn_text = $_POST['btn_text'][$i];
		     $Sliderbtns->btn_sitelink = $_POST['btn_sitelink'][$i];
                     $Sliderbtns->btn_videolink = $_POST['btn_videolink'][$i];
                     $Sliderbtns->slider_id = $listid;
                     $Sliderbtns->save();
					 }
					 }
					 
 $this->redirect(Yii::app()->createUrl('admin/slider/slider'));
 }
		
		$this->render('create',array('model'=>$model,));
		
          
/*		  $this->pageTitle='Create Slider - Business Supermarket';
		   
        $model=new Slider;

		
		if(isset($_POST['Sliderlisting']))
		{
			$model->attributes=$_POST['Sliderlisting'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));*/
        // $id = Yii::app()->request->getParam('sliderid');
          
         //$model = Createsliderlisting::model()->find("slider_id ='".$sliderid."'");   
      

    }
	
	
   
    /**
    * Image upload from userlist step 2
    * 
    *     
    **/
    
    public function actionImageupload(){  
        
        Yii::import("ext.EAjaxUpload.qqFileUploader"); 
         
        
        $thumb = 'upload/users/'.Yii::app()->user->getState('ufolder').'/listing/thumb/';// folder for uploaded files
                
        if (!file_exists($thumb)) {
		  mkdir($thumb, 0777, true);
        }
        
        $videos = 'upload/users/'.Yii::app()->user->getState('ufolder').'/videos';// folder for uploaded files
                
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
        
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        
               
        $result = $uploader->handleUpload($big); 
        
        
        //$uploader->handleUpload($thumb);
        
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize = filesize($big.$result['filename']);//GETTING FILE SIZE
        
        $fileName = $result['filename'];//GETTING FILE NAME   
       
        SharedFunctions::app()->imagethumb($big.$result['filename'], $thumb.$result['filename'], 250); 
        
        
        echo $return;// it's array    
            
    }
    
   
     
	
    /**
    * Image upload from userlist step 3
    * 
    *     
    **/
    public function actionListingimage(){  
        
        Yii::import("ext.EAjaxUpload.qqFileUploader"); 
         
        
        $thumb = 'upload/sliders/thumb/';// folder for uploaded files
                
        if (!file_exists($thumb)) {
		  mkdir($thumb, 0777, true);
        }
        
             
        $big = 'upload/sliders/big/';// folder for uploaded files
                
        if (!file_exists($big)) {
		  mkdir($big, 0777, true);
        }
        
              
        $allowedExtensions = array("jpg",'png','gif');//array("jpg","jpeg","gif","exe","mov" and etc...
        
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        
               
        $result = $uploader->handleUpload($big);
        
        //$uploader->handleUpload($thumb);
        
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize = filesize($big.$result['filename']);//GETTING FILE SIZE
        
        $fileName = $result['filename'];//GETTING FILE NAME   
        
        SharedFunctions::app()->imagethumb($big.$result['filename'], $thumb.$result['filename'], 140);   
        
        echo $return;// it's array
        
            
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sliderlisting']))
		{
			$model->attributes=$_POST['Sliderlisting'];
            		if($model->save())
			{
			      $this->redirect(array('slider/slider'));
			}	
            //$this->redirect(array('view','id'=>$model->drg_lid));
		}
		   
         if($_POST['img_desc']){
           
       
            
            $i=0;            
            for($i=0;$i<6;$i++){ 
     
                 if($_POST['img_name'][$i]!=""){
                    
                     $Sliderlistingimages = new Sliderlistingimages;
                     $Sliderlistingimages->slider_image = $_POST['img_name'][$i];
                     $Sliderlistingimages->slider_imagedesc = $_POST['img_desc'][$i];
                     $Sliderlistingimages->slider_id =  $id;
                     $Sliderlistingimages->save();
                 }                
                   
            }
         
             $this->redirect(Yii::app()->createUrl('admin/slider/slider'));
        } 

	
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		
	}

	public function actionLdelete($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(Yii::app()->createUrl('admin/slider/slider'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{ 	 
	 
           
        /**
         * Listing waiting for publication 
        **/     
         $model= new Slider('search'); 
        $criteria = new CDbCriteria;
        $criteria->order = 'slider_id desc';
        $total = Slider::model()->count($criteria);        
        
        if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 20;
        }

        
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  
        $posts = Slider::model()->findAll($criteria);
        
       $this->render('index',array('model'=>$model,
		'list'=>$posts,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size' => Yii::app()->params['listPerPage'],      
        )) ;
        
        
        
	}

 
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Userlisting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sliderlisting']))
			$model->attributes=$_GET['Sliderlisting'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Userlisting the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Slider::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
}