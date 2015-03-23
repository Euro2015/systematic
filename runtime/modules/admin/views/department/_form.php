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
  <style type="text/css">#div_upload_big{height: auto !important;} #upload-frame { margin-left: 228px !important;} .qq-uploader .qq-upload-button.black.button {
  position: absolute !important;top: 20px; } .chzn-container{top: 7px; }</style>
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
  .sl-photograph img {
height : 141px;
}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tooltips.css" />  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/adminstyle.css" />


<div class="user_listing_search">

<a class="pu-close pu-close1" href="<?php echo Yii::app()->createUrl('/admin/department/index'); ?>" title="Close" style="margin-right: 0px;">X</a>

<div id="details" class="showhide">

    <div class="form">

                <?php $form = $this->beginWidget('CActiveForm', array('id'=>'department-form','enableAjaxValidation'=>false)); ?>	
       

        <div>
		<h2 align="center" class="Blue" style="margin:15px 0;"><?php
  if($model->isNewRecord)
  {
  echo "Create a new Department";
  }
  else 
  { 
  echo "Edit Department";
  } ?></h2>
  <br/>
		<div class="sl-basic-info pro-field" style="  width: 973px; margin-left:2px;text-align:center">
            <label>Department Name <a class="sl-tip tooltip" href="#;">?<span class="classic">Give Specific title for department</span></a></label>                                
            <br/><br/>
            <?php echo $form->textField($model, 'dept_name', array('class' => 'inp width-500', 'id' => 'dept_name', 'style'=>'width:450px','onfocus' => "getNormal('#dept_name');")); ?>
</div><br/>

<div class="sl-basic-info pro-field" style="  width: 973px; margin-left:2px;text-align:center">
            <label>Department Email ID <a class="sl-tip tooltip" href="#;">?<span class="classic">Give Specific email id for department</span></a></label>                                
            <br/><br/>
            <?php echo $form->textField($model, 'dept_email', array('class' => 'inp width-500', 'id' => 'dept_email', 'style'=>'width:450px','onfocus' => "getNormal('#dept_email');")); ?>
</div>
<br/><br/>
    
        <div class="sl-bottom-buttons admin-button" style="  margin-top: 200px !important;">
 
  <?php
  if($model->isNewRecord)
  {
  ?>
    <button type="submit" class="button blue">Create</button>
  <?php
  }
  else
  {
  ?>     <button type="submit" class="button blue" style="margin: 0 80px;">Update</button>
  
       <a href="<?php echo Yii::app()->createUrl('/admin/department/ldelete/id/'.$model->dept_id ); ?>" class="button red">Delete</a>
                
					 <?php
					 }
					 ?>
        <a href="<?php echo Yii::app()->createUrl('/admin/department/index'); ?>" class="button black">Cancel</a>
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
 
 jQuery('#department-form').submit(function(event){
 
	var noImage = [];
	var hasImageButText = [];
 if(jQuery('#dept_name').val()=='')
 {
 alert('Please Enter Department Name');
 event.preventDefault();
 }
 else if(jQuery('#dept_email').val()=='')
 {
 alert('Please Enter Department Email ID');
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
 