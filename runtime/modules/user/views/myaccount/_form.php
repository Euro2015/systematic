<div class="clear"></div>
<div class="registration-box"> 
 
<div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
    <div class="clear"></div>
</div>
<div class="registration-content" style="min-height: 720px;"> 
        <div class="my-account-links">
          <?php 
          $this->renderPartial("//layouts/my-account-links");
 	      $myAccount = new Myaccount();
          ?>
        </div>
         <div class="my-account-left">
         <!--- update profile picture pop up---->
        <div class="photo-upload-box" style="height:692px;">
            <img class="side-robot-upload" style="margin-left:-70px;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
          <div class="my-account-popup-box" id="upload-frame" style="margin-left: 124px;"> <a class="pu-close" onclick="hide_picture_form();" href="javaScript:void(0)" title="Close">X</a>
            <h2>Upload your profile picture</h2>
            Click <b>Upload Picture...</b> to choose an image from your computer<br />
            Select an image that is 120px by 120px for best fit <br />
            Your image will be automatically uploaded.<br />
            <br />
             <div id="wrap">    
                    <div id="uploader">
                        <div id="big_uploader" style="position: relative;">
                        <div id="notice"><img src="<?php  echo Yii::app()->theme->baseUrl;?>/images/ajax-loader.gif" /></div>
                        <br />
                		<i>Upload image maximum of 100KB.</i>
                        <br /><br />
                        <div id="div_upload_big" class="listing_logo">	                          
                            <?php  
                             /* if($model->drg_image){
                                  $img = $model->drg_image;            
                                  ?>
                                  <img src="<?php echo Myaccount::getAvatar($img);?>" alt="<?php echo $model->drg_name.' '.$model->drg_surname; ?>" height="120" /> 

                              <?php }else {
                                                  $img = 'avatar.jpg';

                              ?>
                              <img src="<?php echo $this->createUrl('/upload/logo/'.$img);?>" alt="Profile picture" height="120" /> 

                              <?php }*/
                              ?>
                		</div>
                		<div id="div_upload_big_new"></div>
                      
                        Browse for a picture on your computer
                        <br /><br />
                        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                    'id'=>'uploadFile',
                                    'config'=>array(
                                           'action'=>Yii::app()->createUrl('/user/myaccount/uploadprofileimage'),
                                           'allowedExtensions'=>array("jpg",'png','gif'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                           'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                           'minSizeLimit'=>10,// minimum file size in bytes  
                                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('.qq-upload-list').empty(); $('#notice').hide();getUploadfilename(responseJSON);}",   
                                           'onSubmit'=>"js:function(file, extension){ $('#notice').show();}",                                               
                                    )
                            )); 
                        ?>
                    	</div><!-- big_uploader --> 
                           
                    </div><!-- uploader --> 
                </div>            
          </div>
        </div>
       <!--- update profile picture pop up---->
         
        <!--- Update Email Id---->
        <div class="update-email-box update_height">
              <div id="terms-conditions" class="u-email-box" style="margin-left: 42px;"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
                <div class="my-account-popup-box"> 
                	<a title="Close" href="javaScript:void(0)" onclick="close_email_form()" class="pu-close">X</a>
                  <h2>Update email address</h2>
                  <div id="email_error" class="error_msg"></div>
                  <form method="post" onsubmit="return email_form_validation()">
                    <table id="reg-table" style="width: 100%;">
                      <tr>
                        <th colspan="2">&nbsp;</th>
                        <th class="darkGrey-text"><span class="mandatory-field">*</span> All fields are required</th>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td style="width: 112px;">Old email address</td>
                        <td><input class="inputfield" type="text" name="drg_email" id="drf_email" onblur="check_old_email(this.value);"  /></td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td>New email address</td>
                        <td><input class="inputfield" id="drf_nemail" name="drg_nemail" type="text" onblur="validateEmail('drf_nemail');" /></td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td>Confirm email</td>
                        <td><input class="inputfield" type="text" name="drg_cemail" id="drf_cemail" onblur="validateEmail('drf_cemail');" /></td>
                      </tr>
                    </table>
                      <br />
                    <span class="middle">
                    <input name="email_edit" value="Update email" type="button" onclick="return email_form_validation()" class="button black"  />
                    </span>
                  </form>
                </div>
              </div>
            </div>
        <!---Update Password---->
        <div class="update-password-box update_height">
        <div id="terms-conditions" class="u-email-box" style="margin-left: 42px;"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
        <div class="my-account-popup-box"> <a title="Close" href="javaScript:void(0)" onclick="close_password_form()" class="pu-close">X</a>
          <h2>Update Password</h2>
          <div id="password_error" class="error_msg"></div>
          <form method="post" onsubmit="return password_form_validation()">
            <table id="reg-table" style="width: 100%;">
              <tr class="up-th">
                <th>&nbsp;</th>
                <th><span class="mandatory-field">*</span> All fields are required</th>
                <th>password is case sensitive</th>
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td>Old password</td>
                <td><input class="inputfield" type="password" name="drg_opass" id="drf_opass" /></td>
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td>New password</td>
                <td><input class="inputfield" id="drf_npass" name="drg_npass" type="password"  /></td>
              </tr>
              <tr>
                <td class="mandatory-field">*</td>
                <td>Confirm password</td>
                <td><input class="inputfield" type="password" name="drg_cpass" id="drf_cpass" /></td>
              </tr>
            </table>
            <br />
            <span class="middle">
            <input name="password_edit" value="Update password" type="button" onclick="password_form_validation()" class="button black"  />
            </span>
          </form>
        </div>
        </div>
        </div>

        <div class="pmsg"></div>

            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'myaccount-form',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array('enctype'=>'multipart/form-data','onsubmit'=>'return useraccountcheckdod();'),
            )); 
        
        $user_id = yii::app()->user->getId();
        $usesr_url = Yii::app()->createUrl('/user/myaccount/update&id=').$user_id; 
        ?>
   
        <div class="update-currency-box update_height">
              <div id="terms-conditions" class="u-email-box" style="margin-left: 42px;"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
                <div class="my-account-popup-box"> 
                	<a title="Close" href="javaScript:void(0)" onclick="close_currency_form()" class="pu-close">X</a>
                    <?php //$currency=$user->getAllCurrency();	?>            
                  <h2>Update Your Currency</h2>
                  <div id="currency_error" class="error_msg"></div>
                   
                    <table id="reg-table" style="width: 330px; margin-left: 52px;">
                      
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td><?php echo $form->labelEx($model,'drg_currency', array('class'=>'field')); ?></td>
                        <td>
                        	<?php $cur = CHtml::listData(Currency::model()->findAll(),'currency_id', 'currency_name');?>
                             <?php echo $form->dropDownList($model,'drg_currency',$cur, array('prompt' => 'Please Select')); ?>
                        </td>
                      </tr>
                     </table>
                  <br />
                    <span class="middle"> 
                    <input name="email_edit" value="Update Currency" type="button" onclick="return currency_form_validation()" class="button black"  />
                    </span> 
                </div>
              </div>
            </div>

            <div class="pmsg"></div>
        
        	<?php /*?><div class="row">
        		<?php echo $form->labelEx($model,'drg_uid'); ?>
        		<?php echo $form->textField($model,'drg_uid',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error($model,'drg_uid'); ?>
        	</div><?php */?>
            <span class="darkMauve-text">&nbsp; Profile details</span>
        <table id="update-table">
        	<tr>
            	<td class="darkGrey-text" style="width: 80px;"><?php echo $form->labelEx($model,'drg_name'); ?></td>
                <td width="238"><?php echo $form->textField($model,'drg_name',array('size'=>50,'maxlength'=>50,'disabled'=>true)); ?></td>
                <?php echo $form->error($model,'drg_name'); ?>
            </tr>
        	
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_surname'); ?></td>
        		<td><?php echo $form->textField($model,'drg_surname',array('size'=>50,'maxlength'=>50,'disabled'=>true)); ?></td>
        		<?php echo $form->error($model,'drg_surname'); ?>
        	</tr>
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_email'); ?></td>
        		<td class="editable"><?php echo $form->textField($model,'drg_email',array('size'=>50,'maxlength'=>50,'disabled'=>true)); ?></td>
                <td class="edit-link"><a href="javaScript:void(0)" onClick="show_email_form()">Edit</a></td>
        		<?php echo $form->error($model,'drg_email'); ?>
        	</tr>
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_username'); ?></td>
        		<td><?php echo $form->textField($model,'drg_username',array('disabled'=>true)); ?></td>
        		<?php echo $form->error($model,'drg_username'); ?>
        	</tr>
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_pass'); ?></td>
        		<td class="editable">****************</td>
                <td class="edit-link"><a href="javaScript:void(0)" onClick="show_password_form();">Edit</a></td>
        		<?php echo $form->error($model,'drg_pass'); ?>
        	</tr>
            
            <tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_currency'); ?></td>         
                <td class="currency editable"> 
                    <?php $currency =  Currency::model()->findByPk($model->drg_currency); ?>
                    <?php 
                     echo $currency->currency_name;
                    ?>
                </td>
        		
                <td class="edit-link"><a href="javaScript:void(0)" onClick="show_currency_form()">Edit</a></td>
        		<?php echo $form->error($model,'drg_currency'); ?>
        	</tr>
            
             <tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_gender'); ?></td>
        		<td>
                <?php echo $form->textField($model,'drg_gender',array('disabled'=>true)); ?>
                <?php //echo $form->dropDownList($model,'drg_gender', array('Male'=>"Male",'Female'=>"Female"), array('prompt' => 'Select','class'=>'chzn-select','options' => array($model->drg_gender =>array('selected'=>true)))); ?>
              </td>
        		<?php //echo $form->error($model,'drg_gender'); 
                
                ?>
        	</tr>
            
            <tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_dob'); ?></td>
        		<td><?php  echo $form->textField($model,'drg_dob',array('size'=>50,'maxlength'=>50,'disabled' =>'disabled','value'=>$model->drg_dob ? date('d/m/Y',strtotime($model->drg_dob)):'') ); ?>
                 <?php //echo $model->drg_dob;
                       /* $maxYear = date('Y') - 18;
                        $yearRange = "1900:$maxYear";
                         $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'name'=>'Myaccount[drg_dob]',
                            'model'=>$model->drg_dob,
                            'flat'=>false,//remove to hide the datepicker
                            'value'=>date('d/m/Y',strtotime($model->drg_dob)),
                            'options'=>array(
                                'dateFormat' => 'd/m/yy',
                                'showAnim'=>'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                                'changeMonth'=>true,
                                'changeYear'=>true,
                                'yearRange'=>$yearRange,
                                'minDate'=>'01/01/1900',
                                'maxDate' => date('t/').'12/'.$maxYear,
                                //'defaultDate'=> date('d/m/').$maxYear,
                                'onSelect'=>'js: function(dateText, inst) {myaccountdod()}',  
                            ),
                            'htmlOptions'=>array(
                                'placeholder'=>'DD  /  MM  /  YYYY ',
                                'tabindex'=>8, 
                                'disabled'=>'disabled',  
                            ),
                        )); 
                        */
                        
                  ?>   
                
                </td>
        		<?php echo $form->error($model,'drg_dob'); ?>
        	</tr>            
            <tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'co_title'); ?></td>
        		<td>        
                   <?php echo $form->textField($model,'co_title',array('disabled'=>true)); ?>
                </td>        		 
        	</tr>
        </table>
        <br/>
        <span class="darkMauve-text tooltip">&nbsp; Contact / Delivery address </span>  
        <a href="#;" style="background:none;" class="tooltip"> <b> ? </b><span class="classic">Please ensure that your details are correct.
                Any winnings, prizes, samples etc will only be 
                sent to the address given here.</span>
        </a>
         
        <table id="reg-table" style="width: 350px;">
        	<?php /*?><div class="row">
        		<?php echo $form->labelEx($model,'drg_image'); ?>
        		<?php echo $form->textField($model,'drg_image',array('size'=>60,'maxlength'=>500)); ?>
        		<?php echo $form->error($model,'drg_image'); ?>
        	</div><?php */?>
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_addr1'); ?></td>
        		<td><?php echo $form->textField($model,'drg_addr1',array('size'=>60,'maxlength'=>500,'class'=>'inputfield')); ?></td>
        		<?php echo $form->error($model,'drg_addr1'); ?>
        	</tr>
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_addr2'); ?></td>
        		<td><?php echo $form->textField($model,'drg_addr2',array('size'=>60,'maxlength'=>500,'class'=>'inputfield')); ?></td>
        		<?php echo $form->error($model,'drg_addr2'); ?>
        	</tr>
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_addr3'); ?></td>
        		<td><?php echo $form->textField($model,'drg_addr3',array('size'=>60,'maxlength'=>500,'class'=>'inputfield')); ?></td>
        		<?php echo $form->error($model,'drg_addr3'); ?>
        	</tr>
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_town'); ?></td>
        		<td><?php echo $form->textField($model,'drg_town',array('size'=>60,'maxlength'=>100,'class'=>'inputfield')); ?></td>
        		<?php echo $form->error($model,'drg_town'); ?>
        	</tr>
            
            <tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_county'); ?></td>
        		<td>  
                    <?php echo $form->textField($model,'drg_county',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?>
                     <input type="hidden" id="Myaccount_drg_county_old" name="Myaccount[drg_county_old]" value="<?php echo $model->drg_county ?>" maxlength="30" size="30">
                </td>
        	</tr>
        
            
            <tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_zip'); ?></td>
        		<td><?php echo $form->textField($model,'drg_zip',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?></td>
        		<?php echo $form->error($model,'drg_zip'); ?>
        	</tr>
            
          
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_country'); ?></td>
        		<td>                   
                    <?php $countrylist =  Country::model()->find("country_id = ".$model->drg_country); ?>
                     <?php echo $countrylist->country;?>
                     <input type="hidden" id="Myaccount_drg_country_old" name="Myaccount[drg_country_old]" value="<?php echo $countrylist->country ?>" maxlength="30" size="30">
                </td> 
        	</tr>
        
        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'drg_phone'); ?></td>
        		<td><?php echo $form->textField($model,'drg_phone',array('size'=>30,'maxlength'=>30,'class'=>'inputfield')); ?></td>
        		<?php echo $form->error($model,'drg_phone'); ?>
        	</tr>
        
        </table>	
        
        	
        <br />
        	 <span style="margin-left: 138px;">
        	<!--<div class="row buttons">-->
        		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class'=>'button black')); ?>
        	<!--</div>-->
        </span>
        </div>
        <div class="my-account-right" style="width: 262px;">
          <table id="reg-table2">
            <tr>
              <td class="darkGrey-text"><span>Profile picture</span></td>
            </tr>
            <tr>
              <td class="Boarder" id="showImg">
              <?php  
                if($model->drg_image){
                    $img = $model->drg_image;
                     
                    ?>
                    <img src="<?php echo $myAccount->getAvatar($img);?>" alt="<?php echo $model->drg_name.' '.$model->drg_surname; ?>" height="99" />

                <?php }else {
                                    $img = 'avatar.jpg';

                ?>
                <img src="<?php echo Yii::app()->createUrl('/upload/logo/'.$img);?>" alt="Profile picture" height="99" />

                <?php }
                ?>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
                <a href="javaScript:void(0)" onclick="show_picture_form()" title="Change Profile Picture" class="button black">Update picture</a>  
                <?php   
                
                    //echo $form->fileField($model,'drg_image',array('id'=>'drg_image','style'=>'display:none !important'));  
                    //echo $form->error($model,'drg_image'); 
                ?>
                <input type="hidden" name="oldimage" id="oldimage" value="<?php echo $model->drg_image; ?>" />                
                </td>
            </tr>
            <tr>
              <td>
                <br />
                <div id="terms-conditions" style="width:230px;"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" width="150"  style="margin-bottom:-25px;" />
                   <div>
                     <?php 
                        // Account overview
                        $accountReputation = isset($accountStats[0]['user_reputation']) ? $accountStats[0]['user_reputation'] : 0;
                        $accountCountBanner = isset($accountStats[0]['count_banner']) ? $accountStats[0]['count_banner'] : 0;
                        $accountCountActiveListing = isset($accountStats[0]['count_active_listing']) ? $accountStats[0]['count_active_listing'] : 0;                   
                     ?> 
                       
                    <p> <a href="javascript:void(0);"><b class="in-box Blue">Account overview</b></a><br />
                        
                        <span class="floatLeft">Member Since:</span>
                        <span class="floatRight"> <?php echo $model->drg_rdate; ?></span>
                        <br />
						<span class="floatLeft">Reputation:</span>
                        <span class="floatRight"><?=$accountReputation;?></span>
						<br />
                        <span class="floatLeft">Points acquired this month:</span>
                        <span class="floatRight"> 0</span>
                        <br />
						<span class="floatLeft">Active listings:</span>
                        <span class="floatRight"><?=$accountCountActiveListing;?></span>
						<br />
                        <span class="floatLeft">Sample submissions:</span>
                        <span class="floatRight"> 0</span>
                        <br />
                        <span class="floatLeft">Banner add submissions:</span>
                        <span class="floatRight"><?=$accountCountBanner;?></span>                          
                        <br /> 
                    </p>
                    </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
 <?php $this->endWidget(); ?>
</div> 
</div>
<script type="text/javascript">
$(".chzn-select").chosen(); 

function useraccountcheckdod(){
    var status1 = true;
    $.ajax({
		async: false,
		url:baseUrl+'/ajax/checkdob',
		method: 'post',
		data: "dob="+$("#Myaccount_drg_dob").val(),
		success:function(transport) {
		    var get_message = $.parseJSON(transport);
			if(get_message.success=="false")
			{
			    $("#Myaccount_drg_dob").val('') ;
				$("#Myaccount_drg_dob").parent().addClass('mandatoryerror'); 
                $("#Myaccount_drg_dob").attr('placeholder','You must be over 18yrs to register'); 
                status1 = false;
			} 
		}
	}); 
    return status1;
} 
function getUploadfilename(result){
    if(result.success){ 
        jQuery("#showImg").html('');
        var img = '<img src="<?php echo $myAccount->getAvatarUrl(); ?>/' + result.filename + '" height="120" />'
        jQuery("#oldimage").val(result.filename);
        jQuery("#showImg").html(img);
        jQuery(".my-account-links,#update-table,.fBtn").css({
          'opacity': 1,
          '-ms-filter':"",
          'filter': ''
        });
        jQuery(".photo-upload-box").hide();
   }
 }
function show_currency_form(){
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 0,
      '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
      'filter': 'alpha(opacity=0)'
    });
    $(".update-currency-box").show();
}

