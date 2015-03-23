<?php 
 $years = explode(',',$model->drg_fprojections); 
?>  
<p class="breadcrumb">
        <a href="<?php echo Yii::app()->baseUrl;?>" >Home</a> &gt; 
        <a href="<?php echo Yii::app()->createUrl('myaccount'); ?>"> my profile</a> &gt; 
        <a href="<?php echo Yii::app()->createUrl('listing/create'); ?>"> create user listing</a> &gt;preview listing</p>

    <div>
    <?php
    $this->renderPartial('//../modules/listing/views/layouts/listing_slider');
    ?>
</div>
    <div style="clear:both;"></div>        
  <div class="registration-box" id="ncol"><!-- registration box start-->
      <div id="registration-tabs"> <a href="javascript:void(0);">Details</a>
        <div class="clear"></div>
      </div>
      <div class="registration-content" style="min-height:571px; padding: 1%;">		  
        <div class="preview-listing-box"><!--submit-listing box starts--->
            <div>
                <a href="<?php echo Yii::app()->createUrl('listing/user_listing_step4/listid/'.$model->drg_lid)?>" class="button black exitpreview"> Exit preview mode</a>
                <!--<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/social-network-icons.png" alt="business supermarket social network links" style="position: absolute; margin-left: 640px; margin-top: 32px;"/>-->                
                <div class="social-share-button" style="position: absolute; margin-top: 32px;z-index:9999 !important">                  
                    <!-- Facebook -->                  
                    <a href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $model->drg_title;?>&amp;p[summary]=<?php echo $model->drg_desc;?>&amp;p[url]=<?php echo urlencode($siteurl);?>&amp;                                  
                       p[images][0]=<?php echo $abimage;?>" class="social-icon icon-facebook" target="_blank" alt="Facebook"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/facebook.png" style="width: 20px;"/>
                    </a>                  
                    <!-- twitter -->                  
                    <a class="social-icon icon-twitter" href="https://twitter.com/home?status=<?php echo $model->drg_desc; ?>+<?php echo urlencode($siteurl);?>" target="_blank" alt="Twitter">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/twitter.png" style="width: 20px;"/>
                    </a>                  
                    <!-- linkedin -->                  
                    <a class="social-icon icon-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($siteurl);?>&amp;title=<?php echo $model->drg_title;?>&amp;summary=<?php echo $model->drg_desc;?>" target="_blank" alt="LinkedIn">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/linkedin.png" style="width: 20px;"/>
                    </a>                  
                    <!-- Google+ -->                  
                    <a class="social-icon icon-google" href="https://plus.google.com/share?url=<?php echo urlencode($siteurl);?>&amp;title=<?php echo $model->drg_title;?>&amp;summary=<?php echo $model->drg_desc;?>" target="_blank" alt="Google+"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/google+.png" style="width: 20px;"/>
                    </a>                
                </div>
            </div>
            <div class="sl-page3">
                        <div class="pl-logo-box"> 
                        <!--<img  src="users/subhjain_147/images/fcb70c8093a501ef1a0a83acb506c085.jpg" />-->
                              <div id="pl-logo" class="pl-photograph" >					
                                <?php if(!empty($model->drg_logo)){ 
                                         $img_src='upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/'.$model->drg_logo;
                                 ?>
                                      <img id="pl-logo" src="<?php echo Yii::app()->baseUrl;?>/<?php echo $img_src; ?>" style="height: 120px;width: 185px;" />
                                 <?php 
                                 }else{
                                 ?>
                                        <br/><br/>Image dimensions must not exceed a standard 6 x 4 photo<br> (400 x 600 pixels max)
                                 <?php 
                                 }
                                 ?>
                              </div>
                               <div class="headings">
                                        <h2><?php echo $model->drg_title;?></h2>
                                        <h3 style="max-width: 404px;"><?php echo $model->drg_desc;?></h3>
                                        <div class="content">
                                                 <label class="heading">Listing number: <?php echo $model->drg_lid;?></label>
                                              <div style="height:auto;"><!--<span class="width_20">&nbsp;</span>--><?php 
											  $count = str_word_count($model->drg_explanation); 
											   $expaln =  implode(' ', array_slice(explode(' ', $model->drg_explanation), 0, 150)); 							  
											  ?>
                                              <div class="explain" style="height: 52px;
