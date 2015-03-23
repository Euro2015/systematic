<?php
if($_REQUEST && isset($_REQUEST['retrieve'])){
    ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#login-area").hide();
        $("#reg_here").hide();
        $("#lost_pass_request").show();
        $("#lostpass-inst").show();
    });
</script>
<?php
}
?>
<div id="loading"></div>
<div class="image-robo-torso">
    <img width="120" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/image-robo-torso.png">
</div>
<div class="image-robo-hands">
    <img width="120" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/image-robo-hands.png">
</div>
<?php

if(Yii::app()->user->isGuest){
?>
    <div id="login-box"><!--lost password form-->
    <div id="login-area"><!--login form -->
    <form action="<?php echo Yii::app()->createUrl('/login'); ?>" method="post" name="login_form" id="login_form" onsubmit="return login_validation(this.form)">

       <input onblur="if(this.value=='')this.value='Username'" onfocus="check_user_info(this.id);" type="text" name="drg_username" title="Please enter your username"  value="<?php if(isset($_COOKIE['username'])!=''){ echo $_COOKIE['username']; } else { echo "Username"; } ?>" id="drg_username" size="20"  />

        <div id="passwordbox">
            <input autocomplete="off" type="text" id="drg_pass" name="drg_pass" value="Password" size="20" title="Please enter your password" onfocus="check_pass_info(this.id);" onblur="check_pass_out(this.id);" value="<?php if(isset($_COOKIE['password'])!=''){ echo $_COOKIE['password']; } else { echo "Password"; } ?>" />
        </div>


        <div id="login_check">
        </div>

        <div class="sign-option">
            <ul>
            	<li>
				<input type="checkbox" style="width:15px; float:right; margin-right:11px;" name="rememberme" id="rememberme" value="1" <?php if(isset($_COOKIE['username'])!=''){ echo "checked='checked'"; } ?> />
                 <span style="width:90px; float:right; margin-right:10px">Remember Me?</span>
            	</li>
                <li><span>Sign in to your account</span>
                    <span class="buttons-box">
                        <button class="login_sbmt" name="login_sbmt" type="submit" title='Log into your account'><img style="border-radius:5px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png" width="25" /></button>
                     </span>
                </li>
                <li><span>Lost your password</span>
                    <span class="buttons-box">
                        <a class="login_sbmt lpa" href="javaScript:void(0)" onclick="show_lost_pass_form()"  title='Reset your password'>
                            <img style="border-radius:5px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/lost.png" width="25" />
                        </a>
                     </span>
                 </li>
                 <!--<li><span>Remember me?</span>
                 	<span class="buttons-box">
                    	<input type="submit" value="" name="rememberme" class="rememberme_btn login_sbmt">
                    </span>
                 </li>-->
            </ul>
        </div> <!-- /sign-option -->

    </div> <!-- /login-area -->





<!-- lost password area -->
<div id="lost_pass_request" style="display:none">
<div id="lostpass-box">
<p class="blue_head">Password reset request</p>
<form action="#" method="post" onsubmit="return false;">
<?php echo CHtml::hiddenField('YII_CSRF_TOKEN',Yii::app()->request->csrfToken); ?>
<input onblur="if(this.value=='')this.value='Enter your Email address'" onfocus="if(this.value=='Enter your Email address' || this.value=='Please enter your email' || this.value=='Email address does not exist')this.value=''" onclick="if(this.value=='Enter your Email address')this.value=''" type="text" name="drg_lost_email" id="drg_lost_email" title="Enter your Email address"  value="Enter your Email address" size="20"  />

    <div class="sign-option">
    <br /><br />
        <ul>
            <li>
                <span>Submit</span>
                    <span class="buttons-box">
                    <button class="login_sbmt" name="lostpass_sbmt" type="button" onclick="return lost_password();">
                        <img style="border-radius:5px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png" width="25"  />				 									  					</button>
                 </span>
             </li>
        </ul>
    </div>
</form>
</div>
</div>

<!--Reset success -->
<div id="reset_success" style="display:none">
    <!--lost password form-->
    <div id="lostpass-box">
        <h3>Your password reset instructions have been sent to your email address. Please allow a few minutes to receive the email.</h3>
        <p style='text-align:right; padding-top:44px;'><a href="<?php echo Yii::app()->baseUrl; ?>">Close &#062;&#062 </a></p>
    </div> <!-- /lost password area -->
</div>
</div> <!-- /lost password area -->
<div id="box2" class="lpb">
    <p class="click-here" id="reg_here">Click <?php echo CHtml::link('here', $this->createAbsoluteUrl('/user/register'));?> to become a member and take part in our business community</p>
     <p class="click-here" id="lostpass-inst">
        Instructions to reset your password will be sent to your email address.
     </p>
     <div id="reset_success_box2" style="display:none">
        <h3 style="text-align:center;">Didn't get the email?</h3>
        <p class="click-here" >
            Please check your Spam or Junk folder.
            If you still didn't receive an email then
        </p>
        <p style='text-align:right;'>
        	<a href="help.php" title="contact us"> click here &#062;&#062 </a>
        </p>
      </div>
    <div class="clear"></div>
</div>
<?php
}
?>
<script type="text/javascript">