function close_currency_form(){
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 1,
      '-ms-filter':"",
      'filter': ''
    });
    $(".update-currency-box").hide();
}
	// show email form
function show_email_form()
{
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 0,
      '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
      'filter': 'alpha(opacity=0)'
    });
    $(".update-email-box").fadeIn();
}
function close_email_form(){
  $(".my-account-links,#update-table,.fBtn").css({
    'opacity': 1,
    '-ms-filter':"",
    'filter': ''
  });
  $(".update-email-box").fadeOut();
	$("#email_error").html('');
	$("#drf_email,#drf_nemail,#drf_cemail").val('');
}
function show_password_form()
{
	$(".my-account-links,#update-table,.fBtn").css({
    'opacity': 0,
    '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
    'filter': 'alpha(opacity=0)'
  });
  $(".update-password-box").fadeIn();	
}
function close_password_form(){
  $(".my-account-links,#update-table,.fBtn").css({
    'opacity': 1,
    '-ms-filter':"",
    'filter': ''
  });
  $(".update-password-box").fadeOut();
	$("#password_error").html('');
	$("#drf_opass,#drf_npass,#drf_cpass").val('');
}

function currency_form_validation() 
{ 
 var failedvalidation = false;
 var currency_code = document.getElementById("Myaccount_drg_currency").value;
 
 var currencyName = $('#Myaccount_drg_currency').find(":selected").text();

 //alert(conceptName);
    if(currency_code == "")
    {                
       $("#Myaccount_drg_currency").parent().addClass('mandatoryerror');
	   var closed= generate('error','Please Select the Currency Code');
		
	  close_all_notice(closed);
        failedvalidation = true;            
    } 
    if (failedvalidation) 
    {
        return false;
    }
   
    //loader();
	$.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/user/myaccount/updatecurrency/'); ?>",
			 async: false,
             data: 'type=edit_currency&Myaccount_drg_currency='+currency_code,
             beforeSend:function(){
                $("#loading-div").hide();
             },			 
             success: function(result)
			 {  
			    //loader(); 
          $("#loading-div").hide();
          console.log(result);
				var obj = jQuery.parseJSON(result); 
                if(obj.success){
                  $(".currency").html(currencyName);
                    close_currency_form();
                    show_msg(obj.message);
                }else {
                     $('#currency_code').parent().addClass('mandatoryerror');
                     $('#currency_code').attr('placeholder',obj.message).val(''); 
                     failedvalidation = true;
                }
        	},
			error: function(a)
			 {
				 alert(a);
			 }
  		});
}
// Password Form Validation

