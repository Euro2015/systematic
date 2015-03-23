<?php

class MymessagesController extends Controller
{
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
                'actions'=>array('addmessage','index','downloadAttachement'),
                'users'=>array('*'),
            ),
            /*array('deny',  // deny all users
                'users'=>array('*'),
            ),*/
        );
    }

    public function actionaddMessage(){

        // Return 302 code if the user isn't logged in
        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "");

        }

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $message = $_POST['message'];
        $subject = $_POST['subject'];
        $commentReference = $_POST['commentReference'];
        $attachementUploadFile = $_POST['attachementUploadFile'];

        // No listing so return null
        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0" ) );
            return false;

        }

        $firstMessage = ($commentReference == 0) ? '1' : '0';

        $userMessage = new UserMessages();
        $userMessage->message = $message;
        $userMessage->subject = $subject;
        $userMessage->user_id = Yii::app()->user->Id;
        $userMessage->blist_id = $listingId;
        $userMessage->created_date = date('Y-m-d H:i:s');
        $userMessage->first_message = $firstMessage;


        // Add the attachement if exist
        if( ($attachementUploadFile != "null") && (is_file($this->$uploadDirectoryPath.$attachementUploadFile)) ){

            $userMessage->attachement = $attachementUploadFile;
        }

        $userMessage->save();

        if ( $commentReference > 0 ){

            $commentComment = new PostMessages();
            $commentComment->post_id = $userMessage->id;
            $commentComment->comment_id = $commentReference;
            $commentComment->save();

        }

        // Output some JSON instead of the usual text/html
        echo CJSON::encode( array("action_status" => "1" ) );
        return true;

    }


    public function actionlikeMessage(){

        // Return 302 code if the user isn't logged in
        $authenticatedUserId = Yii::app()->user->Id;

        if( (Yii::app()->user->isGuest) && (empty($authenticatedUserId)) ){

            throw new CHttpException(302, "");

        }

        $messageId = ( isset($_POST['messageId']) ) ? $_POST['messageId'] : NULL;
        $likeAction = ( isset($_POST['likeAction']) ) ? $_POST['likeAction'] : NULL;

        if( ($messageId == NULL) || ($likeAction == NULL) ){

            echo CJSON::encode( array("action_status" => "0" ) );
            return false;

        }

        $criteria = new CDbCriteria;
        $criteria->addCondition("msg_id = {$messageId}");
        $criteria->addCondition("user_id = {$authenticatedUserId}");
        $likeMessage = LikeMessage::model()->find($criteria);

        $criteria2 = new CDbCriteria;
        $criteria2->addCondition("id = {$messageId}");
        $message = UserMessages::model()->find($criteria2);

        $likeAction = ($likeAction == "dislike") ? '0' : '1';

        // So new like or dislike
        if ( ! ($likeMessage instanceof LikeMessage) ){

            $likeMessage = new LikeMessage();
            $likeMessage->msg_id = $messageId;
            $likeMessage->user_id = $authenticatedUserId;
            $likeMessage->like_message = $likeAction;
            $likeMessage->date_create = date('Y-m-d H:i:s');
            $likeMessage->save();

            // Increment the total of like / dislike

            if( $likeAction == '0' ){
                $message->dislikes_total += 1;
            }else{
                $message->likes_total += 1;
            }

            $message->save();

        }else{

            // Update the user choice
            //
            // The same choice no update
            if( $likeMessage->like_message == $likeAction ){

                // Nothing to do here
                // Output some JSON instead of the usual text/html
                echo CJSON::encode( array("action_status" => "0" ) );
                return true;

            }else{

                $likeMessage->like_message = $likeAction;
                $likeMessage->date_update = date('Y-m-d H:i:s');
                $likeMessage->save();

                if( $likeAction == '0' ){
                    $message->dislikes_total += 1;
                    $message->likes_total -= 1;
                }else{
                    $message->dislikes_total -= 1;
                    $message->likes_total += 1;
                }

                $message->save();

            }

        }

        // Output some JSON instead of the usual text/html
        echo CJSON::encode( array("action_status" => "1" ) );

        return true;

    }

    public function actionUploadAttachement(){


        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "");

        }

        $error = FALSE;
        $message = "Upload attachment success";
        $fileName = "error";

        if( empty($_FILES) || ($_FILES['attachement']['error'] != 0)  ){

            $error = TRUE;
            $message = "Attachment not found.";

        }

        if( ! $error ){

            $attachement = $_FILES['attachement'];

            if( (!$error) && ( !in_array($attachement['type'], ForumClass::$allowedUploadType)) ){

                $error = TRUE;
                $message = "Attachment type not allowed.";
            }

            if( (!$error) && ( $attachement['size'] > ForumClass::$maxUploadFile) ){

                $error = TRUE;
                $message = "Attachment size not allowed.";

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

        if( empty($_REQUEST['messageId']) ){

            throw new CHttpException(404, "Page not found.");
        }



        $message = UserMessages::model()->findByPk($_REQUEST['messageId']);

        if ( ! ($message instanceof UserMessages) ){

            throw new CHttpException(404, "Attachement not found.");

        }

        if( empty($message->attachement) || $message->attachement === NULL ){

            throw new CHttpException(404, "Attachement not found.");

        }

        $attachment = $message->attachement;

        // Get the real path of the attachement
        $filePath = Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.MessageClass::$uploadDirectoryPath.$attachment;

        if( ! is_file($filePath) ){

            throw new CHttpException(404, "Attachement not found.");
        }

        // Get the original file name
        $attachementName = explode(".", $attachment);
        $fileNameLength = (int) ( (strlen($attachementName[0])) + 1);

        $originaleFileName = substr($attachment, $fileNameLength);

        $mime = MessageClass::_mime_content_type($originaleFileName);
        // Fix for IE https issue
        header('Pragma: public');
        header('Content-Description: File Transfer');
        header("Content-type: ".$mime);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' . filesize($filePath));

        header("Content-Disposition: attachment; filename=\"".$originaleFileName."\"");

        ob_clean();

        flush();

        readfile($filePath);

    }

    public function actionNavigate(){
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : MessageClass::$messageViewLimit;
        $pageSelected = ( isset($_POST['pageSelected']) ) ? $_POST['pageSelected'] : 1;
        $viewOffsetValue = ( isset($_POST['viewOffsetValue']) ) ? $_POST['viewOffsetValue'] : MessageClass::$messageViewOffset;


        $listingView = $this->renderPartial('/mymessages/page', array(
            'messageViewLimit' => $viewLimitValue,
            'messageViewOffset' => $viewOffsetValue,
            'pageSelected' => $pageSelected
        ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));


    }

    public function actionUpdateViewLimit(){
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] :  MessageClass::$messageViewLimit;

        // Render the forum page with the new paramters
        $listingView = $this->renderPartial('/mymessages/page',
            array(
                'messageViewLimit' => $viewLimitValue,
                'messageViewOffset' => MessageClass::$messageViewOffset
            ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));


    }
}