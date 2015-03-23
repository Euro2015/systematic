<?php

class UsersController extends Controller
{
    public function filters()
    {
        return array( 
        'accessControl' ,// perform access control for CRUD operations
        'postOnly + delete', // we only allow deletion via POST request
        ); 
    }
    
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('login','logout','index'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','index','view'),
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
    
	public function actionIndex()	{
		
        if(!Yii::app()->user->isGuest){           
           $redirect = Yii::app()->createUrl('dasboard'); 
           $this->redirect($redirect);           
        }else {
            $this->redirect(Yii::app()->baseUrl);
        }
   }
    
    public function actionLogin(){
                        
            $model = new Adminuser;
            // uncomment the following code to enable ajax-based validation
             
             if(isset($_POST['ajax']) && $_POST['ajax']==='adminuser-login-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            if(isset($_POST['Adminuser']))
            {
                $model->attributes=$_POST['Adminuser'];                 
                if($model->validate() && $model->login()){   
                    $redirect = Yii::app()->createUrl('dashboard');
                    $this->redirect($redirect);
                    
                }else {
                    $this->render('login',array('model'=>$model));
                }
            }else if(Yii::app()->user->isGuest)  {                
              $this->render('login',array('model'=>$model));
            } 
            else {
                self::actionIndex();
            }
             
             
        
    }
    public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
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
}