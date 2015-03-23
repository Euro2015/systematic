<?php
error_reporting(0);
if($_POST['sendmaillist'])
{
$email=$_POST['toemail'];
$tname=$_POST['toname'];
$fname=$_POST['fromname'];
$fromuname=$_POST['fromuname'];
$femail=$_POST['fromemail'];
$title=$_POST['title'];
$subject11=$_POST['subject'];
$msg=$_POST['msg'];
$listid=$_POST['listid'];
$userid=$_POST['userid'];
$furl=$_POST['furl'];

$sql = "insert into drg_comments (message, user_id, listing_id, first_comment) values (:message, :user_id, :listing_id, :first_comment)";
$parameters = array(":message"=>$msg, ":user_id" =>$userid,  ":listing_id" =>$listid,  ":first_comment" =>'1');
Yii::app()->db->createCommand($sql)->execute($parameters);

$sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >here >> </a>';			$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing/fupdate/listid/".$listid.'" target="_blank" >here >> </a>';					
$template =  MailTemplate::getTemplate('listing_via_contact_user');
$string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($title),
                       '{{#USERNAME#}}'=>ucwords($tname),
                        '{{#SITELINK#}}'=>ucwords($sitelink)
                    );
$subject="Listing ".$model['drg_title']." requires your input";
$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
$result =  SharedFunctions::app()->sendmail($email,$subject,$body);
$newmsg=str_replace("\n","</p><p>",$msg);
$msgg="<span style='color:black;margin:0px;text-transform:capitalize;'>".$newmsg."</span>";

$template1 =  MailTemplate::getTemplate('listing_via_contact_user2');
$string1 = array('{{#LISTINGTITLE#}}'=>ucwords($title),
                       '{{#USERNAME#}}'=>ucwords($tname),
					   '{{#SNAME#}}'=>ucwords($fname),
					   '{{#SUNAME#}}'=>ucwords($fromuname),
                        '{{#SITELINK#}}'=>ucwords($yii_user_request_id),
						'{{#MESSAGE#}}'=>ucwords($msgg)
                    );
$subject1="You have received a private message re: ".$subject11;
$body1 = SharedFunctions::app()->mailStringReplace($template1->template_body,$string1);
$result1 =  SharedFunctions::app()->sendmail($email,$subject1,$body1);
                            
			

$memail=$_POST['memail'];
if($memail!="")
{
$template =  MailTemplate::getTemplate('listing_via_contact_user3');
$string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($title),
                       '{{#USERNAME#}}'=>ucwords($fname),
					   '{{#USER#}}'=>ucwords($tname),
						'{{#MESSAGE#}}'=>ucwords($msgg)
                    );
$subject="You have sent the following message to ".$model['drg_title'];
$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
$result =  SharedFunctions::app()->sendmail($femail,$subject,$body);

}
                            $this->redirect(Yii::app()->createUrl("$furl"));
                            die;   

}
?>
<script type="text/javascript">
	function show_video(video)
	{
		$('.home-slider-wrap').fadeOut();
		$('.home-video-wrap').fadeIn('slow'); 
		 jwplayer('my-video').setup({
                file: video,
                image: '/themes/business/images/robot/defult-video.png',
                width: '640',
                height: '360',
                autostart:'true',
                events: { 
                    onComplete: function() { window.location='../index.php'; } 
                }                 
            });
		
	}		function play_video(video)	{		$('.home-slider-wrap').fadeOut();		$('.home-video-wrap').fadeIn('slow'); 		 jwplayer('my-video').setup({                file: video,                image: '/themes/business/images/robot/defult-video.png',                width: '640',                height: '360',                autostart:'true',                events: {                     onComplete: function() { $('.home-slider-wrap').fadeIn('slow');		$('.home-video-wrap').fadeOut('fast'); }                 }                             });			}
	
	function show_slider()
	{
		$('.home-slider-wrap').fadeIn('slow');
		$('.home-video-wrap').fadeOut('fast');
	}
</script>


