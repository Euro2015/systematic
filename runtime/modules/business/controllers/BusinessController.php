<?php
class BusinessController extends Controller
{    
  public $defaultAction = 'login';    
  //public $layout='//layouts/none';
    
  public function actionIndex()
  {
        $this->redirect('/');
  }
    
    
  public function actionLogin()
  {
      
        $model = new LoginForm;
            // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
          echo CActiveForm::validate($model);
          Yii::app()->end();
        } 
   
        if(isset($_POST['LoginForm']))
        {     
          $model->attributes=$_POST['LoginForm'];
                
                if($model->validate() && $model->login()){  
                    
                   $log = new Logtransaction(); 
                   $log->member_id   = Yii::app()->user->Id;
                   $log->log_id = 2;
                   $log->transaction_description =  Yii::app()->user->name.' has been login successfully';
                   $log->transaction_date = date('Y-m-d h:i:s'); 
                   $log->save();                   
                   $msg = array('success'=>'true','redirect'=>Yii::app()->user->returnUrl); 
                   
                }else {
                    $msg = array('success'=>'false','redirect'=>Yii::app()->user->returnUrl);
                }
        }
            if(!empty($msg)){
                echo CJSON::encode($msg);
                Yii::app()->end();
            }else {
                $this->redirect(Yii::app()->homeUrl);
            }
         
  }
    
    public function actionForget(){
        
    if(isset($_POST['drg_lost_email']))
  {
              $codeActive =  Yii::app()->getRequest()->getParam('drg_lost_email');
                
             if(isset($codeActive)){
                      
               $userData =  User::model()->findAllByAttributes(array('drg_email'=>$codeActive));
               
                   if(!empty($userData)){ 
                           $newpass = rand(0,9999999999);
                           $template =  Mailtemplate::model()->findByAttributes(array('template_id'=>3)); 
                           $postRecord = User::model()->findByPk($userData[0]['drg_id']);
                           $postRecord->drg_active_link='';
                           $postRecord->drg_pstatus='1';
                           $postRecord->drg_pass=SharedFunctions::app()->encrypt_code($newpass); ;
                           $postRecord->save(); 
                           
                           $string = array(
                                    '{{#USERNAME#}}'=>ucwords($userData[0]['drg_name'] .' '.$userData[0]['drg_surname']),
                                    '{{#NEWPASSWORD#}}'=>'Your New password is : <b>'.$newpass.'</b>',  
                                    '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                                    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email'] 
                                    
                                    /*
                                    '{{#USEREMAIL#}}'=>ucwords($userData[0]['drg_name'] .' '.$userData[0]['drg_surname']),
                                    '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                                    */
                           );
                            
                            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
                              
                            SharedFunctions::app()->sendmail($userData[0]['drg_email'],$template->template_subject,$body); 
                               $msg = array('success'=>'true','redirect'=>Yii::app()->user->returnUrl); 
                                
                            
                            //$this->render('active',array('model'=>$userData[0])); 
                            
                            
                        
                    } else {
                        
                        $msg = array('success'=>'false','redirect'=>Yii::app()->user->returnUrl);
                        
                    }
                               
                
             }   
     
     }
        if(!empty($msg)){
            echo CJSON::encode($msg);
            Yii::app()->end();
        }else {
            $this->redirect(Yii::app()->homeUrl);
        }
        
    }
    
    public function actionLogout()
  {
        if(!Yii::app()->user->isGuest) { 
           $log = new Logtransaction(); 
           $log->member_id   = Yii::app()->user->Id;
           $log->log_id = 3;
           $log->transaction_description =  Yii::app()->user->name.' has been logout successfully';
           $log->transaction_date = date('Y-m-d h:i:s'); 
           $log->save();    
      Yii::app()->user->logout();
        }
    $this->redirect(Yii::app()->homeUrl);
  }

  
}