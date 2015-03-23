<br />
<div class="add-carousel"><!--start advertiser carousel--> 
<?php 

//$user_all_banners=$db->selectArrRecords("drg_banner_ads","banner_path,banner_link,banner_id,drg_user_id","banner_approve_status=1");
//$totalResults=$db->CountQuery("drg_banner_ads","*","banner_approve_status=1");

$user_all_banners = Bannerads::model()->findAll("banner_approve_status=1");

if(count($user_all_banners)!=0){?>
      <ul id="add-carousel-wrap" class="jcarousel-skin-ie7">
      
         <?php 
            foreach($user_all_banners as $bannerval){
            ?>
                 <li>
                 <?php 
                  $username = User::model()->find('drg_id='.$bannerval->drg_user_id);                  
                 ?>
                 <a href="http://<?php echo str_replace("http","",$bannerval->banner_link);?>"  target="_blank" onclick="javascript:updateHit(<?php echo $bannerval->banner_id;?>)">
                    <img src="<?php echo Yii::app()->baseUrl.'/upload/'.$bannerval->banner_path; ?>" height="77" width="420" title="Image Name: <?php echo $bannerval->banner_path; ?>" />
                 </a>  
                 </li>
	
            <?php     
            }
         ?>   
      </ul>
<?php }else{ ?>
        <ul id="add-carousel-wrap" class="jcarousel-skin-ie7">
            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/advertise-here.png" height="77" /></li>
            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/business-help-ad.png" height="77" /></li>
            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/dragonsnet.png" height="77" /></li>
            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/member-listing-ad.png" height="77" /></li>
            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/business-support-ad.png" height="77" /></li>
            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/skill-mentor-ad.png" height="77" /></li>
        </ul>
<?php } ?>
 </div> <!-- /end advertiser carousel -->
<?php
if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/preview_user_listing")
{
?>
 <div id="how-to-div" class="clearfix"> 
        <a href="#" id="play1" class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />Get to know the entrepreneur</a> 
        <a href="#" id="play2" class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />Get to know the business idea</a> 
        <a href="#" class="clearfix" id="contactpopup">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30" />Contact the entrepreneur</a> 
</div>
<?php
}
else
{
?>
 <div id="how-to-div" class="clearfix"> 
        <a href="#" class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />Get to know the entrepreneur</a> 
        <a href="#" class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />Get to know the business idea</a> 
        <a href="#" class="clearfix" >
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30" />Contact the entrepreneur</a> 
</div>
<?php
}
?>
   <!-- popup for contact-->
        <div class="registration-box contact_cont" style="display:none">
      
        	<form action="" method="post">
            <input type="hidden" name="url" id="url" value="http://business-supermarket.com<?php echo Yii::app()->request->getUrl();?>">
            	<div class="contact_inner" style="height: 364px;">
            	<div class="closebutton_pop" style="position: relative; top: -13px; z-index: 100;left: 379px; text-align: center;">
                    <a title="Close" href="#" id="close" ><img src="/var/www/themes/business/images/close.png" alt="business supermarket close button" width="24"></a>
                </div>
<?php
if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/preview_user_listing")
{
$lid=$_GET['id'];
if($lid=="")
{
$lid = Yii::app()->request->getParam('listid');
}
}
$connection = Yii::app()->db;
$command1 = $connection->createCommand("select * from `drg_user_listing` where `drg_lid`='$lid'");
$myresult1 = $command1->queryRow();
$uid=$myresult1['drg_uid'];
$title=$myresult1['drg_title'];
$command12 = $connection->createCommand("select * from `drg_user` where `drg_uid`='$uid'");
$myresult12 = $command12->queryRow();
$uname=$myresult12 ['drg_username'];
$uemail=$myresult12 ['drg_email'];

$id = Yii::app()->user->getId();
$command = $connection->createCommand("select * from `drg_user` where `drg_id`='$id'");
$myresult = $command->queryRow();
$cname=$myresult['drg_username'];
$cemail=$myresult['drg_email'];
?>
<div class="feed_heading" style="padding-left: 30px !important;">
                	<span class="span">
Send To : &nbsp; <?php echo $uname; ?> </span>
</div>
                <div class="feed_heading"  style="padding-left: 30px !important;">
                	<span class="span">
                    Subject : 
                    </span>
         <input type="hidden" name="listid" value="<?php echo $lid; ?>">
<input type="hidden" name="userid" value="<?php echo $id; ?>"><input type="hidden" name="fromemail" value="<?php echo $cemail; ?>">
                  <input type="hidden" name="toemail" value="<?php echo $uemail; ?>"><input type="hidden" name="toname" value="<?php echo $uname; ?>">
<input type="hidden" name="fromname" value="<?php echo $cname; ?>"><input type="hidden" name="title" value="<?php echo $title; ?>">
                	<input type="text" name="subject" id="subject" class="feedbackinput" placeholder="Please Enter subject" style="margin-top: -9px;
margin-left: 5px;width: 565px;
"/>
                </div>
                
                <div class="feed_heading"  style="padding-left: 30px !important;">
                	<span class="span">
                    Message : 
                    </span>
                     
                	<textarea  required="required" class="feedbacktextarea" placeholder="Describe your message" name="msg" id="msg" style="width: 575px;
height: 149px; padding: 7px;"> </textarea>
                </div>
                <br /> 

                <div class="button_feed" style="margin-top: 143px;
text-align: center;
width: 763px;
margin-left: 0px;">
                	 Send a copy to my email address for my records <input type="checkbox" name="memail" value="yes"><br/><br/><input type="submit" name="sendmaillist" tabindex="12" id="sendmaillist" class="button black" value="Send">
                </div>
            </div>
            </form>
		</div>


   <!-- popup for video 1-->
        <div class="registration-box contact_cont1" style="left: 50px;
