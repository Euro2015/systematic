
<div class="add-carousel"><!--start advertiser carousel--> 
<?php 

//$user_all_banners=$db->selectArrRecords("drg_banner_ads","banner_path,banner_link,banner_id,drg_user_id","banner_approve_status=1");
//$totalResults=$db->CountQuery("drg_banner_ads","*","banner_approve_status=1");

$user_all_banners = Bannerads::model()->findAll("banner_approve_status=2");

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
 <div id="how-to-div" class="clearfix"> 
        <a href="#;" class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />How to list your business idea</a> 
        <a href="<?php echo $this->createUrl('/page/faq');?>" class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />How to navigate the site</a> 
        <a href="<?php echo $this->createUrl('/page/faq');?>" class="clearfix">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30" />Contact us & FAQ's</a> 
</div>
 
 
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