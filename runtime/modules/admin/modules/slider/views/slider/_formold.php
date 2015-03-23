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
  <style type="text/css">#div_upload_big{height: auto !important;} #upload-frame { margin-left: 228px !important;}</style>
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
.qq-upload-button {
  margin: none !important;
  }
  .sl-photograph img {
height : 141px;
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
            <label>Slider Title <a class="sl-tip tooltip" href="#;">?<span class="classic">Give your slider a title</span></a></label>                                
            <br>
            <?php echo $form->textField($model, 'slider_title', array('class' => 'inp width-500', 'id' => 'slider_title', 'onfocus' => "getNormal('#slider_title');")); ?>
            

        </div>
  <div class="sl-basic-info pro-field" style="  width: 920px; margin-left:24px;  margin-bottom: 20px;">
            <label>Select page <a class="sl-tip tooltip" href="#;">?<span class="classic">Select the page you wish to allocate the slider to</span></a></label>
            <br />
			  <?php
                        $listingpages = CHtml::listData(Allpages::model()->findAll(array('order'=>"`pname` ASC")), 'pslug', 'pname');
                        echo $form->dropDownList($model, 'page_name', $listingpages, array('prompt' => 'Select Page', 'class' => 'chzn-select', 'data-placeholder' => 'Please select', 'onfocus' => 'getSelectNormal("#page_name");', 'id' => 'page_name'));
                       // echo $form->error($model, 'drg_category');
                        ?>
		       <!-- <select class='chzn-select' name="Createsliderlisting[page_name]">
                                <option value="businesslisting" <?php if($model->page_name == "businesslisting") { echo "selected"; } ?> >Business Listing</option>
                                <option value="business_services"<?php if($model->page_name == "business_services") { echo "selected"; } ?> >Business Services</option>
                                <option value="business_ideas" <?php if($model->page_name == "business_ideas") { echo "selected"; } ?> >Business-ideas</option>
                                <option value="indexpage"<?php if($model->page_name == "indexpage") { echo "selected"; } ?> >Index</option>
                                <option value="industrial"<?php if($model->page_name == "industrial") { echo "selected"; } ?> >Industrial</option>
                                <option value="retail"<?php if($model->page_name == "retail") { echo "selected"; } ?> >Retail</option>
                                <option value="science_and_technology"<?php if($model->page_name == "science_and_technology") { echo "selected"; } ?> >Science & Technology</option>
                                <option value="listing"<?php if($model->page_name == "listing") { echo "selected"; } ?> >User Listing</option>
                            </select> -->
            

        </div>
		<br/>
        <div style="margin-bottom: 3px;">
            <label style="color:#A47A8F;">Upload photographs <a class="sl-tip tooltip" href="#;">?<span class="classic">Select and upload five images in one of the following formats:- BMP, JPEG, PNG, GIF<br> Please NOTE image size MUST NOT exceed 6"x4" otherwise cropping will occur.</span></a></label>
        </div>
        <?php 
      $attribs = array('slider_id'=>$model->slider_id);
$criteria = new CDbCriteria(array('order'=>'image_id ASC'));
		  $userimage = Sliderlistingimages::model()->findAllByAttributes($attribs, $criteria); 
	  	
	         
           for ($i = 0; $i < 5; $i++) {
            ?>
       <div class=" listing-upload photo-upload-box<?php echo $i;?>" id="photo-upload-box-tab" style="height: 98%;width: 972px;margin-top: -140px;">
                            <img class="side-robot-upload-slider" src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
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
                                   <div id="wrap" style="text-align:center;">    
                                        <div id="uploader">
                                            <div id="big_uploader">
                                                <div id="notice"></div>
                                        		<i>Upload image maximum of 2MB.</i>
                                                <br/><br/>
                                                 <div id="div_upload_bignew" class="listing_logo">			
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
                                <div class="sl-photograph image_preview" id="image_preview<?php echo $i;?>" style="width: 183px; overflow: hidden; height: 140px;">   
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
      $attribs = array('slider_id'=>$model->slider_id);
$criteria = new CDbCriteria(array('order'=>'image_id ASC'));
		  $userimage = Sliderlistingimages::model()->findAllByAttributes($attribs, $criteria); 

            ?>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="img_desc img_desc_text">
                    <textarea rows="2" cols="9" class="drg_imgdesc" name="slider_imagedesc[]" id="image-description-<?php echo $i; ?>" maxlength="80"><?php echo $userimage[$i - 1]['slider_imagedesc']; ?></textarea>
                    <br>
                    Image <?php echo $i; ?> text
                </div>
                <!-- <?php echo $i; ?>Image text -->
            <?php }?>  
             <br class="clear" />
        </div>
		
		 <br class="clear" />
        <div class="slisting-head">
            <p>Enter a link to each slider <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter either video link or site link for each slider image.</span></a></p>
        </div>
        <div class="sl-image-description admin-description">
            <?php
            $userimage = Sliderlistingimages::model()->findAllByAttributes(array("slider_id" => $model->slider_id));
            ?>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="img_desc img_desc_text">
                    <input type="text" class="inp width" name="slider_sitelink[]" id="slider-sitelink-<?php echo $i; ?>" value="<?php echo $userimage[$i - 1]['slider_sitelink']; ?>" style="background: none repeat scroll 0 0 #F1E5E2;
  border: 1px solid #F1E5E2;
  margin: 6px 0 10px;
  overflow: hidden;
  padding: 5px 4.5px;
  resize: none">
                    <br>
                    Site link<?php echo $i; ?>
               
				<h3 style="  color: #1dbfd8;">OR</h3>
				
                    <input type="text" class="inp width" name="slider_videolink[]" id="slider-videolink-<?php echo $i; ?>" maxlength="80" value="<?php echo $userimage[$i - 1]['slider_videolink']; ?>" style="background: none repeat scroll 0 0 #F1E5E2;
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
		<div class="slisting-head">
            <p>Button text for slider <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter Content for 3 buttons besides the advertise slider . you can add button image , button text and add either site link or video link to each buttons.</span></a></p>
        </div>
  <?php

   $attribs = array('slider_id'=>$model->slider_id);
$criteria = new CDbCriteria(array('order'=>'btn_id ASC'));
		  $userimage = Sliderbtns::model()->findAllByAttributes($attribs, $criteria); 
            ?> <?php for ($i = 1; $i <= 3; $i++) { ?>

<!-- Row 1 Start -->
        <div class="sl-image-description admin-description">
          
            
<h3 style="  color: #1dbfd8;">Button <?php echo $i; ?></h3>
                <div class="img_desc img_desc_text" style="width:233px !important;">
Button Image <br/>
                    <input type="text" class="inp width" name="btn_image[]" id="btn_image_<?php echo $i; ?>" value="<?php echo $userimage[$i - 1]['btn_image']; ?>" style="background: none repeat scroll 0 0 #F1E5E2;
  border: 1px solid #F1E5E2;
  margin: 6px 0 10px;
  overflow: hidden;  width: 215px;
  padding: 5px 4.5px;
  resize: none">
              
                </div>

 <div class="img_desc img_desc_text" style="width:233px !important;">
Button Text<br/>
                    <input type="text" class="inp width" name="btn_text[]" id="btn_text_<?php echo $i; ?>" value="<?php echo $userimage[$i - 1]['btn_text']; ?>" style="background: none repeat scroll 0 0 #F1E5E2;
  border: 1px solid #F1E5E2;
  margin: 6px 0 10px;
  overflow: hidden;  width: 215px;
  padding: 5px 4.5px;
  resize: none">
              
                </div>

 <div class="img_desc img_desc_text" style="width:233px !important;">
Button Site link<br/>
                    <input type="text" class="inp width" name="btn_sitelink[]" id="btn_sitelink_<?php echo $i; ?>" value="<?php echo $userimage[$i - 1]['btn_sitelink']; ?>" style="background: none repeat scroll 0 0 #F1E5E2;
  border: 1px solid #F1E5E2;
  margin: 6px 0 10px;
  overflow: hidden;  width: 215px;
  padding: 5px 4.5px;
  resize: none">
              
                </div>

 <div class="img_desc img_desc_text" style="width:233px !important;">
Button Video Link<br/>
                    <input type="text" class="inp width" name="btn_videolink[]" id="slider-sitelink-<?php echo $i; ?>" value="<?php echo $userimage[$i - 1]['btn_videolink']; ?>" style="background: none repeat scroll 0 0 #F1E5E2;
  border: 1px solid #F1E5E2;
  margin: 6px 0 10px;
  overflow: hidden;  width: 215px;
  padding: 5px 4.5px;
  resize: none">
              
                </div>
               
             <br class="clear" />
        </div>

<!-- Row 1 End -->

<?php
}
?>

    
        <div class="sl-bottom-buttons admin-button">
 
  <?php
  if($model->isNewRecord)
  {
  ?>
    <button type="submit" class="button blue">Create</button>
  <?php
  }
  else
  {
  ?>
       <a href="<?php echo Yii::app()->createUrl('/admin/slider/slider/ldelete/id/'.$model->slider_id ); ?>" class="button red">Delete</a>
                     <button type="submit" class="button blue">Update</button>
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
    
 
 function getUploadfilename(result,id){
    if(result.success){ 
        jQuery("#image_preview"+id).html('');
        var img = '<img src="<?php echo Yii::app()->baseUrl.'/upload/sliders/thumb/'; ?>' + result.filename + '" />'
        jQuery("#logo_"+id).val(result.filename);
        jQuery("#image_preview"+id).html(img);
        jQuery(".photo-upload-box"+id).hide();
   }
 }   

    
function show_picture_form(openTabId){
    jQuery("."+openTabId).show();
   openTabId = openTabId.replace('video-upload-box','');
    jQuery('#pic_frame_'+openTabId).attr({'src':'video-upload/step_1.php?id='+openTabId });
}
 
 jQuery('#slider-form').submit(function(event){
 
	var noImage = [];
	var hasImageButText = [];
 if(jQuery('#slider_title').val()=='')
 {
 alert('Please Enter Slider Title');
 event.preventDefault();
 }
else if(jQuery('#image-description-1').val()==''){
alert('Please enter image description');
event.preventDefault();
		 }


		 
 });

/*jQuery('#slider-form').submit(function(event){

	var failedvalidation = false;

	for(var i=1;i<=5;i++){            
	
		if(jQuery('#image-description-'+i).val()=='' || jQuery('#image-description-'+i).val()=='Please enter image description'){
		   noImage.push(true);  
	
		if( jQuery('#logo_'+i).val()!='' && (jQuery('#image-description-'+i).val()=='' || jQuery('#image-description-'+i).val()=='Please enter image description')){
			hasImageButText.push(true);
			onText.push(i);
		 }
		 
		 
		 if( jQuery('#logo_'+i).val()=='' && ( jQuery('#image-description-'+i).val()!='' && jQuery('#image-description-'+i).val()!='Please enter image description') ){
			hasTextButImage.push(true);
			onImage.push(i);
		 }
	}

		
	if (failedvalidation){		
		event.preventDefault();
	}
	
});*/

//--></script>  
 