overflow: hidden;">
                                        <?php echo $expaln; ?><!--&nbsp;&nbsp;<a onclick="jQuery('.explainfull').show();jQuery('.explain').hide();" class="more readmore">Read more &gt;&gt;</a>-->                                                                            
                                        </div>
                                        <div class="explainfull" style="display:none;">
                                            <?php echo $model->drg_explanation; ?> &nbsp;&nbsp; <a  onclick="jQuery('.explain').show();jQuery('.explainfull').hide();" class="more readmore">Read less &gt;&gt;</a>                                          
                                        </div>
                                              </div>
                                        </div>
                                </div>
                                <div class="clear"></div>
                        </div>
                        <br class="clear" />
                               <div class="content">
                                <label class="heading">Business history &amp; activities</label><br class="clear"/>
                                <div >
                                    <div class="prevew_text" style="height:auto">
                                        <span class="width_20">&nbsp;</span>
                                        <?php $count =  str_word_count($model->drg_businessidea);?> 
                                    <?php //echo $model->drg_businessidea; ?>
                                    
                                    <?php 
                                        if($count>100){
                                            $test =  implode(' ', array_slice(explode(' ', $model->drg_businessidea), 0, 50));
                                        }else {
                                            $test =  implode(' ', array_slice(explode(' ', $model->drg_businessidea), 0, 25));
                                        }
                                        ?>
                                        <div class="less1">
                                        <?php echo $test; ?>&nbsp;&nbsp;<a onclick="jQuery('.full').show();jQuery('.less1').hide();" class="more readmore">Read more &gt;&gt;</a>                                                                            
                                        </div>
                                        <div class="full" style="display:none;">
                                            <?php