function password_form_validation()
	{
			var failedvalidation = false;
			var drf_opass = document.getElementById("drf_opass").value; 
			if(drf_opass == "")
    		{                
       			$("#drf_opass").parent().addClass('mandatoryerror');
	  			$("#drf_opass").attr('placeholder','Enter Your Password'); 
        		failedvalidation = true;            
    		} 
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
			   $("#drf_cpass").parent().addClass('mandatoryerror');
			   $("#drf_cpass").attr('placeholder','Confirm Password Does not match').val(''); 
				failedvalidation = true;            
			} 
             if (failedvalidation) 
            {
                 return false;
            }         
    			//loader();
    			$.ajax({
    					
    					type :"POST",	
    					url : "<?php echo yii::app()->createUrl('/user/myaccount/Updatepassword/')?>",
    					async: false,
    					data : 'type=edit_password&drg_opass='+drf_opass+'&drg_npass='+drf_pass+'&drg_cpass='+drf_cpass,
              beforeSend:function(){
                 $("#loading-div").hide();
              },  
    					 success: function(result)
    			 {  
    				 //loader();  
             $("#loading-div").hide();                   
                     var obj = jQuery.parseJSON(result); 
                     if(obj.success)
                     {
                        $(".psmg").html('<p>'+obj.message+'<p>').show();
                        close_password_form(); 
                        // close_all_notice(closed);
                        show_msg(obj.message);
                        failedvalidation = false;
                        //window.location.reload();
                     }else
                     {
                        $('#drf_'+obj.referto+'pass').parent().addClass('mandatoryerror');
                        $('#drf_'+obj.referto+'pass').attr('placeholder',obj.message).val(''); 
                       // $('#password_error').html(result.message);
                        failedvalidation = true;
                        //$("#drf_opass,#drf_npass,#drf_cpass").val('');
                     }
            	},
    			error: function(a)
    			 {
    				alert(a);
    			 }		
    				
    		});
	}

