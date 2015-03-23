<div id="shadow-wrap">

      <!-- Start of left content Ends -->
    <div id="leftcontent">  <p class="breadcrumb">
        <a href="index.php" >Home</a> &gt; 
        <a href="<?php echo Yii::app()->createUrl('myaccount/update');?>"> my profile</a> &gt; 
        create user listing - step 4 of 4
    </p>  
  <div class="clear"></div>
        <div>
            <?php 
                $this->renderPartial('//../modules/listing/views/layouts/listing_slider');            
            ?>           
        </div>
        <div class="clear"></div>
            <div class="delete_listing black-popup" style="display: none;">
        <div class="delete_listing_popup_big" id="delbox1">
      	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png"/>
		<div class="my-listing-delete-box_big">
		<form action="<?php echo Yii::app()->createUrl('listing/ldelete/listid/'.$model->drg_lid);?>" method="post"> 
		<?php $surll= $_SERVER["REQUEST_URI"];
        $surll1 = ltrim($surll, '/'); ?>         
        <input type="hidden" name="furl" value="<?php echo $surll1; ?>">  
		<input type="hidden" value="<?php echo $model->drg_lid; ?>" id="listing_delete_id" name="listing_delete_id" > 
		<span style="  color: red;
  display: block;
    margin-top: 15px;
  font-size: 35px;">Warning!</span>

<span style="font-size: 17px;display: block;"><b>You are about to permanently delete this listing.</b></span>
<br/>
<span style="display: block;">If you proceed then you will delete all the contents and any marketing data for this listing.</span>
<b>This action is irreversible and cannot be undone.</b><br/>
You may request a stand alone functional copy of this listing for your records from<br/>
<a href="mailto:support@business-supermarket.com" style="display: block;">support@business-supermarket.com*</a><br/>
<span style="color:grey;display: block;" ><i>
* There is a small charge for this service of which you will be notified when you

submit the request. You will receive a fully functional copy of your listing complete

with all it marketing data, images and videos etc. on a USB stick as well as a hard
copy portfolio delivered to the registered address in your profile.
</i></span><br/>
 
		<div class="confirmbtn">
		<button class="button black" type="button" onClick="jQuery('.delete_listing').hide();jQuery('.registration-box').fadeIn('slow'); return false;">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button class="button blue" type="button" onClick="jQuery('.delete_listing').hide();jQuery('.registration-box').fadeIn('slow'); return false;">Download</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button  type="submit" name="deletelisting" class="button red">Delete</button></form>
		</div></div></div></div>
		
        <div class="registration-box">
			
            <!-- registration box start-->
            <!-- <div class="close_caform"><a class="button white smallrounded" href="index.php" title="Close" >X</a></div>-->
            <div id="registration-tabs"><a href="javascript:void(0);">Create Listing</a>
                <div class="clear"></div>
            </div>
            
            <div class="registration-content bstep3" style="min-height:400px">
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
                            <input class="button black" title="Save and close form" name="register" type="button" value="Save & Close"  onclick="window.location.href='<?php echo Yii::app()->createUrl('user/myaccount/update'); ?>'" />               
                            <input class="button black" title="Discard ALL data and close form" onclick="saveforlater();" name="register" type="button" value="Save for later"  />
                        </td>
                      </tr>
                      </table>
                    </div>
                  </div>
                </div>
            <!-- end close--> 
               
            
            
            
            
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
                 
                     <input type="hidden" name="btnsaveforlater" value="0" id="btnsaveforlater" />
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
					 <input type="hidden" name="listid" value="<?php echo $model->drg_lid; ?>" />
                    <label style="color:#808080;"><p style="margin-top:10px;"><em>Send me a progress report  on this listing once every:-</em></p></label>
                    <div style="text-align:center; margin:50px 0;">                         						                        
                        <input type="radio" style="margin: 0 0 0 60px;" value="day" name="drg_reporttime" <?php echo ($model->drg_reporttime=='day')? 'checked="true"': '' ;?>> Day
                        <input type="radio" style="margin: 0 0 0 60px;" value="week" name="drg_reporttime" <?php echo ($model->drg_reporttime=='week')? 'checked="true"': '' ;?>> Week
                        <input type="radio" style="margin: 0 0 0 60px;" value="month" name="drg_reporttime" <?php echo ($model->drg_reporttime=='month')? 'checked="true"': '' ;?>> Month
                        <?php echo $form->error($model,'drg_reporttime');  ?>                        
                    </div>
					<div class="sl-bottom-buttons">
	                     <input type="button" style="margin: 0 30px; padding:7px 12px;" title="Delete listing" class="button red" value="Delete Listing" name="delete" id="sl-pl" onClick="delete_listing();">
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

jQuery(document).ready(function(){
       jQuery(".pu-close1").live("click",function(){
            jQuery(".confirm").show();
        })
            
        close_form(); 
    });
    
	function delete_listing() 
	{     
	jQuery(".delete_listing").fadeIn(); 
	jQuery(".registration-box").fadeOut('fast');
	}
	
    function close_form()
    {   JQ1(".confirm").hide();
    }
    
    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value=1;
        document.getElementById("user_listing_step4").submit();       
    }
    



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