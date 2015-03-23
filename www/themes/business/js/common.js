var JQ = jQuery.noConflict();
JQ(document).ready(function(){
   JQ(".passchage").on("click",function(){       
       var showpass =  JQ("#drf_pass").attr("type");       
       if(showpass=='text'){
           JQ('#drf_pass').get(0).type = 'password';
           JQ('#hide-password').attr({id:'show-password'})  	
       }else {
            JQ('#drf_pass').get(0).type = 'text';           	
            JQ('#show-password').attr({id:'hide-password'});
       }
   }) 
   
   
   JQ("#register-user").live("click",function(){         
        var failedvalidation = false;
        JQ('td').removeClass('mandatoryerror');
        var drf_name = document.getElementById("User_drg_name").value;
        var drf_surname = document.getElementById("User_drg_surname").value;
        var drf_email = document.getElementById("User_drg_email").value;   
        var drg_verifycode = document.getElementById("User_drg_verifycode").value;
        var drf_username = document.getElementById("User_drg_username").value;  
        var drf_addr = document.getElementById("User_drg_country").value;
        var drf_psts = document.getElementById("User_co_title").value;
        var drg_dob = document.getElementById("User_drg_dob").value;
        var drf_pass = document.getElementById("drf_pass").value;
        var drf_gender = document.getElementById("User_drg_gender").value;  
        
        if(drg_verifycode ==""){               
            JQ("#User_drg_verifycode").addClass('mandatoryerror'); 
    	    JQ("#User_drg_verifycode").attr('placeholder','Enter Captcha');
    	    JQ("#User_drg_verifycode").val("");
    		failedvalidation = true;            
        }else {
            if(!process_captcha())
            {
                failedvalidation = true;
            }  
        } 
        
        
        if(drf_name == "")
        {                
            JQ("#User_drg_name").parent().addClass('mandatoryerror');
            JQ("#User_drg_name").attr('placeholder','Please enter your name');             
            failedvalidation = true;    
        }
        if(drf_surname==""){
            JQ("#User_drg_surname").parent().addClass('mandatoryerror');
		   JQ("#User_drg_surname").attr('placeholder','Please enter your surname'); 
           failedvalidation = true;  
        }
        if(drg_dob==""){
            JQ("#User_drg_dob").parent().addClass('mandatoryerror');
		   JQ("#User_drg_dob").attr('placeholder','Please enter your date of birth'); 
           failedvalidation = true;  
        }else {
            registercheckdod();
        }  
        
        if((drf_username == ""))
        {                
           JQ("#User_drg_username").parent().addClass('mandatoryerror');
    	   JQ("#User_drg_username").attr('placeholder','Please enter a username'); 
           failedvalidation = true;            
        }
        
        if(drf_pass == "")
        {                
           JQ("#drf_pass").parent().addClass('mandatoryerror');
    	   JQ("#drf_pass").attr('placeholder','Please enter a password'); 
           failedvalidation = true;            
        } 
        var atpos=drf_email.indexOf("@");            
        var dotpos=drf_email.lastIndexOf("."); 
        if(drf_email=="" || (atpos < 1 || dotpos<atpos+2 || dotpos+2>=drf_email.length)){
            JQ("#User_drg_email").parent().addClass('mandatoryerror');
            JQ("#User_drg_email").attr('placeholder','Please enter a valid email');
            failedvalidation = true;   
        }else {
            check_duplicate_email(drf_email);
        } 
        
		 var gender=JQ( "#User_drg_gender" ).val();
		if(gender == '')
		{
			JQ(".gendermsg").html("Please select your gender");
		}
		else
		{
			JQ(".gendermsg").html("");	
		}
		
		var cotitle=JQ( "#User_co_title" ).val();
		if(cotitle == '')
		{
			JQ(".companymsg").html("Please select your title");
		}
		else
		{
			JQ(".companymsg").html("");	
		}
		var country=JQ( "#User_drg_country" ).val();
		if(country == '')
		{
			JQ(".countrymsg").html("Please select your country");
		}
		else
		{
			JQ(".countrymsg").html("");	
		}
		         
        if(drf_gender == '')
        {                
           JQ("#User_drg_gender").parent().addClass('mandatoryerror'); 
           failedvalidation = true;            
        } 
        
        if(drf_psts == '')
        {           
            JQ("#User_co_title").parent().addClass('mandatoryerror'); 
            failedvalidation = true;     
        } 
        
        
        if(drf_addr == '')
        {                
           JQ("#User_drg_country").parent().addClass('mandatoryerror'); 
    	   failedvalidation = true;  
        } 
         
         
        
        
        if(!JQ("#term_agree").is(':checked')){
            JQ("#term-error-data").html("Please Accept Terms And Conditions To Submit.").show();            
            failedvalidation = true; 
        }
         
        if (failedvalidation) 
    	{
    	   return false;
        }else { 
            JQ("#confirm_email_popup").html(drf_email);
            JQ(".confirm-email").fadeIn();  
        }
   }); 
   JQ("#register-business").on("click",function(){
        
        var failedvalidation = false;
        var drf_pass ="";
        JQ('td').removeClass('mandatoryerror');
        var drf_co_sector = document.getElementById("Business_co_sector").value;
        var drf_name = document.getElementById("Business_drg_name").value;
        var drf_surname = document.getElementById("Business_drg_surname").value;
        var drf_email = document.getElementById("Business_drg_email").value;   
        var drg_verifycode = document.getElementById("Business_drg_verifycode").value;
        var drf_username = document.getElementById("Business_drg_username").value;  
        var drf_addr = document.getElementById("Business_drg_country").value;
        var drf_psts = document.getElementById("Business_co_title").value;
        var drg_dob = document.getElementById("Business_drg_dob").value;
        drf_pass = document.getElementById("Business_drg_pass").value;
        var drf_co_name = document.getElementById("Business_co_name").value;  
        var Business_drg_addr1 = document.getElementById("Business_drg_addr1").value;       
        var Business_drg_town = document.getElementById("Business_drg_town").value;
        var Business_drg_county = document.getElementById("Business_drg_county").value;
        var Business_drg_zip = document.getElementById("Business_drg_zip").value;
        var Business_drg_phone = document.getElementById("Business_drg_phone").value;
        var Business_co_website = document.getElementById("Business_co_website").value;
        
        if(drf_pass == "")
        {                
           JQ("#Business_drg_pass").parent().addClass('mandatoryerror');
    	   JQ("#Business_drg_pass").attr('placeholder','Please enter your password'); 
           failedvalidation = true;            
        } 
        
        if(Business_co_website == "")
        {                
            JQ("#Business_co_website").parent().addClass('mandatoryerror');
            JQ("#Business_co_website").attr('placeholder','Please enter website url');             
            failedvalidation = true;    
        }
       
        if(Business_drg_phone == "")
        {                
            JQ("#Business_drg_phone").parent().addClass('mandatoryerror');
            JQ("#Business_drg_phone").attr('placeholder','Please enter telephone number');             
            failedvalidation = true;    
        }
       
        if(Business_drg_zip == "")
        {                
            JQ("#Business_drg_zip").parent().addClass('mandatoryerror');
            JQ("#Business_drg_zip").attr('placeholder','Please enter zip code');             
            failedvalidation = true;    
        }
        if(Business_drg_county == "")
        {                
            JQ("#Business_drg_county").parent().addClass('mandatoryerror');
            JQ("#Business_drg_county").attr('placeholder','Please enter your country');             
            failedvalidation = true;    
        }
       
       
        if(Business_drg_town == "")
        {                
            JQ("#Business_drg_town").parent().addClass('mandatoryerror');
            JQ("#Business_drg_town").attr('placeholder','Please enter your town');             
            failedvalidation = true;    
        }
       
        if(Business_drg_addr1 == "")
        {                
            JQ("#Business_drg_addr1").parent().addClass('mandatoryerror');
            JQ("#Business_drg_addr1").attr('placeholder','Please enter your address');             
            failedvalidation = true;    
        }
        
        if(drf_co_sector == "")
        {                
            JQ("#Business_co_sector").parent().addClass('mandatoryerror');
            JQ("#Business_co_sector").attr('placeholder','Please select your sector');             
            failedvalidation = true;    
        }

        var businesssector = JQ("#Business_co_sector").val();
        if(businesssector == '')
        {
            JQ(".sector-con").html("Please select your sector");            
        }
        else
        {
            JQ(".sector-con").html(); 
        }
        

        if(drf_name == "")
        {                
            JQ("#Business_drg_name").parent().addClass('mandatoryerror');
            JQ("#Business_drg_name").attr('placeholder','Please enter your name');             
            failedvalidation = true;    
        }
        if(drf_surname ==""){
            JQ("#Business_drg_surname").parent().addClass('mandatoryerror');
		   JQ("#Business_drg_surname").attr('placeholder','Please enter your surname'); 
           failedvalidation = true;  
        }
        if(drg_dob ==""){
           JQ("#Business_drg_dob").parent().addClass('mandatoryerror');
		   JQ("#Business_drg_dob").attr('placeholder','Please enter your date of birth'); 
           failedvalidation = true;  
        }else {
            bussinesscheckdod();
        }
       
        
        if((drf_username == ""))
        {                
           JQ("#Business_drg_username").parent().addClass('mandatoryerror');
    	   JQ("#Business_drg_username").attr('placeholder','Please enter your username'); 
           failedvalidation = true;            
        }
        
      
        var atpos=drf_email.indexOf("@");            
        var dotpos=drf_email.lastIndexOf("."); 
        if(drf_email=="" || (atpos < 1 || dotpos<atpos+2 || dotpos+2>=drf_email.length)){
            JQ("#Business_drg_email").parent().addClass('mandatoryerror');
            JQ("#Business_drg_email").attr('placeholder','Please enter a valid email');
            failedvalidation = true;   
        }else {
            check_duplicate_email(drf_email);
        } 
                 
         if(drf_co_name == '')
        {                
           JQ("#Business_co_name").parent().addClass('mandatoryerror'); 
           JQ("#Business_co_name").attr('placeholder','Please enter your business name');
           failedvalidation = true;            
        }  
        
        if(drf_psts == '')
        {           
            JQ("#Business_co_title").parent().addClass('mandatoryerror'); 
            JQ("#Business_co_title").attr('placeholder','Please enter your business title');
            failedvalidation = true;     
        } 
        
        var businesscontry = JQ("#Business_drg_country").val();
		if(businesscontry == '')
		{
			JQ(".business-con").html("Please select your country");
			
		}
		else
		{
			JQ(".business-con").html();	
		}
		
		
        if(drf_addr == '')
        {                
           JQ("#Business_drg_country").parent().addClass('mandatoryerror'); 
    	   failedvalidation = true;  
        } 
         
        /*if(drg_verifycode =="")
        {               
           JQ("#Business_drg_verifycode").addClass('mandatoryerror'); 
    	   JQ("#Business_drg_verifycode").attr('placeholder','Enter Captcha');
    	   JQ("#Business_drg_verifycode").val("");
    		failedvalidation = true;            
        } */
        
        if(drg_verifycode ==""){               
            JQ("#Business_drg_verifycode").addClass('mandatoryerror'); 
    	    JQ("#Business_drg_verifycode").attr('placeholder','Enter Captcha');
    	    JQ("#Business_drg_verifycode").val("");
    		failedvalidation = true;            
        }else {
            if(!process_captcha())
            {
                failedvalidation = true;
            }  
        }         
         
        if(!JQ("#term_agree").is(':checked')){
            JQ("#term-error-data").html("Please Accept Terms And Conditions To Submit.").show();            
            failedvalidation = true; 
        }else {
            JQ("#term-error-data").hide();
        }
         
        if (failedvalidation) 
    	{	return false;
        }else {
             JQ("#confirm_email_popup").html(drf_email);
             JQ(".confirm-email").fadeIn();  
            //JQ("#user-registerform-form").submit();
        }
   }); 
   
   JQ('.inputfield').focus(function()
	{
        JQ(this).parent().removeClass('mandatoryerror');
        JQ(this).parent().addClass('fieldinfocus');
        JQ(this).attr('placeholder','');
    });

    JQ('.inputfield').focusout(function() 
	{
        JQ(this).parent().removeClass('fieldinfocus');
    });

    JQ('#drg_username').keyup(function() {
         if (this.value.match(/[^a-z0-9]/g)) {
             this.value = this.value.replace(/[^a-z0-9]/g, '');
         }
     });
    
}); 


 
function show_terms()
{
	$("#cont_back_div").show();
}

