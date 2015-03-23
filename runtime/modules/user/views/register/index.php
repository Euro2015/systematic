<style type="text/css">
#ui-datepicker-div {
    left: 124px !important;
    top: 560px !important;
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
 <?php $this->breadcrumbs = array('register'); ?>

<div class="registration-box"><!-- registration box start-->
    <div class="close_caform"><a class="button white smallrounded" href="/" title="Close" >X</a></div>
    <div id="registration-tabs"> <a href="#taba">Create Account</a>
        <div class="clear"></div>
    </div>
    <!-- onsubmit="return form_validation(document.forms['register_form']);" -->
    <div class="registration-content" style="min-height:337px">
    <div class="reg-left">        
    <!--- Confirm email pop up---->        
        <div class="confirm-email">
          <div class="u-email-box"> 
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:-2px;" />
            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
              <a title="Close" href="javaScript:void(0)" onclick="close_email_form()" class="pu-close">X</a>
              <br />
              <h2 class="Blue">Your Account Activation link will be sent to </h2>
              <p class="orange-color" id="confirm_email_popup"></p>
              <p><em>If this is correct please press continue otherwise press cancel to make any corrections</em></p> 
              <br />                
                <input class="button black CreateAccountBtn" style="margin: auto 48px;" name="canle" type="button" value="Cancel"  onclick="jQuery('.confirm-email').hide('slow');"/>                
                <input id="CreateAccountBtn" onclick="userregister();" style="margin: auto 34px;" class="button green_button CreateAccountBtn" name="register" type="button" value="Continue" /> 
            </div>
          </div>
        </div>
    <!-- end popup-->
        
    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'user-registerform-form',
      'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
      //  'action'=>Yii::app()->createUrl('/front/user/register'),        
    )); ?> 
      <table id="reg-table">           
            <tr>
                <th colspan="2">&nbsp;</th>
                <th class="darkGrey-text"><span class="mandatory-field" >*</span> All fields are required</th>
             </tr> 
             <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip" ><?php echo $form->labelEx($model,'drg_name',array('for'=>'User_ttip_solution','rel'=>'User_drg_name')); ?><span class="classic">Please enter your first and second name</span></a></td>
                <td>
                    <?php echo $form->textField($model,'drg_name',array('tabindex'=>1,'placeholder','class'=>'inputfield','id'=>'User_drg_name')); ?>   
                    <?php echo $form->error($model,'drg_name'); ?>                              
                </td>
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_surname',array('for'=>'User_ttip_solution','rel'=>'User_drg_surname')); ?> <span class="classic">Please enter your last name</span></a></td>
                <td>
                    <?php echo $form->textField($model,'drg_surname',array('tabindex'=>2,'class'=>'inputfield')); ?>  
                    <?php echo $form->error($model,'drg_surname'); ?>              
                </td>
              </tr> 
              <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_dob',array('for'=>'User_ttip_solution','rel'=>'User_drg_dob')); ?> <span class="classic">You must be over 18 years of age to register</span> </a></td>
                <td class="" >                
                <?php
                $maxYear = date('Y') - 18;
                $yearRange = "1900:$maxYear";
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'User[drg_dob]',
                    'model'=>$model->drg_dob,
                    'flat'=>false,//remove to hide the datepicker
                    'options'=>array(
                        'dateFormat' => 'd/m/yy',
                        'showAnim'=>'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'changeMonth'=>true,
                        'changeYear'=>true,
                        'yearRange'=>$yearRange,
                        'minDate'=>'01/01/1900',
                        'maxDate' => date('t/').'12/'.$maxYear,      // minimum date
                        'defaultDate'=> date('d/m/').$maxYear,
                        'onSelect'=>'js: function(dateText, inst) {registercheckdod()}',
                    ),
                    'htmlOptions'=>array(
                        'placeholder'=>'DD  /  MM  /  YYYY ',
                        'tabindex'=>3,
                        'class'=>'inputfield',
                        'readonly'=>'readonly',
                       
                        
                    ),
                ));
                ?>   
                <?php echo $form->error($model,'drg_dob'); ?>               
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_username',array('for'=>'User_ttip_solution','rel'=>'User_drg_username')); ?><span class="classic">You may change this if you wish. No special characters, numbers or spaces are allowed. <br>
                  Only text and numbers.</span></a></td>
                <td >
                <?php echo $form->textField($model,'drg_username',array('tabindex'=>4,'class'=>'inputfield','onblur'=>'check_duplicate_username(this.value)','onfocus'=>'if(this.value=="Username already taken") this.value=""')); ?>
                <?php echo $form->error($model,'drg_username'); ?>
                
                </td>
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_email',array('for'=>'User_ttip_solution','rel'=>'User_drg_email')); ?><span class="classic">Please enter your email address.</span></a></td>
                <td class="">
                    <?php echo $form->textField($model,'drg_email',array('tabindex'=>5,'class'=>'inputfield','onblur'=>'check_duplicate_email(this.value)','onfocus'=>'if(this.value=="Email address already registered") this.value=""')); ?>
                     <?php echo $form->error($model,'drg_email'); ?>
                </td>
              </tr>
              
              <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_pass',array('for'=>'User_ttip_solution','rel'=>'drf_pass')); ?><span class="classic">Please enter your password</span></a></td>
                <td >
                <?php echo $form->passwordField($model,'drg_pass',array('id'=>'drf_pass','class'=>'inputfield pass_icon','tabindex'=>6)); ?>                
                <input type="button" id="show-password" class="passchage" />     
                 <?php echo $form->error($model,'drg_pass'); ?>           
                </td>
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_gender',array('for'=>'User_ttip_solution','rel'=>'User_drg_gender')); ?><span class="classic">Please select your gender</span></a></td>
                <td class="">
                <label class="gendermsg"></label>
                <?php echo $form->dropDownList($model,'drg_gender', array('Male'=>"Male",'Female'=>"Female"), array('prompt' => 'Select','tabindex'=>7,'class'=>'chzn-select')); ?>
                <?php echo $form->error($model,'drg_gender'); ?>  
                </td>  
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'co_title',array('for'=>'User_ttip_solution','rel'=>'User_co_title')); ?><span class="classic">Please select your title from the dropdown list</span></a></td>
                <td class="">
                 <label class="companymsg"></label>
                <?php  $data = CHtml::listData(Profession::model()->findAll(), 'drg_profession', 'drg_profession');?>
                 <?php echo $form->dropDownList($model,'co_title',$data, array('prompt' => 'Select','tabindex'=>8,'class'=>'chzn-select')); ?>
                 <?php echo $form->error($model,'co_title'); ?>
               </td>
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td class="darkGrey-text"><a href="#;" style="background:none;" class="tooltip"><?php echo $form->labelEx($model,'drg_country',array('for'=>'User_ttip_solution','rel'=>'User_drg_country')); ?><span class="classic">Please select the country you live in</span></a></td>
                <td>
                <label class="countrymsg"></label>
                    <?php  $data = CHtml::listData(Country::model()->findAll(), 'country_id', 'country');?>
                    <?php echo $form->dropDownList($model,'drg_country',$data, array('prompt' => 'Please Select','tabindex'=>9,'class'=>'chzn-select')); ?>
                      <?php echo $form->error($model,'drg_country'); ?>
                </td>
              </tr>              
        </table>
        <span class="hdn_msg">Hover over labels to get further information </span> 
        </div>
         <div class="reg-right">
            <table id="reg-table2"> 
                <tr>
                    <td> <div id="captcha_result" style="display:none; color:#f00"></div>
                        
                   </td>
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
                    <input type="text" id="User_drg_verifycode" name="User[drg_verifycode]" class="captcha_fld" size="20" maxlength="10" />
                    <br />
                    <input type="hidden" name="captcha_validation" id="captcha_validation" value="" />
                 </p>
                  <input type="checkbox" name="term_agree" onclick="show_terms()" style="margin-top:4px;" id="term_agree" value="1" tabindex="11" />
                  I have read and accept the <a href="javascript:void(0)" onclick='show_terms()'>Terms and Conditions.</a><br />
                  <br />
                  <div id="term-error-data" style="display:none; color:#f00"></div>
                  </td>
              </tr>
              <tr>
                <td align="center"></td>
              </tr>               
            </table>
            <p style="text-align:center;">
                <?php echo CHtml::button('button',array('value'=>'Create Account','class'=>'button black' ,'id'=>'register-user','tabindex'=>12)) ?>
                <?php //echo CHtml::submitButton('button',array('value'=>'Create Account','class'=>'button black')); ?>
                <!--<input type="button" class="button black" value="Create Account" onclick="return form_validation();"/>-->
            </p>
            <p style="text-align:center; margin-top:36px; cursor:pointer;">If you are a business and wish to offer your services to our members then
                <a href="<?php echo Yii::app()->createUrl('/business/register');?>">create a business services account here>></a>
            </p>
          </div>
          <div class="clear"></div>     
    <?php $this->endWidget(); ?><!-- form -->    
