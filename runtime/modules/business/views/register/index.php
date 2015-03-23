<style type="text/css">
#ui-datepicker-div {
    left: 142px !important;
    top: 682px !important;
    width: 16.6em !important;
}
@media screen and (-webkit-min-device-pixel-ratio:0) {    
  #ui-datepicker-div {
      left: 131px !important;
      top: 539px !important;
      width: 16.6em !important;
  }
}
</style>
<div class="clear"></div> 
 <?php $this->breadcrumbs = array('register for a business services account'); ?>
  
  
  <div class="registration-box"><!-- registration box start-->
    <div class="close_caform"><a class="button white smallrounded" href="/" title="Close" >X</a></div>
    <div id="registration-tabs"> <a href="#taba">Create Account</a>
        <div class="clear"></div>
    </div>
      <!--- update profile picture pop up---->
     <div class="photo-upload-box biz_modal_box">
         <img class="side-robot-upload" src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
       <div class="my-account-popup-box" id="upload-frame"> <a class="pu-close" onclick=$(".photo-upload-box").hide(); href="javaScript:void(0)" title="Close">X</a>
         <h2>Upload your company logo</h2>
            Click <b>Upload Picture...</b> to choose an image from your computer<br />
            Select an image that is 120px by 120px for best fit <br />
            Your image will be automatically uploaded.<br />
            <br />
          <div id="wrap">    
                 <div id="uploader">
                     <div id="big_uploader">
                     <div id="notice"><img src="ajax-loader.gif" /></div>
                     <i>Upload image maximum of 2MB.</i><br/><br/>
                     <div id="div_upload_big" class="listing_logo"></div>
                     <div id="div_upload_big_new"></div>
                     
                     Browse for a picture on your computer
                     <br /><br /><br />
                     <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                         array(
                                 'id'=>'uploadFile',
                                 'config'=>array(
                                        'action'=>Yii::app()->createUrl('/business/register/uploadprofileimage'),
                                        'allowedExtensions'=>array("jpg",'png','gif'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                        'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                        'minSizeLimit'=>10,// minimum file size in bytes 
                                        'onComplete'=>"js:function(id, fileName, responseJSON){getUploadfilename(responseJSON);}",                                                  
                                 )
                         )); 
                     ?>
                     </div><!-- big_uploader --> 
                        
                 </div><!-- uploader --> 
             </div>            
       </div>
     </div>
    <!--- update profile picture pop up---->

    <!--- Confirm email pop up---->        
        <div class="confirm-email biz_modal_box">
          <div class="u-email-box" style="margin: 0 auto;"> 
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:-2px;" />
            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
              <a title="Close" href="javaScript:void(0)" onclick="close_email_form()" class="pu-close">X</a>
              <br />
              <h2 class="Blue">Your Account Activation link will be sent to </h2>
              <p class="orange-color" id="confirm_email_popup"></p>
              <p><em>If this is correct please press continue otherwise press cancel to make any corrections</em></p>
              <br />
              <div>
                <input class="button black CreateAccountBtn" style="margin: auto 48px;" name="canle" type="button" value="Cancel"  onclick="jQuery('.confirm-email').hide('slow');"/>                
                <input id="CreateAccountBtn" style="margin: auto 34px;" onclick="userregister();" class="button green_button CreateAccountBtn" name="register" type="button" value="Continue" />
             </div>   
            </div>
          </div>
        </div>
    <!-- end popup-->
        <div class="registration-content" style="min-height:337px">
            <div class="reg-left"> 
            
            <?php $form=$this->beginWidget('CActiveForm', array(
              'id'=>'business-registerform-form',
              'enableAjaxValidation'=>false,
                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
            )); ?>
            
              <table id="reg-table" style="width: 392px;">           
                    <tr>
                        <th colspan="2">&nbsp;</th>
                        <th class="darkGrey-text"><span class="mandatory-field">*</span> All fields are required</th>
                     </tr> 
                      
                     <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip">Business sector<span class="classic">Please enter your business sector </span></a></td>
                        <td>
                          <label class="sector-con"></label>
                            <?php echo $form->dropDownList($model,'co_sector',CHtml::listData(ListingProfession::getAll(),'list_profession_id','list_profession_name'), array('prompt' => 'Please Select','tabindex'=>1,'class'=>'chzn-select')); ?>
                             <?php echo $form->error($model,'co_sector'); ?> 
                                                          
                        </td>
                     </tr> 
                     <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'co_name',array('for'=>'Business_ttip_solution','rel'=>'Business_co_name')); ?><span class="classic">Please enter your business name </span></a></td>
                        <td>
                            <?php echo $form->textField($model,'co_name',array('tabindex'=>2,'class'=>'inputfield')); ?>   
                            <?php echo $form->error($model,'co_name'); ?>                              
                        </td>
                     </tr> 
                     <tr>
                        <td class="mandatory-field"></td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'co_slogon',array('for'=>'Business_ttip_solution','rel'=>'Business_co_slogon')); ?><span class="classic">Please enter your business slogon </span></a></td>
                        <td>
                            <?php echo $form->textField($model,'co_slogon',array('tabindex'=>3,'class'=>'inputfield')); ?>   
                            <?php echo $form->error($model,'co_slogon'); ?>                              
                        </td>
                     </tr>                         
                     <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_name',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_name')); ?><span class="classic">Please enter your first and second name</span></a></td>
                        <td>
                            <?php echo $form->textField($model,'drg_name',array('tabindex'=>4,'class'=>'inputfield')); ?>   
                            <?php echo $form->error($model,'drg_name'); ?>                              
                        </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_surname',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_surname')); ?> <span class="classic">Please enter your last name</span></a></td>
                        <td>
                            <?php echo $form->textField($model,'drg_surname',array('tabindex'=>5,'class'=>'inputfield')); ?>  
                            <?php echo $form->error($model,'drg_surname'); ?>              
                        </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'co_title',array('for'=>'Business_ttip_solution','rel'=>'Business_co_title')); ?><span class="classic">Please enter your title, i.e Sole trader, Owner, Partnership, Director etc. </span></a></td>
                        <td class="">
                         <?php echo $form->textField($model,'co_title',array('tabindex'=>6,'class'=>'inputfield')); ?>  
                         <?php echo $form->error($model,'co_title'); ?>    
                       </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_dob',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_dob')); ?> <span class="classic">You must be over 18 years of age to register</span> </a></td>
                        <td class="" >   
                        <?php
                        $maxYear = date('Y') - 18;
                        $yearRange = "1900:$maxYear";
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'name'=>'Business[drg_dob]',
                            'model'=>$model->drg_dob,
                            'flat'=>false,//remove to hide the datepicker
                            'options'=>array(
                                'dateFormat' => 'd/m/yy',
                                'showAnim'=>'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                                'changeMonth'=>true,
                                'changeYear'=>true,
                                'yearRange'=>$yearRange,
                                'minDate'=>'01/01/1900',
                                'maxDate' => date('t/').'12/'.$maxYear,
                                'defaultDate'=> date('d/m/').$maxYear,

                                'onSelect'=>'js: function(dateText, inst) {bussinesscheckdod()}',
                            ),
                            'htmlOptions'=>array(
                                'placeholder'=>'DD  /  MM  /  YYYY ',
                'tabindex'=>7,
                                'class'=>'inputfield',
                                'readonly'=>'readonly',
                            ),
                        ));
                        ?>   
                        <?php echo $form->error($model,'drg_dob'); ?>               
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_username',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_username')); ?><span class="classic">You may change this if you wish. No special characters, numbers or spaces are allowed. <br>
                          Only text and numbers.</span></a></td>
                        <td >
                        <?php echo $form->textField($model,'drg_username',array('tabindex'=>8,'class'=>'inputfield','onblur'=>'bussinesscheckdod();check_duplicate_username(this.value)','onfocus'=>'bussinesscheckdod();if(this.value=="Username already taken") this.value=""')); ?>
                        <?php echo $form->error($model,'drg_username'); ?>
                        
                        </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_email',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_email')); ?><span class="classic">Please enter your email address.</span></a></td>
                        <td class="">
                            <?php echo $form->textField($model,'drg_email',array('tabindex'=>9,'class'=>'inputfield','onblur'=>'check_duplicate_email(this.value)','onfocus'=>'if(this.value=="Email address already registered") this.value=""')); ?>
                             <?php echo $form->error($model,'drg_email'); ?>
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_pass',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_pass')); ?><span class="classic">Please enter your password</span></a></td>
                        <td >
                        <?php echo $form->passwordField($model,'drg_pass',array('id'=>'Business_drg_pass','class'=>'inputfield pass_icon','tabindex'=>10)); ?>                
                        <input type="button" id="show-password" class="bpasschage" />     
                         <?php echo $form->error($model,'drg_pass'); ?>           
                        </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_addr1',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_addr1')); ?><span class="classic">Please enter your Address</span></a></td>
                        <td class="">
                            <?php echo $form->textField($model,'drg_addr1',array('tabindex'=>11,'class'=>'inputfield')); ?>
                         <?php echo $form->error($model,'drg_addr1'); ?>           
                        </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field"></td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_addr2',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_addr2')); ?><span class="classic">Please enter your Address</span></a></td>
                        <td class="">
                            <?php echo $form->textField($model,'drg_addr2',array('tabindex'=>12, 'class'=>'inputfield')); ?>
                         <?php echo $form->error($model,'drg_addr2'); ?>           
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="mandatory-field"></td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_addr3',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_addr3')); ?><span class="classic">Please enter your Address</span></a></td>
                        <td class="">
                            <?php echo $form->textField($model,'drg_addr3',array('tabindex'=>13, 'class'=>'inputfield')); ?>
                         <?php echo $form->error($model,'drg_addr3'); ?>           
                        </td>
                      </tr>
                      
                       <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_town',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_town')); ?><span class="classic">Please enter your Town</span></a></td>
                        <td class="">
                         <?php echo $form->textField($model,'drg_town',array('tabindex'=>14, 'class'=>'inputfield')); ?>
                         <?php echo $form->error($model,'drg_town'); ?>           
                        </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_county',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_county')); ?><span class="classic">Please enter your county</span></a></td>
                        <td class="">
                         <?php echo $form->textField($model,'drg_county',array('tabindex'=>15, 'class'=>'inputfield')); ?>
                         <?php echo $form->error($model,'drg_county'); ?>           
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_zip',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_zip')); ?><span class="classic">Please enter your zip</span></a></td>
                        <td class="">
                        <?php echo $form->textField($model,'drg_zip',array('tabindex'=>16, 'class'=>'inputfield')); ?>
                         <?php echo $form->error($model,'drg_zip'); ?>           
                        </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_country',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_country')); ?><span class="classic">Please select the country you live in</span></a></td>
                        <td>
                          <label class="business-con"></label>
                            <?php  $data = CHtml::listData(Country::model()->findAll(), 'country_id', 'country');?>
                            <?php echo $form->dropDownList($model,'drg_country',$data, array('prompt' => 'Please Select','tabindex'=>17,'class'=>'chzn-select')); ?>
                              <?php echo $form->error($model,'drg_country'); ?>
                        </td>
                      </tr> 
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_phone',array('for'=>'Business_ttip_solution','rel'=>'Business_drg_phone')); ?><span class="classic">Please enter your telephone no </span></a></td>
                        <td class="">
                         <?php echo $form->textField($model,'drg_phone',array('tabindex'=>18, 'class'=>'inputfield')); ?>  
                         <?php echo $form->error($model,'drg_phone'); ?>    
                       </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field"></td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'co_fax',array('for'=>'Business_ttip_solution','rel'=>'Business_co_fax')); ?><span class="classic">Please enter your fax no </span></a></td>
                        <td class="">
                         <?php echo $form->textField($model,'co_fax',array('tabindex'=>19, 'class'=>'inputfield')); ?>  
                         <?php echo $form->error($model,'co_fax'); ?>    
                       </td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'co_website',array('for'=>'Business_ttip_solution','rel'=>'Business_co_website')); ?><span class="classic">Please enter your website </span></a></td>
                        <td class="">
                         <?php echo $form->textField($model,'co_website',array('tabindex'=>20, 'class'=>'inputfield')); ?>  
                         <?php echo $form->error($model,'co_website'); ?>    
                       </td>
                      </tr> 
                                 
                </table>
                <span class="hdn_msg">Hover over labels to get further information </span></div>
                 
                 <div class="reg-right">
                    <table id="reg-table2"> 
                      <tr>
                            <td> 
                           </td>
                      </tr> 
                      <tr>
                        <td class="Boarder">
                          <span class="com_logo_head">Company Logo</span><br>
                          <div id="preview_logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/avatar.jpg"></div>
                              
                       <?php 
                             echo $form->hiddenField($model,'drg_image');  
                             echo $form->error($model,'drg_image'); 
              ?>
            </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><a href="javaScript:void(0)" onclick="show_picture_form()" title="Upload company logo" class="button black">Upload company logo</a></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><div id="captcha_result" style="display:none; color:#f00"></div></td>
                    </tr>
                      <tr>
                        <td align="center"> 
                          <p style="border:2px solid #f4dfd9; padding:2px; padding-bottom:8px; margin-left:72px; margin-right:72px; width:180px;"> 
                                <img id="siimage" style=" width:130px; height:50px; border:1px solid #ccc; margin-right: 15px" src="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left"/>
                                <object type="application/x-shockwave-flash" data="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.swf?audio_file=<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="23" width="23" >
                                    <param name="movie" value="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.swf?audio_file=<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
                                </object>
                                &nbsp; <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/captcha/images/refresh.png" alt="Reload Image" onclick="this.blur()" align="bottom" border="0" height="23" width="23"/></a><br style="clear:both" />
                                <br />
                                <font style="font-size:7px;">Type the characters you see in the picture below</font><br />
                                <br />
                                <input type="text" id="Business_drg_verifycode" name="Business[drg_verifycode]" class="captcha_fld" size="20" maxlength="10" />
                                <br />
                                <input type="hidden" name="captcha_validation" id="captcha_validation" value="" />
                        </p>
                          <input type="checkbox" name="term_agree" onclick="show_terms()" style="margin-top:4px;" id="term_agree" value="1" tabindex="21"/>
                          I have read and accept the <a href="javascript:void(0)" onclick='show_terms()'>Terms and Conditions.</a><br />
                          <br />
                          <div id="term-error-data" style="display:none; color:#f00"></div></td>
                      </tr>
                      <tr>
                        <td align="center"></td>
                      </tr>               
                    </table>
                    <p style="text-align:center;">
                        <?php echo CHtml::button('button',array('value'=>'Create Account','class'=>'button black' ,'id'=>'register-business','tabindex'=>22)) ?>                                              
                    </p>
                    <p style="text-align:center; margin-top:36px; cursor:pointer;">If you are not a business and wish to upload an idea for a business that you have then
                        <a href="<?php echo Yii::app()->createUrl('/user/register');?>">create a user account here>></a>
                    </p>
                  </div>
              <div class="clear"></div>     
        <?php $this->endWidget(); ?><!-- form -->    
        </div> 
        <div id="cont_back_div" style="height:94%;">
        <div id="inner_cont_div">
          <div class="pop-up" style="margin:22px auto !important">
            <h2 align="center"><?php echo Yii::app()->params['domain']; ?> Terms & Conditions</h2>
            <div class="pop-up-content">
              <div id="pop-up-toc" style="height: 500px;">
                <?php $this->renderPartial('toc'); ?>
              </div>
              <br />
            </div>
          </div>
          <div class="RtnBtn"><a onclick="close_terms()" class="button white smallrounded" href="javascript:void(0);" title="Close" >X</a></div>
        </div>
      </div>

  </div>
  
 <script type="text/javascript">  
 jQuery(document).ready(function(){
    JQ("#show-password").on("click",function(){       
       var showpass =  JQ("#Business_drg_pass").attr("type");       
       if(showpass=='text'){
           JQ('#Business_drg_pass').get(0).type = 'password';
           JQ('#hide-password').attr({id:'show-password'})    
       }else {
            JQ('#Business_drg_pass').get(0).type = 'text';            
            JQ('#show-password').attr({id:'hide-password'});
       }
   });  

   JQ('#Business_drg_username').keyup(function() {
        if (this.value.match(/[^a-z0-9]/g)) {
            this.value = this.value.replace(/[^a-z0-9]/g, '');
        }
    });

   JQ("#Business_co_sector,#Business_drg_country").on('click',function(){
     $(this).closest('td').removeClass('mandatoryerror');
   })
     
   JQ("#Business_drg_country").on("change",function(){
        if(JQ(this).val() !=""){
            JQ(".business-con").html('');
        }else {
            JQ(".business-con").html('Please select your country');
        }
   });
   JQ("#Business_co_sector").on("change",function(){
        if(JQ(this).val() !=""){
            JQ(".sector-con").html('');
        }else {
            JQ(".sector-con").html('Please select your sector');
        }
   });
 })

