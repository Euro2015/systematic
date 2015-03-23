<div class="clear"></div><style>#sign-up-tabs li a{  padding: 0px !important;    padding-top: 7px !important;	  font-size: 1.4em !important;}</style>
     <div>
            <?php 
             $this->renderPartial('//../modules/businesslisting/views/layouts/listing_slider');  
            ?> 
        </div>
         <div class="clear"></div>
    <p class="breadcrumb"><a href="index.php" >Home</a> &gt; Preview listing</p>    
    <!-- Where business meets invention --> 
    <!-- /main-content -->
    <div class="clear"></div>
	<div> 
        <?php //$modules->get('listing_slider'); ?> 
    </div>
    <div class="clear"></div>
	  <div class="sign-up-tabss"> <!-- start sign up tab -->            <div id="tabs_container">            <ul id="sign-up-tabs">			  <li class="active"><a href="#taba">Details</a></li>					        <li><a href="#tab2">Reviews</a></li>                  <li><a href="#tab3">Samples</a></li>                  <li><a href="#tab4">Downloads</a></li>                  <li><a href="#tab5">News & updates</a></li>                  <li><a href="#tab6">FAQ's</a></li>                  <div class="clear"></div>                </ul>        <div class="clear"></div>    </div> <!-- /tabs_container -->	  <div id="tabs_content_container">	          <div id="taba" class="preview-listing-box sign-up-tab_content" style="display:block;">
 <?php  $users = User::model()->findByPk(Yii::app()->user->getId());                    $abimage =  Yii::app()->baseUrl.'/upload/logo/'.$users->drg_image;                  $siteurl = $this->createAbsoluteUrl('/preview_business_listing/blistid/'.$model->drg_blid);                ?>
            <div>
                <a href="<?php echo Yii::app()->createUrl('businesslisting/business_listing_step2/blistid/'.$model->drg_blid)?>" class="button  black exitpreview"> Exit preview mode</a>				<div class="social-share-button" style="margin-top: 35px;  z-index: 9999;">                  <!-- Facebook -->                  <a href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $users->co_title;?>&amp;p[summary]=<?php echo $users->co_slogon ;?>&amp;p[url]=<?php echo urlencode($siteurl);?>&amp;                                  p[images][0]=<?php echo $abimage;?>" class="social-icon icon-facebook" target="_blank" alt="Facebook"></a>                  <!-- twitter -->                  <a class="social-icon icon-twitter" href="https://twitter.com/home?status=<?php echo $users->co_title; ?>+<?php echo urlencode($siteurl);?>" target="_blank" alt="Twitter"></a>                  <!-- linkedin -->                  <a class="social-icon icon-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($siteurl);?>&amp;title=<?php echo $users->co_title;?>&amp;summary=<?php echo $users->co_slogon;?>" target="_blank" alt="LinkedIn"></a>                  <!-- Google+ -->                  <a class="social-icon icon-google" href="https://plus.google.com/share?url=<?php echo urlencode($siteurl);?>&amp;title=<?php echo $users->co_title;?>&amp;summary=<?php echo $users->co_slogon;?>" target="_blank" alt="Google+"></a>                </div>				
            </div>			            <div class="sl-page3">
                        <div class="pl-logo-box"> 
                              <div id="pl-logo" class="pl-photograph" style="   height: 88px; width: 114px;" >
                                <?php 
                                if(!empty($users->drg_image)){ 
                                    $img_src = Yii::app()->baseUrl.'/upload/logo/'.$users->drg_image;
                                 ?>
                                      <img id="pl-logo" src="<?php echo $img_src; ?>" style="  height: 88px;  width: 113px;" />
                              <?php }
                              else{
                              ?>
                                    <br/><br/>Image dimensions must not exceed a standard 6 x 4 photo<br> (400 x 600 pixels max)
                              <?php 
                              }
                              ?>
                              </div>
                               <div class="headings" style="  width: 79%;  margin-left: 130px;">
                              
                                        <h2><?php echo $users->co_title;?></h2>
                                        <h3><?php echo $users->co_slogon;?></h3>
                                        <div class="content">
                                          <label class="heading">Listing number: <?php echo $model->drg_blid;?></label>
                                              <div><!--<span class="width_20">&nbsp;</span>--><?php echo $model->drg_slogon;?></div>
                                        </div>
                                </div>
                                <div class="clear"></div>
                        </div>
                        <br class="clear" />
                               <div class="content">
                                <label class="heading">Who we are</label><br class="clear"/>
                                <div >								
                                    <div class="prevew_text" style="height: auto;">
                                        <span class="width_20">&nbsp;</span> 
                                        <?php $count =  str_word_count($model->drg_whoweare);?> 
                                        <?php                                          $who = str_replace("\n", "</p><p>", $model->drg_whoweare); 
                                        if($count>150){
                                            $test =  implode(' ', array_slice(explode(' ', $who), 0, 120));
                                        }else {
                                            $test =  implode(' ', array_slice(explode(' ', $who), 0, 50));
                                        }
                                        ?>
                                        <div class="less1">
                                        <?php echo $test; ?>&nbsp;&nbsp;<a onclick="jQuery('.full').show();jQuery('.less1').hide();" class="more readmore">Read more &gt;&gt;</a>                                                                            
                                        </div>
                                        <div class="full" style="display:none;">
                                            <?php echo str_replace("\n", "</p><p>", $model->drg_whoweare); ?> &nbsp;&nbsp; <a  onclick="jQuery('.less1').show();jQuery('.full').hide();" class="more readmore">Read less &gt;&gt;</a>                                          
                                        </div>
                                        &nbsp;&nbsp;                                        
                                    </div>
                                    
                                </div>
                                </div>
                        <div class="clear"></div><br />
                            <div class="content">
                                <label class="heading">What we offer</label><br class="clear"/>
                                <div>
                                    <div  class="prevew_text" style="height: auto;" >
                                        <span class="width_20">&nbsp;</span>
                                        <?php $count =  str_word_count($model->drg_offer);?> 
                                        <?php $who1 = str_replace("\n", "</p><p>", $model->drg_offer);
                                        if($count>150){
                                            $test =  implode(' ', array_slice(explode(' ', $who1), 0, 120));
                                        }else {
                                            $test =  implode(' ', array_slice(explode(' ', $who1), 0, 50));
                                        }
                                        ?>
                                        <div class="less2">
                                        <?php echo $test; ?>&nbsp;&nbsp;<a onclick="jQuery('.full1').show();jQuery('.less2').hide();" class="more readmore">Read more &gt;&gt;</a>                                                                            
                                        </div>
                                        <div class="full1" style="display:none;">
                                            <?php echo str_replace("\n", "</p><p>", $model->drg_offer); ?> &nbsp;&nbsp; <a  onclick="jQuery('.less2').show();jQuery('.full1').hide();" class="more readmore">Read less &gt;&gt;</a>                                          
                                        </div>
                                        
                                    </div>
                                    
                                 </div>    
                            </div>
                        <div class="clear"></div><br />
                        <div class="clear"></div><br />		  <div class="content"><div class="left" style="  width: 78%;  float: left;">                                <label class="heading">What we can do for you</label><br class="clear"/>                                <div>                                    <div  class="prevew_text" style="height: auto;" >                                        <span class="width_20">&nbsp;</span>                                        <?php $count3 =  str_word_count($model->drg_whatwecando);?>                                         <?php                                         if($count3>100){                                            $test3 =  implode(' ', array_slice(explode(' ', $model->drg_whatwecando), 0, 70));                                        }else {                                            $test3 =  implode(' ', array_slice(explode(' ', $model->drg_whatwecando), 0, 50));                                        }                                        ?>                                        <div class="less3">                                        <?php echo $test3; ?>&nbsp;&nbsp;<a onclick="jQuery('.full3').show();jQuery('.less3').hide();" class="more readmore">Read more &gt;&gt;</a>                                                                                                                    </div>                                        <div class="full3" style="display:none;">                                            <?php echo str_replace("\n", "</p><p>", $model->drg_whatwecando); ?> &nbsp;&nbsp; <a  onclick="jQuery('.less3').show();jQuery('.full3').hide();" class="more readmore">Read less &gt;&gt;</a>                                                                                  </div>                                                                            </div>                                                                     </div>                                			
                            <div class="clear"></div>
                            <div>&nbsp;</div><br/>
                            <div class="member_business_info" style="background: #ecdeed;  height: 63px;">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td valign="top" class="heading" style="color: #A84793;">Member Since</td>
                                            <td valign="top" class="heading" style="color: #A84793;">Reputation</td>
                                            <td valign="top" class="heading" style="color: #A84793;">Average user rating</td>
                                            <td valign="top" class="heading" style="color: #A84793;">Location</td>
                                        </tr>
                                        <tr>
                                            <td class="value"><?php echo date('d/m/Y',strtotime($UserData['drg_ltime'])); ?></td>
                                            <td class="value" align="center"><span class="blue-font"> 216 </span></td>
                                            <td class="value"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/4-stars.png" width="100%;" ></td>
                                            <td class="value"><?php echo $loation = implode(',',array( $UserData['drg_town'], Country::model()->findByPk($UserData['drg_country'])->country)); ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        <!--<div class="special-offer">
                        	<label class="heading">Special offers</label><br class="clear" />
                            <div class="offer-box">
                            	<p>There are no <br /> special offers available<br /> at the moment</p>

                            </div>
                        </div> -->
