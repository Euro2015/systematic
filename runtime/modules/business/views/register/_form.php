<style type="text/css">#ui-datepicker-div {
left:254.703125px!important;
width:17.2em!important;
top:731.703125px!important;
}

",) )); ?> </div> <!-- big_uploader --> </div> <!-- uploader --> </div> </div> </div> <!--- update profile picture pop up----> <!--- Update your company slogon pop up----> <div class="slogan" style="display: none;"> <div class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:-2px;" /> <div class="my-account-popup-box" style="margin-top:-38px !important"> <a title="Close" href="javaScript:void(0)" onclick="close_slogan_form()" class="pu-close">X</a> <br /> <h2 class="Blue">Update your company slogon </h2> <div id="drg_slogan_error" class="error_msg"></div> <table id="update-table" style="width:100%;"> <tr> <td class="darkGrey-text"><input class="inputfield" type="text" name="drg_slogan" id="drg_slogan" style="width: 370px;"/></td> </tr> <tr> <td style="text-align: center;background: none;border: none;"><input id="UpdateSloganBtn" class="button black" name="register" type="button" value="Update" /></td> </tr> </table> </div> </div> </div> <!-- Update your company slogon popup--> <!--- Update Email Id----> <div class="update-email-box"> <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" /> <div class="my-account-popup-box"> <a title="Close" href="javaScript:void(0)" onclick="close_email_form()" class="pu-close">X</a> <h2>Update email address</h2> <div id="email_error" class="error_msg"></div> <form method="post" onsubmit="return email_form_validation()"> <table id="reg-table" style="width:100%;"> <tr> <th colspan="2">&nbsp;</th> <th class="darkGrey-text"><span class="mandatory-field">*</span> All fields are required</th> </tr> <tr> <td class="mandatory-field">*</td> <td>Old email address</td> <td><input class="inputfield" type="text" name="drg_email" id="drf_email" /></td> </tr> <tr> <td class="mandatory-field">*</td> <td>New email address</td> <td><input class="inputfield" id="drf_nemail" name="drg_nemail" type="text" /></td> </tr> <tr> <td class="mandatory-field">*</td> <td>Confirm email</td> <td><input class="inputfield" type="text" name="drg_cemail" id="drf_cemail" /></td> </tr> </table> <br /> <span> <input name="email_edit" value="Update email" type="button" onclick="return email_form_validation()" class="button black" /> </span> </form> </div> </div> </div> <!---Update Password----> <div class="update-password-box"> <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" /> <div class="my-account-popup-box"> <a title="Close" href="javaScript:void(0)" onclick="close_password_form()" class="pu-close">X</a> <h2>Update Password</h2> <div id="password_error" class="error_msg"></div> <form method="post" onsubmit="return password_form_validation()"> <table id="reg-table" style="width:100%;"> <tr class="up-th"> <th>&nbsp;</th> <th><span class="mandatory-field">*</span> All fields are required</th> <th>password is case sensitive</th> </tr> <tr> <td class="mandatory-field">*</td> <td>Old password</td> <td><input class="inputfield" type="password" name="drg_opass" id="drf_opass" /></td> </tr> <tr> <td class="mandatory-field">*</td> <td>New password</td> <td><input class="inputfield" id="drf_npass" name="drg_npass" type="password" /></td> </tr> <tr> <td class="mandatory-field">*</td> <td>Confirm password</td> <td><input class="inputfield" type="password" name="drg_cpass" id="drf_cpass" /></td> </tr> </table> <br /> <span> <input name="password_edit" value="Update password" type="button" onclick="password_form_validation()" class="button black" /> </span> </form> </div> </div> </div> <?php $form = $this->beginWidget('CActiveForm',array( 'id'=>'myaccount-form','enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data','onsubmit'=>'return bussinesscheckdod();'),)); ?> <!-- Update Currency --> <div class="update-currency-box"> <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" /> <div class="my-account-popup-box"> <a title="Close" href="javaScript:void(0)" onclick="close_currency_form()" class="pu-close">X</a> <?php //$currency=$user->getAllCurrency();	?> <h2>Update Your Currency</h2> <div id="currency_error" class="error_msg"></div> <table id="reg-table" style="margin-left: 40px;"> <tr> <td class="mandatory-field">*</td> <td><?php echo $form->labelEx($model,'drg_currency',array('class'=>'field')); ?></td> <td><?php $cur = CHtml::listData(Currency::model()->findAll(),'currency_id','currency_name');?> <?php echo $form->dropDownList($model,'drg_currency',$cur,array('prompt' => 'Please Select','class'=>'chzn-select')); ?></td> </tr> </table> <br /> <span> <input name="email_edit" value="Update Currency" type="button" onclick="return currency_form_validation()" class="button black" /> </span> </div> </div> </div> <span class="darkMauve-text">&nbsp; Profile details</span> <table id="update-table"> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'co_name'); ?></td> <td width="223"><?php echo $form->textField($model,'co_name',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?></td> <?php echo $form->error($model,'co_name'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'co_slogon'); ?></td> <td><?php echo $form->textField($model,'co_slogon',array('size'=>50,'maxlength'=>50,'class'=>'inputfield','readonly'=>true)); ?></td> <td class="edit-link"><a href="javaScript:void(0)" onClick="show_slogan_form()">Edit</a></td> <?php echo $form->error($model,'co_slogon'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'co_sector'); ?></td> <td><?php echo $form->textField($model,'co_sector',array('size'=>50,'maxlength'=>50,'class'=>'inputfield','readonly'=>true)); ?></td> <?php echo $form->error($model,'co_sector'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_name'); ?></td> <td><?php echo $form->textField($model,'drg_name',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?></td> <?php echo $form->error($model,'drg_name'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_surname'); ?></td> <td><?php echo $form->textField($model,'drg_surname',array('size'=>50,'maxlength'=>50)); ?></td> <?php echo $form->error($model,'drg_surname'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_email'); ?></td> <td class="editable"><?php echo $form->textField($model,'drg_email',array('size'=>50,'maxlength'=>50,'readonly'=>'true')); ?></td> <td class="edit-link"><a href="javaScript:void(0)" onClick="show_email_form()">Edit</a></td> <?php echo $form->error($model,'drg_email'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_username'); ?></td> <td><?php echo $model->drg_username; ?></td> <?php echo $form->error($model,'drg_username'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_pass'); ?></td> <td class="editable">****************</td> <td class="edit-link"><a href="javaScript:void(0)" onClick="show_password_form();">Edit</a></td> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_currency'); ?></td> <td class="currency editable"><?php $currency = Currency::model()->findByPk($model->drg_currency); ?> <?php echo $currency->currency_name; ?></td> <td class="edit-link"><a href="javaScript:void(0)" onClick="show_currency_form()">Edit</a></td> <?php echo $form->error($model,'drg_currency'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_gender'); ?></td> <td><?php echo $model->drg_gender ; ?></td> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_dob'); ?></td> <td><?php echo $model->drg_dob; ?></td> <?php echo $form->error($model,'drg_dob'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'co_title'); ?></td> <td><?php echo $model->co_title; ?></td> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_addr1'); ?></td> <td><?php echo $form->textField($model,'drg_addr1',array('size'=>60,'maxlength'=>500)); ?></td> <?php echo $form->error($model,'drg_addr1'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_addr2'); ?></td> <td><?php echo $form->textField($model,'drg_addr2',array('size'=>60,'maxlength'=>500)); ?></td> <?php echo $form->error($model,'drg_addr2'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_addr3'); ?></td> <td><?php echo $form->textField($model,'drg_addr3',array('size'=>60,'maxlength'=>500)); ?></td> <?php echo $form->error($model,'drg_addr3'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_town'); ?></td> <td><?php echo $form->textField($model,'drg_town',array('size'=>60,'maxlength'=>100)); ?></td> <?php echo $form->error($model,'drg_town'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_county'); ?></td> <td><?php echo $model->drg_county;?></td> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_zip'); ?></td> <td><?php echo $form->textField($model,'drg_zip',array('size'=>50,'maxlength'=>50)); ?></td> <?php echo $form->error($model,'drg_zip'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_country'); ?></td> <td><?php $data = CHtml::listData(Country::model()->findAll(),'country_id','country');?> <?php echo $form->dropDownList($model,'drg_country',$data,array('prompt' => 'Please Select')); ?></td> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_phone'); ?></td> <td><?php echo $form->textField($model,'drg_phone',array('size'=>30,'maxlength'=>30)); ?></td> <?php echo $form->error($model,'drg_phone'); ?> </tr> <tr> <td class="darkGrey-text"><?php echo $form->labelEx($model,'co_website'); ?></td> <td><?php echo $form->textField($model,'co_website',array('size'=>30,'maxlength'=>30)); ?></td> <?php echo $form->error($model,'co_website'); ?> </tr> </table> <span class="middle" style="left:92px;"> <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update address details',array('class'=>'button black','id'=>'register-business-update')); ?> </span> </div> <div class="my-account-right" style="width:262px;"> <table id="reg-table2"> <tr> <td class="darkGrey-text"><p style="margin:0 0 0 12px;">Company Logo</p></td> </tr> <tr> <td class="Boarder" id="showImg"><?php if($model->drg_image) {
img:$model->drg_image;
}