display: none;">

<div class="contact_inner1" style="height: 300px;
display: block;
width: 50%;">
            	<div class="closebutton_pop" style="position: relative;
top: 14px;
z-index: 100;
margin-left: 294px;">
                	<a title="Close" href="#" id="close" ><img src="/var/www/themes/business/images/close.png" alt="business supermarket close button" width="24"></a>
                </div>
<?php
if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/preview_user_listing")
{
$lid=$_GET['id'];
if($lid=="")
{
$lid = Yii::app()->request->getParam('listid');
}
}
$connection = Yii::app()->db;
$command1 = $connection->createCommand("select * from `drg_user_listing` where `drg_lid`='$lid'");
$myresult1 = $command1->queryRow();
$uid=$myresult1['drg_video1'];

$command11 = $connection->createCommand("select * from `drg_listing_videos` where `drg_lid`='$lid' order by drg_video_id asc limit 1");
$myresult11 = $command11->queryRow();
$file1=$myresult11['drg_listing_video'];
$path11 = $_SERVER['DOCUMENT_ROOT'].''.Yii::app()->request->baseUrl; 
$apath1= $path11."/upload/users/".Yii::app()->user->getState('ufolder')."/videos/".$file1;
?>
  <div class="sl-photo-box" style=" width:450px;margin-left: 15px;">
                <div class="clear"></div>
 

                <div id="ova-example-player-container_11" class="video_player_container" style="">
                    <div id="ova-example-player_11" style="position:relative;">
                        <div id="ova-player-instance_11" loaded="false" class="video_player_instances" style=""> 
                            <!-- SELECTED PLAYER INSTANCE GOES IN HERE -->
                        </div>
 <?php
                        if (file_exists($apath1)) {
?>
<script language="javascript">
                                jwplayer("ova-player-instance_11").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                         file: '<?php echo Yii::app()->getBaseUrl(true);?>/upload/users/<?php echo Yii::app()->user->getState('ufolder');?>/videos/<?php echo $file1; ?>',autostart:'true',
                
                                 height: 360,
                                width: 640,
events: { 
                    onComplete: function() { window.location='../index.php'; } 
                }  
                                });
                            </script> 
<?php
}
else
{
?>
<script language="javascript">
                                jwplayer("ova-player-instance_11").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                                file: '<?php echo $uid; ?>',
                                autostart:'true',
                
                                 height: 360,
                                width: 640,
events: { 
                    onComplete: function() { window.location='../index.php'; } 
                }  
                                });
                            </script> 
<?php
}
?>
                           
                    </div>
                </div>
         </div> 
            </div>
            
		</div>
 
 <!-- popup for video 2-->
        <div class="registration-box contact_cont2" style="
left: 50px;
display: none;
">

<div class="contact_inner2" style="height: 300px;
display: block;
width: 50%;">
            	<div class="closebutton_pop" style="position: relative;
top: 14px;
z-index: 100;
margin-left: 294px;">
                	<a title="Close" href="#" id="close" ><img src="/var/www/themes/business/images/close.png" alt="business supermarket close button" width="24"></a>
                </div>
<?php

if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/preview_user_listing")
{
$lid=$_GET['id'];
if($lid=="")
{
$lid = Yii::app()->request->getParam('listid');
}
}
$connection = Yii::app()->db;
$command1 = $connection->createCommand("select * from `drg_user_listing` where `drg_lid`='$lid'");
$myresult1 = $command1->queryRow();
$uid2=$myresult1['drg_video2'];

$command22 = $connection->createCommand("select * from `drg_listing_videos` where `drg_lid`='$lid' order by drg_video_id desc limit 1");
$myresult22 = $command22->queryRow();
$file2=$myresult22['drg_listing_video'];
$path11 = $_SERVER['DOCUMENT_ROOT'].''.Yii::app()->request->baseUrl; 
$apath11= $path11."/upload/users/".Yii::app()->user->getState('ufolder')."/videos/".$file2;
?>
  <div class="sl-photo-box" style=" width:450px;margin-left: 15px;">
                <div class="clear"></div>
 

                <div id="ova-example-player-container_22" class="video_player_container" style="">
                    <div id="ova-example-player_22" style="position:relative;">
                        <div id="ova-player-instance_22" loaded="false" class="video_player_instances" style=""> 
                            <!-- SELECTED PLAYER INSTANCE GOES IN HERE -->
                        </div>
<script language="javascript">
                                jwplayer("ova-player-instance_22").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                                file: '<?php echo $uid2; ?>',
                                height: 285,
                                width: 650,
                                });
                            </script>  
 <?php
                        if (file_exists($apath1)) {
?>
<script language="javascript">
                                jwplayer("ova-player-instance_22").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                         file: '<?php echo Yii::app()->getBaseUrl(true);?>/upload/users/<?php echo Yii::app()->user->getState('ufolder');?>/videos/<?php echo $file2; ?>',autostart:'true',
                
                                 height: 360,
                                width: 640,
events: { 
                    onComplete: function() { window.location='../index.php'; } 
                }  
                                });
                            </script> 
<?php
}
else
{
?>
<script language="javascript">
                                jwplayer("ova-player-instance_22").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                                file: '<?php echo $uid2; ?>',
                              autostart:'true',
                
                                 height: 360,
                                width: 640,
events: { 
                    onComplete: function() { window.location='../index.php'; } 
                }  
                                });
                            </script>
<?php
}
?>
                           
                    </div>
                </div>
         </div> 
            </div>
            
		</div>
 