jQuery('label').on('click',function(){
  var target_element = $(this).attr('rel');
  $('#'+target_element).focus();
});
   
 //$(".chzn-select").chosen();
 function getUploadfilename(result){
     if(result.success){ 
        // jQuery("#preview_logo").html('');
         var img = '<img src="<?php echo Yii::app()->baseUrl.'/upload/logo/'; ?>' + result.filename + '" height="120" />'
         jQuery("#Business_drg_image").val(result.filename);
         jQuery("#preview_logo").html(img);
         jQuery(".photo-upload-box").hide();
    }
  }
 
function show_picture_form(){
    $(".photo-upload-box").show();
}

function close_picture_form(){
    $(".photo-upload-box").hide();
    
window.location.href=window.location.href
}


function check_duplicate_email(eml)
{  
    if(eml !='')
  {
        jQuery.ajax({
            url:'<?php echo Yii::app()->createUrl("/business/register/checkmail");?>',
            type:'POST',
            data:{eml:eml},
            success: function(result)
      {
                var obj = jQuery.parseJSON(result); 
                if(obj.success==false){ 
                    jQuery("#Business_drg_email").val('');
                    jQuery("#Business_drg_email").parent().addClass('mandatoryerror');
                    jQuery("#Business_drg_email").attr('placeholder',obj.message); 
                                        
                }else {
                    jQuery("#Business_drg_email").parent().removeClass('mandatoryerror');
                    jQuery("#Business_drg_email").parent().removeClass('validtext');
                }                 
            }
        });
    }else {
        var atpos=eml.indexOf("@");            
        var dotpos=eml.lastIndexOf("."); 
        if(eml=="" || (atpos < 1 || dotpos<atpos+2 || dotpos+2>=eml.length)){
            JQ("#Business_drg_email").parent().addClass('mandatoryerror');
            JQ("#Business_drg_email").attr('placeholder','Please enter a valid email');
            failedvalidation = true;   
        } 
    }
}
function check_duplicate_username(uname1)
{  
    if(uname1 !='')
  {
        jQuery.ajax({
            url:'<?php echo Yii::app()->createUrl("/business/register/checkuser");?>',
            type:'POST',
            data:{uname:uname1},
            success: function(result)
      {
                var obj = jQuery.parseJSON(result); 
                if(obj.success==false){ 
                    jQuery("#Business_drg_username").val('');
                    jQuery("#Business_drg_username").parent().addClass('mandatoryerror');
                    jQuery("#Business_drg_username").attr('placeholder',obj.message); 
                                        
                }else {
                    jQuery("#Business_drg_username").parent().removeClass('mandatoryerror');
                    jQuery("#Business_drg_username").parent().removeClass('validtext');
                }                 
            }
        });
    } 
}

function userregister(){
   if($("#register-business").trigger("click")){
        jQuery('#business-registerform-form').submit();
        close_email_form();            
   }  
}

function close_email_form()
{
  jQuery(".confirm-email").hide();
}
</script>