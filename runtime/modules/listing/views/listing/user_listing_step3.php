   <?php 
   Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jwplayer1/jwplayer.js',CClientScript::POS_END);   
   ?> 
   <script type="text/javascript">jwplayer.key="2SjjlzyKCa+5G6RGoZhN/hLyW2KiOB0xz/7EcQ==";</script>  
  <style type="text/css">#div_upload_big{height: auto !important;}</style>
    <p class="breadcrumb">
        <a href="index.php" >Home</a> &gt; 
        <a href="<?php echo Yii::app()->createUrl('myaccount/update');?>"> my profile</a> &gt; 
        create user listing - step 3 of 4
    </p>
    <div class="clear"></div>
        <div>
            <?php 
                $this->renderPartial('//../modules/listing/views/layouts/listing_slider');            
            ?>           
        </div>
        <div style="clear:both;"></div>
        <div class="registration-box">
            <!-- registration box start-->
            <div id="registration-tabs"><a href="javascript:void(0);">Create Listing</a>
                <div class="clear"></div>
            </div>
           
            <div class="registration-content" style="min-height:571px">
                 <a class="pu-close pu-close-step2 pu-close1" href="javascript:void(0);" title="Close">X</a>      
                <h2 align="center" class="Blue">Create a User listing</h2>
                <div style="text-align:center"><i style="font-size:7pt; color:#999999">Tell us about your business idea</i></div>
               
               
               <!--- Confirm close pop up---->        
                <div class="confirm " style="width: 98%; height: 94%;  padding-top:30px; margin-top:-40px;">
                  <div class="u-email-box"> 
                  	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:2px;" />
                    <div class="my-account-popup-box" style="margin-top:-38px !important"> 
                      <a title="Close" href="javaScript:void(0)" onclick="close_form()" class="pu-close">X</a>
                      <br />
                      <h2 class="Blue">Are you sure you want to leave this page?</h2>
                      <p>You form data has not been saved  leaving the listing submission process now will result in any data you have submitted being lost.<br /> Please save your listing first.</p>              
                      <table align="center" width="100%">
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                      	<tr>              	
                      	<td align="center"> 
                            <input class="button black" title="Close and return to form" name="canle" type="button" value="Cancel"  onclick="jQuery('.confirm').hide('slow');"/>  
                            <input class="button black" title="Save and close form" onclick="saveforlater();" name="register" type="button" value="Save & Close"  />
                            <input class="button black" title="Discard ALL data and close form" name="register" type="button" value="Discard"  onclick="window.location.href='<?php echo Yii::app()->createUrl('user/myaccount/update'); ?>'" />               
                        </td>
                      </tr>
                      </table>
                    </div>
                  </div>
                </div>
            <!-- end close--> 
               
               
               <!-- <form action="" method="post" enctype="multipart/form-data" id="user_listing_step3" onsubmit="return checkVideoUploading();" >-->
                <?php $form = $this->beginWidget('CActiveForm', array('id'=>'user_listing_step3','enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>				
                    <input type="hidden" name="btnsaveforlater" value="0" id="btnsaveforlater" />	
                    <div style="margin-bottom: 3px;">
                        <label style="color:#A47A8F;">Upload photographs <a class="sl-tip tooltip" href="#;">?<span class="classic">Select and upload five images in one of the following formats:- BMP, JPEG, PNG, GIF<br> Please NOTE image size MUST NOT exceed 6"x4" otherwise cropping will occur.</span></a></label>
                    </div>                    
                    <?php
                    
                    /*
                    * Photo upload 5 boxs for user listing start here
                    */
                    $userimage = Userlistingimages::model()->findAllByAttributes(array("drg_lid"=>$model->drg_lid));
                    //print_r($userimage); 
                    //echo count($userimage);
                    /*
                    
                    foreach($userimage as $image){
                        echo $image->drg_listing_image;
                    } 
                    
                    */
                    $f =  0;
                    $old = 0;
                    for($i=1;$i<=5;$i++){                         
                    ?>
                        <div class=" listing-upload photo-upload-box<?php echo $i;?>" id="photo-upload-box-tab" style="height:94%;">
                            <img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
                            <div class="my-account-popup-box" id="upload-frame"> 
                                    <a class="pu-close" onclick='jQuery(".photo-upload-box<?php echo $i;?>").hide();' href="javaScript:void(0)" title="Close">X</a>
                                    <h2>Upload user listing picture</h2>
					 Click <b>Upload Picture...</b> to choose an image from your computer<br />
            Select an image that is 120px by 120px for best fit <br />
            Your image will be automatically uploaded.<br />
            <br />
                                   <?php 
                                   $imagename = "";   
                                   if($userimage[$f]->drg_listing_image !=""){
                                    $imagename = $userimage[$f]->drg_listing_image;
                                   }
                                   ?> 
                                    <input type="hidden" id="logo_<?php echo $i; ?>" value="<?php echo $imagename; ?>" name="img_name[]" /> 
                                    <input type="hidden" value="<?php echo $imagename; ?>" name="old_img_name[]" />                                  
                                   <div id="wrap">    
                                        <div id="uploader">
                                            <div id="big_uploader">
                                                <div id="notice"><img src="ajax-loader.gif" /></div>
                                        		<i>Upload image maximum of 2MB.</i>
                                                <br/><br/>
                                                 <div id="div_upload_big" class="listing_logo">			
                                        			<p  style="padding: 42px 10px;">&nbsp;</p>
                                        		</div>
                                    		  <div id="div_upload_big_new"></div> 
                                            Browse for a picture on your computer
                                            <br /> <br />
                                            <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                                array(
                                                    'id'=>'uploadFile'.$i,
                                                    'config'=>array(
                                                           'action'=>Yii::app()->createUrl('listing/listingimage'),
                                                           'allowedExtensions'=>array("jpg",'png','gif'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                           'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                                           'minSizeLimit'=>10,// minimum file size in bytes 
                                                           'onComplete'=>"js:function(id, fileName, responseJSON){getUploadfilename(responseJSON,".$i.");}",                                                  
                                                    )
                                                )); 
                                            ?>
                                        	</div><!-- big_uploader -->                                                
                                        </div><!-- uploader --> 
                                    </div>
                            </div>
                          </div>
                            <div class="sl-photo-box" style="margin:0px; text-align:center">
                              <div class="clear"></div>
                                <br />
                                <div class="sl-photograph image_preview" id="image_preview<?php echo $i;?>">   
                                    <?php 
                                    if($imagename !="")
                                    {?>
                                        <img title="<?php echo $userimage[$f]->drg_imgdesc;?>" alt="<?php echo $userimage[$f]->drg_imgdesc;?>" src="<?php echo Yii::app()->baseUrl;?>/upload/users/<?php echo Yii::app()->user->getState('ufolder');?>/listing/thumb/<?php echo $userimage[$f]->drg_listing_image;?>" height="104" />
                                    <?php
                                    $old++;    
                                    }
                                    ?>
                                </div>
                                <!-- File Upload for Company Logo -->
                                <div style="margin:10px 0 0 7px;"> 
                                    <a class="button gray" title="Upload logo" onClick="show_picture_form('photo-upload-box<?php echo $i;?>')" href="javaScript:void(0)" id="uplaod-logo-<?php echo $i;?>" > &nbsp; Select Image &nbsp;</a>
                                </div>
                            </div>
                    <?php 
                    $f++;
                    }
                    ?>
                    <input type="hidden" value="<?php echo $old ?>" name="oldimage" id="oldimage" />
                    <br class="clear" />
                    <br class="clear" />
                    <!-- Image text starts here -->
                    <div class="slisting-head">
                        <p>Enter a short description for each image <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter a short description explaining each image. Please note text is limited to 4 lines.</span></a></p>
                    </div>
                    <!-- Title -->
                    <div class="sl-image-description">
                        <?php 
                        $userimage = Userlistingimages::model()->findAllByAttributes(array("drg_lid"=>$model->drg_lid));
                        $g=0;
                        for($i=1;$i<=5;$i++){
                           $imagedesc =  $userimage[$g]->drg_imgdesc;
                        ?>
                            <div class="img_desc img_desc_text">
                                <textarea rows="2" cols="9" class="drg_imgdesc" name="drg_imgdesc[]" id="image-description-<?php echo $i;?>" maxlength="80"><?php echo $imagedesc; ?></textarea>
                                <br>
                                Image <?php echo $i;?> text
    			             </div> 
                        <?php
                        $g++; 
                        }
                        ?>  
                    </div>
                    <br class="clear" />                    
                    <br class="clear" />
                    <div class="slisting-head">
                        <p>Enter a link to each slider <a class="sl-tip tooltip" href="#;">?
                                                            <span class="classic">Enter video link for each slider image.</span>
                                                       </a>
                        </p>					 
                    </div>  					 
                    <div class="sl-image-description admin-description">      					
                        <?php $userimage = Userlistingimages::model()->findAllByAttributes(array("drg_lid" => $model->drg_lid));   					
                        ?>    					 
                            <?php 							 
                            $h=0;							 
                            for ($i = 1; $i <= 5; $i++) { 						 
                                $sitelink =  $userimage[$h]->drg_sitelink;						 
                                $videolink =  $userimage[$h]->drg_videolink;						 
                                ?>               					 
                    <div class="img_desc img_desc_text">      					 
                        <!--<input type="text" class="inp width" name="drg_sitelink[]" id="slider-sitelink-<?php echo $i; ?>" value="<?php echo $sitelink; ?>" 
                               style="background: none repeat scroll 0 0 #F1E5E2;  border: 1px solid #F1E5E2;  margin: 6px 0 10px;width: 126px;  overflow: hidden;  padding: 5px 4.5px;  resize: none" />  		

							   <br>              

							   Site link<?php echo $i; ?>    	

							   <h3 style="  color: #1dbfd8;">OR</h3>-->	

							   <input type="text" class="inp width" name="drg_videolink[]" id="slider-videolink-<?php echo $i; ?>" maxlength="80" value="<?php echo $videolink; ?>" style="background: none repeat scroll 0 0 #F1E5E2;  border: 1px solid #F1E5E2;  margin: 6px 0 10px;width: 126px;  overflow: hidden;  padding: 5px 4.5px;  resize: none;">      	

							   <br>                	

							   Video link<?php echo $i; ?>   

							   </div>             		

							   <!-- <?php echo $i; ?>Image text -->     	

							   <?php $h++; }?>        				

							   <br class="clear" />     		

							   </div>   					

							   <br class="clear" />		     
							   
                    <br class="clear" />
                    <div style="margin-bottom: 3px;">
                        <label style="color:#A47A8F;">Upload Videos <a class="sl-tip tooltip" href="#;">?<span class="classic">Upload your business videos in 3gp, avi, mpeg, mpg, mov, m4a, mj2, flv,  mp4, ogg or webm formats only.<br>Long videos can be heavy going, so make your video short sharp and to the point and aim to get your main points across in 60 seconds or less.</span></a></label>
                    </div>
                        <?php 
                        $uservideo = Userlistingvideos::model()->findAllByAttributes(array("drg_lid"=>$model->drg_lid));                         
                        $k=0;
                        for($j=1;$j<=2;$j++){?>
                         
                                          
                          <div class="sl-photo-box" style="margin:<?php if($j==1){echo '0 0 0 20px;';}else {echo '0;';}?> width:360px;">
                                <div class="clear"></div>
                                <br>
                                <div id="preview-<?php echo $j;?>" class="sl-photograph video_preview" style="margin-left: 90px;">                                   
                                 <?php 
if($j=="1")
{
$vid=$model['drg_video1'];
}
else if($j=="2")
{
$vid=$model['drg_video2'];
}
$path1 = $_SERVER['DOCUMENT_ROOT'].'/';  
                                        $uservideoname = "";
                                        $drg_videodesc = "";
                                         $insert = true;
                                        if($uservideo[$k]->drg_listing_video!="")
                                        {    $insert = false;
                                            $uservideoname = $uservideo[$k]->drg_listing_video;
                                            $drg_videodesc = $uservideo[$k]->drg_videodesc;
                                        }
$apath= $path1."/upload/users/".Yii::app()->user->getState('ufolder')."/videos/".$uservideoname;
                                    ?>
                                    <div id="show-<?php echo $k;?>" > 
                                    <input type="hidden" name="drg_videos[]" value="<?php echo $uservideoname;?>" id="video-<?php echo $j;?>" />  
                                    </div>
        							<input type="hidden" name="drg_old_videos[]" value="<?php echo $uservideoname;?>"/>
                                </div>
                                
                                 <div id="ova-example-player-container_<?php echo $j; ?>" class="video_player_container" style="">
                                    <div id="ova-example-player_<?php echo $j; ?>" style="position:relative;">
                                        <div id="ova-player-instance_<?php echo $j; ?>" loaded="false" class="video_player_instances" style=""> 
                                                 <!-- SELECTED PLAYER INSTANCE GOES IN HERE --><p style="font-size: 14px;
padding: 19px;color:#808080" id="vidtxt_<?php echo $j; ?>" >Please upload a video size no greater<br/>
than 50MB and no longer than 5mins<br/>
in total length.<br/><br/>
Please make your video short and<br/>
concise. Consider it like a 30 second<br/>
advertisement.<br/><br/>
Long videos quickly lose interest.<br/><br/>
You may always upload a new video<br/>
at any time
</p>
                                        </div>    
  <?php
                        if (file_exists($apath))
 { 
if($uservideoname!="")
{
                            ?> <script language="javascript">
                                jwplayer("ova-player-instance_<?php echo $j; ?>").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                      file: '<?php echo Yii::app()->getBaseUrl(true);?>/upload/users/<?php echo Yii::app()->user->getState('ufolder');?>/videos/<?php echo $uservideoname; ?>',
                                height: 260,
                                width: 338,
                                });
                            </script>  
                            <?php
                        }}
else if($vid!="")
{
?>
<script language="javascript">
                                jwplayer("ova-player-instance_<?php echo $j; ?>").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                                file: '<?php echo $vid; ?>',  
                                height: 260,
                                width: 338,
                                });
                            </script> 
