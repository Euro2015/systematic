<?php

class LoginController extends Controller
{
   /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
    public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'login' actions.
				'actions'=>array('index','login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionIndex()
	{
        if(Yii::app()->user->id)
        {
            $this->redirect(array('/admin/dashboard'));
        }
        //$this->layout='adminIndex';
        $model=new LoginForm();
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                            
                            $log = new LogtransactionAdmin(); 
                            $log->admin_id   = Yii::app()->user->Id;
                            $log->log_id = 2;
                            $log->transaction_description =  Yii::app()->user->name.' has been login successfully';
                            $log->transaction_date = date('Y-m-d h:i:s'); 
                            $log->ip_address = getenv('REMOTE_ADDR');
                            $log->save();                            

                            $this->redirect(array('/admin/dashboard'));
                        }
		}
		// display the login form
        $this->render('index',array('model'=>$model));
	}
    public function actionLogout()
	{
        
                $log = new LogtransactionAdmin(); 
                $log->admin_id   = Yii::app()->user->Id;
                $log->log_id = 3;
                $log->transaction_description =  Yii::app()->user->name.' has been logout successfully';
                $log->transaction_date = date('Y-m-d h:i:s');
                $log->ip_address = getenv('REMOTE_ADDR');                
                $log->save();
        
		Yii::app()->user->logout(false);
		$this->redirect(Yii::app()->getModule('admin')->user->loginUrl);
	}
}