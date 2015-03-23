<?php

class ContentsController extends Controller
{
    public $metaDesc;
    public $metaKeys;
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';
    
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
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','update','create','view'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	
        $model=new Contents;
        $model->status = 1;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Contents']))
		{
            $model->attributes=$_POST['Contents'];
            $redirectTo = false;

            if($model->parent!="")
            {
                $display_order=$model->getMaxDisplayOrder($model->parent);
                $model->display_order=$display_order+1;

                $redirectTo = true;
            }
            
            $meta_title=$model->meta_title;
            if($meta_title=="")
            {
                $meta_title=$model->title; 
            }
            $meta_desc=$model->meta_desc;
            if($meta_desc=="")
            {
                $meta_desc=substr(strip_tags($model->desc),0,160);
                $whiteSpace = '\s'; //if you dnt even want to allow white-space set it to ''
                $pattern = '/[^a-zA-Z0-9-' . $whiteSpace . ']/u';
                $meta_desc = preg_replace($pattern, '', (string) $meta_desc);
                $meta_desc= str_replace("\t",'',$meta_desc);
            }
            
            /*$page_seo=$model->page_seo;
            if($page_seo=="")
            {
                $page_seo=$meta_title." , ". $meta_desc;
            }*/
            
            $model->meta_title=$meta_title;
            $model->meta_desc=$meta_desc;
            //$model->meta_keywords=$_POST['Contents']['meta_keywords'];
            $model->created_date=time();
            //$model->page_seo=$page_seo;
            
			if($model->save())
			{
				CommonClass::makePageSlug($model, $model->title, $model->id);

				Yii::app()->user->setFlash('success', '<strong>Success!</strong> Your page created successfully.');
				$this->redirect(array('index'));
			}else
			{
				 Yii::app()->user->setFlash('error', '<strong>Error!</strong> Failed to create page!');
			}
                
		}

		$this->render('create',array(
			'model'=>$model,
		));
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
		//$this->performAjaxValidation($model);

		if(isset($_POST['Contents']))
		{
			$model->attributes=$_POST['Contents'];
            if(isset($_POST['Contents']['meta_desc']))
            	$meta_desc=$_POST['Contents']['meta_desc'];
            else
            	$meta_desc='';
            if($meta_desc=="")
            {
                $meta_desc=substr(strip_tags($model->desc),0,160);
                $whiteSpace = '\s'; //if you dnt even want to allow white-space set it to ''
                $pattern = '/[^a-zA-Z0-9-' . $whiteSpace . ']/u';
                $meta_desc = preg_replace($pattern, '', (string) $meta_desc);
                $meta_desc= str_replace("\t",'',$meta_desc);
            }
            else{        
                $meta_desc=$_POST['Contents']['meta_desc'];
            }
            $model->meta_desc=$meta_desc;
            //$model->meta_keywords=$_POST['Contents']['meta_keywords'];
            
            if(isset($_POST['Contents']['meta_title']))
            	$meta_title=$_POST['Contents']['meta_title'];
            else
            	$meta_title='';
            $model->created_date=time();
            if($meta_title=="")
            {
                $meta_title=substr(strip_tags($model->title),0,60);
                $whiteSpace = '\s'; //if you dnt even want to allow white-space set it to ''
                $pattern = '/[^a-zA-Z0-9-' . $whiteSpace . ']/u';
                $meta_title = preg_replace($pattern, '', (string) $meta_title);
                $meta_title= str_replace("\t",'',$meta_title);
            }
            else{        
                $model->meta_title = $_POST['Contents']['meta_title'];
            }
            //$model->meta_title = $_POST['Contents']['meta_title'];            

			if($model->save()){
				CommonClass::makePageSlug($model, $model->title, $model->id);
				Yii::app()->user->setFlash('success', '<strong>Success!</strong> Your page updated successfully.');
               	$this->redirect(array('index'));
            }else
			{
				 Yii::app()->user->setFlash('error', '<strong>Error!</strong> Failed to update page!');
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{ 
		$this->loadModel($id)->delete();  
		$this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new Contents('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contents']))
			$model->attributes=$_GET['Contents'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contents('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contents']))
			$model->attributes=$_GET['Contents'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Contents::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contents-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSort2()
	{
	    if (isset($_GET['list'])) {
	        $items=$_GET['list'];
	        $items=explode(',',$items);
	        if(is_array($items))
	        {
	          $i = 1;
	          foreach ($items as $item) {
	                $model=$this->loadModel($item);
	                $model->display_order = $i;
	                $model->save();
	                $i++;
	          }
	       	echo '<div id="successmsg">Successfully saved.</div>';
	       	//make the success message disappear slowly
	       	echo '<script type="text/javascript">$(document).ready(function(){ $("#successmsg").fadeOut(2000); });</script>';  
	        }
	    }
	}
    
    public function actionSort() {
        $ids = $_GET['list'];
        if (empty($ids) || !is_array($ids)) {
            die();
        }
        $order = 1;
        foreach ($ids as $id) {
           Contents::model()->updateByPk($id, array('display_order' => $order));
            $order++;
        }

       /* if ($update)
            echo "updated";
        else
            echo ":(";*/
        echo '<div id="successmsg">Successfully saved.</div>';
        //make the success message disappear slowly
        echo '<script type="text/javascript">$(document).ready(function(){ $("#successmsg").fadeOut(2000); });</script>';
        die();
        }

    
  //   public function actionManage($id='')
  //   {
		// if($id)
		// 	$model=Contents::model()->findAll(array('condition'=>'parent='.$id,'order'=>'display_order'));
		// else
  //           $model=Contents::model()->findAll(array('condition'=>'parent=0','order'=>'display_order')); 
       	
  //       $this->render('manage',array(
		// 	'model'=>$model,
		// ));
  //   }
  
    public function actionManage($id = '') {
        if ($id)
            $model = Contents::model()->findAll(array('condition' => 'id=' . $id, 'order' => 'display_order'));
        else
            $model = Contents::model()->findAll(array('condition' => 'parent=0', 'order' => 'display_order'));

        $this->render('manage', array(
            'model' => $model,
        ));
    }

  //   public function actionAdminEmail()
  //   {
  //   	$model = AdminEmail::model()->findByAttributes(array('type'=>'pages'));
  //       if(!isset($model) && $model=='') $model = new AdminEmail;
        
  //       if(isset($_POST['AdminEmail'])){
  //           $model->attributes = $_POST['AdminEmail'];
  //           if($model->save()){
  //               Yii::app()->user->setFlash('success', '<strong>Success!</strong> Admin Email updated successfully.');
  //           }
  //       }

		// $this->render('adminemail',array('model'=>$model));
  //   }
}