<?php
}

?>                               
                                       
                                    </div>
                                 </div>
                                <div id="progressbox_<?php echo $j; ?>" class="progressbox" style="display:none;">
                                     <div class="uploading_<?php echo $j; ?>"> Uploading ....</div>
                                    <div id="progressbar_<?php echo $j; ?>" class="progressbar" ></div >
                                    <div id="statustxt_<?php echo $j; ?>" class="statustxt" >0%</div>
                                </div>
        
                                <div id="progressstatus_<?php echo $j; ?>" class="progressstatus" style="display:none;"></div>
                                
                                <p class="slisting-head">Video <?php echo $j;?> (Get to know the business idea) <a class="sl-tip tooltip" href="#;">?<span class="classic">Potential investors want to know the person behind the business; your skills, how you present yourself, your experience and credibility, all play a vital role if you wish to see your business idea succeed.<br><br /></span></a></p>
                                 
                       <?php
if (file_exists($apath))
{
?>
                <input value="<?php echo $drg_videodesc; ?>" type="text" name="drg_videodesc[]" id="fileName<?php echo $j; ?>" class="file_input_textbox" style="width:335px;" />
<?php
}
else
{
?>
 <input value="<?php echo $vid; ?>" type="text" name="drg_videodesc[]" id="fileName<?php echo $j; ?>" class="file_input_textbox" style="width:335px;" />
<?php
}
?>        
                                <div class="clear"></div>
                                <!-- File Upload for Company Logo -->
                                <div style="margin-top:20px; margin-bottom:50px; text-align:center;">  
        							<!-- <a class="button gray" title="Upload logo" onClick="show_picture_form('video-upload-box<?php echo $j;?>')" href="javaScript:void(0)" id="upload_video<?php echo $j;?>"> &nbsp; Select Video &nbsp;</a>  -->
        							
        							<a class="button gray" title="Upload logo" onClick="uploadVideo('<?php echo $j;?>')" href="javaScript:void(0)"> &nbsp; Select Video &nbsp;</a> 
        							<div class="upload_video_res_<?php echo $j; ?>"></div>
        							<div id="loading_<?php echo $j; ?>" style="display: none;"><img src="loading.gif"></div> 
        							
        						</div>
                            </div> 
                    <?php 
                    $k++;
                    }
                    ?>
                    <div class="submit_button">
                          <input type="button" name="saveforlater" id="savelater" class="button blue" value="Save for later" style="float:left; margin-left:140px;" />                         
                     
                        <?php 
                        if($model->isNewRecord || $insert==true){
                        ?>
                            <input type="submit" name="submit_user_listing_step3" class="button green_button" value="Insert" style="float:right; margin-right:146px;" />
                        <?php 
                        }
                        else {
                        ?>
                            <input type="submit" name="update_user_listing_step3" class="button black" value="Update" style="float:right; margin-right:140px;" />
                        <?php 
                         }
                        ?>
                     </div> 
                <!--</form> -->
                <?php 
                 $this->endWidget();  
                
                    for($j=1;$j<=2;$j++){?>
					<form id="upload_video_<?php echo $j; ?>" onsubmit="" enctype="multipart/form-data" method="post" action="<?php echo Yii::app()->createUrl('listing/listingvideo/');?>" name="chooseF">
						<input type="file" name="file_vid" class="upload_video_file_<?php echo $j; ?>" style="display:none;" onchange="check_extension(this,<?php echo $j; ?>);" />
						<input type="hidden" class="is_upload_file_<?php echo $j; ?>" value="" />						
						<input type="hidden" name="video_id" value="<?php echo $j; ?>" />						
						<input name="type" type="hidden" class="blue_font" value="flv" />
						<input name="quality" type="hidden" value="1000000" />
						<input name="audio" type="hidden" value="44100" />
						<input name="size" type="hidden" value="512x384" />	 
					</form>
                
                <?php } ?>
                
                
                <div id="progressbox" style="display:none;"><div id="progressbar"></div ><div id="statustxt">0%</div></div>

                
                <div style="clear:both; height:20px;"></div>
                <div class="navigation">
                    <div><a href="<?php echo Yii::app()->createUrl('listing/user_listing_step2/listid/'.$model->drg_lid);?>" >&lt;&lt; previous</a></div>
                    <div> 
                        <a href="<?php echo Yii::app()->createUrl('listing/create/listid/'.$model->drg_lid);?>">1</a> 
                        <a  href="<?php echo Yii::app()->createUrl('listing/user_listing_step2/listid/'.$model->drg_lid);?>">2</a> 
                        <a class="active" style="cursor:default;" >3</a> 
                        <a onclick="form_validation_step3();">4</a>
                    </div>
                    <div><a onclick="form_validation_step3();" href="javascript:void(0);">next &gt;&gt;</a></div>
                </div>
                <div style="clear:both; height:20px;"></div>
            </div>
            <div class="clear"></div>
        </div>
        <!--end bottom carousel----->
    
