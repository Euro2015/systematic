<?php 
class SharedFunctions {
    
    /**   $replceString = array(
            '{{#USERNAME#}}'=>'',
            '{{#COMPANY_NAME#}}'=>'',
            '{{#COMPANY_EMAIL#}}'=>'',
            '{{#COMPANY_ADDRESS#}}'=>'',
            '{{#BASEURL#}}'=>'',
            '{{#THEME_BASEURL#}}'=>'',
            '{{#ACCOUNT_ACTIVATION_LINK#}}'=>'',
            '{{#COMPANY_SIGNATURE#}}'=>''
        );
    **/
    
    public static function app() {
        return new SharedFunctions();
    } 
     
    public static function sendmail($to="",$subject="",$body="",$attachment = "",$cc=false,$from="") {
        
        $mail = new YiiMailer();  
        
        // Check From mail set or not
        
        if($from){
            $mail->setFrom($from,Yii::app()->params['company_name']);
        }
        else if($from =="") {
           $mail->setFrom(Yii::app()->params['company_email'],Yii::app()->params['company_name']);
        }
        
        // check to mail  more then one persone
        if($to !="" || !empty($to)){
            $mail->setTo($to);
        } 
        
        
        // check if any mail sent to cc more then one person
        if($cc!="" || !empty($cc)){
            $mail->setCc($cc);
        }        
        
        
        // Check subject is empty
        if($subject !=""){
            $mail->setSubject($subject);            
        }
        
        // Check any attachment or not
        if($attachment !="" || !empty($attachment)){
            $mail->setAttachment($attachment);
        }
        
        // check body empty or not
        if($body !="" || !empty($body)){
           $newstring = str_replace("{{BR}}","<br />",$body);  
           $mail->setBody($newstring);
        }
        
        
        if($mail->send()){
            return true;
        }
        return false;
    }

    public static function mailStringReplace($string="",$replceString=""){
        
        if(is_array($replceString)){
            
            $newstring = $string;
            
            foreach($replceString as $key=>$val){
               $newstring =  str_replace($key,$val,$newstring); 
               
            }
            
        }
        return $newstring;
    }
    
    public static function randvalue(){
        
        $random = substr(str_replace(" ","",date('Y m d')),0,10).substr(md5(time()),1,5).substr(str_replace(".","", Yii::app()->request->getUserHostAddress()),0,15).md5(substr(number_format(time() * rand(),0,'',''),0,5));
        return $random;      
        
    }
    
    
    /*Password check*/
    
    public static function encrypt_code($string){
        
       if($string !=""){ 
        return  md5($string);
    }
        
    }
    
    public static function validateEmail($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public static function check_captch($val){
        
        if ($securimage->check($val) == false) {
            echo CJSON::encode(array('success'=>false,'message'=>"Incorrect security code entered !",'captcha'=>true));
            Yii::app()->end();
        }
    }
    
    public static function insert_log($arrayData){
        
        if(is_array($arrayData)){ 
             $log = new Logtransaction(); 
             $log->member_id  = $arrayData['member_id'];
             $log->log_id = $arrayData['log_id'];
             $log->transaction_description =  $arrayData['description'];
             $log->transaction_date = date('Y-m-d h:i:s'); 
             $log->save();  
        }
        
    }
    
    public static function age($birthday){
            
             list($day,$month,$year) = explode("/",$birthday);
            
             $year_diff  = date("Y") - $year;
            
             $month_diff = date("m") - $month;
            
             $day_diff   = date("d") - $day;
            
             if ($day_diff < 0 && $month_diff==0){$year_diff--;}
            
             if ($day_diff < 0 && $month_diff < 0){$year_diff--;}
            
             return $year_diff;
  }

  public static function calculateage($dob){
        $dob = date("Y-m-d",strtotime($dob));
        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();
        $diff = $dobObject->diff($nowObject);
        return $diff->y;
    }

  function first_last_date($d=''){
      $d = $d?$d:time();
      $f = mktime(0,0,0,date("n",$d),1,date("Y",$d));
      $l = mktime(0,0,0,date("n",$d),date("t",$d),date("Y",$d));
      return array($f,$l);
  } 
  
  
    public static function get_user_names($d='')
    {
        $row = Yii::app()->db->createCommand(array(
            'select' => array( 'drg_username '),
            'from' => 'drg_user',
            'where' => 'drg_uid=:drg_uid',
            'params' => array(':drg_uid'=>$d),
        ))->queryRow();
        return $row[""];
    }
  
    public static function get_listingtype($d='')
    {
        $row = Yii::app()->db->createCommand(array(
        'select' => array( 'list_category_name '),
        'from' => 'drg_listing_category',
        'where' => 'list_category_id=:list_category_id',
        'params' => array(':list_category_id'=>$d),
        ))->queryRow();
        if($row[""]!="")
        {
          return $row[""];   
        }
        else
        {
           return "Default"; 
        }
       
    }
    
    /* user  for banner current symbol*/

    public static function _get_currency_symbol($CurrencyCode){
        
        if($CurrencyCode !=""){
            $symbol = '';
            switch ($CurrencyCode) {
                case 'USD':
                    $symbol = '$';
                    break;
                case 'GBP':
                    $symbol = '&pound;';
                    break;
                case 'EUR':
                    $symbol = '&euro;';
                    break;
                default :
                    $symbol = $CurrencyCode;
                    
            } 
            
        }
        return $symbol;        
    }
    
    public static function time_elapsed_string($datetime, $full = false) {
        
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string)  : 'just now';
    }
    