$test1=$model->drg_businessidea;
echo $test2=str_replace("\n","</p><p>",$test1);


 ?> &nbsp;&nbsp; <a  onclick="jQuery('.less1').show();jQuery('.full').hide();" class="more readmore">Read less &gt;&gt;</a>                                          
                                        </div>
                                    
                                    </div>
                                    
                                    
                                    <!--<a class="readmore less">Read more &gt;&gt;</a>-->                                    
                                </div>
                                </div>
                                      <br class="clear"/>
                                <label class="heading">Financial Projections</label><br />						  
                                <?php if($model->drg_famount){?>
								
                                  <div class="pl-financial-view">
                                  <label> Year 1<br /> <span><?php echo number_format($years[0], 2, '.', ',');?></span> </label>
                                  <label> Year 2<br /> <span><?php echo number_format($years[1], 2, '.', ',');?></span> </label>
                                  <label> Present<br /> <span><?php echo number_format($years[2], 2, '.', ',');?></span> </label>
                                  <label> Year 1<br /> <span><?php echo  number_format($years[3], 2, '.', ',');?></span> </label>
                                  <label> Year 2<br /> <span><?php echo number_format($years[4], 2, '.', ',');?></span> </label>
                                  <label> Year 3<br /> <span><?php echo number_format($years[5], 2, '.', ',');?></span> </label>
                                  <div class="clear"></div>
                                  </div>
                                  <br class="clear"/>
                                  <?php 
                                    
                                   $amount_data = Data::model()->findByPk('1'); 
                                   $amount_data1 = CJSON::decode($amount_data->data);
                                   $info="";
                                   foreach($amount_data1 as $key => $value){                                        
                                        if($model->drg_famount==$key){
                                           $info=$value;
                                           break;
                                        }
                                   }
                                  ?>
                                  <div class="flow_right mrgn_r1"><em> Financial projections are in <?php echo $info;?> </em></div>
                                   <?php 
                                   }
                                   else{                                            
                                          $financial_data = Data::model()->findByPk('2'); 
                                          $financial_data1 = CJSON::decode($financial_data->data); 
                                          $info='';
                                          foreach($financial_data1 as $key => $value){
                                              if($model->drg_financial_data==$key){
                                                      $info=$value;
                                                      break;
                                              }
                                          } 
                                    ?> 
                                    <div class="flow_left mrgn_l1"><span class="width_20">&nbsp;</span><?php echo $info;?> </div>
                                    <?php 
                                    }
                                   ?>
                        <div class="clear"></div><br />
                        <div class="content">
                              <label class="heading">What the entrepreneur/business wants</label><br class="clear"/>
                              <div >
                                  <div class="prevew_text" style="height:auto;">
                                      <span class="width_20">&nbsp;</span>
                                    <?php $count =  str_word_count($model->drg_want);?>   
                                  <?php //echo $model->drg_want;?>
                                  
                                  <?php 
                                        if($count>100){
                                            $test =  implode(' ', array_slice(explode(' ', $model->drg_want), 0, 50));
                                        }else {
                                            $test =  implode(' ', array_slice(explode(' ', $model->drg_want), 0, 25));
                                        }
                                        ?>
                                        <div class="less2">
                                        <?php echo $test; ?>&nbsp;&nbsp;<a onclick="jQuery('.full1').show();jQuery('.less2').hide();" class="more readmore">Read more &gt;&gt;</a>                                                                            
                                        </div>
                                        <div class="full1" style="display:none;">
                                            <?php $drg_want=$model->drg_want; echo $test4=str_replace("\n","</p><p>",$drg_want); ?> &nbsp;&nbsp; <a  onclick="jQuery('.less2').show();jQuery('.full1').hide();" class="more readmore">Read less &gt;&gt;</a>                                          
                                        </div>
                                  
                                  </div>
                                  <!--<a class="readmore less">Read more &gt;&gt;</a>-->
                              </div>
                              </div>
                                <div class="clear"></div><br />
                                <div class="clear"></div><br />					  
                                <label class="heading">Market Research</label><br class="clear" />
                                <div class="pl-mrquestion"  style="height: 214px;">
                                                <p class="pl-question">
                                                <?php echo $model->drg_mktquestion;?>
                                                    <br />
                                                    <div class="amountselect">
                                                        <div style="width:100px;">Yes&nbsp;<input id="1" name="drg_mktqstatus" class="drg_mktqstatus" type="radio" value="Yes" /></div>                                                
                                                        <div style="width:100px;">Maybe&nbsp;<input id="2" name="drg_mktqstatus" class="drg_mktqstatus" type="radio" value="Maybe" /></div>
                                                        <div style="width:100px;">No&nbsp;<input id="3" name="drg_mktqstatus" class="drg_mktqstatus" type="radio" value="No" /></div>                                                
                                                   </div>
                                               </p>
                                                <br /><br />
                                                <div class="pl-reason">
                                                        Please leave a reason for your voting choice below
                                                        <p></p>
                                                </div>
                                                      <p class="pl-question"><em class="grey">
                                                        Your comments will be added to the forum (see voice your opinion tab above).<br />
                                                        where you may discuss your opinion further or take part in the debate.
                                                      </em></p>
                                              <br class="clear" />
                                        <div class="flow_right mrgn_r1 width70">
                                        <label  class="heading">Submit</label>
                                        <span class="buttons-box flow_right">
                                                <button class="login_sbmt" disabled="disabled" name="login_sbmt" type="submit" title="Submit your vote"><img style="border-radius:5px;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/buttons/user.png" width="25"></button>
                                        </span>
                                        </div>
                                </div>
                                <div>
                                        <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/graph-image.jpg" width="236px"  style="height: 224px;"/>
                                </div>				  
                                      <div class="clear"></div><br />
                        <br />
                </div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <script type="text/javascript">
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
 