<script type="text/javascript"><!--
jQuery(document).ready(function(){
       jQuery(".pu-close1").live("click",function(){
            jQuery(".confirm").show();
        })            
        close_form(); 
    });    
    function close_form()
    {   JQ1(".confirm").hide();
    }
    
    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value=1;
        document.getElementById("user_listing_step3").submit();       
    }
    
    
 function form_validation_step3(){
    jQuery('#user_listing_step3').submit();
 }
 function getUploadfilename(result,id){
    if(result.success){ 
        jQuery("#image_preview"+id).html('');
        var img = '<img src="<?php echo Yii::app()->baseUrl.'/upload/users/'.Yii::app()->user->getState('ufolder').'/listing/thumb/'; ?>' + result.filename + '" />'
        jQuery("#logo_"+id).val(result.filename);
        jQuery("#image_preview"+id).html(img);
        jQuery(".photo-upload-box"+id).hide();
   }
 }   
// Advert Carousel
jQuery(document).ready(function() {
    jQuery('#add-carousel-wrap').jcarousel({
        wrap: 'circular',
        scroll: 1
    });
    
    jQuery(".upload_video").click(function(e){
		
	//	alert("ok");
		jQuery(".upload_video_file").trigger("click");
		
	});
    jQuery("#savelater").live("click",function(){
    	jQuery(".pu-close1").trigger("click");
    	jQuery('html, body').animate({scrollTop: '300px'}, 1000);
    });   

    
});
    
