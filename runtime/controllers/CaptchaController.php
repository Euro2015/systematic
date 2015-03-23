<?php
class CaptchaController extends Controller
{
	   public function actionIndex(){
	    
            $capchacode = Yii::app()->getParams('captcha');
            
            if($capchacode!="" && $securimage->check($capchacode)){
                   
                echo CJSON::encode(array('success'=>false,'message'=>"done"));
                Yii::app()->end();
                
            }else {
                echo CJSON::encode(array('success'=>false,'message'=>"Incorrect security code entered"));
                Yii::app()->end();
            } 
           
	   }
    
}