<?php


/**
 * 
 * 
 * @name ForumClass : Common class for module configuration
 * @license Business Market
 * @author Riadh H.
 * @package Forum
 * 
 *
 */


class MessageClass extends CComponent {
    
    // Default number of comment to display
    public static $messageViewLimit = 6;
    
    // Default offset to get comment
    public static $messageViewOffset = 0;

    // Directory for upload attachement
    public static $uploadDirectoryPath = 'upload/mymessages/';
    
    // Max size file to upload ( 2 MB )
    public static $maxUploadFile = 2097152;
    
    // Allowed mime type for file to upload
    public static $allowedUploadType = array("application/pdf", "application/zip", "application/x-rar-compressed", "application/x-compressed", "image/jpg", "image/jpeg", "image/png", "image/bmp", "image/gif", "image/thm", "image/tif");
    
    // Forum administrator email
    public static $adminMail = "dsp7@blueyonder.co.uk";
    
    // Key to use when checking admin connection (manage spam comments)
    public static $key = "U:h4y)f9";
    
    
   /**
    * Format a date
    *
    * @param $date to format
    *
    * @return new date formated
    *
   */
    public static function formatDate($date) {
        
        if( empty($date) )
            return NULL;
        
        $result['time'] = date('h:i A', strtotime($date));
        
        $result['date'] = date('d/m/Y', strtotime($date));
        
        return $result;
        
    }
    
    
    
   /**
    * Get the view pagination
    *
    * @param $viewLimitValue number of comment to display
    * @param $pageSelected seleted page
    * @param $commentOrderBy Criteria Order by val of comment to display
    * @param $listingId number of comment to display
    * @param $userProfession number of comment to display 
    * 
    * @return pagination view
    *
   */
    
    public static function renderPagination( $viewLimitValue, $pageSelected, $listingId) {
                
        $viewLimitValue = ( isset($viewLimitValue) ) ? $viewLimitValue : MessageClass::$messageViewLimit;
        $viewOffset = ( isset($viewOffset) ) ? $viewOffset : MessageClass::$messageViewOffset;

        $limit = $viewLimitValue;
        $offset = $viewOffset;

        $sql = "SELECT COUNT(*) as total_post";
        $sql .= " FROM {{user_messages}}";

        if(Yii::app()->user->_user_Type == 'business'){
            $sql .= " WHERE first_message = '1'";
            $sql .= " AND blist_id LIKE '%{$listingId}'";
        }

        if(Yii::app()->user->_user_Type == 'user'){
             $sql .= " WHERE user_id =".Yii::app()->user->getId();
        }


        $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
        $nbOfPost = (int) $totalPosts[0]['total_post'];

        // All posts in one page
        if( $nbOfPost <= $viewLimitValue ){

            $paginationContent = "<a class='active'>Page 1</a>";

        }else{          

            // Get the previous page if the select page isn't the first
            if( ($pageSelected != 1) ){
                
                $previousPage = (int) ($pageSelected - 1);
                
                $offset = (int) (($previousPage - 1) * $viewLimitValue);

                $paginationContent = "<a offset='{$offset}' page='{$previousPage}'>< Previous</a>";
                
            }
            
            // Loop the pagination on depend the limit view
            for ($i = 1; $i <= ($nbOfPost / $viewLimitValue); $i++) {
                
                    $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";
                    
                    $offset = (int) (($i - 1) * $viewLimitValue);
                    
                    $paginationContent .= "<a offset='{$offset}' page='{$i}' {$activeClass}>{$i}</a>";
            }          
            
            // Get the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost ){
                
                $nexPage = (int) ($pageSelected + 1);
                
                $offset = (int) (($nexPage - 1) * $viewLimitValue);               
                
                $koffset = (int) (($i - 1) * $viewLimitValue);

                $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";
                
                $paginationContent .= "<a offset='{$koffset}' {$activeClass} page='{$i}'>{$i}</a>";
                $nextPagination = "<a offset='{$offset}' page='{$nexPage}'>Next ></a>";

            }

            // Render the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost){
            
                $paginationContent .= $nextPagination;
            
            }

        }

        return $paginationContent;

    }
    
    
    
     /**
     * Encrypt a string
     *
     * @param string $string string to encrypt
     *
     * @return string encrypted
     *
     */


    public static function encryptString($string) {

        $key = self::$key;

        $result = '';

        for($i=0; $i < strlen($string); $i++) {

          $char = substr($string, $i, 1);

          $keychar = substr($key, ($i % strlen($key))-1, 1);

          $char = chr(ord($char)+ord($keychar));

          $result.= $char;
        }

        return base64_encode($result);

    }


    /**
     * Decrypt a string
     *
     * @param string $string string to decrypt
     *
     * @return string decrypted
     *
     */


      public static function decryptString($string){

            $key = self::$key;

            $result = '';

            $string = base64_decode($string);

            for($i=0; $i < strlen($string); $i++) {

              $char = substr($string, $i, 1);

              $keychar = substr($key, ($i % strlen($key))-1, 1);

              $char = chr(ord($char)-ord($keychar));

              $result.= $char;

            }

            return $result;

        }
        
        /**
         * Get the view pagination
         *
         * @param $adminKey Forum administrator email
         * 
         * @return boolean true if the key encrypted is the admin email else false
         *
        */        
        
        public static function checkAdminKey($adminKey) {
            
            if( self::decryptString($adminKey) == ForumClass::$adminMail ){
                
                return TRUE;                
            }
            
            return FALSE;
        }

        public static function _mime_content_type($filename) {
            $result = new finfo();

            if (is_resource($result) === true) {
                return $result->file($filename, FILEINFO_MIME_TYPE);
            }

            return false;
        }

}

?>