</div>
    <div id="cont_back_div">
        <div id="inner_cont_div">
          <div class="pop-up" style="margin:22px auto !important">
            <h2 align="center"><?php echo Yii::app()->params['domain']; ?> Terms & Conditions</h2>
            <div class="pop-up-content">
              <div id="pop-up-toc">
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
jQuery("#User_co_title").on("change",function(){
        if(jQuery(this).val() !=""){
            jQuery(".companymsg").html('');
        }else {
            jQuery(".companymsg").html('Please select your title');
        }
   });

jQuery('label').on('click',function(){
  var target_element = $(this).attr('rel');
  $('#'+target_element).focus();
});

JQ('#User_drg_username').keyup(function() {
     if (this.value.match(/[^a-z0-9]/g)) {
         this.value = this.value.replace(/[^a-z0-9]/g, '');
     }
 });

JQ("#User_drg_country").on("change",function(){
        if(JQ(this).val() !=""){
            JQ(".countrymsg").html('');
        }else {
            JQ(".countrymsg").html('Please select your country');
        }
   });
JQ("#User_drg_gender").on("change",function(){
        if(JQ(this).val() !=""){
            JQ(".gendermsg").html('');
        }else {
            JQ(".gendermsg").html('Please select your gender');
        }
   });
JQ("#User_drg_gender,#User_drg_country,#User_co_title").on('click',function(){
  $(this).closest('td').removeClass('mandatoryerror');
})
   
