<?php
class FeedbackController extends Controller
{
	public $layout='//layouts/column2';
	public function actionindex()
	{
		
		function _joinpath($dir1, $dir2) 
		{
		    return $file_reac=realpath($dir1 . '/' . $dir2."/runtime/application.log");
		}
		 
		$homePath      = dirname(__FILE__) . '/../..';
		//$protectedPath = _joinpath($homePath, 'protected');//create runtime directory path 
		
        $protectedPath=Yii::getPathOfAlias('application.runtime').'/application.log';
       
        $file = fopen($protectedPath, "r"); 
        
		$fp=Yii::app()->getBaseUrl()."/";
		$fp = fopen( 'log.txt', 'w' );
		while(!feof($file))
		{
			$line= fgets($file);
			# do same stuff with the $line 
			$fp = fopen('log.txt', 'a+'); 
	       
			fseek($fp, 0, SEEK_SET); //MOVES THE CURSOR 0 PLACES FROM START OF THE FILE
			fwrite($fp, $line."\n");
		} 
		fclose($file);
 		$htmlbody = $_POST['msg']."\r\n \r\n".$_POST['url']."\r\n \r\n";
        
        $htmlbody .= ' From  Username : '.Yii::app()->user->getState('username') ;
       // array with filenames to be sent as attachment
        $files = array("log.txt");
         
        // email fields: to, from, subject, and so on
       $to = "jitendra@artifex-online.com;rajiv@artifex-online.com;dsp7@blueyonder.co.uk";     
        //$to = "jitendra@artifex-online.com;"; 
        $subject = " Feed Back "; //Email Subject        
        $headers = "From: ".$_POST['email']."\r\nReply-To: ".$_POST['email']."";
         
        // boundary
        $semi_rand = md5(time());
        
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
         
        // headers for attachment
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
         
        // multipart boundary
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $htmlbody . "\n\n";
        $message .= "--{$mime_boundary}\n";
         
        // preparing attachments
        $attachment = chunk_split(base64_encode(file_get_contents('http://business-supermarket.com/log.txt')));   
        $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$files[$x]\"\n" .
        "Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" .
        "Content-Transfer-Encoding: base64\n\n" . $attachment . "\n\n";
        $message .= "--{$mime_boundary}\n";  
    
		$mail_sent = @mail( $to, $subject,  $message, $headers );  
        
		$this->redirect($_POST['url'].'/?action=success'); 
        
	}
	function actionviewcall()
	{
		$this->render('feedbackthanks');
	}
}