//show lost password form
function show_lost_pass_form()
{
	$("#login-area").hide();
	$("#reg_here").hide();
	$("#lost_pass_request").show();
	$("#lostpass-inst").show();
}

function check_user_info(id)
{
	var username = $('#'+id).val();
	 if(username=='Username' || username=='Please enter your username' || username=='Username not recognized')
	 {
		 $('#'+id).val('');
	 }
}


function check_pass_field(id)
{
	var password = $('#'+id).val();
	 if(password=='Enter New Password' ||  password=='Enter Confirm Password' || password=='')
	 {
		 $('#'+id).val('');
		 $('#'+id).attr('type', 'password');
	 }
}

function check_pass_info(id)
{

	var password = $('#'+id).val();
	 if(password=='Password' || password=='Please enter your password' || password=='Password not recognized')
	 {
		 $('#'+id).val('');
		 $('#'+id).attr('type', 'password');
	 }
}

function check_pass_out(id)
{
	var password = $('#'+id).val();
	 if(password=='Password' || password=='Please enter your password' || password=='Password not recognized' || password=='')
	 {
		 $('#'+id).attr('type', 'text');
		 $('#'+id).val('Password');
	 }
}

function lost_password()
{
	var failedvalidation = false;
    var drg_lost_email = document.getElementById("drg_lost_email").value;
	if(drg_lost_email == "Enter your Email address" || drg_lost_email == "Please enter your email" || drg_lost_email == "")
        {
            $("#drg_lost_email").css('border','1px solid #f00');
			$("#drg_lost_email").val('Please enter your email');
            failedvalidation = true;
        }

	if(failedvalidation==false)
	{
		 $.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/site/forget');?>",
			 async: false,
             //data: 'type=lost_password&email='+drg_lost_email,
              data: 'drg_lost_email='+drg_lost_email+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
             success: function(result)
			 {
			     var result1 = jQuery.parseJSON(result);

				 if(result1.success=='true')
				 {
				     $("#lost_pass_request").css('display','none');
					 $("#lostpass-inst").css('display','none');
					 $("#reset_success").fadeIn('slow');
					 $("#reset_success_box2").fadeIn('slow');
					//window.location.href ='<?php echo Yii::app()->baseUrl; ?>';
					failedvalidation = false;

				 }
				 else
				 {
				 	$("#drg_lost_email").css('border','1px solid #f00');
					$("#drg_lost_email").css('color','#f00');
					$("#drg_lost_email").val('Email address does not exist');
				    failedvalidation = true;
            	 }
				 return false;
        	},
			error: function(a)
			 {
				 alert(a);
			 }
  		});
	}

	if(failedvalidation)
	{
        return false;
    }

}