   public static function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
    {
      // open the directory
      $dir = opendir( $pathToImages );
    
      // loop through it, looking for any/all JPG files:
      while (false !== ($fname = readdir( $dir ))) {
        // parse path for the extension
        $info = pathinfo($pathToImages . $fname);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' ||  strtolower($info['extension']) == 'png' ||  strtolower($info['extension']) == 'gif'  )
        {
          //echo "Creating thumbnail for {$fname} <br />";
    
          // load image and get image size
          $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
          $width = imagesx( $img );
          $height = imagesy( $img );
    
          // calculate thumbnail size
          $new_width = $thumbWidth;
          $new_height = floor( $height * ( $thumbWidth / $width ) );
    
          // create a new temporary image
          $tmp_img = imagecreatetruecolor( $new_width, $new_height );
    
          // copy and resize old image into new image
          imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
    
          // save thumbnail into a file
          imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
        }
      }
      // close the directory
      closedir( $dir );
    }
    
    public static function imagethumb( $image_src , $image_dest = NULL , $max_size = 100, $expand = FALSE, $square = FALSE )
    {
    	 
        
        if( !file_exists($image_src) ) return FALSE;
    
    	// R�cup�re les infos de l'image
    	$fileinfo = getimagesize($image_src);
    	if( !$fileinfo ) return FALSE;
    
    	$width     = $fileinfo[0];
    	$height    = $fileinfo[1];
    	$type_mime = $fileinfo['mime'];
    	$type      = str_replace('image/', '', $type_mime);
    
    	if( !$expand && max($width, $height)<=$max_size && (!$square || ($square && $width==$height) ) )
    	{
    		// L'image est plus petite que max_size
    		if($image_dest)
    		{
    			return copy($image_src, $image_dest);
    		}
    		else
    		{
    			header('Content-Type: '. $type_mime);
    			return (boolean) readfile($image_src);
    		}
    	}
    
    	// Calcule les nouvelles dimensions
    	$ratio = $width / $height;
    
    	if( $square )
    	{
    		$new_width = $new_height = $max_size;
    
    		if( $ratio > 1 )
    		{
    			// Paysage
    			$src_y = 0;
    			$src_x = round( ($width - $height) / 2 );
    
    			$src_w = $src_h = $height;
    		}
    		else
    		{
    			// Portrait
    			$src_x = 0;
    			$src_y = round( ($height - $width) / 2 );
    
    			$src_w = $src_h = $width;
    		}
    	}
    	else
    	{
    		$src_x = $src_y = 0;
    		$src_w = $width;
    		$src_h = $height;
    
    		if ( $ratio > 1 )
    		{
    			// Paysage
    			$new_width  = $max_size;
    			$new_height = round( $max_size / $ratio );
    		}
    		else
    		{
    			// Portrait
    			$new_height = $max_size;
    			$new_width  = round( $max_size * $ratio );
    		}
    	}
    
    	// Ouvre l'image originale
    	$func = 'imagecreatefrom' . $type;
    	if( !function_exists($func) ) return FALSE;
    
    	$image_src = $func($image_src);
    	$new_image = imagecreatetruecolor($new_width,$new_height);
    
    	// Gestion de la transparence pour les png
    	if( $type=='png' )
    	{
    		imagealphablending($new_image,false);
    		if( function_exists('imagesavealpha') )
    			imagesavealpha($new_image,true);
    	}
    
    	// Gestion de la transparence pour les gif
    	elseif( $type=='gif' && imagecolortransparent($image_src)>=0 )
    	{
    		$transparent_index = imagecolortransparent($image_src);
    		$transparent_color = imagecolorsforindex($image_src, $transparent_index);
    		$transparent_index = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
    		imagefill($new_image, 0, 0, $transparent_index);
    		imagecolortransparent($new_image, $transparent_index);
    	}
    
    	// Redimensionnement de l'image
    	imagecopyresampled(
    		$new_image, $image_src,
    		0, 0, $src_x, $src_y,
    		$new_width, $new_height, $src_w, $src_h
    	);
    
    	// Enregistrement de l'image
    	$func = 'image'. $type;
    	if($image_dest)
    	{
    		$func($new_image, $image_dest);
    	}
    	else
    	{
    		header('Content-Type: '. $type_mime);
    		$func($new_image);
    	}
    
    	// Lib�ration de la m�moire
    	imagedestroy($new_image); 
    
    	return TRUE;
    }
    
    public static function get_user_data($d='')
    {
        $row = Yii::app()->db->createCommand(array(
            'select' => array( '*'),
            'from' => 'drg_user',
            'where' => 'drg_uid=:drg_uid',
            'params' => array(':drg_uid'=>$d),
        ))->queryRow();
        return $row;
    }
    
    
}
?>