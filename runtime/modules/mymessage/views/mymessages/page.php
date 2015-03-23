<?php
/* @var $this MymessagesController */

$this->breadcrumbs=array(
    'Mymessages',
);


// Default values
if( $messageViewLimit === NULL ){

    $messageViewOffset = MessageClass::$messageViewOffset;
    $messageViewLimit = MessageClass::$messageViewLimit;
}

$pageSelected = ( $pageSelected !== NULL ) ? $pageSelected : 1;


if(Yii::app()->user->_user_Type == 'business'){
$blistings = Businesslisting::model()->findAllByAttributes(array('drg_uid'=>Yii::app()->user->getState('uid')));

$blist_id = array();
foreach($blistings as $index=>$listing)
{
    $blist_id[] = $listing->drg_blid;
}
$blistIds = implode(',',$blist_id);

// generate sql query for geting purchased details
$sql = "SELECT us.* FROM drg_user_messages us WHERE us.blist_id IN($blistIds) AND  first_message = '1' ";
$sql .= " ORDER BY us.id DESC "; // to set ordr by
$sql .= " LIMIT ".$messageViewOffset.",".$messageViewLimit; //this query contains all the data

    $userMessages  = UserMessages::model()->findAllBySql($sql);
}

if(Yii::app()->user->_user_Type == 'user'){
    $sql = "SELECT us.* FROM drg_user_messages us WHERE us.user_id=".Yii::app()->user->getId();
    $sql .= " AND first_message = '1' ORDER BY us.id DESC "; // to set ordr by
    $sql .= " LIMIT ".$messageViewOffset.",".$messageViewLimit; //this query contains all the data

    $userMessages  = UserMessages::model()->findAllBySql($sql);
}

$totalComments = count($userMessages);
$comments = $userMessages;
?>
<div class="clear"></div>
<div class="registration-box">
<div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
    <div class="clear"></div>
</div>
<div class="registration-content" style="min-height:580px">
<div class="my-account-links">
    <?php
        $this->renderPartial("//layouts/my-account-links");
    ?>
</div>
<div class="">
<h1 align="center">My Messages</h1>
<p align="center">This is a list of all your private messages regarding your listings</p>

<div class="my-account-left">
<div id="voice-your-opinion " class="message-box">

