<div id="shadow-wrap">
  
    <!-- Start of left content Ends -->
    <div id="leftcontent">   

        <div class="clear"></div>
        
        <div class="registration-box">
			
            <!-- registration box start-->
            <div class="close_caform"><a class="button white smallrounded" href="index.php" title="Close" >X</a></div>
            <div id="registration-tabs"><a href="javascript:void(0);">Create Listing</a>
                <div class="clear"></div>
            </div>
            
            <div class="registration-content bstep3" style="min-height:400px">
            <?php if (isset($_SESSION['dragonsnet_usr']['drg_status']) && $_SESSION['dragonsnet_usr']['drg_status'] == 'Save for later') { ?>
                    <!--- Confirm email pop up---->        
                    <div class="save_later listing_draft">
                        <div class="u-email-box"> 
                            <img src="<?php Yii::app()->them->baseUrl;?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:2px;" />
                            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
                                <a title="Close" href="javaScript:void(0)" onclick="close_save_later()" class="pu-close">X</a>
                                <br />
                                <h2 class="Blue">you have successfully saved a draft copy of this listing</h2>
                                <p class="orange-color" id="confirm_email_popup"></p>
                                <p style="text-align: center;">you may come back to this listing anytime to complete and submit it for publication</p>
                                <input id="CreateAccountBtn" class="button black" name="canle" type="button" value="Close"  onclick="close_save_later();"/>
                            </div>
                        </div>
                    </div>
                    <!-- end popup-->                      
            <?php 
            unset($_SESSION['dragonsnet_usr']['drg_status']);  
            }
            ?>
                <h2 align="center" class="Blue">Create a User listing</h2>
                <div style="text-align:center"><i style="font-size:7pt; color:#999999">Tell us about your business idea</i></div>
                
                 <?php $form=$this->beginWidget('CActiveForm', array('id'=>'user_listing_step4','enableAjaxValidation'=>false)); ?>	
                 
                    
                    <!-- Image text starts here -->
                    <div class="slisting-head">
                        <p>Enter your marketing question below <a class="sl-tip tooltip" href="#;">?<span class="classic">Make sure your question is simple and easy to understand.<br>Please ensure that your question results in a YES, MAYBE or NO response. </span></a></p>
                    </div>
                    <!-- Title --> 
                    <?php  
                        
                         echo $form->textArea($model,'drg_mktquestion',array('id'=>'drg_list_maketing_question','style'=>'height:40px; text-align:center; font-size:1.8em' ,'class'=>'textarea-full', 'onfocus'=>"getNormal('#drg_list_maketing_question');",)); 
                         echo $form->error($model,'drg_mktquestion'); 
                     ?> 
		            <br class="clear" />
                    <br class="clear" />
					<div style="margin-bottom: 3px; margin-top:25px;">
                        <label style="color:#A47A8F;">Listing Notification <a class="sl-tip tooltip" href="#;">?<span class="classic">You will receive a progress report on your listing via email. You may chose the frequency of such notification here.  </span></a></label>
                    </div>
                    <label style="color:#808080;"><p style="margin-top:10px;"><em>Send me a progress report  on this listing once every:-</em></p></label>
                    <div style="text-align:center; margin:50px 0;">                         						                        
                        <input type="radio" style="margin: 0 0 0 60px;" value="day" name="drg_reporttime" <?php echo ($model->drg_reporttime=='day')? 'checked="true"': '' ;?>> Day
                        <input type="radio" style="margin: 0 0 0 60px;" value="week" name="drg_reporttime" <?php echo ($model->drg_reporttime=='week')? 'checked="true"': '' ;?>> Week
                        <input type="radio" style="margin: 0 0 0 60px;" value="month" name="drg_reporttime" <?php echo ($model->drg_reporttime=='month')? 'checked="true"': '' ;?>> Month
                        <?php echo $form->error($model,'drg_reporttime');  ?>                        
                    </div>
					<div class="sl-bottom-buttons">
						<input type="submit" title="Save your listing to be completed at a later date" class="button black" value="Save for later" name="saveforlater" id="sl-sfl">
						<input type="submit" title="See a preview of your listing" class="button blue" value="Preview Listing" name="preview" id="sl-pl">
						<input type="submit" title="Submit your listing for publication" class="button green_button" value="Submit Listing" name="save" id="sl-sl">
					</div>
                
                <div style="clear:both; height:20px;"></div>
                <div class="navigation">
                    <div><a href="<?php echo Yii::app()->createUrl('listing/user_listing_step3/listid/'.$model->drg_lid);?>">&lt;&lt; previous</a></div>
                    <div> 
                        <a href="<?php echo Yii::app()->createUrl('listing/create/listid/'.$model->drg_lid);?>">1</a> 
                        <a href="<?php echo Yii::app()->createUrl('listing/user_listing_step2/listid/'.$model->drg_lid);?>">2</a> 
                        <a  href="<?php echo Yii::app()->createUrl('listing/user_listing_step3/listid/'.$model->drg_lid);?>">3</a> 
                        <a class="active">4</a>
                    </div>
                </div>
                
            </div>
            <div class="clear"></div>
        </div>
        <!--end bottom carousel----->
    </div>
    <!-- /leftcontent -->
    <!-- rightbar starts here -->
    <div id="rightbar">
       
    </div>
    <div class="clear"></div>
  <?php $this->endWidget(); ?>
    <div class="clear"></div>
</div>
<script type="text/javascript"><!--
    // Advert Carousel
    jQuery(document).ready(function() {
        jQuery('#add-carousel-wrap').jcarousel({
            wrap: 'circular',
            scroll: 1
        });
    });
    
     function close_save_later() {
         location='my-account.php';
         /* $(".save_later").hide(); */
    }
//form validations
function getNormal(id){
	jQuery(id).attr('placeholder','');	
	if(jQuery(id).hasClass('mandatoryerror')){
	   jQuery(id).removeClass('mandatoryerror');
	}
}
function getSelectNormal(id){
	if(jQuery(id).hasClass('mandatoryerror')){
	   jQuery(id).removeClass('mandatoryerror');
	}
}
jQuery('#user_listing_step4').submit(function(event){
	var failedvalidation = false;
	/**	@validation for listing maketing question */
	var drg_list_maketing_question = jQuery('#drg_list_maketing_question').val();
	if(drg_list_maketing_question == ""){
    	jQuery("#drg_list_maketing_question").addClass('mandatoryerror');
    	jQuery("#drg_list_maketing_question").attr({'placeholder':'Enter maketing question'});
	failedvalidation = true;
	}else{
    	jQuery("#drg_list_maketing_question").removeClass('mandatoryerror');
    	jQuery("#drg_list_maketing_question").attr({'placeholder':''});
   }
	if (failedvalidation){
		event.preventDefault()
	}
});
//--></script>
<!-- /shadow-wrap -->
</body></html>