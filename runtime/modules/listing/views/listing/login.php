	 <div class="login_box">
        <div id="terms-conditions" class="u-email-box">
		    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
            <div class="my-account-popup-box" style="text-align: center;"> 
			<h4 style="margin-top: 30px;">Please enter your username and password to continue</h4>
			  <form  action="/login" method="post" name="login_form" id="login_form" onsubmit="return login_validation1(this.form)">
              <input type="text" name="drg_username" id="dname" placeholder=" Username" size="45px" style="height: 23px;margin-top: 17px;border: 1px solid rgb(134, 131, 131);"><br>
			   <input type="password" name="drg_pass"  id="dpass" placeholder=" Password" size="45px"  style="height: 23px;margin-top: 12px;border: 1px solid rgb(134, 131, 131);"><br>
			   
			  <div class="retrieve" style="margin-top: 10px;margin-left: 153px;"> <a href="#" onclick="show_lost_pass_form()">Retrieve username and password</a> </div>
		<?php $BaseUrl=Yii::app()->getBaseUrl(true); $lid = Yii::app()->request->getParam('listid'); 
		$request_id = $BaseUrl."/"."listing"."/"."fupdate"."/listid/".$lid; ?>
		<input type="hidden" name="rid"  id="rid" value="<?php echo $request_id; ?>">
                            <input type="submit"  name="login_sbmt" value="Login" class="button black" style="margin-top: 12px;"/>
            
			   </form>
            </div>
        </div>
    </div>
			
	<script type="text/javascript">
	function login_validation1(frm)
{
	var failedvalidation = false;
    var drf_name = document.getElementById("dname").value;
	var drf_pass = document.getElementById("dpass").value;
var rid = document.getElementById("rid").value;
    if(drf_name == "Username" || drf_name == "Please enter your username" || drf_name == "")
        {
            $("#dname").css('border','1px solid #f00');
			$("#dname").val('Please enter your username');
            failedvalidation = true;
        }

    if(drf_pass == "Password" || drf_pass == "Please enter your password" || drf_pass=='')
	{
		$("#dpass").css('border','1px solid #f00');
		$("#dpass").val('Please enter your password');
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
             url: "/login",
			 async: false,
             data: 'LoginForm[username]='+drf_name+'&LoginForm[password]='+drf_pass+'&YII_CSRF_TOKEN=a83e4344f76803a5a985b08d9d9556f6ea5b60b2',
             success: function(data)
			 {

                var result = jQuery.parseJSON(data);
				                //alert(result.success);
				 if(result.success=='true')
				 {
				    window.location.href = rid;
					failedvalidation = false;

				 } else{

                    if(result=='User name Exist'){
				 	$("#dpass").css('border','1px solid #f00');
                    $("#dname").css('border','1px solid #999999');
					$('#dpass').attr('type', 'text');
					$("#dpass").val('Password not recognized');
				    failedvalidation = true;
            	 }else{
                    $("#dname").css('border','1px solid #f00');
                    $("#dname").val('Username not recognized');
                    $("#dpass").css('border','1px solid #f00');
					$('#dpass').attr('type', 'text');
					$("#dpass").val('Password not recognized');
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
</script>