//$(".chzn-select").chosen();
function check_duplicate_email(eml){  
    if(eml !='')
  {
        jQuery.ajax({
            url:'<?php echo Yii::app()->createUrl("/user/register/checkmail");?>',
            type:'POST',
            data:{eml:eml},
            success: function(result)
      {
                var obj = jQuery.parseJSON(result); 
                if(obj.success==false){ 
                    jQuery("#User_drg_email").val('');
                    jQuery("#User_drg_email").parent().addClass('mandatoryerror');
                    jQuery("#User_drg_email").attr('placeholder',obj.message); 
                                        
                }else {
                    jQuery("#drf_email").parent().removeClass('mandatoryerror');
                    jQuery("#drf_email").parent().removeClass('validtext');
                }                 
            }
        });
    }else {
        var atpos=eml.indexOf("@");            
        var dotpos=eml.lastIndexOf("."); 
        if(eml=="" || (atpos < 1 || dotpos<atpos+2 || dotpos+2>=eml.length)){
            JQ("#User_drg_email").parent().addClass('mandatoryerror');
            JQ("#User_drg_email").attr('placeholder','Please enter a valid email');
            failedvalidation = true;   
        } 
    }
}
function check_duplicate_username(uname1)
{  
    if(uname1 !='')
  {
        jQuery.ajax({
            url:'<?php echo Yii::app()->createUrl("/user/register/checkuser");?>',
            type:'POST',
            data:{uname:uname1},
            success: function(result)
      {
                var obj = jQuery.parseJSON(result); 
                if(obj.success==false){ 
                    jQuery("#User_drg_username").val('');
                    jQuery("#User_drg_username").parent().addClass('mandatoryerror');
                    jQuery("#User_drg_username").attr('placeholder',obj.message); 
                                        
                }else {
                    jQuery("#User_drg_username").parent().removeClass('mandatoryerror');
                    jQuery("#User_drg_username").parent().removeClass('validtext');
                }                 
            }
        });
    } 
}

function userregister(){
   if($("#register-business").trigger("click")){
        jQuery('#user-registerform-form').submit();
        close_email_form();            
   }  
}

function close_email_form()
{
  jQuery(".confirm-email").hide();
}
</script>