// email form validations
function email_form_validation() { 
    
    var failedvalidation = false;
 	var x = document.getElementById("drf_email").value;           
    var atpos=x.indexOf("@");            
    var dotpos=x.lastIndexOf(".");            
    if ((atpos < 1 || dotpos<atpos+2 || dotpos+2>=x.length))             
        {              
            $("#drf_email").parent().addClass('mandatoryerror');
            $("#drf_email").attr('placeholder','Please enter a valid email'); 
            failedvalidation = true;               
        }
	var y = document.getElementById("drf_nemail").value;           
    var atpos=y.indexOf("@");            
    var dotpos=y.lastIndexOf(".");            
    if ((atpos < 1 || dotpos<atpos+2 || dotpos+2>=y.length))             
        {              
            $("#drf_nemail").parent().addClass('mandatoryerror');
            $("#drf_nemail").attr('placeholder','Please enter a valid email'); 
            failedvalidation = true;               
        }	
	var em = document.getElementById("drf_nemail").value;
	var cem = document.getElementById("drf_cemail").value;           
    if (em != cem)             
    {              
       $("#drf_cemail").parent().addClass('mandatoryerror');
	   $("#drf_cemail").attr('placeholder','Confirm Email does not Match'); 
        failedvalidation = true;              
    } 
    
    if(failedvalidation) return false;

	if(x !="" && em !=""){
	   //loader();
     $("#loading-div").hide();
		 $.ajax({ 
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/user/myaccount/changeemail/'); ?>",
			 async: false,
             data: 'type=edit_email&drg_email='+x+'&drg_nemail='+em,
             beforeSend:function(){
                $("#loading-div").hide();
             }, 
             success: function(result)
			 {
                $("#loading-div").hide();
                //loader();
                var obj = jQuery.parseJSON(result); 
                if(obj.success){                    
					$('#Myaccount_drg_email').val(em);
          close_email_form(); 
          show_msg(obj.message);
					failedvalidation = false;
                    //window.location.reload();
                }else {
                    $("#drf_nemail,#drf_cemail").parent().addClass('mandatoryerror');
                    $("#drf_nemail,#drf_cemail").attr('placeholder',obj.message); 
                      failedvalidation = true;
			         $("#drf_email,#drf_nemail,#drf_cemail").val('');
                } 
                  
        	},
			error: function(a)
			 {
				 alert(a);
			 }
  		});
     }
 	if (failedvalidation) 
	{
        return false;
    }
    return false;
}