function show_picture_form(openTabId){
    jQuery("."+openTabId).show();
   openTabId = openTabId.replace('video-upload-box','');
    jQuery('#pic_frame_'+openTabId).attr({'src':'video-upload/step_1.php?id='+openTabId });
}
 function loadvideo(id,name){
    jQuery('#show-'+id).load('video-upload/play-video.php?id='+id+'&src='+name);
}


/******** code added by vishal *********/
function uploadVideo(j)
{
	// trigger the file uploads
	jQuery(".upload_video_file_"+j).trigger("click");
	//alert("ok");
}


function check_extension(self, s) 
{ 
	var allowed = {'flv':1,'avi':1,'3gp':1,'mpg':1,'mpeg':1,'mpe4':1,'mov':1,'m4a':1,'mj2':1,'mp4':1,'ogg':1,'webm':1};
	var fileinput = self;
	var fileSize = fileinput.files[0].size //size in kb
    var fileSize = fileSize / 1048576; //size in mb 
	var y = fileinput.value.split(".");
	var ext = y[(y.length)-1];
	ext=ext.toLowerCase(); 
	
	var progressbox     = jQuery('#progressbox_'+s);
	var progressbar     = jQuery('#progressbar_'+s);
	var statustxt       = jQuery('#statustxt_'+s);
	var completed       = '0%'; 
	
	if (fileSize < 50)
	{
	if (allowed[ext]) {
        //document.chooseF.confirm.disabled = false;
        jQuery("#fileName"+s).val(fileinput.value);
        
        // process to call the ajax form
                
        jQuery(".is_upload_file_"+s).val("process");
        
        jQuery('#progressbox_'+s).show("slow"); jQuery('#vidtxt_'+s).hide("fast");
        
        jQuery('#progressstatus_'+s).show("slow");
       
        jQuery("#upload_video_"+s).ajaxForm({   
                  uploadProgress: function(event, position, total, percentComplete){ 
                        progressbar.width(percentComplete + '%') ; 
						statustxt.html(percentComplete + '%'); 
                        jQuery(".uploading_"+s).show(); 
						if(percentComplete>95)
						{
							statustxt.css('color','#fff'); 
                            jQuery(".uploading_"+s).empty().append("You video is being converted ....");
                        }  
						var res = percentComplete + '% | ' + (position/1024).toFixed(2) +' kb / '+(total/1024).toFixed(2) +' kb';
						jQuery("#progressstatus_"+s).html(res);
                        
                        
					  
				},success:function(data){ 
				     jwplayer("ova-player-instance_"+s).setup({ 
						flashplayer: "<?php echo Yii::app()->theme->baseUrl;?>/js/jwplayer1/jwplayer.flash.swf",
						file: '<?php echo Yii::app()->getBaseUrl(true). "/upload/users/".Yii::app()->user->getState('ufolder')."/videos/" ;?>'+jQuery.trim(data),
						height: 260,
						width: 338, 
					}); 
					jQuery(".is_upload_file_"+s).val("");
                    jQuery("#fileName"+s).val(data);
					jQuery("#video-"+s).val(data);
					jQuery('#progressbox_'+s).hide("slow");
					jQuery('#progressstatus_'+s).hide("slow"); 
				},
         }).submit(); 
               
        
        
		return true;
    } else {
        alert("This is an unsupported file type. Supported files are: 3gp,avi,mpg,mpeg,mpe4,mov,m4a,mj2,flv,wmv,mp4,ogg,webm");
        document.chooseF.confirm.disabled = true;
		return false;
    }
	 } else {
        alert("You are trying to upload a video file greater than 50MB Max upload size limit.");
        document.chooseF.confirm.disabled = true;
		return false;
    }
}
 