</div>
                            <div class="map-offer" style="float: right;">
                                <label class="heading">Where we are</label><br class="clear" />
                                <div class="offer-box" style="border: 2px solid #A84793;">
                                    <?php
                                    $gMap = new EGMap();
                                    $gMap->setWidth(150);
                                    $gMap->setHeight(150);
                                    $gMap->zoom = 4;

                                    $address = $UserData['drg_town'] .','. Country::model()->findByPk($UserData['drg_country'])->country;

                                    // Create geocoded address
                                    $geocoded_address = new EGMapGeocodedAddress($address);
                                    $geocoded_address->geocode($gMap->getGMapClient());

                                    // Center the map on geocoded address
                                    $gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());

                                    $info_window = new EGMapInfoWindow('<div><a href="https://www.google.co.in/maps/place/'.$address.'" target="_blank" >Click on map to view location
                                    <br/>in google maps</a> </div>');

                                    $marker = new EGMapMarker($geocoded_address->getLat(), $geocoded_address->getLng());

                                    $marker->addHtmlInfoWindow($info_window);
                                    // Add marker on geocoded address

                                    $gMap->addMarker($marker);
                                    $gMap->renderMap();
                                    ?>

                                </div>
                            </div></div>
               <?php /* <div class="where_we_are">
                    <label class="heading">Where we are</label><br class="clear" />
                    <div class="googlemap-box">
                        <?php
                        $gMap = new EGMap();
                        $gMap->setWidth(300);
                        $gMap->setHeight(200);
                        $gMap->zoom = 5;

                        $sample_address = 'Czech Republic, Prague, Olivova';

                        // Create geocoded address
                        $geocoded_address = new EGMapGeocodedAddress($sample_address);
                        $geocoded_address->geocode($gMap->getGMapClient());

                        // Center the map on geocoded address
                        $gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());

                        $info_window = new EGMapInfoWindow('<div>I was living here as a kid!</div>');

                        $marker = new EGMapMarker($geocoded_address->getLat(), $geocoded_address->getLng());

                        $marker->addHtmlInfoWindow($info_window);
                        // Add marker on geocoded address

                        $gMap->addMarker($marker);
                        $gMap->renderMap();
?>
                    </div>
                    </div> */ ?>
                        <div class="clear"></div>
                            <div>&nbsp;</div>
                            <div>&nbsp;</div>



                    </div>
                        <br />
                
        </div><!--submit-listing box ends--->
	       <div class="clear"></div>    
      </div>
      <div class="clear"></div>
    </div>
    </div>
<script type="text/javascript">

    /*jQuery(".more").live("click",function(){
        jQuery(this).addClass("less");
        jQuery(this).removeClass("more");
        jQuery(".less1").hide("slow");
        jQuery(".full").show("slow");
    });
    jQuery(".less").live("click",function(){
        jQuery(".full").hide("slow");
         jQuery(".less1").show("slow");
        jQuery(this).removeClass("less");
        jQuery(this).addClass("more");
        
    });*/
    
    
    
    /* jQuery('.readmore').click(function(){
        if(jQuery(this).hasClass('less')){
            jQuery(this).siblings('.prevew_text').css({'height':'auto'});
            jQuery(this).html('&lt;  &lt; Read less');
            jQuery(this).removeClass('less');
            jQuery(this).addClass('more');
        }else{
            var height = jQuery(this).attr('id');
            height = height.replace('height-','')
            jQuery(this).siblings('.prevew_text').css({'height': height+'px'});
           	jQuery(this).html('Read more &gt; &gt;');
            jQuery(this).removeClass('more');
           	jQuery(this).addClass('less');
        }
    }); */
</script>
    <!--end bottom carousel----->    
  