<?php



class ContactController extends Controller

{

	public function actionIndex()

	{
	
	$this->pageTitle='Contact Us - Business Supermarket';  

		if(isset($_POST['contactus']))
	 
	 {

	     $fname = $_POST['attachment'];
		 
         $ffname=$_SERVER['DOCUMENT_ROOT']."/upload/attachments/".$fname;
  
	     $dept_email=$_POST['dept_email'];
		 
		 $uemail=$_POST['email'];
		 
		 $template =  MailTemplate::getTemplate('contact_us_admin');

   	     $string = array(
                        '{{#USERNAME#}}'=>ucwords($_POST['username']),
						'{{#EMAIL#}}'=>ucwords($_POST['email']),
                        '{{#SUBJECT#}}'=>ucwords($_POST['subject']),
						'{{#MSG#}}'=>ucwords($_POST['msg']),
                    );
					
		 $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
         $result =  SharedFunctions::app()->sendmail($dept_email,$template->template_subject,$body,$ffname); 
					
		 if($_POST['memail']=="yes")
         
		 {
					
		  $template1 =  MailTemplate::getTemplate('contact_us_user');
					 
		  $body1 = SharedFunctions::app()->mailStringReplace($template1->template_body,$string);
                    
          $result1 =  SharedFunctions::app()->sendmail($uemail,$template->template_subject,$body1,$ffname); 
			
		}
      
	     $this->render('success',array('model'=>$uemail));
	 
	 //$this->redirect(array('index'));
	 }
	 
	 else
	 
	 {
	 
        $this->render('index');
     }
	 
	}


}