/*function checkVideoUploading()
{	
	 for(var i=0;i<2;i++)
	 {
		 
        if($(".is_upload_file_"+i).val()=="" || $(".is_upload_file_"+i).val()==null)
		{
		  
		}
		else
		{			
			alert("Please wait for video upload");
			return false;
		}
			
	} 
	return true;
	
}*/ 


/****** code added by vishal end *******/

jQuery('.drg_imgdesc').focus(function(){
    if(jQuery(this).val()=='Please enter image description'){
       jQuery(this).removeClass('listing_mandatoryerror');
       jQuery(this).val('');
    }
});
jQuery('.file_input_textbox').focus(function(){
    if(jQuery(this).hasClass('mandatoryerror')){
       jQuery(this).removeClass('mandatoryerror');
    }
});

jQuery('#user_listing_step3').submit(function(event){
	/**@ userlisting images validatiosn Starts*/
	var failedvalidation = false;
	var hasImage=true;
	var hasText=true;
	var hasImageButText = [];
	var hasTextButImage = [];
	var onImage = [];
	var noImage = [];
	var onText = [];
	var noText = [];
	for(var i=1;i<=5;i++){            
		if(jQuery('#preview_logo_'+i).parent().hasClass('mandatoryerror')){
			jQuery('#preview_logo_'+i).parent().removeClass('mandatoryerror');
			jQuery('#preview_logo_'+i).html('');
		}
		if(jQuery('#image-description-'+i).val()=='Please enter image description'){
			jQuery('#image-description-'+i).val('');
		}
		if(jQuery('#image-description-'+i).hasClass('listing_mandatoryerror')){
			jQuery('#image-description-'+i).removeClass('listing_mandatoryerror')
		}
		if(jQuery('#logo_'+i).val()==''){
		   noText.push(true);     
		}
		if(jQuery('#image-description-'+i).val()=='' || jQuery('#image-description-'+i).val()=='Please enter image description'){
		   noImage.push(true);  
		}
		/**@ check if is there any image present but that particular image description is not present. */
		if( jQuery('#logo_'+i).val()!='' && (jQuery('#image-description-'+i).val()=='' || jQuery('#image-description-'+i).val()=='Please enter image description')){
			hasImageButText.push(true);
			onText.push(i);
		 }
		 /**@ check if is there any image description present but that particular image is not present. */
		 
		 
		 if( jQuery('#logo_'+i).val()=='' && ( jQuery('#image-description-'+i).val()!='' && jQuery('#image-description-'+i).val()!='Please enter image description') ){
			hasTextButImage.push(true);
			onImage.push(i);
		 }
	}

	if(noText.length==5 && noImage.length==5){
		hasImage=false;
		hasText=false;
	} 
        
	/**@ check if is there any image present or not. 
            if($('#logo_'+i).val()!=''){
          	hasImage=true;
	    }   */             
            /**@ check if is there any text in image description present or not. 
            if($('#image-description-'+i).val()!='' && $('#image-description-'+i).val()!='Please enter image description'){
                    hasText=true;
            }
        */
	var flushTextContents=[];
	 /**@ check if there is image but that image has no description then display error message benith that image area. */
	jQuery.each(hasImageButText ,function(key,value){
		if(value){
		   var message = 'Please enter image description';            
		   var va = $('#image-description-'+onText[key]).val();
		   if(va==message || va==''){
			$('#image-description-'+onText[key]).val(message);
			$('#image-description-'+onText[key]).addClass('listing_mandatoryerror');            
			failedvalidation=true;
			flushTextContents.push(true);
			}
		}
	});
	var flushContents=[];
	/**@ check if there is image description but that image description has no image then display error message above that image description area. */
	jQuery.each(hasTextButImage ,function(key,value){
		 if(value){    
		 if($('#preview_logo_'+onImage[key]+':has(img)').length=='0'){      
		
		
		   var message='<p style="color:#808080;"><br>\
			<br>\
			Image dimensions must not exceed a standard 6 x 4 photo<br>\
			(400 x 600 pixels max)</p>';              
			$('#preview_logo_'+onImage[key]).html(message);
			$('#preview_logo_'+onImage[key]).parent().addClass('mandatoryerror');
			flushContents.push(true);
			failedvalidation=true;
		}
		}
	});
	 /**@ on select any image remove error messages*/
	jQuery('.image').click(function(){
        var nos = $(this).attr('id');
        nos = nos.split('-');                
        var key = nos[nos.length-1];
            $('#preview_logo_'+key).html('');
            $('#preview_logo_'+key).parent().removeClass('mandatoryerror');
            if($('#image-description-'+key).val()=='Please enter image description'){
                 $('#image-description-'+key).removeClass('mandatoryerror');
                $('#image-description-'+key).val('');
            }
           
	});
    /**@ check if is there is not image description present then show error message indicating write image description. */
	var flushTextContent=false;
	if(!hasText){
		var message = 'Please enter image description';
                var va = $('#image-description-1').val();
                 if(va=='' || va==message){

                    $('#image-description-1').val(message);
                    $('#image-description-1').addClass('listing_mandatoryerror');
                    failedvalidation=true;
                    flushTextContent=true;                
                 }
	}       
    /**@ check if there is not image present then display error message to user to select atleast one image with 400*600 px */
	var flushContent=false;
	if(!hasImage){
        if($('#preview_logo_1:has(img)').length=='0'){
			var message='<p style="color:#808080;"><br>\
			<br>\
			Image dimensions must not exceed a standard 6 x 4 photo<br>\
			(400 x 600 pixels max)</p>';
			$('#preview_logo_1').html(message);
			$('#preview_logo_1').parent().addClass('mandatoryerror');
			flushContent=true;
			failedvalidation=true;
		}    
    }
	/**@ userlisting images validatiosn ends*/
	/**@ userlisting videos validation starts*/
	var videos=[];
	var hasVideoButTitle=[];
	var hasTitleButVideo=[];
	var onVideo=[];
	var onTitle=[];
	for(var i=1;i<=2;i++){
	
		if( jQuery('#video-'+i).parent().parent('#preview-'+i).hasClass('mandatoryerror')){
			 jQuery('#video-'+i).parent().parent('#preview-'+i).removeClass('mandatoryerror');                
		}
		if( jQuery('#fileName'+i).hasClass('mandatoryerror')){
			 jQuery('#fileName'+i).removeClass('mandatoryerror');                
		}
		if(jQuery('#video-'+i).val()=='' && jQuery('#fileName'+i).val()==''){
			hasVideoButTitle.push(true);  
            hasTitleButVideo.push(true);
			onTitle.push(i);
            onVideo.push(i);
		}
	
		if(jQuery('#video-'+i).val()!='' && jQuery('#fileName'+i).val()==''){
			hasVideoButTitle.push(true);  
			onTitle.push(i);
		}
		
		if(jQuery('#fileName'+i).val()!='' && jQuery('#video-'+i).val()==''){
			hasTitleButVideo.push(true);
			onVideo.push(i);
		}
		
	}
        
	jQuery.each(hasVideoButTitle,function(key,value){
		if(value){
			jQuery('#fileName'+onTitle[key]).addClass('mandatoryerror');  
			failedvalidation=true;
		}
	
	}); 
        
	 jQuery.each(hasTitleButVideo,function(key,value){
		if(value){
			jQuery('#video-'+onVideo[key]).parent().parent('#preview-'+onVideo[key]).addClass('mandatoryerror'); 
			failedvalidation=true;				
		}
	
	});
	/**@ userlisting videos validation ends*/ 
	if (failedvalidation){		
		event.preventDefault();
	}
	
});
//--></script>  
 