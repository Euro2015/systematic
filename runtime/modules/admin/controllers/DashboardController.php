<?php

class DashboardController extends Controller
{
    //public $layout='/layouts/column2';
    public $title = '';
    
    public function init()
    {
      parent::init();
      $this->setPageTitle('Admin Panel - Home menu');
    }
    
    public function filters()
    {
        return array( 
        'accessControl' ,// perform access control for CRUD operations
        'postOnly + delete', // we only allow deletion via POST request
        ); 
    }
    
    public function accessRules()
    {
        return array(
            // array('allow',  // allow all users to perform 'index' and 'view' actions
            //     'actions'=>array('',''),
            //     'users'=>array('*'),
            // ),
            // array('allow', // allow authenticated user to perform 'create' and 'update' actions
            //     'actions'=>array(''),
            //     'users'=>array('@'),
            // ),
            // array('allow', // allow admin user to perform 'admin' and 'delete' actions
            //     //'actions'=>array('admin','delete','create','update','index','view','index'),
            //     'users'=>array('admin'),
            // ),
            // array('deny',  // deny all users
            //     'users'=>array('*'),
            // ),
        );
    }
	public function actionIndex()
	{		
        $this->render('index');
    }
     

    public function actionInfopanel()
    {
    
        if( isset($_REQUEST['report_frequency']) ){
            
            $reportFrequency = Data::model()->findByAttributes(array('data_type' => 'report_frequency'));
            
            if( $reportFrequency instanceof Data ){
                // Update the current value of report frequency
                $reportFrequency->data = $_REQUEST['report_frequency'];
                $reportFrequency->save();
                
            }else{           
                // Add new report frequency data
                $reportFrequency = new Data();            
                $reportFrequency->data_type = "report_frequency";            
                $reportFrequency->data = $_REQUEST['report_frequency'];
                $reportFrequency->save();            
            }
            
            $reportRecipient = Data::model()->findByAttributes(array('data_type' => 'report_recipient'));
            
            if( $reportRecipient instanceof Data ){
                // Update the current value of report recipient
                $reportRecipient->data = implode(",", array_filter($_REQUEST['report_recipient']));
                $reportRecipient->save();
                
            }else{           
                // Add new report recipient data
                $reportRecipient = new Data();            
                $reportRecipient->data_type = "report_recipient";            
                $reportRecipient->data = implode(",", array_filter($_REQUEST['report_recipient']));
                $reportRecipient->save();            
            }
            
            $reportRecipientValues = $_REQUEST['report_recipient'];
            
        }else{
            
            $reportRecipient = Data::model()->findByAttributes(array('data_type' => 'report_recipient'));
            
            $reportRecipientValues = array();
            
            if( $reportRecipient instanceof Data ){               
                
                $reportRecipientValues = explode(',', $reportRecipient->data);
                
            }
            
            
            
        }
        
        // Default is the first page
        $currentPage = 1;
        
        if( isset($_REQUEST['admin_activity_action']) ){
            
            if( $_REQUEST['admin_activity_action'] == 'previous' ){
                
                $currentPage = (int) ($_REQUEST['current_page'] - 1);
                
            }else{
                
                $currentPage = (int) ($_REQUEST['current_page'] + 1);
                
            }
            
        }
        
        
        // Export admin activity
        if( isset($_REQUEST['admin_activity_from_date_hidden']) ){
            
            if( isset($_REQUEST['admin_activity_from_date_hidden']) && isset($_REQUEST['admin_activity_to_date_hidden']) ){            
                
                $fromDate = explode("/", $_REQUEST['admin_activity_from_date_hidden']);
                $fromDate = $fromDate[2]."-".$fromDate[1]."-".$fromDate[0];

                $toDate = explode("/", $_REQUEST['admin_activity_to_date_hidden']);
                $toDate = $toDate[2]."-".$toDate[1]."-".$toDate[0];

                $sql6 = "SELECT A.admin_id, B.username, A.transaction_date, A.ip_address";
                $sql6 .= " FROM {{log_transaction_admin}} A";
                $sql6 .= " LEFT JOIN {{adminuser}} B";
                $sql6 .= " ON A.admin_id = B.user_id";
                $sql6 .= " WHERE A.log_id = 2";
                $sql6 .= " AND A.transaction_date BETWEEN '{$fromDate}' AND '{$toDate}'";
                $sql6 .= " ORDER BY A.transaction_date DESC";
                
                $usersLoggingIn = Yii::app()->db->createCommand($sql6)->queryAll();

                if( $usersLoggingIn ){

                    $adminActivity = array(); 

                    foreach ($usersLoggingIn as $userLoggingIn) {

                            $sql7 = "SELECT MIN(A.transaction_date) as logout_date";
                            $sql7 .= " FROM {{log_transaction_admin}} A";
                            $sql7 .= " WHERE A.admin_id = {$userLoggingIn['admin_id']}";
                            $sql7 .= " AND A.transaction_date > '{$userLoggingIn['transaction_date']}'";
                            $sql7 .= " AND A.ip_address = '{$userLoggingIn['ip_address']}'";
                            $sql7 .= " AND A.log_id = 3";

                            // if no result the result is already connected
                            $usersLoggingOut = Yii::app()->db->createCommand($sql7)->queryAll();

                            array_push( $adminActivity, array('username' => $userLoggingIn['username'], 
                                                             'login_date' => date( 'd/m/Y', strtotime($userLoggingIn['transaction_date'])),
                                                             'login_time' => gmdate ( 'H:i', strtotime($userLoggingIn['transaction_date']))." GMT",
                                                             'logout_time' => isset( $usersLoggingOut[0]['logout_date'] ) ? gmdate( 'H:i', strtotime($usersLoggingOut[0]['logout_date']))." GMT" : "-",
                                                             'ip_address' => $userLoggingIn['ip_address'])
                                      );

                    }
                    
                    $fromDate = str_replace("-", "", $fromDate);
                    $toDate = str_replace("-", "", $toDate);

                    $attachment = Yii::app()->basePath.'/../www/upload/documents/report.admin.activity.'.$fromDate.'.'.$toDate.'.csv';

                    $exportContentCSV = "Username;Date;Time in;Time out;IP Address\n";

                    foreach ( $adminActivity as $adminActivityItem ){

                        $exportContentCSV .= $adminActivityItem['username'].";";
                        $exportContentCSV .= $adminActivityItem['login_date'].";";
                        $exportContentCSV .= $adminActivityItem['login_time'].";";
                        $exportContentCSV .= $adminActivityItem['logout_time'].";";
                        $exportContentCSV .= $adminActivityItem['ip_address'];
                        $exportContentCSV .= "\n";

                    }

                    $fh = fopen($attachment, "w") or die("can't open file".$attachment);

                    fwrite($fh, $exportContentCSV);

                    fclose($fh);

                    $body = "";

                }else{
                    // No data to export, so just put the following text in the body
                    $body = "No admin activity between ".CommonClass::getUkDate($_REQUEST['admin_activity_from_date_hidden'])." and ".CommonClass::getUkDate($_REQUEST['admin_activity_from_date_hidden']);

                }            

                $subject = "Admin activity between ".$_REQUEST['admin_activity_from_date_hidden']." and ".$_REQUEST['admin_activity_to_date_hidden'];

                $mail = new YiiMailer();
                $mail->setFrom("Business Supermarket");
                
                // Change this to deliver file to a different email address
                $mail->setTo("medriadh.hamdi@gmail.com");
                //$mail->setTo("website@business-supermarket.com");
                $mail->setSubject($subject);
                $mail->setBody($body, "text/html");
                $mail->setAttachment($attachment);
                $mail->send();
            
            }
            
        }
        
        if( isset($_REQUEST['blacklistdomain']) ){
            
            $blacklistdomain = Data::model()->findByAttributes(array('data_type' => 'blacklist_domain'));
            
            if( $blacklistdomain instanceof Data ){
                // Update the current value of blacklist domain                
                if( $_REQUEST['blacklistdomain'] != "" ){
                    
                    $blacklistdomain->data = $_REQUEST['blacklistdomain'];
                    $blacklistdomain->save();
                    
                }else{
                    // Delete if the new value is empty
                    $blacklistdomain->delete();
                }
                
                
            }else{           
                // Add new report blacklist domain
                $blacklistdomain = new Data();            
                $blacklistdomain->data_type = "blacklist_domain";            
                $blacklistdomain->data = $_REQUEST['blacklistdomain'];
                $blacklistdomain->save();            
            }
            
            $blacklistaddress = Data::model()->findByAttributes(array('data_type' => 'blacklist_address'));
            
            if( $blacklistaddress instanceof Data ){
                // Update the current value of blacklist address
                
                if( $_REQUEST['blacklistaddress'] != "" ){
                    
                    $blacklistaddress->data = $_REQUEST['blacklistaddress'];
                    $blacklistaddress->save();
                    
                }else{
                    // Delete if the new value is empty
                    $blacklistaddress->delete();
                }
                
                
                
            }else{           
                // Add new report blacklist address data
                $blacklistaddress = new Data();            
                $blacklistaddress->data_type = "blacklist_address";            
                $blacklistaddress->data = $_REQUEST['blacklistaddress'];
                $blacklistaddress->save();            
            }
            
            $blacklistdomainString = $_REQUEST['blacklistdomain'];
            $blacklistaddressString = $_REQUEST['blacklistaddress']; 
            
        }else{
            
            $blacklistdomain = Data::model()->findByAttributes(array('data_type' => 'blacklist_domain'));
            $blacklistaddress = Data::model()->findByAttributes(array('data_type' => 'blacklist_address'));
            
            $blacklistdomainString = $blacklistdomain->data;
            $blacklistaddressString = $blacklistaddress->data;
            
        }
        
        
        $this->render('info_panel', array('report_recipient' => $reportRecipientValues, 'currentPage' => $currentPage, "blacklistdomainString" => $blacklistdomainString, "blacklistaddressString" => $blacklistaddressString));
    }
    
    
    public function actionExportNewRegistration(){
        
        $reportFrequency = Data::model()->findByAttributes(array('data_type' => 'report_frequency'));
        $reportRecipient = Data::model()->findByAttributes(array('data_type' => 'report_recipient'));
        
        // Nothing to do in case
        if( !($reportRecipient instanceof Data) ){            
            return;            
        }
        
        // Default frequency is daily
        if( !($reportFrequency instanceof Data) ){
            
            $reportFrequencyValue = "daily";
            
        }elseif ( ($reportFrequency->data != "daily") && ($reportFrequency->data != "weekly") && ($reportFrequency->data != "monthly") ) {
            
            return;
            
        }else{
            
            $reportFrequencyValue = $reportFrequency->data;
            
        }        
        
        $sendExport = FALSE;
        $timeStamp = time();
        $criteria = new CDbCriteria;
        //$criteria->select = array('*, (likes_total - dislikes_total) as rate');
        
        if( $reportFrequencyValue == "daily" ){
            
            $criteria->addCondition(" drg_rdate = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY))");
            $sendExport = TRUE;
            
        }elseif ( $reportFrequencyValue == "weekly" ) {
            
            if( date('D', $timeStamp) === 'Mon' ){ 
               
                $criteria->addCondition(" drg_rdate BETWEEN (DATE_SUB(NOW(), INTERVAL 7 DAY)) AND (DATE_SUB(NOW(), INTERVAL 1 DAY))");
                $sendExport = TRUE;
                
            }
            
        }else{
            
            if( date('j', $timeStamp) === '1' ) {
                
                $criteria->addCondition(" LEFT(drg_rdate, 7) = LEFT(DATE_SUB(NOW(), INTERVAL 1 MONTH), 7)");
                $sendExport = TRUE;
            }
            
        }
        
        if( $sendExport ){
        
            $registrations = User::model()->findAll($criteria);
        
        }        
        
     	$attachment = ""; $userCount = 0; $businessCount = 0;
        
        // There's a data so create attachement
        if( sizeof($registrations) > 0 ){
            
            $attachment = Yii::app()->basePath.'/../www/upload/documents/report.new.registrations.'.date('dmy').'.csv';
            
            $exportContentCSV = "Name;Email;Registration date;Type\n";
            
            foreach ( $registrations as $registration ){
                
                $exportContentCSV .= $registration->drg_name.";";
                $exportContentCSV .= $registration->drg_email.";";
                $exportContentCSV .= $registration->drg_rdate.";";
                $exportContentCSV .= $registration->drg_user_type;
                $exportContentCSV .= "\n";
                
                ( $registration->drg_user_type == "user" ) ? $userCount++ : $businessCount++;

            }
	        
	    $fh = fopen($attachment, "w") or die("can't open file");
	    
	    fwrite($fh, $exportContentCSV);
	    
	    fclose($fh);
        
        }
        
        // COUNT user and business to date
        $sql = "SELECT COUNT(*) AS total, drg_user_type";
        $sql .= " FROM {{user}}";
        $sql .= " GROUP BY drg_user_type";
        $sql .= " ORDER BY drg_user_type DESC";
        $users = Yii::app()->db->createCommand($sql)->queryAll();
        $defaultUsers = isset($users[0]['total']) ? $users[0]['total'] : 0;
        $businessUsers = isset($users[1]['total']) ? $users[1]['total'] : 0;
        
        // Get waiting listings        
        $sql = "SELECT COUNT(*) AS waiting_listings, B.drg_user_type";
        $sql .= " FROM {{user_listing}} A";
        $sql .= " LEFT JOIN {{user}} B";
        $sql .= " USING(drg_uid)";
        $sql .= " WHERE A.drg_listingstatus = 0";
        $sql .= " GROUP BY B.drg_user_type";
        $sql .= " ORDER BY B.drg_user_type DESC";
        $waitingListings = Yii::app()->db->createCommand($sql)->queryAll();
        $userWaitingListings = isset($waitingListings[0]['waiting_listings']) ? $waitingListings[0]['waiting_listings'] : 0;
        $businessWaitingListings = isset($waitingListings[1]['waiting_listings']) ? $waitingListings[1]['waiting_listings'] : 0;
        
        // Get active listings
        $sql = "SELECT COUNT(*) AS active_listings, B.drg_user_type";
        $sql .= " FROM {{user_listing}} A";
        $sql .= " LEFT JOIN {{user}} B";
        $sql .= " USING(drg_uid)";
        $sql .= " WHERE A.drg_listingstatus = 1";
        $sql .= " GROUP BY B.drg_user_type";
        $sql .= " ORDER BY B.drg_user_type DESC";
        $activeListings = Yii::app()->db->createCommand($sql)->queryAll();        
        $userActiveListings = isset($activeListings[0]['active_listings']) ? $activeListings[0]['active_listings'] : 0;
        $businessActiveListings = isset($activeListings[1]['active_listings']) ? $activeListings[1]['active_listings'] : 0;        
        
        // Get waiting banners
        $sql = "SELECT COUNT(*) AS count_banners, B.drg_user_type";
        $sql .= " FROM {{banner_ads}} A";
        $sql .= " LEFT JOIN {{user}} B";
        $sql .= " ON A.drg_user_id = B.drg_id";
        $sql .= " WHERE A.banner_approve_status = 0";
        $sql .= " GROUP BY B.drg_user_type";
        $sql .= " ORDER BY B.drg_user_type DESC";
        $countBanners = Yii::app()->db->createCommand($sql)->queryAll();
        
        $countBannersItemStatus = array(); 
        
        foreach ($countBanners as $countBannersItem) {
            
            $countBannersItemStatus[$countBannersItem['drg_user_type']] = $countBannersItem['count_banners'];
    
        }        
        
        $userWaitingBanners = isset($countBannersItemStatus['user']) ? $countBannersItemStatus['user'] : 0;
        $businessWaitingBanners = isset($countBannersItemStatus['business']) ? $countBannersItemStatus['business'] : 0;
        
        // Get active banners
        $sql = "SELECT COUNT(*) AS active_banners";
        $sql .= " FROM {{banner_ads}} A";
        $sql .= " WHERE A.banner_approve_status = 1";
        $activeBanners = Yii::app()->db->createCommand($sql)->queryAll();
        $activeBanners = (int) $activeBanners[0]['active_banners'];
        
        
        // Get the report_new_registrations template and prepare it
        $mailTemplate =  new MailTemplate();        
        $template =  $mailTemplate->getTemplate('report_new_registrations');        
        
        // Format the template with the right parameters
        $bodyString = array(
                 '{{#DEFAULT_USER_REGISTRATION_NB#}}' => $userCount,
                 '{{#BUSINESS_SERVICES_REGISTRATION_NB#}}' => $businessCount,
                 '{{#DEFAULt_USER_TO_DATE#}}' => $defaultUsers,
                 '{{#BUSINESS_SERVICES_TO_DATE#}}'=> $businessUsers,
                 '{{#USER_LISTINGS_WAITING_PUBLICATION#}}' => $userWaitingListings,
                 '{{#BUSINESS_LISTINGS_WAITING_PUBLICATION#}}' => $businessWaitingListings,
                 '{{#ACTIVE_USER_SERVICES_LISTINGS#}}' => $userActiveListings,
                 '{{#ACTIVE_BUSINESS_SERVICES_LISTINGS#}}' => $businessActiveListings,
                 '{{#WAITING_USER_BANNERS#}}' => $userWaitingBanners,
                 '{{#WAITING_BUSINESS_BANNERS#}}' => $businessWaitingBanners,
                 '{{#ACTIVE_BANNERS#}}' => $activeBanners
        );
        
        $body = SharedFunctions::app()->mailStringReplace($template->template_body, $bodyString);        
                
        echo "You shall receive the email content below :<br/><br/>";
        echo "Subject : ".$template->template_subject."<br/><br/>";
        echo "Body : ".$body."<br/><br/>";
        if( ($attachment != "") && (is_file($attachment)) ){
            echo "Attachement : report.new.registrations.".date('dmy').".csv";
        }        
        
        // Get recipient email
        $to = explode(",", $reportRecipient->data);
        
     	//SharedFunctions::sendmail($to, $template->template_subject, $body, $attachment);
                
        $mail = new YiiMailer();
        $mail->setFrom("Business Supermarket");
        $mail->setTo($to);
        $mail->setSubject($template->template_subject);
        $mail->setBody($body, 'text/html');
        $mail->setAttachment($attachment);
        $mail->send();
        
        
    }
     
}