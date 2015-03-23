<?php
$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');
$js->registerScriptFile($baseUrl . '/js/tinymce.min.js');


?>
   <?php 
   Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jwplayer1/jwplayer.js',CClientScript::POS_END);   
   ?> 
   <script type="text/javascript">jwplayer.key="2SjjlzyKCa+5G6RGoZhN/hLyW2KiOB0xz/7EcQ==";</script>  
  <style type="text/css">#div_upload_big{height: auto !important;}</style>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".chzn-select").chosen();
        jQuery("#registration-tabs a").live("click",function(){
            jQuery("#registration-tabs a").removeClass("active");
            jQuery(this).addClass("active");  
            jQuery(".showhide").hide();
            /*var activediv =  jQuery(this).attr("data-active") ;
            jQuery(this).addClass("active");*/
            jQuery("#"+jQuery(this).attr("data-active")).show();
        });
    });


//jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>
<?php
/* @var $this SliderController */
/* @var $model Slider */
/* @var $form CActiveForm */
?>
<style>
.black-popup{
position: fixed;
    top: 20%;
    left: 35%;
    z-index: 99999999;    
}  

.my-account-popup-box{
position: fixed;
    top: 20%;
    left: 35%;
    z-index: 99999999;	
	
}
.user_info_container {
    right: 0px !important;
}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tooltips.css" />  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/adminstyle.css" />


<div class="user_listing_search">


<div id="details" class="showhide">

    <div class="form">

                <?php $form = $this->beginWidget('CActiveForm', array('id'=>'slider-form','enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>	
       

        <div>
        <div class="sl-basic-info pro-field" style="  width: 920px; margin-left:24px;">
            <label>Slider Title <a href="#;" class="sl-tip tooltip">?<span class="classic">Give your slider a title</span></a></label>
            <br>
            <?php echo $form->textField($model, 'slider_title', array('class' => 'inp width-500', 'id' => 'slider_title','required' => 'true', 'onfocus' => "getNormal('#slider_title');")); ?>
            

        </div>
		
        <div style="margin-bottom: 3px;">
            <label style="color:#A47A8F;">Upload photographs <a class="sl-tip tooltip" href="#;">?<span class="classic">Select and upload five images in one of the following formats:- BMP, JPEG, PNG, GIF<br> Please NOTE image size MUST NOT exceed 6"x4" otherwise cropping will occur.</span></a></label>
        </div>
        <?php 
      
		  $userimage = Sliderlistingimages::model()->findAllByAttributes(array("slider_id" => $model->slider_id)); 
	  	
	         
           for ($i = 1; $i <= 5; $i++) {
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
                                   if($userimage[$i]->slider_image !=""){
                                    $imagename = $userimage[$i]->slider_image;
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
                                                           'action'=>Yii::app()->createUrl('admin/slider/slider/listingimage'),
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
                                <div class="sl-photograph image_preview" id="image_preview<?php echo $i;?>" style="  width: 183px;
  overflow: hidden;
  height: 140px;">   
                                    <?php 
                                    if($imagename !="")
                                    {?>
                                        <img title="<?php echo $userimage[$i]->slider_imagedesc;?>" alt="<?php echo $userimage[$i]->slider_imagedesc;?>" src="<?php echo Yii::app()->baseUrl;?>/upload/sliders/thumb/<?php echo $userimage[$i]->slider_image;?>" height="104" />
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
                    }?>

        <br class="clear" />
        <br class="clear" />
        <div class="slisting-head">
            <p>Enter a short description for each image <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter a short description explaining each image. Please note text is limited to 4 lines.</span></a></p>
        </div>
        <div class="sl-image-description admin-description">
            <?php
            $userimage = Sliderlistingimages::model()->findAllByAttributes(array("slider_id" => $model->slider_id));
            ?>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="img_desc img_desc_text">
                    <textarea rows="2" cols="9" class="slider_imagedesc" name="slider_imagedesc[]" id="image-description-<?php echo $i; ?>" maxlength="80"><?php echo $userimage[$i - 1]['slider_imagedesc']; ?></textarea>
                    <br>
                    Image <?php echo $i; ?> text
                </div>
                <!-- <?php echo $i; ?>Image text -->
            <?php }?>  
             <br class="clear" />
        </div>
		
		 <br class="clear" />
        <div class="slisting-head">
            <p>Enter a link to each slider</p>
        </div>
        <div class="sl-image-description admin-description">
            <?php
            $userimage = Sliderlistingimages::model()->findAllByAttributes(array("slider_id" => $model->slider_id));
            ?>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="img_desc img_desc_text">
                    <input type="text" class="inp width" name="slider_sitelink[]" id="image-description-<?php echo $i; ?>" value="<?php echo $userimage[$i - 1]['slider_sitelink']; ?>" style="background: none repeat scroll 0 0 #F1E5E2;
  border: 1px solid #F1E5E2;
  margin: 6px 0 10px;
  overflow: hidden;
  padding: 5px 4.5px;
  resize: none">
                    <br>
                    Site link<?php echo $i; ?>
               
				<h3 style="  color: #1dbfd8;">OR</h3>
				
                    <input type="text" class="inp width" name="slider_videolink[]" id="image-description-<?php echo $i; ?>" maxlength="80" value="<?php echo $userimage[$i - 1]['slider_videolink']; ?>" style="background: none repeat scroll 0 0 #F1E5E2;
  border: 1px solid #F1E5E2;
  margin: 6px 0 10px;
  overflow: hidden;
  padding: 5px 4.5px;
  resize: none;">
                    <br>
                    Video link<?php echo $i; ?>
                </div>
                <!-- <?php echo $i; ?>Image text -->
            <?php }?>  
             <br class="clear" />
        </div>

        <br class="clear" />

    
        <div class="sl-bottom-buttons admin-button">
        <!--<a href="<?php echo Yii::app()->createUrl('/admin/listings/listings/delete', array('id' => $model->slider_id)); ?>" class="button red">Delete</a>-->
  <?php
  if($model->isNewRecord)
  {
  ?>
    <button type="submit" onClick="listing_validation()" class="button blue">Create</button>
  <?php
  }
  else
  {
  ?>
                     <button type="submit" onClick="listing_validation()" class="button blue">Update</button>
					 <?php
					 }
					 ?>
        
   		<div class="clear"></div>
        </div>

 

<?php $this->endWidget(); ?>
	


    </div><!-- form -->
</div>
  </div>
	
</div>

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
        var img = '<img src="<?php echo Yii::app()->baseUrl.'/upload/sliders/thumb/'; ?>' + result.filename + '" />'
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
 