function close_terms()
{
	$("#cont_back_div").hide();
    
}
function process_captcha()
{
	var captcha_val = $(".captcha_fld").val();
	var test =  false;
	$.ajax({
		async: false,
		url:baseUrl+'/captcha/ajax_captcha.php',
		method: 'post',
		data: "captcha=1&ct_captcha="+captcha_val,
		success:function(transport) {
			var get_message = transport.split("|||");
			if(get_message[0] == 1)
			{
				$("#captcha_validation").val("okay");
               	$("#captcha_result").hide();
			 	test = true;
			}
			else if(get_message[0] == 0)
			{
				$("#captcha_validation").val(0);
				$("#captcha_result").show();
				$("#captcha_result").html(get_message[1]);
				$(".captcha_fld").val("");
                reloadCaptcha();
				test = false;
			}
		}
	});
	return test;
}
function reloadCaptcha()
{
	document.getElementById('siimage').src = baseUrl+'/captcha/securimage_show.php?sid=' + Math.random();
}
 
function loader(){
	var thediv=document.getElementById('loading-div');
	if(thediv.style.display == "none"){
		thediv.style.display = "";		
	}else{
		thediv.style.display = "none";
	}
	return false;
}

function registercheckdod(){ 
    $.ajax({
		async: false,
		url:baseUrl+'/ajax/checkdob',
		method: 'post',
		data: "dob="+$("#User_drg_dob").val(),
		success:function(transport) {
		    var get_message = $.parseJSON(transport);
			if(get_message.success=="false")
			{
			    $("#User_drg_dob").val('') ;
				$("#User_drg_dob").parent().addClass('mandatoryerror'); 
                $("#User_drg_dob").attr('placeholder','You must be over 18yrs to register'); 
                
			} 
		}
	}); 
}
function myaccountdod(){  
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
                
			} 
		}
	}); 
}
function bussinesscheckdod(){ 
    $.ajax({
		async: false,
		url:baseUrl+'/ajax/checkdob',
		method: 'post',
		data: "dob="+$("#Business_drg_dob").val(),
		success:function(transport) {
		    var get_message = $.parseJSON(transport);
			if(get_message.success=="false")
			{
			    $("#Business_drg_dob").val('') ;
				$("#Business_drg_dob").parent().addClass('mandatoryerror'); 
                $("#Business_drg_dob").attr('placeholder','You must be over 18yrs to register'); 
                
			} 
		}
	}); 
}
 
 function validateEmail(fid)
{
  var fvalue = $("#"+fid).val();
  failedvalidation = false;
  if(jQuery.trim(fvalue)=='') {
    $("#"+fid).parent().addClass('mandatoryerror');
    $("#"+fid).val('').attr('placeholder','Please enter a valid email.'); 
    failedvalidation = true;
  }else if(jQuery.trim(fvalue)!='' && !fvalue.match(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/)) {
    $("#"+fid).parent().addClass('mandatoryerror');
    $("#"+fid).val('').attr('placeholder','Please enter a valid email.'); 
    failedvalidation = true;
  }

  if(failedvalidation)
    return false;
}

function show_msg(messg)
{
  $(".my-account-links,#update-table").css({
    'opacity': 0,
    '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
    'filter': 'alpha(opacity=0)'
  });
  $(".pmsg").html('<div class="u-email-box" id="terms-conditions"> <img src="'+baseUrl+'/themes/business/images/robot/robot-torso.png"><div class="my-account-popup-box"> <h2>'+messg+'</h2><span class="middle"> <input type="button" class="button black" onclick="close_msg();" value="Close" name="closebtn"></span></div></div>').show();
}

 function close_msg()
 {
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 1,
      '-ms-filter':"",
      'filter': ''
    });
  $('.pmsg').hide();
 }