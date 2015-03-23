<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/upload/css/imgareaselect-default.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/upload/css/styles.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/upload/css/button.css" /> 
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/upload/js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript">
var JQ = jQuery.noConflict();
function upload_pic(form)
{
	JQ('#upload_big').submit();
}

JQ(document).ready(function() { 
	JQ("#upload_picture").click(function() { 
		JQ.ajax({
             type: "POST",
             url: "save_logo_listing.php",
             data: 'save_thumbnail='+JQ("#save_thumbnail").val(),
             success: function(result)
			 {
			 	var imgShow = "<img src='"+result+"' style='height:120px;' >";
			 	JQ("#showImg", top.document).html(imgShow);
				JQ("#drg_listing_logo", top.document).val(result);
				JQ('#div_upload_big').css('display','none');
				JQ('#div_upload_big_new').html('<img src="imagess/avatar.jpg" />');
				JQ(".photo-upload-box1", top.document).css('display','none');
			 }
		});	 
	});
	
	JQ("#file").click(function() { 
		JQ('#div_upload_big').css('display','block');
		JQ('#div_upload_big').html('');
		JQ('#div_upload_big_new').html(''); 
	});
	
	
});
</script> 
<div id="wrap">    
    <div id="uploader">
        <div id="big_uploader">
        <div id="notice"><img src="<?php  echo Yii::app()->theme->baseUrl;?>/images/ajax-loader.gif" /></div>
		<i>Upload image maximum of 2MB.</i>
        <div id="div_upload_big" class="listing_logo">			
			<p style="padding: 23px 10px;">Image dimensions <br> must not exceed a standard 6 x 4 photo<br> (400 x 600 pixels max)</p>
		</div>
		<div id="div_upload_big_new"></div>
            <form name="upload_big" id="upload_big"  method="post" enctype="multipart/form-data" action="upload.php?act=bigthumb" target="upload_target">
              <label><br />Browse for a picture on your computer<br /></label><br />
              <input name="photo" id="file" size="27" type="file" onChange="upload_pic()" />
              <input type="hidden" name="height" value="400" />
              <input type="hidden" name="width" value="400" /> 
			  <input type="hidden" name="heighthumb" value="120">
              <input type="hidden" name="widththumb" value="185" />    
              <br /><br />
              <!--<input type="submit" name="action" value="Preview Picture" class="black button" />-->
            </form>
    	</div><!-- big_uploader -->
        
<div id="content">
	<div id="uploaded">
        <form name="upload_thumb" id="upload_thumb" method="post"  target="upload_target" action=""> 
        <input type="hidden" name="save_thumbnail" id="save_thumbnail" value="" />
        <input type="submit" class="black button" value="Upload Picture" id="upload_picture"/> 
        </form>
   </div> 
</div> 

        <iframe id="upload_target" name="upload_target" src="" style="width:100%;height:400px;border:1px solid #ccc; display:none"></iframe>
        <!-- this is the secret iframe :) -->
        
    </div><!-- uploader -->


</div><!-- wrap -->
<style type="text/css">
.pu-submit{
	background:url(../images/buttons/small-button-normal-state.png) no-repeat center center;
	border:none;
	padding:10px 60px;
	color:#fff;
	font-weight:bold;
	text-align:center!important;
	margin:10px auto;
	font-size:12px;
	cursor:pointer;
	}
.pback{
	margin-left:175px;
	text-decoration:none;}	
	
</style>	
