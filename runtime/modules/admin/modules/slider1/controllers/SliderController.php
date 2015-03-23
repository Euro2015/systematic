<?php
class SliderController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','index','update','create','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionCreate()
	{
		$model=new Slider;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Slider']))
		{
			$model->attributes=$_POST['Slider'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', 'Slider Updated Successfully.');
				$this->redirect(array('view','id'=>$model->drg_lid));
			}
		}

		$this->render('create',array('model'=>$model,));
	}
	
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);
		if(isset($_POST['Slider']))
		{
			$data = $_REQUEST['drg_fprojections1'].",".$_REQUEST['drg_fprojections2'].",".$_REQUEST['drg_fprojections3'].",".$_REQUEST['drg_fprojections4'].",".$_REQUEST['drg_fprojections5'].",".$_REQUEST['drg_fprojections6'];
			$model->drg_financial_data=$_REQUEST['drg_financial_data'];
			$model->drg_famount = $_REQUEST['drg_famount'];
			$model->drg_reporttime = $_REQUEST['drg_reporttime'];
			$model->drg_fprojections=$data;
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
						  $this->redirect(array('index'));
			}	
		}
		
		
		
		$this->render('update',array(
			'model'=>$model,
		));
	}	
	
	public function loadModel($id)
	{
		$model=Slider::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function actionIndex()
	{
	   
        $model= new Slider('search');  
        $criteria = new CDbCriteria;  
      
               
         if(isset($_REQUEST['slider_name']) && $_REQUEST['slider_name'] !="" ){ 
            $criteria->compare('slider_name',addslashes($_REQUEST['slider_name']),true); 
          
        } 
               
        $criteria->order = 'slider_id desc';
        
        $total = Slider::model()->count($criteria); 
    
        if(isset($_REQUEST['rows'])){
        	$count = $_REQUEST['rows'];
        }else {
        	$count = 5;
        } 
        
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  // the trick is here!
	 
       $posts = Slider::model()->findAll($criteria);

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

}