<?php

class ForumController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

        public function init(){
		
            parent::init();            
            
            Yii::app()->session['adminKey'] = '0';
                
        }
        
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('addcomment',),
				'users'=>array('*'),
			),
			/*array('deny',  // deny all users
				'users'=>array('*'),
			),*/
		);
	}

        
    public function actionAddComment(){		

            // Return 302 code if the user isn't logged in        
            if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){
               
                throw new CHttpException(302, "");
                
            }
            
            $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
            $message = $_POST['message'];            
            $commentReference = $_POST['commentReference'];
            $attachementUploadFile = $_POST['attachementUploadFile'];
            
            // No listing so return null
            if( $listingId == NULL ){
                
                echo CJSON::encode( array("action_status" => "0" ) );
                return false;
                
            }            
            
            $firstComment = ($commentReference == 0) ? '1' : '0';
            
            $comment = new Comments();
            $comment->message = $message;
            $comment->user_id = Yii::app()->user->Id;
            $comment->listing_id = $listingId;
            $comment->first_comment = $firstComment;            
            
            // Add the attachement if exist
            if( ($attachementUploadFile != "null") && (is_file(ForumClass::$uploadDirectoryPath.$attachementUploadFile)) ){
            
                $comment->attachement = $attachementUploadFile;
            }
            
            
            $comment->date_create = date('Y-m-d H:i:s');
            $comment->save();
            
            if ( $commentReference > 0 ){
                
                $commentComment = new PostComments();
                $commentComment->post_id = $comment->id;
                $commentComment->comment_id = $commentReference;
                $commentComment->save();
            
            }
            
            // Output some JSON instead of the usual text/html            
            echo CJSON::encode( array("action_status" => "1" ) );
            return true;
            
    }
    
    
    public function actionlikeComment(){
        
           // Return 302 code if the user isn't logged in
           $authenticatedUserId = Yii::app()->user->Id;
        
           if( (Yii::app()->user->isGuest) && (empty($authenticatedUserId)) ){
               
               throw new CHttpException(302, "");
                
            }
            
            $commentId = ( isset($_POST['commentId']) ) ? $_POST['commentId'] : NULL;
            $likeAction = ( isset($_POST['likeAction']) ) ? $_POST['likeAction'] : NULL;
            
            if( ($commentId == NULL) || ($likeAction == NULL) ){
                
                echo CJSON::encode( array("action_status" => "0" ) );
                return false;
                
            }
            
            $criteria = new CDbCriteria;  
            $criteria->addCondition("comment_id = {$commentId}");
            $criteria->addCondition("user_id = {$authenticatedUserId}");            
            $likeComment = LikeComment::model()->find($criteria);
            
            $criteria2 = new CDbCriteria;  
            $criteria2->addCondition("id = {$commentId}");
            $comment = Comments::model()->find($criteria2);
            
            $likeAction = ($likeAction == "dislike") ? '0' : '1';
            
            // So new like or dislike
            if ( ! ($likeComment instanceof LikeComment) ){
                
                $likeComment = new LikeComment();
                $likeComment->comment_id = $commentId;
                $likeComment->user_id = $authenticatedUserId;
                $likeComment->like_comment = $likeAction;
                $likeComment->date_create = date('Y-m-d H:i:s');
                $likeComment->save();
                
                // Increment the total of like / dislike
                
                if( $likeAction == '0' ){                    
                    $comment->dislikes_total += 1;                            
                }else{                    
                    $comment->likes_total += 1;
                }
                
                $comment->save();
                
            }else{
                
                // Update the user choice
                // 
                // The same choice no update
                if( $likeComment->like_comment == $likeAction ){
                    
                    // Nothing to do here
                    // Output some JSON instead of the usual text/html            
                    echo CJSON::encode( array("action_status" => "0" ) );
                    return true;
                    
                }else{                    
                
                    $likeComment->like_comment = $likeAction;
                    $likeComment->date_update = date('Y-m-d H:i:s');
                    $likeComment->save();
                    
                    if( $likeAction == '0' ){                        
                        $comment->dislikes_total += 1;
                        $comment->likes_total -= 1; 
                    }else{                        
                        $comment->dislikes_total -= 1;
                        $comment->likes_total += 1;
                    }
                    
                    $comment->save();
                    
                }
                
            }
            
            // Output some JSON instead of the usual text/html            
            echo CJSON::encode( array("action_status" => "1" ) );
            
            return true;
        
    }
    
    
    public function actionUpdateViewLimit(){        
                       
            $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
            $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : ForumClass::$commentViewLimit;
            $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : ForumClass::$commentOrderBy;
            $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : ForumClass::$userProfession;
        
            if( $listingId == NULL ){
                
                echo CJSON::encode( array("action_status" => "0") );
                return false;
                
            }
            
            $listing = Userlisting::model()->findByPk($listingId);
            
            // Render the forum page with the new paramters
            $listingView = $this->renderPartial('/forum/page', 
                    array(
                            'listing' => $listing,
                            'commentViewLimit' => $viewLimitValue,
                            'commentViewOffset' => ForumClass::$commentViewOffset,
                            'commentOrderBy' => $commentOrderBy,
                            'userProfession' => $userProfession 
                        ), true);
            
            echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));            
            
            
    }
    
    
    public function actionNavigate(){        
                       
            $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
            $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : ForumClass::$commentViewLimit;
            $pageSelected = ( isset($_POST['pageSelected']) ) ? $_POST['pageSelected'] : 1;
            $viewOffsetValue = ( isset($_POST['viewOffsetValue']) ) ? $_POST['viewOffsetValue'] : ForumClass::$commentViewOffset;
            $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : ForumClass::$commentOrderBy;            
            $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : ForumClass::$userProfession;
            
            if( $listingId == NULL ){
                
                echo CJSON::encode( array("action_status" => "0") );
                return false;
                
            }
            
            $listing = Userlisting::model()->findByPk($listingId);
            
            $listingView = $this->renderPartial('/forum/page', array(
                    'listing' => $listing,
                    'commentViewLimit' => $viewLimitValue,
                    'commentViewOffset' => $viewOffsetValue,
                    'commentOrderBy' => $commentOrderBy,
                    'pageSelected' => $pageSelected,
                    'userProfession' => $userProfession
                    ), true);
            
            echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));            
            
            
    }
    
    

    public function actionReportAsSpam(){        
                       
            if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){
               
                throw new CHttpException(302, "");
                
            }
        
            $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
            $commentId = ( isset($_POST['commentId']) ) ? $_POST['commentId'] : NULL;
        
            if( ($listingId == NULL) || ($commentId == NULL) ){
                
                echo CJSON::encode( array("action_status" => "0") );
                return false;
                
            }
            
            $comment = Comments::model()->findByPk($commentId);
            
            $comment->is_spam = '1';
            
            $comment->save();
            
            // Send mail to admin
            
            $commentOwner = User::model()->findByPk($comment->user_id);            
            $commentOwnerName = $commentOwner->drg_name." ".$commentOwner->drg_surname;
            
            $listing = Userlisting::model()->findByPk($listingId);            
            $listingOwner = User::model()->findByPk($listing->drg_uid);
            $listingOwnerName = $listingOwner->drg_name." ".$listingOwner->drg_surname;
            
            $mailTemplate =  new MailTemplate();
            
            // Get the forum_report_comment_as_spam template 
            $template =  $mailTemplate->getTemplate('forum_report_comment_as_spam');            
            
            // No need to continue if the template is not found
            if( ! ($template instanceof MailTemplate ) ){
                
                echo CJSON::encode(array("action_status" => "0"));
                return FALSE;
            }
            
            // To secure admin connection, it's necessary to add an encrypted key in the listing link to be sent to the admin
            $encrypedKey = ForumClass::encryptString(ForumClass::$adminMail);
            
            $listingLink = Yii::app()->getBaseUrl(true)."/listing/view?id={$listingId}&h=".$encrypedKey;
            
            $commentDateCreat = ForumClass::formatDate($comment->date_create);
            
            // Format the template with the right parameters
            $bodyString = array(
                     '{{#COMMENT_OWNER#}}' => $commentOwnerName,
                     '{{#COMMENT_DATE#}}' => $commentDateCreat['date']." ".$commentDateCreat['time'],
                     '{{#COMMENT_CONTENT#}}' => $comment->message,
                     '{{#LISTING_OWNER#}}' => $listingOwnerName,
                     '{{#LISTING_TITLE#}}' => $listing->drg_title,
                     '{{#LISTING_LINK#}}' => $listingLink
             );

            $subjectString = array('{{#LISTING_NUMBER#}}' => $listingId);
            
            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $bodyString);
            $subject = SharedFunctions::app()->mailStringReplace($template->template_subject, $subjectString);
            
            // Send the email
            $mail = new YiiMailer();
            $mail->IsSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup server
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = '';                            // SMTP username
            $mail->Password = '';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
            $mail->Port = 587;
            //set mail properties
            $mail->setFrom("Business Supermarket");

            $mail->setTo(ForumClass::$adminMail);

            $mail->setSubject($subject);
            $mail->setBody($body, 'text/html');
            
            $result = ($mail->send()) ? "1" : "0";
            
            echo CJSON::encode(array("action_status" => "1"));
            
    }
    
    
    public function actionUploadAttachement(){
        
        
            if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){
               
                throw new CHttpException(302, "");
                
            }
                
            $error = FALSE;
            $message = "Upload attachement success";
            $fileName = "error";

            if( empty($_FILES) || ($_FILES['attachement']['error'] != 0)  ){

                $error = TRUE;
                $message = "Attachement not found.";

            }

            if( ! $error ){

                $attachement = $_FILES['attachement'];

                if( (!$error) && ( !in_array($attachement['type'], ForumClass::$allowedUploadType)) ){

                    $error = TRUE;
                    $message = "Attachement type not allowed.";
                }
                
                if( (!$error) && ( $attachement['size'] > ForumClass::$maxUploadFile) ){

                    $error = TRUE;
                    $message = "Attachement size not allowed.";

                }                

            }

            if( !$error ){

                $fileToUploadPath = ForumClass::$uploadDirectoryPath.time().".".$attachement['name'];
                
                // Add time in file name to avoid conflict beetween files names
                $fileName = time().".".$attachement['name'];

                if( ! (move_uploaded_file($attachement['tmp_name'], $fileToUploadPath)) ){

                    $error = TRUE;
                    $message = "Upload attachement failed.";
                    $fileName = "error";
                }
            }
                
            $actionStatus = (!$error) ? "1" : "0";
            
            echo CJSON::encode(array("action_status" => $actionStatus, "message" => $message, "file_name" => $fileName));
            
            
    }
    
    
    public function actionDownloadAttachement(){
        
        
        // User must be logged in to see the file
        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){
            
            throw new CHttpException(302, "You must be logged in to view this page.");
            
        }        
        
        if( empty($_REQUEST['commentId']) ){
            
            throw new CHttpException(404, "Page not found.");
        }
        
        
        $commentId = $_REQUEST['commentId'];
        
        $comment = Comments::model()->findByPk($commentId);
        
        if ( ! ($comment instanceof Comments) ){
            
            throw new CHttpException(404, "Attachement not found.");
            
        }
        
        if( empty($comment->attachement) || $comment->attachement === NULL ){
            
            throw new CHttpException(404, "Attachement not found.");
            
        }
        
        $attachment = $comment->attachement;
        
        // Get the real path of the attachement
        $filePath = Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.ForumClass::$uploadDirectoryPath.$attachment;
        
        if( ! is_file($filePath) ){
            
            throw new CHttpException(404, "Attachement not found.");
        }
         
        // Get the original file name
        $attachementName = explode(".", $attachment);
        $fileNameLength = (int) ( (strlen($attachementName[0])) + 1);

        $originaleFileName = substr($attachment, $fileNameLength);        
        
        // Fix for IE https issue
        header('Pragma: public');

        header('Content-Description: File Transfer');
        //header("Content-type: ".$mime);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' . filesize($filePath));

        header("Content-Disposition: attachment; filename=\"".$originaleFileName."\"");

        ob_clean();

        flush();

        readfile($filePath);        
        
    }
    
    
    public function actionSetViewByCriteria(){        
                       
            $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
            $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : ForumClass::$commentViewLimit;
            $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : ForumClass::$commentOrderBy;
            $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : ForumClass::$userProfession;            
            
            if( $listingId == NULL ){
                
                echo CJSON::encode( array("action_status" => "0") );
                return false;
                
            }
            
            $listing = Userlisting::model()->findByPk($listingId);
            
            $listingView = $this->renderPartial('/forum/page', array(   
                                                                        'listing' => $listing, 
                                                                        'commentViewLimit' => $viewLimitValue,
                                                                        'commentViewOffset' => ForumClass::$commentViewOffset,
                                                                        'commentOrderBy' => $commentOrderBy,
                                                                        'userProfession' => $userProfession
                    ), true);
            
            echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));            
            
            
    }
    
    
    
    public function actionDeleteComment(){        
                       
            if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){
               
                throw new CHttpException(302, "");
                
            }
        
            $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
            $commentId = ( isset($_POST['commentId']) ) ? $_POST['commentId'] : NULL;
        
            if( ($listingId == NULL) || ($commentId == NULL) ){
                
                echo CJSON::encode( array("action_status" => "0") );
                return false;
                
            }
            
            $comment = Comments::model()->findByPk($commentId);
                        
            $comment->delete();            

            echo CJSON::encode(array("action_status" => "1"));
            
            
    }
    	
     
}
