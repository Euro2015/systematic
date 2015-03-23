<?php 

// Put a sesion key for the admin
Yii::app()->session['adminKey'] = '0';
if( (isset($adminKey)) && ($adminKey !== "") ){
    if ( ForumClass::checkAdminKey($adminKey) ){
        Yii::app()->session['adminKey'] = '1';
    }
}

$notLogguedInText = "";

if( Yii::app()->user->isGuest ){
    $notLogguedInText = "You must be logged in to leave a comment.";
}

$listingId = $listing->drg_lid;

// Default values
if( $commentViewLimit === NULL ){
    $commentViewOffset = ForumClass::$commentViewOffset;
    $commentViewLimit = ForumClass::$commentViewLimit;
    $commentOrderBy = ForumClass::$commentOrderBy;
    $userProfession = ForumClass::$userProfession;
}

$pageSelected = ( $pageSelected !== NULL ) ? $pageSelected : 1;
$professionText = "&nbsp;"; $reputationText = "&nbsp;";
if( ($commentOrderBy == "user_reputation desc") || ($commentOrderBy == "user_reputation asc") ){
    $reputationText = "Reputation";
}

if( ($userProfession != "0") && ($pageSelected == 1) ){
    $professionText = "User";
}

$comments = Comments::getCommentsByListing($listingId, $commentViewOffset, $commentViewLimit, $commentOrderBy, $userReputation, $userProfession);
$usersStats = Comments::getUserStats($listingId);

// Report as spam is only permitted for the listing's owner
$reportAsSpamAllow = ( Yii::app()->user->Id == $listing->drg_uid ) ? TRUE : FALSE;
$totalComments = sizeof($comments);

?>

<script type="text/javascript">
    
    // Update the total comment
    $("#totalComment").html("("+<?=Comments::getTotalComments($listingId)?>+")");
    
</script>    

