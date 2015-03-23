<?php

class DepartmentController extends Controller
{

    public function filters()
    {
        return array( 
        'accessControl' ,// perform access control for CRUD operations
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
				'actions'=>array('admin','index','create','ldelete'),
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
        $this->pageTitle='Create Department Emails - Business Supermarket';
        if(isset($listid) && $listid !=""){            
            $model = Department::model()->find("dept_id  ='".$listid."'");   
            $model->attributes=$_POST['Department'];           
            
        }else {
            $model = new Department; 
            $model->attributes=$_POST['Department'];
        }
		
		
        
       if(isset($_POST['Department']))
		   {

                if($model->save())
    			{    
    		 	
	 					//$this->redirect(Yii::app()->createUrl('admin/slider/slider'));
					

                }
     
          $this->redirect(Yii::app()->createUrl('admin/department'));
        } 
	$this->render('create',array('model'=>$model,));
					 

 }
		

	public function actionLdelete($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(Yii::app()->createUrl('admin/department'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{ 	 
	 
        /**
         * Listing waiting for publication 
        **/     
         $model= new Department('search'); 
        $criteria = new CDbCriteria;
        $criteria->order = 'dept_id desc';
        $total = Department::model()->count($criteria);        
        
        if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 20;
        }

        
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  
        $posts = Department::model()->findAll($criteria);
        
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
		if(isset($_GET['Department']))
			$model->attributes=$_GET['Department'];

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
		$model=Department::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
}