<script type="text/javascript">
  jQuery(".contact_cont").hide(1000);
		//<![CDATA[
		jQuery(function(){
			jQuery('#contactpopup').poshytip();
            jQuery('#play1').poshytip();
            jQuery('#play2').poshytip();
            jQuery('#demo1-basic1').poshytip();
			jQuery('#demo1-basic2').poshytip();
			jQuery('#feedback1').poshytip();
			jQuery('#demo1-tip-yellow').poshytip();
			 jQuery("#loginerrpopup").click(function(){		        jQuery(".sign-up-tabss").fadeOut();		   jQuery("#usererror").fadeIn('slow');	     	jQuery(".home-slider-wrap").fadeIn('slow');		    jQuery(".home-video-wrap").fadeOut('fast');		    jQuery("#ncol").fadeOut('fast');	         })
        jQuery("#contactpopup").click(function(){
             jQuery(".sign-up-tabss").fadeOut();	        jQuery(".contact_cont").fadeIn('slow');	        jQuery(".contact_inner").fadeIn('slow');		    jQuery(".home-slider-wrap").fadeIn('slow');		    jQuery(".home-video-wrap").fadeOut('fast');		    jQuery("#ncol").fadeOut('fast');
        })
        
		jQuery("#close,.close").click(function(){
            jQuery(".contact_cont").fadeOut();            jQuery(".contact_inner").fadeOut();            jQuery("#ncol").fadeIn('slow');	        jQuery(".sign-up-tabss").fadeIn('slow');	       	jQuery(".home-slider-wrap").fadeIn('slow');		    jQuery(".home-video-wrap").fadeOut('fast');			jQuery("#usererror").fadeOut('fast');
            })
         jQuery("#voiceopen").click(function(){            jQuery(".contact_cont").fadeOut();			jQuery(".contact_inner").fadeOut();			jQuery(".sign-up-tabss").fadeIn('slow');			jQuery("#tab2").fadeIn('slow');			jQuery("#taba").fadeOut();			jQuery("#tabhide1").removeClass('active');			jQuery("#tabshow2").addClass('active');        })		
		});		 
		//]]>	
		function remove_thankspopup()
		{
			jQuery("#popcnt").fadeOut("slow");
			jQuery(".feedbacthanks").fadeOut("slow",function (){
			     var href = window.location.href.split('/?'); 
			    window.history.pushState(null, "hi", href[0]);			 
                jQuery(".feedbacthanks , .thanks_popup").css("display","none !important");
                jQuery(".feedbacthanks , .thanks_popup").css("background","none");
                jQuery(".feedbacthanks , .thanks_popup").css("z-index","-9999");
			});
             
		}
		jQuery( window ).load(function() {
			jQuery(".tip-yellow").css("left","50%");
		});
		
	</script>
<style>
.favBtn
{
z-index:0 !important; 
}
</style>
<script language="javascript" type="text/javascript">
function updateHit(bannerId){
	jQuery.ajax({				
    	type:"POST",
    	url:"updateHit.php",
    	data:"banner_id="+bannerId,
    	cache: false,
    	success:function(response){
    	},
    	fail:function(error){
    		alert(error);
   		}
	});
}
// Advert Carousel
function mycarousel_initCallback(carousel)
{
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};
jQuery(document).ready(function() {
    jQuery('#add-carousel-wrap').jcarousel({
        wrap: 'circular',
        scroll: 1,
		 hoverPause: true,
     initCallback: mycarousel_initCallback
    });
    });
</script>

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
$connection = Yii::app()->db;
$contract=Yii::app()->controller->id."/".Yii::app()->controller->action->id;
$getslider = $connection->createCommand("select * from `drg_slider_listing` where `page_name`='$contract'");
$sliderresult = $getslider->queryRow();
$sliderid = $sliderresult['slider_id'];

