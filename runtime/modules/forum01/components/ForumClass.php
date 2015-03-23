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


class ForumClass extends CComponent {
    
    // Default number of comment to display
    public static $commentViewLimit = 6;
    
    // Default offset to get comment
    public static $commentViewOffset = 0;
    
    // Default order by value
    public static $commentOrderBy = 'date_create DESC';
    
    // User default value
    public static $userProfession = '0';
    
    // Directory for upload attachement
    public static $uploadDirectoryPath = 'upload/comments/';
    
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
    
    public static function renderPagination( $viewLimitValue, $pageSelected, $commentOrderBy, $listingId, $userProfession) {
                
        $viewLimitValue = ( isset($viewLimitValue) ) ? $viewLimitValue : ForumClass::$commentViewLimit;
        $viewOffset = ( isset($viewOffset) ) ? $viewOffset : ForumClass::$commentViewOffset;
        $commentOrderBy = ( isset($commentOrderBy) ) ? $commentOrderBy : ForumClass::$commentOrderBy;
        $userProfession = ( isset($userProfession) ) ? $userProfession : ForumClass::$userProfession;
            
        $limit = $viewLimitValue;
        $offset = $viewOffset;
        
        if( ($commentOrderBy != "user_reputation desc") && ($commentOrderBy != "user_reputation asc") && ($userProfession == "0") ){

            $sql = "SELECT COUNT(*) as total_post";
            $sql .= " FROM {{comments}}";
            $sql .= " WHERE first_comment = '1'";
            $sql .= " AND listing_id = {$listingId}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        }elseif ( (($commentOrderBy == "user_reputation desc") || ($commentOrderBy == "user_reputation asc")) && ($userProfession == "0") ) {

            $sql = "SELECT COUNT(c1.id) as total_post FROM {{comments}} c1";
            $sql .= " INNER JOIN (";
            $sql .= " SELECT u.drg_id as user_id, (sum(likes_total) - sum(dislikes_total)) AS user_reputation";
            $sql .= " FROM {{comments}} c2";
            $sql .= " INNER JOIN {{user}} u";
            $sql .= " ON c2.user_id = u.drg_id";
            $sql .= " WHERE c2.listing_id = {$listingId}";
            $sql .= " GROUP BY c2.user_id) z";
            $sql .= " ON z.user_id = c1.user_id";
            $sql .= " WHERE c1.first_comment = '1'";
            $sql .= " AND c1.listing_id = {$listingId}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        }elseif ( ($commentOrderBy != "user_reputation desc") && ($commentOrderBy != "user_reputation asc") && ($userProfession != "0") ) {

            $sql = "SELECT COUNT(c.id) as total_post FROM {{comments}} c";
            $sql .= " INNER JOIN {{user}} u";
            $sql .= " ON c.user_id = u.drg_id";
            $sql .= " INNER JOIN {{profession}} p";
            $sql .= " ON u.drg_pstatus = p.profession_id";
            $sql .= " WHERE c.first_comment = '1'";
            $sql .= " AND c.listing_id = {$listingId}";
            $sql .= " AND p.profession_id = {$userProfession}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        }elseif ( (($commentOrderBy == "user_reputation desc") || ($commentOrderBy == "user_reputation asc")) && ($userProfession != "0") ) {

            $sql = "SELECT COUNT(c1.id) as total_post FROM {{comments}} c1";
            $sql .= " INNER JOIN (";
            $sql .= " SELECT u.drg_id as user_id, (sum(likes_total) - sum(dislikes_total)) AS user_reputation";
            $sql .= " FROM {{comments}} c2";
            $sql .= " INNER JOIN {{user}} u";
            $sql .= " ON c2.user_id = u.drg_id";
            $sql .= " INNER JOIN {{profession}} p";
            $sql .= " ON u.drg_pstatus = p.profession_id";                
            $sql .= " WHERE c2.listing_id = {$listingId}";
            $sql .= " AND p.profession_id = {$userProfession}";
            $sql .= " GROUP BY c2.user_id) z";
            $sql .= " ON z.user_id = c1.user_id";
            $sql .= " WHERE c1.first_comment = '1'";                
            $sql .= " AND c1.listing_id = {$listingId}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        }
        

        // All posts in one page
        if( $nbOfPost <= $viewLimitValue ){

            $paginationContent = "<a class='active'>Page 1</a>";

        }else{          

            // Get the previous page if the select page isn't the first
            if( ($pageSelected != 1) ){
                
                $previousPage = (int) ($pageSelected - 1);
                
                $offset = (int) (($previousPage - 1) * $viewLimitValue);

                $paginationContent = "<a orderby='{$commentOrderBy}' offset='{$offset}' page='{$previousPage}'>< Previous</a>";
                
            }
            
            // Loop the pagination on depend the limit view
            for ($i = 1; $i <= ($nbOfPost / $viewLimitValue); $i++) {
                
                    $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";
                    
                    $offset = (int) (($i - 1) * $viewLimitValue);
                    
                    $paginationContent .= "<a orderby='{$commentOrderBy}' offset='{$offset}' page='{$i}' {$activeClass}>{$i}</a>";                    
            }          
            
            // Get the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost ){
                
                $nexPage = (int) ($pageSelected + 1);
                
                $offset = (int) (($nexPage - 1) * $viewLimitValue);               
                
                $koffset = (int) (($i - 1) * $viewLimitValue);

                $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";
                
                $paginationContent .= "<a orderby='{$commentOrderBy}' offset='{$koffset}' {$activeClass} page='{$i}'>{$i}</a>";
                $nextPagination = "<a orderby='{$commentOrderBy}' offset='{$offset}' page='{$nexPage}'>Next ></a>";

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


}

?>
