<?php

class CommonClass extends CComponent {

    public function getSlug($string) {
        $new_string = preg_replace("/[^a-zA-Z0-9-\@\$ \s]/", "", strtolower(strip_tags($string)));
        $rep_string = str_replace(" ", "-", trim($new_string));
        $rep_string = preg_replace('/-+/', '-', $rep_string);
        $ret_string = preg_replace('/\'/', '', $rep_string);
        return $ret_string;
    }

    public function makePageSlug($model, $title, $id) {
        $slug = CommonClass::getSlug($title);
        $criteria = new CDbCriteria;
        $criteria->condition = "id <> '$id' AND page_seo = '$slug'";
        if ($model->findAll($criteria)) {
            $slug = $slug . $id;
        }

        $model->updateByPk($id, array('page_seo' => $slug));
        return true;
    }

    public function Download($file)
    {
      if(file_exists($file))
      {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.basename($file).'"'); //<<< Note the " " surrounding the file name
          header('Content-Transfer-Encoding: binary');
          header('Connection: Keep-Alive');
          header('Expires: 0');
          header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          ob_clean();
          flush();
          readfile($file);
          exit;
      }
    }
    
    public static function getUserStatusLabel($status){

        $drgStatusLabels = array('y' => 'Activated', 'n' => 'Suspend');

        return $drgStatusLabels[$status];
    
    }
    
    public static function getUkDate($date){

        return date("d/m/y", strtotime($date));
    
    }
    
    public static function getMySqlDate($date){

        if(empty($date)){
            
            return NULL;
        }
        
        $date = explode("/", $date);
        
        return "20".$date[2]."-".$date[1]."-".$date[0];
    
    }
    
    public static function getLoggedInUsersByCriteria( $criteria = NULL ){

        $usersLogguedIn = array(); 
                
        $sql1 = "SELECT log_id";
        $sql1 .= " FROM drg_log_types";
        $sql1 .= " WHERE log_type IN('Login', 'Logout')";
        $sql1 .= " ORDER BY log_type ASC";
        $logType = Yii::app()->db->createCommand($sql1)->queryAll();
        $loginType = $logType[0]['log_id'];
        $logoutType = $logType[1]['log_id'];        

        $sql2 = "SELECT drg_id";
        $sql2 .= " FROM drg_user";
        $sql2 .= ($criteria !== NULL) ? " WHERE ".$criteria : "";
        $users = Yii::app()->db->createCommand($sql2)->queryAll();

        foreach( $users as $u ){
            
                $sql3 = "SELECT transaction_date";
                $sql3 .= " FROM drg_log_transaction";
                $sql3 .= " WHERE member_id = {$u[drg_id]} AND log_id = '{$loginType}'";
                $sql3 .= " ORDER BY transaction_id desc";
                $sql3 .= " LIMIT 0, 1;";
                $trnsDate = Yii::app()->db->createCommand($sql3)->queryAll();                
                
                if( count($trnsDate) > 0 ){
                    
                    $trnsDateValue = $trnsDate[0]['transaction_date'];
                    
                    $sql4 = "SELECT COUNT(*) AS login";
                    $sql4 .= " FROM drg_log_transaction";
                    $sql4 .= " WHERE member_id = '{$u['drg_id']}' AND log_id = '{$logoutType}' AND transaction_date > '{$trnsDateValue}'";
                    $trnsLogguedIn = Yii::app()->db->createCommand($sql4)->queryAll();
                    $logguedInCount = $trnsLogguedIn[0]['login'];

                    if( $logguedInCount == 0 ){
                        $usersLogguedIn[] = $u['drg_id'];
                    }
                }
        }

        return $usersLogguedIn;

    }
    

}

?>