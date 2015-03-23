<?php $this->breadcrumbs = array('Update Password'); ?>
    <div class="registration-box"><!-- registration box start-->
      <div class="close_caform"><a class="button white smallrounded" href="<?php echo $this->createUrl('/');?>" title="Close" >X</a></div>
      <div id="registration-tabs"> <a href="javascript:void(0);">Update Password</a>
        <div class="clear"></div>
      </div>
     <!-- onsubmit="return form_validation(document.forms['register_form']);" 
     
      -->
      <div class="registration-content">
        
       	 

  <div class="u-email-box"> <img src="<?php echo $this->createUrl('/themes/business/images/robot/Robot-pointing-down.png');?>" />
    <div class="my-account-popup-box" style="margin-top:-40px;"> 
        <!-- <a title="Close" href="javaScript:void(0)" onclick="close_password_form()" class="pu-close">X</a> -->
      <br />
        <h2>Update Password</h2>
        <?php $form=$this->beginWidget('CActiveForm', array(
          //'id'=>'user-registerform-form',
          'enableAjaxValidation'=>false,
            'htmlOptions'=>array('onsubmit'=>'return password_form_validation();'),
        )); ?> 
        <table id="reg-table">
          <?php if($paserror_msg){echo "<tr><th class='error_msg' colspan='3'>$paserror_msg</th></tr>";}?>
          <tr class="up-th">
            <th>&nbsp;</th>
            <th><span class="mandatory-field">*</span> All fields are required</th>
            <th>password is case sensitive</th>
          </tr>
          <tr>
            <td class="mandatory-field">*</td>
            <td>New password</td>
            <td><input class="inputfield" type="password" name="drg_npass" id="drf_npass" /></td>
          </tr>
          <tr>
            <td class="mandatory-field">*</td>
            <td>Confirm password</td>
            <td><input class="inputfield" type="password" name="drg_cpass" id="drf_cpass" /></td>
          </tr>
        </table>
        <span class="middle">
        <input name="drg_uid" value="<?php echo $_GET['user_id']; ?>" type="hidden" />
        <input name="drg_id" value="<?php echo $_GET['id']; ?>" type="hidden" />
        <input name="password_edit" value="Update password" type="submit" class="button black"  />
        </span>
      <?php $this->endWidget(); ?><!-- form -->    
    </div>
  </div>      
      </div>
      <div class="clear"></div>
    </div>

<script type="text/javascript">
function password_form_validation() 
{ 
 var failedvalidation = false;

	var drf_pass = document.getElementById("drf_npass").value;
    if(drf_pass == "")
    {                
       $("#drf_npass").parent().addClass('mandatoryerror');
	   $("#drf_npass").attr('placeholder','Enter Your Password'); 
        failedvalidation = true;            
    } 

	var drf_cpass = document.getElementById("drf_cpass").value;
    if(drf_cpass != drf_pass)
    {       
		$("#drf_cpass").val('');         
       $("#drf_cpass").parent().addClass('mandatoryerror');
	   $("#drf_cpass").attr('placeholder','Confirm Password Does not match'); 
        failedvalidation = true;            
    } 

    if (failedvalidation) 
	{
        return false;
    }
	return true;
}
</script>