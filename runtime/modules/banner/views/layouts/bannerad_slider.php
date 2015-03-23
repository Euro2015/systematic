<br />
<div class="add-carousel"><!--start advertiser carousel-----> 
<?php 

//$user_all_banners=$db->selectArrRecords("drg_banner_ads","banner_path,banner_link,banner_id,drg_user_id","banner_approve_status=1");
//$totalResults=$db->CountQuery("drg_banner_ads","*","banner_approve_status=1");

$user_all_banners = Bannerads::model()->findAll("banner_approve_status = 2 ");


if(Yii::app()->controller->id=='banner' && in_array(Yii::app()->controller->action->id,array('reject'))){
        
        $bannerId = Yii::app()->request->getParam('code');
        
        $user_all_banners1 = Bannerads::model()->findByPk($bannerId); 
        
        if(count($user_all_banners1)>0){?>
              <ul id="add-carousel-wrap" class="jcarousel-skin-ie7">
                 <li>
                     <?php $username = User::model()->findByPk($user_all_banners1['drg_user_id']); ?>
                     <a href="http://<?php echo str_replace("http","",$bannerval->banner_link);?>"  target="_blank" onclick="javascript:updateHit(<?php echo $user_all_banners1['banner_id'];?>);'">
                        <img src="<?php echo Yii::app()->getBaseUrl(true).'/upload/'.$user_all_banners1['banner_path']; ?>" height="77" width="420" title="Image Name: <?php echo $user_all_banners1['banner_path']; ?>" />
                     </a>  
                 </li> 
              </ul>
        <?php }  
}else{ 
    
        if(count($user_all_banners)!=0){?>
              <ul id="add-carousel-wrap" class="jcarousel-skin-ie7">
              
                 <?php 
                    foreach($user_all_banners as $bannerval){
                    ?>
                         <li>
                         <?php 
                          $username = User::model()->find('drg_id='.$bannerval->drg_user_id);                  
                         ?>
                         <a href="http://<?php echo str_replace("http","",$bannerval->banner_link);?>"  target="_blank" onclick="javascript:updateHit(<?php echo $bannerval->banner_id;?>);">
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

<?php } ?>
 </div>  
 
<script language="javascript" type="text/javascript">
function updateHit(bannerId){
	jQuery.ajax({				
    	type:"POST",
    	url:"<?php echo Yii::app()->createUrl('/banner/updatehit') ?>",
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
