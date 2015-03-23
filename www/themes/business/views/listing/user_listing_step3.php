  <style type="text/css">#div_upload_big{height: auto !important;}</style>
    <p class="breadcrumb">
        <a href="index.php" >Home</a> &gt; 
        <a href="<?php echo Yii::app()->createUrl('myaccount/update');?>"> my profile</a> &gt; 
        create user listing - step 3 of 4
    </p>
    <div class="clear"></div>
        <div>
            <?php 
            $this->renderPartial('//layouts/listing_slider');
            ?>
            
        </div>
        <div style="clear:both;"></div>
        <div class="registration-box">
            <!-- registration box start-->
            <div id="registration-tabs"><a href="javascript:void(0);">Create Listing</a>
                <div class="clear"></div>
            </div>
           
            <div class="registration-content" style="min-height:571px">
                <h2 align="center" class="Blue">Create a User listing</h2>
                <div style="text-align:center"><i style="font-size:7pt; color:#999999">Tell us about your business idea</i></div>
               <!-- <form action="" method="post" enctype="multipart/form-data" id="user_listing_step3" onsubmit="return checkVideoUploading();" >-->
                <?php $form = $this->beginWidget('CActiveForm', array('id'=>'user_listing_step3','enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>				
                    
                    <div style="margin-bottom: 3px;">
                        <label style="color:#A47A8F;">Upload photographs <a class="sl-tip tooltip" href="#;">?<span class="classic">Select and upload five images in one of the following formats:- BMP, JPEG, PNG, GIF<br> Please NOTE image size MUST NOT exceed 6"x4" otherwise cropping will occur.</span></a></label>
                    </div>                    
                    <?php
                    /*
                    * Photo upload 5 boxs for user listing start here
                    */
                    $userimage = Userlistingimages::model()->findAllByAttributes(array("drg_lid"=>$model->drg_lid));
                    //echo count($userimage);
                    /*
                    foreach($userimage as $image){
                        echo $image->drg_listing_image;
                    } 
                    */
                    
                    for($i=1;$i<=5;$i++){                         
                    ?>
                        <div class="photo-upload-box<?php echo $i;?>" id="photo-upload-box-tab">
                            <img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
                            <div class="my-account-popup-box" id="upload-frame"> 
                                    <a class="pu-close" onclick='jQuery(".photo-upload-box<?php echo $i;?>").hide();' href="javaScript:void(0)" title="Close">X</a>
                                    <h2>Upload user listing picture</h2>
                                    Click <b>Browse...</b> to select a picture from your computer<br />
                                    Click <b>Preview Picture</b> to see a thumbnail of your image<br />
                                    Click <b>Upload Picture</b> to save your profile picture and close this dialog box.<br />
                                    <br />
                                   <?php 
                                   $imagename = "";
                                   if($userimage[$i]->drg_listing_image !=""){
                                    $imagename = $userimage[$i]->drg_listing_image;
                                   }
                                   ?> 
                                    <input type="hidden" id="logo_<?php echo $i; ?>" value="<?php echo $imagename; ?>" name="img_name[]" />                                   
                                   <div id="wrap">    
                                        <div id="uploader">
                                            <div id="big_uploader">
                                            <div id="notice"><img src="<?php  echo Yii::app()->theme->baseUrl;?>/images/ajax-loader.gif" /></div>
                                        		<i>Upload image maximum of 2MB.</i>
                                                <div id="div_upload_big" class="listing_logo">			
                                        			<p style="padding: 23px 46px;">Image dimensions <br> must not exceed a standard 6 x 4 photo<br> (400 x 600 pixels max)</p>
                                        		</div>
                                    		  <div id="div_upload_big_new"></div>                                              
                                            Browse for a picture on your computer
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
                                        <img title="<?php echo $userimage[$i]->drg_imgdesc;?>" alt="<?php echo $userimage[$i]->drg_imgdesc;?>" src="upload/users/<?php echo Yii::app()->user->getState('ufolder');?>/listing/big/<?php echo $userimage[$i]->drg_listing_image;?>" width="65" />
                                    <?php    
                                    }
                                    ?>
                                </div>
                                <!-- File Upload for Company Logo -->
                                <div style="margin-top:10px;"> 
                                    <a class="button gray" title="Upload logo" onClick="show_picture_form('photo-upload-box<?php echo $i;?>')" href="javaScript:void(0)" id="uplaod-logo-<?php echo $i;?>" > &nbsp; Select Image &nbsp;</a>
                                </div>
                            </div>
                    <?php 
                    }
                    ?>
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
                        
                            for($i=1;$i<=5;$i++){
                               $imagedesc =  $userimage[$i]->drg_imgdesc;
                            ?>
                                <div class="img_desc img_desc_text">
                                    <textarea rows="2" cols="9" class="drg_imgdesc" name="drg_imgdesc[]" id="image-description-<?php echo $i;?>" maxlength="80"><?php echo $imagedesc; ?></textarea>
                                    <br>
                                    Image <?php echo $i;?> text
        			             </div> 
                            <?php 
                            }
                            ?>  
                    </div>
                    <br class="clear" />
                    <br class="clear" />
                    <div style="margin-bottom: 3px;">
                        <label style="color:#A47A8F;">Upload Videos <a class="sl-tip tooltip" href="#;">?<span class="classic">Upload your business videos in 3gp, avi, mpeg, mpg, mov, m4a, mj2, flv,  mp4, ogg or webm formats only.<br>Long videos can be heavy going, so make your video short sharp and to the point and aim to get your main points across in 60 seconds or less.</span></a></label>
                    </div>
                        <?php 
                        $uservideo = Userlistingvideos::model()->findAllByAttributes(array("drg_lid"=>$model->drg_lid));
                     
                        for($j=1;$j<=2;$j++){?>
                           <div class="video-upload-box<?php echo $j;?>" id="video-upload-box-tab">
                            <img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
                            <div class="my-account-popup-box" id="upload-frame"> 
                                    <a class="pu-close" onclick='jQuery(".video-upload-box<?php echo $j;?>").hide();' href="javaScript:void(0)" title="Close">X</a>
                                    <h2>Upload user listing video</h2>
                                    Click <b>Browse...</b> to select a picture from your computer<br />
                                    Click <b>Upload Video</b> to save your video and close this dialog box
                                    <br /><br />
                                    <!-- <iframe src="video-upload/step_1.php?id=<?php echo $j;?>" frameborder="0" width="390" height="340" id="pic_frame_<?php echo $j;?>"></iframe>-->
                            </div>
                          </div>  
                                          
                          <div class="sl-photo-box" style="margin:<?php if($j==1){echo '0 0 0 20px;';}else {echo '0;';}?> width:360px;">
                                <div class="clear"></div>
                                <br>
                                <div id="preview-<?php echo $j;?>" class="sl-photograph video_preview" style="margin-left: 90px;">
                                   <div id="show-<?php echo $j;?>" > 
                                    <input type="hidden" name="drg_videos[]" value="<?php echo $uservideoname;?>" id="video-<?php echo $j;?>" />  
                                    </div>
                                    <?php 
                                    $uservideoname = "";
                                    $drg_videodesc = "";
                                    if($uservideo[$j]->drg_listing_video!="")
                                    {
                                        $uservideoname = $uservideo[$j]->drg_listing_video;
                                        $drg_videodesc = $uservideo[$j]->drg_videodesc;
                                    }
                                    ?>
        							<input type="hidden" name="drg_old_videos[]" value="<?php echo $uservideoname;?>"/>
                                </div>
                                
                                 <div id="ova-example-player-container_<?php echo $j; ?>" class="video_player_container" style="">
                                    <div id="ova-example-player_<?php echo $j; ?>" style="position:relative;">
                                        <div id="ova-player-instance_<?php echo $j; ?>" loaded="false" class="video_player_instances" style=""> 
                                                 <!-- SELECTED PLAYER INSTANCE GOES IN HERE -->
                                        </div>
                                        <?php 
                                         if($uservideoname !=""){
                                         ?> <script language="javascript">
                                                jwplayer("ova-player-instance_<?php echo $j; ?>").setup({
                                                    flashplayer: "<?php echo Yii::app()->theme->baseUrl;?>/js/jwplayer1/jwplayer.flash.swf",
                                                    file: '<?php echo Yii::app()->baseUrl;?>/upload/users/<?php echo Yii::app()->user->getState('ufolder');?>/videos/<?php echo $uservideoname; ?>',
                                                   // image: "http://business-supermarket.com/themes/business/images/video_icon.jpg",
                                                    height: 260,
                                                    width: 338,
                                                });
                                            </script>  
                                        <?php 
                                        }
                                        ?>
                                    </div>
                                 </div>
                                <div id="progressbox_<?php echo $j; ?>" class="progressbox" style="display:none;"><div id="progressbar_<?php echo $j; ?>" class="progressbar" ></div ><div id="statustxt_<?php echo $j; ?>" class="statustxt" >0%</div></div>
        
                                <div id="progressstatus_<?php echo $j; ?>" class="progressstatus" style="display:none;"></div>
                                
                                <p class="slisting-head">Video <?php echo $j;?> (Person behind the business) <a class="sl-tip tooltip" href="#;">?<span class="classic">Potential investors want to know the person behind the business; your skills, how you present yourself, your experience and credibility, all play a vital role if you wish to see your business idea succeed.<br><br /></span></a></p>
                                 
                                <input value="<?php echo $drg_videodesc; ?>" type="text" name="drg_videodesc[]" id="fileName<?php echo $j;?>" class="file_input_textbox" style="width:335px;" />
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
                    }
                    ?>
                    <div class="submit_button">
                        
                        <?php 
                        if($model->isNewRecord){
                        ?>
                            <input type="submit" name="submit_user_listing_step3" class="button black" value="Insert" />
                        <?php 
                        }
                        else {
                        ?>
                            <input type="submit" name="update_user_listing_step3" class="button black" value="Update" />
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
                        <a href="<?php echo Yii::app()->createUrl('listing/create/'.$model->drg_lid);?>">1</a> 
                        <a  href="<?php echo Yii::app()->createUrl('listing/user_listing_step2/listid/'.$model->drg_lid);?>">2</a> 
                        <a class="active" style="cursor:default;">3</a> 
                        <a>4</a>
                    </div>
                    <div><a onclick="form_validation_step3();" href="javascript:void(0);">next &gt;&gt;</a></div>
                </div>
                <div style="clear:both; height:20px;"></div>
            </div>
            <div class="clear"></div>
        </div>
        <!--end bottom carousel----->
    
<script type="text/javascript"><!--
 function form_validation_step3(){
    jQuery('#user_listing_step3').submit();
 }
 function getUploadfilename(result,id){
    if(result.success){ 
        jQuery("#image_preview"+id).html('');
        var img = '<img src="<?php echo Yii::app()->baseUrl.'/upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/'; ?>' + result.filename + '" height="90" />'
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
		
		alert("ok");
		jQuery(".upload_video_file").trigger("click");
		
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
	
	var y = fileinput.value.split(".");
	var ext = y[(y.length)-1];
	ext=ext.toLowerCase(); 
	
	var progressbox     = jQuery('#progressbox_'+s);
	var progressbar     = jQuery('#progressbar_'+s);
	var statustxt       = jQuery('#statustxt_'+s);
	var completed       = '0%'; 
	
	if (allowed[ext]) {
        //document.chooseF.confirm.disabled = false;
        jQuery("#fileName"+s).val(fileinput.value);
        
        // process to call the ajax form
                
        jQuery(".is_upload_file_"+s).val("process");
        
        jQuery('#progressbox_'+s).show("slow");
        
        jQuery('#progressstatus_'+s).show("slow");
       
        jQuery("#upload_video_"+s).ajaxForm({   
                  uploadProgress: function(event, position, total, percentComplete){ 
                        progressbar.width(percentComplete + '%') ; 
						statustxt.html(percentComplete + '%');  
						if(percentComplete>50)
						{
							statustxt.css('color','#fff'); 
                        }  
						var res = percentComplete + '% | ' + (position/1024).toFixed(2) +' kb / '+(total/1024).toFixed(2) +' kb';
						jQuery("#progressstatus_"+s).html(res);
					  
				},success:function(data){ 
                     jwplayer("ova-player-instance_"+s).setup({ 
						flashplayer: "js/jwplayer1/jwplayer.flash.swf",
						file: jQuery.trim(data),
						height: 260,
						width: 338, 
					}); 
					jQuery(".is_upload_file_"+s).val("");
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