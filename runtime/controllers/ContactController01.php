<?php

class ContactController extends Controller
{
	public function actionIndex()
	{
		$drg_subject = Yii::app()->request->getParam('drg_subject');
        $drg_username = Yii::app()->request->getParam('drg_username');
        $drg_surname = Yii::app()->request->getParam('drg_surname');
        $drg_email = Yii::app()->request->getParam('drg_email');
        $drg_message = Yii::app()->request->getParam('drg_message');
        $emailto = Yii::app()->params['company_email'];
         
        if($drg_subject !="" &&  $drg_username !="" && $drg_surname !="" && $drg_email !="" && $drg_message !=""){
               
                
                $string = array(
                    '{{#USERNAME#}}'=>ucwords($drg_username),
                    '{{#SURNAME#}}'=>ucwords($drg_surname),
                    '{{#MESSAGE#}}'=>$drg_message,
                    '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                    '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                );
            $template =  Mailtemplate::model()->findByAttributes(array('template_id'=>1));     
            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);            
            $result =  SharedFunctions::app()->sendmail($emailto,$drg_subject,$body,false,false,$drg_email); 
            if($result){
                //$this->render('index',array('res'=>true));
                $this->redirect(yii::app()->createUrl('contact/mailsent'));
            } 
            
        }
        $this->render('index');
	}
    
    public function actionMailsent(){
        $this->render('mail_popup');
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