$getsliderbtns = $connection->createCommand("select * from `drg_slider_btns` where `slider_id`='$sliderid'");
$sliderresults = $getsliderbtns->queryRow();
$sliderids = $sliderresults['slider_id'];
if($sliderids!="")
{
?>
 <div id="how-to-div" class="clearfix"> 
 <?php
 $getsliderbtnss = $connection->createCommand("select * from `drg_slider_btns` where `slider_id`='$sliderid' order by `btn_id` ASC");
$getbtns = $getsliderbtnss->queryAll();
foreach($getbtns as $data )
{
if($data['btn_videolink']!="")
{
?>
<a href="javascript:void(0)" onclick="play_video('<?php echo $data['btn_videolink']; ?>');" class="clearfix"> 
<?php 
}
else
{
?>
<a href="<?php echo $data['btn_sitelink']; ?>" class="clearfix"> 
<?php
}
?>
<img src="<?php echo Yii::app()->baseUrl; ?>/themes/business/images/buttons/<?php echo $data['btn_image']; ?>" width="30" /><?php echo $data['btn_text']; ?></a> 
         
<?php 
}
?>
</div>
<?php
}
else if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/preview_user_listing"  || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/rdelete" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/fupdate"){$lid=$_GET['id'];if($lid==""){$lid = Yii::app()->request->getParam('listid');}$connection = Yii::app()->db;$command1 = $connection->createCommand("select * from `drg_user_listing` where `drg_lid`='$lid'");$myresult1 = $command1->queryRow();$uid1=$myresult1['drg_video1'];$uid2=$myresult1['drg_video2'];$drg_uid=$myresult1['drg_uid'];$ncommand1 = $connection->createCommand("select * from `drg_user` where `drg_uid`='$drg_uid'");$nmyresult1 = $ncommand1->queryRow();$userfolder=$nmyresult1['drg_username']."_".$nmyresult1['drg_id'];$command11 = $connection->createCommand("select * from `drg_listing_videos` where `drg_lid`='$lid' order by drg_video_id asc limit 1");$myresult11 = $command11->queryRow();$file1=$myresult11['drg_listing_video'];$path11 = $_SERVER['DOCUMENT_ROOT'].'/'; $apath1= $path11."upload/users/".$userfolder."/videos/".$file1;if (file_exists($apath1)) {$videofile1= Yii::app()->getBaseUrl(true)."/upload/users/".$userfolder."/videos/".$file1;}else{$videofile1=$uid1;}$command22 = $connection->createCommand("select * from `drg_listing_videos` where `drg_lid`='$lid' order by drg_video_id desc limit 1");$myresult22 = $command22->queryRow();$file2=$myresult22['drg_listing_video'];$path11 = $_SERVER['DOCUMENT_ROOT'].'/'; $apath2= $path11."upload/users/".$userfolder."/videos/".$file2;if (file_exists($apath2)) {$videofile2= Yii::app()->getBaseUrl(true)."/upload/users/".$userfolder."/videos/".$file2;}else{$videofile2=$uid2;}$ufold=Yii::app()->user->getState('ufolder');
?>
 <div id="how-to-div" class="clearfix"> 
         <a href="javascript:void(0)" onclick="play_video('<?php echo $videofile1; ?>');" class="clearfix"> 
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />Get to know the entrepreneur</a> 
         <a href="javascript:void(0)" onclick="play_video('<?php echo $videofile2; ?>');" class="clearfix"> 
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />Get to know the business idea</a> 
         <a href="#" class="clearfix" id="<?php if($ufold!="") { echo "contactpopup"; } else { echo "loginerrpopup"; } ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30" />Contact the entrepreneur</a> 