<?php if( $totalComments > 0 ){

    $i = 1;

    foreach ($comments as $commentId => $commentDetails) {

        $commentBoxClassColor = ($i%2 == 0) ? "": "even";

        $usersStats = UserMessages::getUserStats( $commentDetails->blist_id );
        $listingData = BusinessListing::model()->findByAttributes(array('drg_blid'=>$commentDetails->blist_id));
        $userInfo = User::model()->findByAttributes(array('drg_id'=>$commentDetails->user_id));

        ?>

        <div class="dd_coment_box <?=$commentBoxClassColor;?>">
        <ul class="dd_coment_heading" style="overflow: visible;">
            <a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$commentDetails->user_id]['username'];?><span class="classic">Username</span></a>
            <a class="tooltip reputation" href="#" style="margin-right: 5px;">*<?=$usersStats[$commentDetails->user_id]['user_reputation'];?><span class="classic">User reputation</span></a>
            <a class="tooltip" href="#" style="float:right;margin: 0"><?php $o = UserMessages::formatDate($commentDetails->created_date); echo $o['date'];?>&nbsp;<?=$o['time'];?>&nbsp;GMT<span class="classic">Date of comment</span></a>
        </ul>
        <div class="user_image">
            <?php
            if($userInfo['drg_image']) {
                $img = $userInfo['drg_image'];
                $user_dirname = strtolower($userInfo['drg_username']) . '_' . $userInfo['drg_id'];
                if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/images/' . $img)) {
                    ?>
                    <img
                        src="<?php echo Yii::app()->createUrl('/upload/users/' . $user_dirname . '/images/' . $img); ?>"
                        alt="<?php echo $userInfo['drg_name'] . ' ' . $userInfo['drg_surname']; ?>"
                        width="60px"/>
                <?php
                }else if(file_exists(Yii::app()->basePath . '/../www/upload/logo/'. $img)){ ?>
                    <img
                        src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                        alt="<?php echo $userInfo['drg_name'] . ' ' . $userInfo['drg_surname']; ?>"
                        width="60px"/>

                <?php }else {
                    $img = 'avatar.jpg';
                    ?>
                    <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                         alt="Profile picture" width="60px"/>

                <?php
                }
            }
            ?>
        </div>

        <span style="color: #7d7e7d;"> listing title</span> <span class="tooltip reputation"> <a href="<?php echo Yii::app()->baseUrl.'/businesslisting/view?id='.$listingData['drg_blid'];?>"><?php echo isset($listingData) ? $listingData['drg_slogon'] : '';?>
                <span class="classic">Click on the title to go to that listing</span></span></a>  </span><br/>
        <span style="color: #7d7e7d;">subject</span> <span style="color: #E254E8"><?php echo $commentDetails->subject;?></span>
        <br/>
        <span class="comment moremsg">
            <?=$commentDetails->message;?></span>

        <div class="dd_coment" commentId="<?=$commentDetails->id;?>">
        <?php if(Yii::app()->user->_user_Type == 'user'){?>
            <a class="closeMsg" commentId="<?=$commentDetails->id;?>"  style="cursor: pointer;font-size:0.8em;margin-left: 400px;">Close</a>
        <?php } ?>
        <?php
        $post_comment = UserMessages::model()->getPostComments($commentDetails->id);

        // There's a post comment
        if( count($post_comment) > 0 ){ ?>

            <a class="tooltip openCloseMessages" status="closed" style="margin-left: 1px;cursor: pointer; font-size:0.8em;">My Message <span class="classic openCloseCommentsTooltip">Open Thread</span></a><img class="arrowClass" src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/down-bluearrow.gif"/> <img style="display: none;" class="uparrowClass" src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/up-bluearrow.gif"/>

        <?php }

        if( isset($commentDetails->attachement) && !empty($commentDetails->attachement)){

            // Display original file name
            $attachement = explode(".", $commentDetails->attachement);
            $fileNameLength = (int) ( (strlen($attachement[0])) + 1);
            $originaleFileName = substr($commentDetails->attachement, $fileNameLength);

            $classNotAllowed = "notAllowed";
            $dowloadAttachementLink = "";

            if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){

                $classNotAllowed = "";
                $dowloadAttachementLink = "href='../../mymessage/mymessages/downloadAttachement?messageId={$commentDetails->id}'";

            }

            ?>

            <a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="float:right;margin-right: 18px;"><span class="classic"><?=$originaleFileName;?></span></a>

        <?php } ?>



        <div class="clear"></div>


        <a class="floatRight replpToPostMsgComment" commentId="<?=$commentDetails->id;?>" style="cursor: pointer; font-size:0.8em; margin-right: 43px;margin-top: -16px;">Reply to post <span style="margin-top: 5px;"> <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/down-yellowarrow.gif"/></span></a>
        <?php /*<div class="msg_like_buuton_box" commentId="<?=$commentDetails->id;?>">
            <a><span class="msg_like_button" likeAction="like">Like</span></a>
            <a><span class="msg_dislike_button" likeAction="dislike">Dislike</span></a>
        </div>*/ ?>
        <div class="clear"></div>
        <ul class="dd_social_list" style="top:15px !important;">
            <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span> </a></li>
            <li><a href="http://www.twitter.com" class="tooltip twitter"><span class="classic">Send to my twitter account</span> </a></li>
            <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to my google plus account</span> </a></li>
            <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to my linked In account</span></a> </li>
        </ul>
        <div class='postBlock'>

            <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$commentDetails->id;?>" commentReference="<?=$commentDetails->id;?>" listingid="<?=$commentDetails->id;?>" subject="<?=$commentDetails->subject;?>">
                <br/><br/>
                    <span style="float: left;">
                       <?php         $this->widget('ext.DzRaty.DzRaty', array(
                           'name' => 'my_rating_field_'.$commentDetails->id,
                           'value' => 0,
                           'options' => array(
                               'path' => Yii::app()->theme->baseUrl. '/images/raty',
                               'cancel' => TRUE,
                               'cancelPlace' => 'right',
                               'half' => TRUE,
                               'width' => 200,
                               'starOff' => 'raty-star-off.png',
                               'starOn' => 'raty-star-on.png',
                               'starHalf' => 'raty-star-half.png',
                               'cancelOff' => 'raty-cancel-off.png',
                               'cancelOn' => 'raty-cancel-on.png',
                               'click' => "js:function(score, evt){
                                 $.ajax({
                                type: 'POST',
                                url: '".Yii::app()->createUrl('user/myaccount/rating')."',
                                data: {'rate':score, 'user_id': ".Yii::app()->user->getId().", 'msg_id': ".$commentDetails->id.",'blist_id': ".$commentDetails->blist_id."},
                                success: function(name,value,exdays) {
                                }
                            });

                                }",
                           ),
                       ));?>

                   </span>
                <textarea style="margin-left: 100px;padding: 0 !important;width: 58%;" id="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                <div class="submitBtn"><a class="dd_post_msg_button" title="Submit comment" >Post</a></div>
                <br/><br/><br/>
                <div class='attachement-div'>
                    <input type="file" class='attachement-file' id="attachement<?=$commentDetails->id;?>" name="attachement<?=$commentDetails->id;?>" uploadsuccess="0" uploadfile="null" multiple />
                                   <span class="user-attach-icon attachement-icon" content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded" style="width: 25%; margin-top: -43px;padding-left: 18px;float:right">
                                    <span class="attachement-text" style="padding-left: 17px !important;"> </span>
                                   </span>
                </div>
            </form>
        </div>

        <div class="clear"></div>

        <?php

        $k = 1;
        // echo '<pre>';
        //  print_r($post_comment);
        // exit;
        foreach ($post_comment as $postsComments) {

            $userDetail = User::model()->findByAttributes(array('drg_id'=>$postsComments['user_id']));

            $postCommentBoxClassColor = ($k%2 == 0) ? "": "even";

            ?>
            <div class="dd_coment_box <?=$postCommentBoxClassColor;?> hiddenPostComments" style="width:98%;">


                <?php /*<div class="user_image">
                    <?php
                    if($userDetail['drg_image']) {
                        $img = $userDetail['drg_image'];
                        $user_dirname = strtolower($userDetail['drg_username']) . '_' . $userDetail['drg_id'];
                        if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/images/' . $img)) {
                            ?>
                            <img
                                src="<?php echo Yii::app()->createUrl('/upload/users/' . $user_dirname . '/images/' . $img); ?>"
                                alt="<?php echo $userDetail['drg_name'] . ' ' . $userDetail['drg_surname']; ?>"
                                width="60px"/>
                        <?php
                        }else if(file_exists(Yii::app()->basePath . '/../www/upload/logo/'. $img)){ ?>
                            <img
                                src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                alt="<?php echo $userDetail['drg_name'] . ' ' . $userDetail['drg_surname']; ?>"
                                width="60px"/>

                        <?php }else {
                            $img = 'avatar.jpg';
                            ?>
                            <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                 alt="Profile picture" width="60px"/>

                        <?php
                        }
                    }
                    ?>
                </div>*/ ?>

                <div class="dd_coment" commentId="<?=$postsComments['id'];?>">
                    <?php

                    if( isset($postsComments['attachement']) && !empty($postsComments['attachement']) ){

                        // Display original file name
                        $attachement = explode(".", $postsComments['attachement']);
                        $fileNameLength = (int) ( (strlen($attachement[0])) + 1);

                        $originaleFileName = substr($postsComments['attachement'], $fileNameLength);

                        $classNotAllowed = "notAllowed";
                        $dowloadAttachementLink = "";

                        if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){

                            $classNotAllowed = "";
                            $dowloadAttachementLink = "href='../mymessage/downloadAttachement/{$postsComments['id']}'";

                        }

                        ?>

                        <a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="margin-left: 97px;
top: 36px;"><span class="classic"><?=$originaleFileName;?></span></a>

                    <?php }  ?>
                    <ul class="dd_coment_heading">
                       <a class="tooltip" href="#" style="float:right;"><?php $u = UserMessages::formatDate($postsComments['created_date']); echo $u['date'];?><span class="classic">Date of comment</span>
                            <?=$u['time'];?>&nbsp;GMT<span class="classic">Time of comment</span></a>
                    </ul>
                    <div class="clear"></div>
                    <span class="comment moremsg" style="margin-left: 120px;color:#808080">
                         <?php
                         $regards = 'Hi ';
                         if($usersStats[$commentDetails->user_id]['username']){
                             $regards .=$usersStats[$commentDetails->user_id]['username'];
                         }
                         echo $regards.' ,';
                         echo '</br>';
                         echo '</br>';
                         ?>
                        <?=$postsComments['message'];?></span>
                    <?php /*<div class="msg_like_buuton_box" commentId="<?=$postsComments['id'];?>">
                        <a><span class="like_button" likeAction="like">Like</span></a>
                        <a><span class="dislike_button" likeAction="dislike">Dislike</span></a>
                    </div> */ ?>
                    <div class="clear"></div>
                    <a class="floatLeft replpToPostMsgComment" commentId="<?=$postsComments['id'];?>" style="cursor: pointer;font-size:0.8em;">Reply to post</a>

                    <div class="commentLink" style="margin-right: -70px;"><span> In reply to </span> <a href=""><?=$usersStats[$commentDetails->user_id]['username'];?></a></div>
                    <ul class="dd_social_list">
                        <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span> </a></li>
                        <li><a href="http://www.twtter.com" class="tooltip twitter"><span class="classic">Send to twitter account</span> </a></li>
                        <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to google plus account</span> </a></li>
                        <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to linkedIn account</span> </a></li>
                    </ul>
                    <div class='postBlock'>
                        <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$postsComments['id'];?>" commentReference="<?=$postsComments['id'];?>" listingid="<?=$postsComments['blist_id'];?>" subject="<?=$postsComments['subject'];?>">
                            <br />
                            <textarea id="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                            <div class="submitBtn"><a class="dd_post_msg_button" title="Submit comment" >Post</a></div>
                            <br/><br/><br/>
                            <div class='attachement-div'>
                                <input type="file" class='attachement-file' id="attachement<?=$postsComments['id'];?>" name="attachement<?=$postsComments['id'];?>" uploadsuccess="0" uploadfile="null" multiple />
                                                <span class="user-attach-icon attachement-icon" style="width: 25%;margin-top: -47px;margin-right: -16px;float: right;">
                                                    <span class="attachement-text" style="padding-left: 17px !important;"> </span>
                                                </span>

                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <?php

            $k++;

        } ?>


        </div>
        </div>

        <?php

        $i++;

    }
    ?>
    <!-- Comment box grey -->

    <div class="clear"></div>
    <div class="user-pagination">
        <!-- Number of records to view drop down menu -->

        <div class="user-msgpage-nav">
            <span title="Select number of records to view from the dropdown menu">View</span>
            <select data-placeholder=" " class="chzn-select" style="width: 60px; display: none;" tabindex="-1">
                <option value="6"<?php if( $messageViewLimit == 6 ) echo "selected";?>>6</option>
                <option value="12"<?php if( $messageViewLimit == 12 ) echo "selected";?>>12</option>
                <option value="25"<?php if( $messageViewLimit == 25 ) echo "selected";?>>25</option>
                <option value="50"<?php if( $messageViewLimit == 50 ) echo "selected";?>>50</option>
                <option value="100"<?php if( $messageViewLimit == 100 ) echo "selected";?>>100</option>
            </select>
            <script type="text/javascript"> $(".chzn-select").chosen();</script>
        </div>


        <!-- Bottom navigation menu -->
        <div class="page_numbers messagePageNumbers">
            <?php

            echo MessageClass::renderPagination($messageViewLimit, $pageSelected, $listingId);

            ?>

            <input type='hidden' id='messageViewLimit' value='<?=$messageViewLimit;?>' />

        <!-- <a href="#">< Previous</a> <a href="#">1</a> <a href="#">2</a> <a href="#" class="active">3</a> <a href="#">4</a> <a href="#">5</a> <a href="#">Next ></a> --></div>
    </div>

    <div class="clear"></div><?php } ?>
</div>

</div>
<!-- Message List Starts -->

<div class="clear"></div>
</div> <!-- my_account End -->

</div>
</div>

<script type="text/javascript">

    // Chosen dropbox styling code
    $(".chzn-select").chosen();
    $(".chzn-select-deselect").chosen({allow_single_deselect:true});

</script>