<div id="voice-your-opinion" listingId="<?=$listingId;?>">
    
        <div style="display: none;" class="white_content confirm-email" id="light">
          <div class="u-email-box"> 
            <img src="<?=Yii::app()->theme->getBaseUrl().'/images/robot/Robot-pointing-down.png';?>" style="z-index:999999; position:relative; top:2px;">
            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
              <a title="Close" href="javaScript:void(0)" onclick="forum.closeNotification();" class="pu-close">X</a>
              <br>
              <h2 class="Blue">Oops.</h2>
              <h2 class="Blue text-message">You must be logged in to continue.</h2>
            </div>
          </div> <!-- /End of u-email-box -->
        </div>
        
        <div id="fade" style="border-radius: 14px;" class="black_overlay"></div>
    
    
        <div class="italic-font">
            <?php
                $userimage = Userlistingimages::model()->findAllByAttributes(array("drg_lid" => $listing->drg_lid)); 
                $username = User::model()->findAllByAttributes(array("drg_uid" => $listing->drg_uid));  
                $ufolder = $username[0]['drg_username'].'_'.$username[0]['drg_id'];
                $img_src='upload/users/'.$ufolder.'/listing/big/'.$listing->drg_logo;
            ?>
            <img class="v_thumbnail" src="<?php echo Yii::app()->baseUrl;?>/<?php echo $img_src; ?>"  style="height:120px;width:185px;"/>
            <h2 clas><?=$listing->drg_title;?></h2>
            <label><?=$listing->drg_desc;?></label>
            <strong><?=$listing->drg_uid;?></strong>
            <p><?=$listing->drg_explanation;?></p>
        </div> <!-- /End of italic-font -->
        <div class="clear"></div>
        <div class='postBlock'>
            <form class="submit-comment" commentReference="0">
                <br />
                <textarea id="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                <div class="submitBtn"><a class="dd_post_button" title="Submit comment">Post</a></div>
            </form>
            <br/>            
            <div class='attachement-div'>
                <input type="file" class='attachement-file' id="attachement0" name="attachement0" uploadsuccess="0" uploadfile="null" multiple />            
                <span class="user-attach-icon attachement-icon" style="width: 18%; margin-top: 4px;padding-left: 18px;">
                    Add attachement
                    <span class="attachement-text" style="padding-left: 17px !important;"></span>
                </span>
            </div>
        </div> <!-- /End of postBlock -->
            
        <div class="clerboth"></div>
                
        <ul class="comments_button_list" style="padding-top:0px !important;">
              <li><a href="#;" class="viewByCriteria" orderby="date_create DESC">Newest</a></li>
              <li><a href="#;" class="viewByCriteria" orderby="date_create ASC">Oldest</a></li>
              <li><a href="#;" class="viewByCriteria" orderby="rate DESC">Best Rated</a></li>
              <li><a href="#;" class="viewByCriteria" orderby="rate ASC">Worst Rated</a></li>
              <li class="userReputation">
                  <div class="userReputationText"><?=$reputationText;?></div>
                  <div class="userReputationSelect">
                    <select data-placeholder="Reputation" class="chzn-select" style="width: 120px; display: none;" tabindex="-1">
                      <option value=""></option>
                      <option value="user_reputation desc" <?php if( $commentOrderBy == "user_reputation desc" ) echo "selected";?>>Highest first</option>
                      <option value="user_reputation asc" <?php if( $commentOrderBy == "user_reputation asc" ) echo "selected";?>>Lowest first</option>
                    </select>
                  </div>
                  <script type="text/javascript"> $(".chzn-select").chosen();</script>
              </li>
              <li class="userProfession">
                  <div class="userProfessionText"><?=$professionText;?></div>
                  <div class="userProfessionSelect">
                    <select data-placeholder="User" class="chzn-select" style="width: 150px; display: none;" tabindex="-1">
                           <option value=""></option>
                           <option value="0" <?php if( $userProfession == "0" ) echo "selected";?>>All</option>
                           <option value="1" <?php if( $userProfession == "1" ) echo "selected";?>>Business owner</option>
                           <option value="2" <?php if( $userProfession == "2" ) echo "selected";?>>Consumer</option>
                           <option value="3" <?php if( $userProfession == "3" ) echo "selected";?>>Entrepreneur</option>
                           <option value="4" <?php if( $userProfession == "4" ) echo "selected";?>>Investor</option>
                           <option value="5" <?php if( $userProfession == "5" ) echo "selected";?>>Other</option>
                    </select>
                   </div>
                <script type="text/javascript"> $(".chzn-select").chosen();</script>
              </li>
        </ul>
        <div class="clear"></div>
            
        <?php if( $totalComments > 0 ){
            $i = 1;
            foreach ($comments as $commentId => $commentDetails) {
                $commentBoxClassColor = ($i%2 == 0) ? "": "even";
                $grayedOutClass = ( $commentDetails['comment']->is_spam == '1' ) ? "grayedOut" : "";
                $spamCommentStyle = "";
                if( (Yii::app()->session['adminKey'] == '1') && ($commentDetails['comment']->is_spam == '1') ){
                $spamCommentStyle = "border: 2px solid #ED1C24;";                
           }           
        ?>

        <div class="dd_coment_box <?=$commentBoxClassColor;?>" style="width:98%; <?=$spamCommentStyle;?>">
            <div class="user_image"> <img src="<?=Yii::app()->theme->getBaseUrl().'/images/icons/user.png';?>" width="60px"> </div>
            <div class="ratting_box">                    
                <span class="rating_title" href="#">Rating</span>
                <span class="tooltip like_icon" href="#"><?=$commentDetails['comment']->likes_total;?><span class="classic">Total number of Likes</span></span>
                <span class="tooltip dislike_icon" href="#"><?=$commentDetails['comment']->dislikes_total;?><span class="classic">Total number of Dislikes</span></span>
            </div> <!-- /End of ratting_box -->
            <div class="dd_coment" commentId="<?=$commentDetails['comment']->id;?>">

                <ul class="dd_coment_heading" style="overflow: visible;">
                    <a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$commentDetails['comment']->user_id]['username'];?><span class="classic">Username</span></a>
                    <a class="tooltip reputation" href="#" style="margin-right: 5px;">*<?=$usersStats[$commentDetails['comment']->user_id]['user_reputation'];?><span class="classic">User reputation</span></a>
                    <a class="tooltip" href="#" style="margin-right: 5px;"><?php $o = ForumClass::formatDate($commentDetails['comment']->date_create); echo $o['date'];?><span class="classic">Date of comment</span></a>
                    <a class="tooltip" href="#" style="margin-right: 5px;"><?=$o['time'];?><span class="classic">Time of comment</span></a>

                    <?php

                    // There's a post comment
                    if( count($commentDetails['post_comment']) > 0 ){ ?>
                        <a class="tooltip openCloseComments" status="closed" style="margin-right: 5px;">Open all<span class="classic openCloseCommentsTooltip">Open all comments</span></a>
                    <?php }

                    if( isset($commentDetails['comment']->attachement) ){

                        // Display original file name
                        $attachement = explode(".", $commentDetails['comment']->attachement);
                        $fileNameLength = (int) ( (strlen($attachement[0])) + 1);
                        $originaleFileName = substr($commentDetails['comment']->attachement, $fileNameLength);
                        $classNotAllowed = "notAllowed";
                        $dowloadAttachementLink = "";
                        if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){
                            $classNotAllowed = "";
                            $dowloadAttachementLink = "href='../forum/downloadAttachement/{$commentDetails['comment']->id}'";
                        }
                   ?>

                        <a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="margin-right: 5px;"><span class="classic"><?=$originaleFileName;?></span></a>

                    <?php } ?>

                </ul>
                <div class="clear"></div>
                <span class="comment more"><?=$commentDetails['comment']->message;?></span>
                <div class="like_buuton_box" commentId="<?=$commentDetails['comment']->id;?>">
                    <a><span class="like_button <?=$grayedOutClass;?>" likeAction="like">Like</span></a>
                    <a><span class="dislike_button <?=$grayedOutClass;?>" likeAction="dislike">Dislike</span></a>
                </div> <!-- /End of comment more -->
                <div class="clear"></div>
                <a class="floatLeft replpToPostComment <?=$grayedOutClass;?>" commentId="<?=$commentDetails['comment']->id;?>" style="cursor: pointer; font-size:0.8em;">Reply to post</a>
                <?php

                if( $commentDetails['comment']->is_spam == '1' ){
                    if( Yii::app()->session['adminKey'] == '1' ){?>
                        <a class="floatLeft redText deleteComment" commentId="<?=$commentDetails['comment']->id;?>" style="font-size:0.8em; margin-left:25px;"><em>Delete comment</em></a>
                    <?php }else{
                    ?>
                        <label class="floatLeft redText" commentId="<?=$commentDetails['comment']->id;?>" style="font-size:0.8em; margin-left:25px;"><em>Comment under review</em></label>
                    <?php }
                    }else{
                        if( $reportAsSpamAllow ){?>
                            <a class="floatLeft reportAsSpam" commentId="<?=$commentDetails['comment']->id;?>" style="font-size:0.8em; margin-left:25px;"><em>Report as spam</em></a>
                            <?php
                        }
                    }
                ?>

                <!-- <div class="commentLink" style="margin-right: 0px;"><span> In reply to </span> <a href="#;">Jourdan (show original message)</a></div> -->
                <ul class="dd_social_list ">
                    <li><a href="http://www.facebook.com" class="face_book"></a></li>
                    <li><a href="http://www.twtter.com" class="twitter"></a></li>
                    <li><a href="https://plus.google.com" class="googleplus"></a></li>
                    <li><a href="https://www.linkedin.com" class="linked"></a></li>
                </ul>
                <div class='postBlock'>
                    <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$commentDetails['comment']->id;?>" commentReference="<?=$commentDetails['comment']->id;?>">
                            <br/><br/>
                            <textarea id="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                            <div class="submitBtn"><a class="dd_post_button" title="Submit comment" >Post</a></div>                                
                     <br/><br/><br/>
                   <div class='attachement-div'>
                       <input type="file" class='attachement-file' id="attachement<?=$commentDetails['comment']->id;?>" name="attachement<?=$commentDetails['comment']->id;?>" uploadsuccess="0" uploadfile="null" multiple />
                       <span class="user-attach-icon attachement-icon" style="width: 25%; margin-top: 8px;padding-left: 18px;">
                           Add attachement
                           <span class="attachement-text" style="padding-left: 17px !important;"></span>
                       </span>
                   </div>
                   </form>                                
                </div> <!-- /End of postBlock -->

            <div class="clear"></div>

            <?php 
                $k = 1;
                foreach ($commentDetails['post_comment'] as $postsComments) {
                    $postCommentBoxClassColor = ($k%2 == 0) ? "": "even";
                    $grayedOutClass = ( $postsComments['is_spam'] == '1' ) ? "grayedOut" : "";
                    $spamCommentStyle = "";
                    if( (Yii::app()->session['adminKey'] == '1') && ($postsComments['is_spam'] == '1') ){
                        $spamCommentStyle = "border: 2px solid #ED1C24;";                
                    }
            ?>
                    <div class="dd_coment_box <?=$postCommentBoxClassColor;?> hiddenPostComments" style="width:98%; <?=$spamCommentStyle;?>">
                    <div class="user_image"> <img src="<?=Yii::app()->theme->getBaseUrl().'/images/icons/user.png';?>" width="60px"> </div>
                    <div class="ratting_box">
                        <span class="rating_title">Rating</span>
                        <span class="tooltip like_icon" href="#"><?=$postsComments['likes_total'];?><span class="classic">Total number of Likes</span></span>
                        <span class="tooltip dislike_icon" href="#"><?=$postsComments['dislikes_total'];?><span class="classic">Total number of Dislikes</span></span>
                    </div> <!-- /End of ratting_box -->
                    <div class="dd_coment" commentId="<?=$postsComments['id'];?>">
                        <ul class="dd_coment_heading">
                            <a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$postsComments['user_id']]['username'];?><span class="classic">Username</span></a>
                    <a class="tooltip reputation" href="#" style="margin-right: 5px;">*<?=$usersStats[$postsComments['user_id']]['user_reputation'];?><span class="classic">User reputation</span></a>
                    <a class="tooltip" href="#" style="margin-right: 5px;"><?php $u = ForumClass::formatDate($postsComments['date_create']); echo $u['date'];?><span class="classic">Date of comment</span></a>
                    <a class="tooltip" href="#" style="margin-right: 5px;"><?=$u['time'];?><span class="classic">Time of comment</span></a>
                    <!-- a class="tooltip" href="#" style="margin-right: 5px;">open all<span class="classic">Open ALL comments</span></a>-->
                    <!--<a class="user-attach-icon tooltip" href="#" style="margin-right: 5px;"><span class="classic">Attachment</span></a> -->

                    <?php

                    if( isset($postsComments['attachement']) ){
                        // Display original file name
                        $attachement = explode(".", $postsComments['attachement']);
                        $fileNameLength = (int) ( (strlen($attachement[0])) + 1);
                        $originaleFileName = substr($postsComments['attachement'], $fileNameLength);
                        $classNotAllowed = "notAllowed";
                        $dowloadAttachementLink = "";
                        if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){
                            $classNotAllowed = "";
                            $dowloadAttachementLink = "href='../forum/downloadAttachement/{$postsComments['id']}'";
                        }
                    ?>

                        <a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="margin-right: 5px;"><span class="classic"><?=$originaleFileName;?></span></a>

                    <?php }  ?>

                        </ul>
                        <div class="clear"></div>
                        <span class="comment more"><?=$postsComments['message'];?></span>
                        <div class="like_buuton_box" commentId="<?=$postsComments['id'];?>">
                            <a><span class="like_button <?=$grayedOutClass;?>" likeAction="like">Like</span></a>
                            <a><span class="dislike_button <?=$grayedOutClass;?>" likeAction="dislike">Dislike</span></a>
                        </div> <!-- /End of like_buuton_box -->
                        <div class="clear"></div>
                        <a class="floatLeft replpToPostComment <?=$grayedOutClass;?>" commentId="<?=$postsComments['id'];?>" style="cursor: pointer;font-size:0.8em;">Reply to post</a>

                        <?php

                            if( $postsComments['is_spam'] == '1' ){
                                if( Yii::app()->session['adminKey'] == '1' ){?>
                                <a class="floatLeft deleteComment" commentId="<?=$postsComments['id'];?>" style="font-size:0.8em; margin-left:25px;"><em>Delete comment</em></a>
                            <?php
                                }else{?>
                                      <label class="floatLeft redText" commentId="<?=$postsComments['id'];?>" style="font-size:0.8em; margin-left:25px;"><em>Comment under review</em></label>  
                                <?php }
                                }else{
                                if( $reportAsSpamAllow ){?>
                                    <a class="floatLeft reportAsSpam" commentId="<?=$postsComments['id'];?>" style="font-size:0.8em; margin-left:25px;"><em>Report as spam</em></a>
                                    <?php
                                }
                            }
                            ?>

                        <div class="commentLink" style="margin-right: 0px;"><span> In reply to </span> <a href=""><?=$usersStats[$commentDetails['comment']->user_id]['username'];?></a></div>
                        <ul class="dd_social_list ">
                            <li><a href="http://www.facebook.com" class="face_book"></a></li>
                            <li><a href="http://www.twtter.com" class="twitter"></a></li>
                            <li><a href="https://plus.google.com" class="googleplus"></a></li>
                            <li><a href="https://www.linkedin.com" class="linked"></a></li>                                        
                        </ul>
                        <div class='postBlock'>
                            <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$postsComments['id'];?>" commentReference="<?=$commentDetails['comment']->id;?>">
                                <br />
                                <textarea id="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                                <div class="submitBtn"><a class="dd_post_button" title="Submit comment" >Post</a></div>
                                <br/><br/><br/>
                                <div class='attachement-div'>
                                    <input type="file" class='attachement-file' id="attachement<?=$postsComments['id'];?>" name="attachement<?=$postsComments['id'];?>" uploadsuccess="0" uploadfile="null" multiple />
                                    <span class="user-attach-icon attachement-icon" style="width: 25%; margin-top: 4px;padding-left: 18px;">
                                        Add attachement
                                        <span class="attachement-text" style="padding-left: 17px !important;"></span>
                                    </span>

                                </div> <!-- /End of attachement-div -->
                            </form>    
                        </div> <!-- /End of postBlock -->
                     </div> <!-- /End of dd_comment-->
                </div> <!-- /End of dd_comment_box -->

        <?php
                $k++;
                } ?>
             </div> <!-- /End of dd_comment -->
        </div> <!-- /End of dd_comment_box -->
                            <?php
                            $i++;
            }
     ?>
            <!-- Comment box grey -->
            <div class="clear"></div>
            <div class="user-pagination">
                
                <!-- Number of records to view drop down menu -->
                <div class="user-page-nav">
                    <span title="Select number of records to view from the dropdown menu">View</span>
                     <select data-placeholder=" " class="chzn-select" style="width: 60px; display: none;" tabindex="-1">
                       <option value="6"<?php if( $commentViewLimit == 6 ) echo "selected";?>>6</option>
                       <option value="12"<?php if( $commentViewLimit == 12 ) echo "selected";?>>12</option>
                       <option value="25"<?php if( $commentViewLimit == 25 ) echo "selected";?>>25</option>
                       <option value="50"<?php if( $commentViewLimit == 50 ) echo "selected";?>>50</option>
                       <option value="100"<?php if( $commentViewLimit == 100 ) echo "selected";?>>100</option>
                     </select>
                    <script type="text/javascript"> $(".chzn-select").chosen();</script>
                </div> <!-- /End of user-page-nav -->

                <!-- Bottom navigation menu -->
                <div class="page_numbers forumPageNumbers">
                    <?php                       
                      echo ForumClass::renderPagination($commentViewLimit, $pageSelected, $commentOrderBy, $listingId, $userProfession );
                    ?>

                    <input type='hidden' id='commentViewLimit' value='<?=$commentViewLimit;?>' />
                </div> <!-- /End of page_numbers forumPageNumbers -->            
             </div> <!-- /End of attachement-div -->
            
            <div class="clear"></div>
            
<?php } ?>      
            
</div> <!-- /End of voice-your-opinion -->