</div>
<?php
}
else
{
?>
 <div id="how-to-div" class="clearfix"> 
        <a href="javascript:void(0)" onclick="play_video('');"  class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />How to list your business idea</a> 
      <a href="javascript:void(0)" onclick="play_video('');"  class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />How to market your listing</a> 
        <a href="#" class="clearfix" >
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30" />Frequently asked questions</a> 
</div>
<?php
}
?>
   <!-- popup for contact-->
         <div class="registration-box contact_cont" style="display:none; margin-left: 10px;">              	<form action="" method="post">            <input type="hidden" name="url" id="url" value="http://business-supermarket.com<?php echo Yii::app()->request->getUrl();?>">            	<div class="contact_inner" style="height: 411px;">            	<div class="closebutton_pop" style="position: relative; top: -13px; z-index: 100;left: 379px; text-align: center;">                    <a title="Close" href="#" id="close" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24"></a>                </div>                <div style="text-align: center; ">                    <h2 style="color:#00acce; margin-top: -15px;">You are about to send a private message to the owner of this listing</h2>                    <p>Your message will be private and only viewable by you and the listing owner.</p>                    <p style="width: 500px; margin: auto;"><em>If your question may be of interest to other users, then consider posting the message in the <b style="color: #A84793;"><a href="#" id="voiceopen"  style="color: #A84793;">Voice your Opinion</a></b> tab where other users could benefit from your query.</em></p>                </div>
 <?php
 if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/preview_user_listing" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/rdelete" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/fupdate")
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
$uname=$myresult12['drg_username'];
$usname=$myresult12['drg_surname'];
$uemail=$myresult12['drg_email'];
$ufname=$uname." ".$usname;
$id = Yii::app()->user->getId();
$command = $connection->createCommand("select * from `drg_user` where `drg_id`='$id'");
$myresult = $command->queryRow();
$cname=$myresult['drg_name'].' '.$myresult['drg_surname'];
$cuname=$myresult['drg_username'];
$cemail=$myresult['drg_email'];
?>
<div class="feed_heading" style="padding-left: 30px !important;">
    <span class="span">Send to: &nbsp; <?php echo $uname; ?> </span>
</div>
 <div class="feed_heading" style="padding-left: 30px !important;">
     <span class="span">Subject:</span>
     <input type="text" name="subject" id="subject" class="feedbackinput" placeholder="Please Enter subject" style="margin-top: -9px;margin-left: 5px;width: 573px;" required="" />                
 </div>       	
     <input type="hidden" name="listid" value="<?php echo $lid; ?>">
     <input type="hidden" name="fromuname" value="<?php echo $cuname; ?>">
     <input type="hidden" name="userid" value="<?php echo $id; ?>">
     <input type="hidden" name="fromemail" value="<?php echo $cemail; ?>">
     <input type="hidden" name="toemail" value="<?php echo $uemail; ?>">
     <input type="hidden" name="toname" value="<?php echo $uname; ?>">
     <input type="hidden" name="fromname" value="<?php echo $cname; ?>">
     <input type="hidden" name="title" value="<?php echo $title; ?>">       
     <?php $surll= $_SERVER["REQUEST_URI"];
     $surll1 = ltrim($surll, '/'); ?>         
     <input type="hidden" name="furl" value="<?php echo $surll1; ?>">            
                
     <div class="feed_heading"  style="padding-left: 30px !important;">
        <span class="span">Message:</span>
        <textarea  required="" class="feedbacktextarea" placeholder="Describe your message" name="msg" id="msg" style="width: 575px; height: 160px; padding: 4px;"> </textarea>
     </div>
     <br /> 
     <div class="button_feed">
         Send a copy to my email address for my records <input type="checkbox" name="memail" value="yes"><br/><br/><input type="submit" name="sendmaillist" tabindex="12" id="sendmaillist" class="button black" value="Send">
     </div>
</div>
</form>
</div><div class="confirm" id="usererror" style="display: none; background: none;" >          <div class="u-email-box success-popup" style="margin-left: 24px;  margin-top: 100px;">           	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:-2px;" />            <div class="my-account-popup-box" style="margin-top:-38px !important;height: 126px;">               <h2 style="color: black;  font-size: 15px;"> <span style="color: #e5a04d;  font-size: 32px;">Oops </span><br /><br />You need to be logged in to contact the entrepreneur              </h2>              <p><em>Please login to your account or create a new user account</em></p>                          <div class="center-button" style="margin-top:0px"><a  href="#" id="close"  class="black button">Close</a></div>               </div>          </div>        </div>