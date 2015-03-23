<?php 
 $years = '';//explode(',',$model->drg_fprojections); 
?> 
<?php
/* @var $this ListingController */
/* @var $model Userlisting */
$type = array('name'=>'Business Services','slug'=>'business-services');
$this->breadcrumbs=array(
  strtolower($type['name']) => $type['slug'],
  $model->co_name
); 
?> 
<div>
        <?php 
           $this->renderPartial('//../modules/businesslisting/views/layouts/listing_slider');             
        ?>           
    </div>
    <div style="clear:both;"></div>        
    <div class="sign-up-tabss"> <!-- start sign up tab -->
      
      <div id="tabs_container">
            <ul id="sign-up-tabs">

                  <li class="active"><a href="#taba">Details<br />

                    18/03/2012</a></li>

                  <li><a href="#tab2">Voice your Opinion<br />

                    (No of comments)</a></li>

                  <li><a href="#tab3">Request a Sample<br />

                    (0)</a></li>

                  <li><a href="#tab4">Open for Bidding<br />

                    (0)</a></li>

                  <li><a href="#tab5">Open for Investment<br />

                    (0)</a></li>

                  <li><a href="#tab6">Investor Area</a></li>

                  <div class="clear"></div>

                </ul>
        <div class="clear"></div>
    </div> <!-- /tabs_container -->
    
    <div id="tabs_content_container">	  
        <div id="taba" class="preview-listing-box sign-up-tab_content" style="display:block;">
          <!-- submit-listing box starts -->
            <div>
                <?php $model = Businesslisting::model()->findByPk($_GET['id']); if(!Yii::app()->user->isGuest){
                $user_id = Yii::app()->user->id;
                $fav_exists = Bfavourites::model()->findByAttributes(array('user_id'=>$user_id,'blisting_id'=>$model->drg_blid));
                if($fav_exists){
                    $btn_text = 'Remove from favourites';
                    $btn_link = 'remove_favourite';
                }
                else{
                    $btn_text = 'Add to favourites';
                    $btn_link = 'add_favourite';
                }
                ?>

            <?php  $users = User::model()->findByPk(Yii::app()->user->getId());                    $abimage =  Yii::app()->baseUrl.'/upload/logo/'.$users->drg_image;                  $siteurl = $this->createAbsoluteUrl('/preview_business_listing/blistid/'.$model->drg_blid);                ?>
                <a href="<?php echo Yii::app()->createUrl('businesslisting/'.$btn_link.'?blistid='.$model->drg_blid)?>" class="button black float_right exitpreview"> <?php echo $btn_text; ?></a><?php }?>
                
                <!-- <img src="<?php //echo Yii::app()->theme->baseUrl; ?>/images/social-network-icons.png" alt="business supermarket social network links" style="position: absolute; margin-left: 640px; margin-top: 32px;"/> -->
              	<div class="social-share-button" style="margin-top: 35px;  z-index: 9999;">                  <!-- Facebook -->                  <a href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $users->co_title;?>&amp;p[summary]=<?php echo $users->co_slogon ;?>&amp;p[url]=<?php echo urlencode($siteurl);?>&amp;                                  p[images][0]=<?php echo $abimage;?>" class="social-icon icon-facebook" target="_blank" alt="Facebook"></a>                  <!-- twitter -->                  <a class="social-icon icon-twitter" href="https://twitter.com/home?status=<?php echo $users->co_title; ?>+<?php echo urlencode($siteurl);?>" target="_blank" alt="Twitter"></a>                  <!-- linkedin -->                  <a class="social-icon icon-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($siteurl);?>&amp;title=<?php echo $users->co_title;?>&amp;summary=<?php echo $users->co_slogon;?>" target="_blank" alt="LinkedIn"></a>                  <!-- Google+ -->                  <a class="social-icon icon-google" href="https://plus.google.com/share?url=<?php echo urlencode($siteurl);?>&amp;title=<?php echo $users->co_title;?>&amp;summary=<?php echo $users->co_slogon;?>" target="_blank" alt="Google+"></a>                </div>

            </div>
            <div class="sl-page3">
                        <div class="pl-logo-box"> 
                        <!--<img  src="users/subhjain_147/images/fcb70c8093a501ef1a0a83acb506c085.jpg" />-->
                              <div id="pl-logo" class="pl-photograph" style="height: 88px;width: 114px;">					
                                      <?php                                 if(!empty($users->drg_image)){                                     $img_src = Yii::app()->baseUrl.'/upload/logo/'.$users->drg_image;                                 ?>                                      <img id="pl-logo" src="<?php echo $img_src; ?>" style="  height: 88px;  width: 113px;" />                              <?php }                              else{                              ?>                                    <br/><br/>Image dimensions must not exceed a standard 6 x 4 photo<br> (400 x 600 pixels max)                              <?php                               }                              ?>
                              </div>
                               <div class="headings" style="width: 79%;margin-left: 130px;">
                                        <h2><?php echo $users->co_title;?></h2>
                                        <h3><?php echo $users->co_slogon;?></h3>
                                        <div class="content">
                                              <label class="heading">Listing number: <?php echo $model->drg_blid;?></label>											  <div><!--<span class="width_20">&nbsp;</span>--><?php echo $model->drg_slogon;?></div>
                                        </div>
                                </div>
                                <div class="clear"></div>
                        </div>
                        <br class="clear" />
                               <div class="content">
                                <label class="heading">Who we are</label><br class="clear"/>
                                <div >
                                    <div class="prevew_text" style="height:auto">
                                        <span class="width_20">&nbsp;</span>
                                        <?php $count =  str_word_count($model->drg_whoweare);?> 
                                    <?php //echo $model->drg_businessidea; ?>
                                    
                                    <?php  $who = str_replace("\n", "</p><p>", $model->drg_whoweare);
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
                                    
                                    </div>
                                    
                                    
                                    <!--<a class="readmore less">Read more &gt;&gt;</a>-->                                    
                                </div>
                                </div>
                                 <div class="clear"></div><br />
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
							<?php
							$UserData = User::model()->findByPk(Yii::app()->user->getId()); 
							?>
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
                
        </div>
        <div id="tab2" class="sign-up-tab_content">

            <img src="images/voice-your-opinon.png" alt="" />       

        </div> <!-- /End of tab2 Promotions tab -->

        

        <div id="tab3" class="sign-up-tab_content">

                  <div> <img src="images/samples.png" alt="" /> </div>

                </div>

        <!-- /End of tab3 Product samples tab -->

        

        <div id="tab4" class="sign-up-tab_content">

                  <div style="text-align:center;">

            <p><img src="images/user_auction_view.png" alt="" /></p>

          </div>

                </div>

        <!-- /End of tab4 Open for bidding tabb -->

        

        <div id="tab5" class="sign-up-tab_content">

                  <div style="text-align:center;">

            <p><img src="images/investment.png" alt="" /></p>

          </div>

                </div>

        <!-- /End of tab5 Investment opportunity tab -->

        

        <div id="tab6" class="sign-up-tab_content">

            <div style="text-align:center;">

                <p><a href="http://www.business-supermarket.com/dragonsnet.us/users/Jaguar/plummate/investor_1.php"><img src="images/investor-area-none-investor.jpg" alt="" /></a></p>

            </div>

        </div>

        <!-- /End of tab6 Open for investment tab --> 
        <div class="clear"></div>
      </div>

      <div class="clear"></div>
    </div>
    <script type="text/javascript">
    //  When user clicks on tab, this code will be executed
    $("#sign-up-tabs li").click(function() {
        //  First remove class "active" from currently active tab
        $("#sign-up-tabs li").removeClass('active');
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");
        //  Hide all tab content
        $(".sign-up-tab_content").hide();
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");
        //  Show the selected tab content
        $(selected_tab).fadeIn();
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
        /* jQuery('.readmore').click(function(){
            if(jQuery(this).hasClass('less')){
                jQuery(this).siblings('.prevew_text').css({'height':'auto'});
                jQuery(this).html('&lt;  &lt; Read less');
                jQuery(this).removeClass('less');
                jQuery(this).addClass('more');
            }else{
                jQuery(this).siblings('.prevew_text').css({'height':'30px'});
               jQuery(this).html('Read more &gt; &gt;');
                jQuery(this).removeClass('more');
               jQuery(this).addClass('less');
            }
        });*/
    </script>
 