else {
img:avatar.jpg;
ajaxtype:POST, url: "<?php echo Yii::app()->createUrl('myaccount/updateslogan/'); ?>", async: false, data: Myaccount_slogan=+drg_slogan, success: function(result) { var obj = jQuery.parseJSON(result);
failedvalidation:true;
}

?> <img src="<?php echo IMG_LOGO_PATH.$img;?>" alt="<?php Yii::app()->params['company_name']; ?>" height="120" /></td> </tr> <tr> <td>&nbsp;</td> </tr> <tr> <td><a href="javaScript:void(0)" title="Change Profile Picture" class="button black" onclick="show_picture_form();">Update Logo</a> <input type="hidden" name="oldimage" id="oldimage" value="<?php echo $model->drg_image; ?>" /></td> </tr> <tr> <td><br /> <div id="terms-conditions" style="width:230px;"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" width="150" style="margin-bottom:-25px;" /> <div> <p> <a href="javascript:void(0);"><b class="in-box Blue">Account overview</b></a><br /> <span class="floatLeft">Member Since :</span> <span class="floatRight"> <?php echo $model->drg_rdate; ?></span> <br /> <span class="floatLeft">Average user rating :</span> <span class="floatRight"> *****</span> <br /> <span class="floatLeft">Sample submissions:</span> <span class="floatRight"> 0</span> <br /> <span class="floatLeft">Sample supplied :</span> <span class="floatRight"> 0</span> <br /> <span class="floatLeft">Banner add submission :</span> <span class="floatRight"> 0</span> <br /> <span class="floatLeft">Banner add click :</span> <span class="floatRight"> 0</span> <br /> </p> </div> </div></td> </tr> </table> </div> <div class="clear"></div> <?php $this->endWidget(); ?> </div></div><script type="text/javascript">$(".chzn-select").chosen();function getUploadfilename(result) {
varimg:'<img src="<?php echo Yii::app()->baseUrl.'/upload/logo/'; ?>' 0 result.filename 0 '" height="120" />' jQuery(#oldimage).val(result.filename);
}

// email form validationsfunction email_form_validation() {
varfailedvalidation:false;
varx:document.getElementById(drf_email).value;
varatpos:x.indexOf(@);
vardotpos:x.lastIndexOf(.);
ifatpos1dotposatpos2dotpos2:x.length)) { $(#drf_email).parent().addClass(mandatoryerror);
failedvalidation:true;
}

if(x !="" && em !="") {
ajaxtype:POST, url: "<?php echo Yii::app()->createUrl('myaccount/changeemail/'); ?>", async: false, data: type=edit_email&drg_email=+x+&drg_nemail=+em, success: function(result) { var obj = jQuery.parseJSON(result);
failedvalidation:false;
}

jQuery("#UpdateSloganBtn").click(function() {
varfailedvalidation:false;
vardrg_slogan:document.getElementById(drg_slogan).value;
ifdrg_slogan:= ) { jQuery(#drg_slogan).parent().addClass(mandatoryerror);
varclosed:generate('error','Please Enter Slogan');
failedvalidation:true;
}

);function currency_form_validation() {
varfailedvalidation:false;
varcurrency_code:document.getElementById(Business_drg_currency).value;
varcurrencyname:$(#Business_drg_currency).find(:selected).text();
ifcurrency_code:= ) { $(#Business_drg_currency).parent().addClass(mandatoryerror);
varclosed:generate('error','Please Select the Currency Code');
failedvalidation:true;
}

$.ajax( {
type:POST, url : "<?php echo yii::app()->createUrl('myaccount/Updatepassword/')?>", async: false, data : type=edit_password&drg_pass=+drf_opass+&drg_npass=+drf_pass, success: function(result) { alert(result);
ifresult:){ var obj = jQuery.parseJSON(result);
failedvalidation:false;
}

// Password Form Validation function password_form_validation() {
varfailedvalidation:false;
vardrf_opass:document.getElementById(drf_opass).value;
ifdrf_opass:= ) { $(#drf_opass).parent().addClass(mandatoryerror);
failedvalidation:true;
}

function bussinesscheckdod() {
varstatus:true;
ajaxasync:false, url:baseUrl+/ajax/checkdob, method: post, data: dob=+$(#Business_drg_dob).val(), success:function(transport) { var get_message = $.parseJSON(transport);
ifget_messagesuccess:=false) { $(#Business_drg_dob).val();
status:false;
}

var y = document.getElementById("drf_nemail").value; var atpos=y.indexOf("@"); var dotpos=y.lastIndexOf("."); if ((atpos < 1 || dotpos<atpos+2 || dotpos+2>=y.length)),var em = document.getElementById("drf_nemail").value;	var cem = document.getElementById("drf_cemail").value; if (em != cem),var drf_pass = document.getElementById("drf_npass").value;	if(drf_pass == ""),var drf_cpass = document.getElementById("drf_cpass").value;	if(drf_cpass != drf_pass) {
failedvalidation:true;
}

@media screen and -webkit-min-device-pixel-ratio0{
#ui-datepicker-div {
left:254.703125px!important;
width:17.2em!important;
top:718.703125px!important;
}
}
