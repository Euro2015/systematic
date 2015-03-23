<?php
class UserController extends Controller
{    
  public $defaultAction = 'login';    
  //public $layout='//layouts/none';
    
  public function actionIndex()
  {
    //$this->render('index');
        $this->redirect('/');
  }
    
    
  
  
}