function show_picture_form(){
   jQuery(".my-account-links,#update-table,.fBtn").css({
     'opacity': 0,
     '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
     'filter': 'alpha(opacity=0)'
   });
    jQuery(".photo-upload-box").show();
 }

 function hide_picture_form(){
    //jQuery("#drg_image").trigger("click");
    jQuery(".my-account-links,#update-table,.fBtn").css({
     'opacity': 1,
     '-ms-filter':"",
     'filter': ''
    });
    jQuery(".photo-upload-box").hide();  
  }

 function check_old_email(eml){  
     if(eml !='')
   {
         jQuery.ajax({
             url:'<?php echo Yii::app()->createUrl("/user/myaccount/checkmail");?>',
             type:'POST',
             data:{eml:eml},
             success: function(result)
       {
                 var obj = jQuery.parseJSON(result); 
                 if(obj.success==false){ 
                     jQuery("#drf_email").val('');
                     jQuery("#drf_email").parent().addClass('mandatoryerror');
                     jQuery("#drf_email").attr('placeholder',obj.message); 
                                         
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
             JQ("#drf_email").parent().addClass('mandatoryerror');
             JQ("#drf_email").attr('placeholder','Please enter a valid email');
             failedvalidation = true;   
         } 
     }
 }

 function check_old_pwd(eml){  
     if(eml !='')
   {
         jQuery.ajax({
             url:'<?php echo Yii::app()->createUrl("/user/myaccount/checkoldpwd");?>',
             type:'POST',
             data:{eml:eml},
             success: function(result)
       {
                 var obj = jQuery.parseJSON(result); 
                 if(obj.success==false){ 
                     jQuery("#drf_opass").val('');
                     jQuery("#drf_opass").parent().addClass('mandatoryerror');
                     jQuery("#drf_opass").attr('placeholder',obj.message); 
                                         
                 }else {
                     jQuery("#drf_opass").parent().removeClass('mandatoryerror');
                     jQuery("#drf_opass").parent().removeClass('validtext');
                 }                 
             }
         });
     }else {
             JQ("#drf_opass").parent().addClass('mandatoryerror');
             JQ("#drf_opass").attr('placeholder','Please enter old password');
             failedvalidation = true;   
     }
 }
</script>

<!--</div>-->
