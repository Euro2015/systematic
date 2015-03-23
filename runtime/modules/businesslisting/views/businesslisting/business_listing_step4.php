

<div id="shadow-wrap">

    <!-- Start of left content Ends -->
    <div id="leftcontent">
        <!-- slider-wrapper start -->
       
        <!-- Loads home slider -->
        <!-- /#dragongallery /.stepcarousel -->
        <p class="breadcrumb"><a href="index.php" >Home</a> &gt; my account &gt; create business listing &gt; step 2 &gt; step 3 of 3</p>
        <!-- Where business meets invention -->
        <!-- /main-content -->
        <div class="clear"></div>
		<div>
            <?php              
               $this->renderPartial('//../modules/listing/views/layouts/listing_slider');  
            ?>  
        </div>
		<div style="clear:both;"></div>
        
        <div class="registration-box">
			
            <!-- registration box start--> 
            
            <div id="registration-tabs"><a href="javascript:void(0);">My account</a>
                <div class="clear"></div>
            </div>
            <div class="registration-content" style="min-height:571px">
             <a class="pu-close pu-close-step2 pu-close1" href="javascript:void(0);" title="Close">X</a>  
             
             
              <!--- Confirm close pop up---->        
                <div class="confirm " style="width: 98%; height: 95%;">
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
                            <input class="button black" title="Save and close form" name="register" type="button" value="Save & Close"  onclick="window.location.href='<?php echo Yii::app()->createUrl('business/myaccount/update'); ?>'" />               
                            <input class="button black" title="Discard ALL data and close form" onclick="saveforlater();" name="register" type="button" value="Discard"  />
                        </td>
                      </tr>
                      </table>
                    </div>
                  </div>
                </div>
              <!--- Confirm close pop up---->  

                <h2 align="center" class="Blue">Create a business services listing</h2>
                <div style="text-align:center"><i style="font-size:7pt; color:#999999">Submit your marketing question</i></div>
                <?php $form = $this->beginWidget('CActiveForm', array('id'=>'business_listing_step4','enableAjaxValidation'=>false, 'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>
                <?php echo $form->errorSummary($model); ?>
               
                    <div>                    
                    <div class="slisting-head">
                        <p>Customer testimonail<a class="sl-tip tooltip" href="#;">?<span class="classic">Using the WYSIWYG editor enter any customer testimonials below.</span></a></p>
                    </div>
                   <!-- <textarea onFocus="getNormal('#drg_list_testimonial')" class="textarea-full" id="drg_list_testimonial" name="drg_testimonial"  style="height:100px;"></textarea>-->	
                   <?php echo $form->textArea($model,'drg_testimonial',array('class'=>'textarea-full', 'id'=>'drg_list_testimonial', 'style'=>'height:100px','tabindex'=>1)); ?>
		          <?php echo $form->error($model,'drg_testimonial'); ?>	</div>
					<br class="clear" />
					
					<div>                    
                    <div class="slisting-head">
                        <p>Enter keywords for our search engine.<a class="sl-tip tooltip" href="#;">?<span class="classic">
						Be specific in the choice of your keywords. <br>A few well chosen descriptive words give better response than a large block of text that could make it difficult for you to attract the right kind of interest.<br>Separate each word with a comma and a space.</span></a></p>
                    </div>
                    
                    <?php echo $form->textArea($model,'drg_keyword',array('class'=>'textarea-full','id'=>'drg_list_keyword','style'=>'height:100px','tabindex'=>2)); ?>
					<?php echo $form->error($model,'drg_keyword'); ?>
					<br class="clear" />
					</div>
					<div class="sl-bottom-buttons">
                    
                        <input type="submit" title="Save your listing to be completed at a later date" class="button black" value="Save for later" name="saveforlater" id="sl-sfl">
                    
                         <input type="submit" title="Preview Listing" class="button blue" value="Preview Listing" name="preview" id="sl-sfl">
                         
                        <!--<a href="<?php echo Yii::app()->createUrl('businesslisting/preview_business_listing/blistid/'.$model->drg_blid);?>" class="button blue" name="preview">Preview Listing</a>-->
                    
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Submit Listing', array('class'=>'button green_button','id'=>'s1-s1','name'=>'submitlisting')); ?>
					
                    </div> 
                
                <div style="clear:both;height:20px;"></div>
                <div class="navigation">
                    <div>
                        <a href="<?php echo Yii::app()->createUrl('businesslisting/business_listing_step2/blistid/'.$model->drg_blid);?>">&lt;&lt; previous</a>
                    </div>
                    <div> 
                        <a href="<?php echo Yii::app()->createUrl('businesslisting/create/blistid/'.$model->drg_blid);?>">1</a> 
                        <a href="<?php echo Yii::app()->createUrl('businesslisting/business_listing_step2/blistid/'.$model->drg_blid);?>">2</a> 
                        <a class="active">3</a>
                    </div>
					<div><a onClick="$('#business_listing_step4').submit();">Next &gt;&gt;</a></div>
                </div>
                <div style="clear:both; height:20px;"></div>
            </div>
            <div class="clear"></div>
        </div>
        <!--end bottom carousel----->
    </div>
    <!-- /leftcontent -->
    <!-- rightbar starts here -->
     <?php $this->endWidget(); ?>
    <div class="clear"></div>
   
    <div class="clear"></div>
</div>
<script type="text/javascript">
/*
	// wysiwyg text editor for textarea
	tinymce.init({
		selector: "textarea1"
	});
	*/
//form validations
function getNormal(id){
	$(id).attr({'placeholder':''});	
	if($(id).hasClass('mandatoryerror')){
	$(id).removeClass('mandatoryerror');
	}
}
function getSelectNormal(id){
	if($(id).hasClass('mandatoryerror')){
	$(id).removeClass('mandatoryerror');
	}
}

$('#business_listing_step4').submit(function(event){	
	
	/**	@validation for listing Customer testimonial */
	var drg_list_testimonial = $('#drg_list_testimonial').val();
	if(drg_list_testimonial == ""){
		$("#drg_list_testimonial").addClass('mandatoryerror');
		$("#drg_list_testimonial").attr({'placeholder':'Enter Customer testimonial'});
		failedvalidation = true;
	}else{
		$("#drg_list_testimonial").removeClass('mandatoryerror');
		$("#drg_list_testimonial").attr({'placeholder':''});
        failedvalidation = false;
	}
	/**	@validation for listing search engine keyword */
	var drg_list_keyword = $('#drg_list_keyword').val();
	if(drg_list_keyword == ""){
		$("#drg_list_keyword").addClass('mandatoryerror');
		$("#drg_list_keyword").attr({'placeholder':'Enter search engine keyword'});
		failedvalidation = true;
		}else{
		$("#drg_list_keyword").removeClass('mandatoryerror');
		$("#drg_list_keyword").attr({'placeholder':''});
        failedvalidation = false;
	}
		
	if (failedvalidation){
       	event.preventDefault()
	}
});
</script>
<script type="text/javascript"> 
 
     tinymce.init({
        selector: "#drg_list_testimonial",
        plugins: [
            "advlist autolink lists link  charmap  preview anchor",
            "searchreplace visualblocks  ",
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });  
    
    jQuery(document).ready(function(){
       jQuery(".pu-close1").live("click",function(){
            jQuery(".confirm").show();
        })
            
        close_form(); 
    });
    
    function close_form()
    {   jQuery(".confirm").hide();
    }
    
    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value=1;
        document.getElementById("business_listing_step4").submit();       
    }
</script>
<!-- /shadow-wrap -->
</body></html>