function login_validation(frm)
{
	var failedvalidation = false;
    var drf_name = document.getElementById("drg_username").value;
	var drf_pass = document.getElementById("drg_pass").value;

    if(drf_name == "Username" || drf_name == "Please enter your username" || drf_name == "")
        {
            $("#drg_username").css('border','1px solid #f00');
			$("#drg_username").val('Please enter your username');
            failedvalidation = true;
        }

    if(drf_pass == "Password" || drf_pass == "Please enter your password" || drf_pass=='')
	{
		$("#drg_pass").css('border','1px solid #f00');
		$("#drg_pass").val('Please enter your password');
		failedvalidation = true;
	}


	if(failedvalidation==false)
	{
	     if($("#rememberme").is(':checked'))
         {    setCookie('username',drf_name);
              setCookie('password',drf_pass);

         }

		 $.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/login');?>",
			 async: false,
             data: 'LoginForm[username]='+drf_name+'&LoginForm[password]='+drf_pass+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
             success: function(data)
			 {

                var result = jQuery.parseJSON(data);
                 //alert(result.success);
				 if(result.success=='true')
				 {
				    window.location.href ='<?php echo Yii::app()->baseUrl; ?>';
					failedvalidation = false;

				 } else{

                    if(result=='User name Exist'){
				 	$("#drg_pass").css('border','1px solid #f00');
                    $("#drg_username").css('border','1px solid #999999');
					$('#drg_pass').attr('type', 'text');
					$("#drg_pass").val('Password not recognized');
				    failedvalidation = true;
            	 }else{
                    $("#drg_username").css('border','1px solid #f00');
                    $("#drg_username").val('Username not recognized');
                    $("#drg_pass").css('border','1px solid #f00');
					$('#drg_pass').attr('type', 'text');
					$("#drg_pass").val('Password not recognized');
				    failedvalidation = true;
                 }

                }
				 return false;
        	},
			error: function(a)
			 {
				 //alert(a);
			 }
  		});
	}

    if(failedvalidation)
	{
        return false;
    }
}



function setCookie(c_name,value,exdays)
    {
      var exdate=new Date();
      exdate.setDate(exdate.getDate() + exdays);
      var c_value=escape(value) +
        ((exdays==null) ? "" : ("; expires="+exdate.toUTCString()));
      document.cookie=c_name + "=" + c_value;
    }

    function getCookie(c_name)
    {
     var i,x,y,ARRcookies=document.cookie.split(";");
     for (i=0;i<ARRcookies.length;i++)
     {
      x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
      y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
      x=x.replace(/^\s+|\s+$/g,"");
      if (x==c_name)
      {
       return unescape(y);
      }
     }
    }

    function setCookie(c_name,value,exdays)
    {
      var exdate=new Date();
      exdate.setDate(exdate.getDate() + exdays);
      var c_value=escape(value) +
        ((exdays==null) ? "" : ("; expires="+exdate.toUTCString()));
      document.cookie=c_name + "=" + c_value;
    }

    function getCookie(c_name)
    {
     var i,x,y,ARRcookies=document.cookie.split(";");
     for (i=0;i<ARRcookies.length;i++)
     {
      x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
      y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
      x=x.replace(/^\s+|\s+$/g,"");
      if (x==c_name)
      {
       return unescape(y);
      }
     }
    }
// Add the text Password to password input field
function changefield(typ,vl){
	if((typ=='text') && (vl=='Password')){
			 document.getElementById("passwordbox").innerHTML = "<input id=\"drg_pass\" type=\"password\" name=\"drg_pass\" title=\"Password\" onblur=\"changefield(this.type,this.value);\" />";
	document.getElementById("drg_pass").focus();
	}
	if((typ=='password') && (vl=='')){
	document.getElementById("passwordbox").innerHTML = "<input id=\"drg_pass\" type=\"text\" name=\"drg_pass\" value='Password' title=\"Password\" onfocus=\"changefield(this.type,this.value);\" />";
	}
}
</script>