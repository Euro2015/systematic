 <p class="breadcrumb">
        <p class="breadcrumb"><a href="index.php" >Home</a> > contact support</p>    
    <!-- /main-content -->
    <div class="clear"></div> 
            <div id="main-content">
                <div class="help-form">
                <form action="" method="post" id="help_form" onsubmit="return help_form_vaidations()">
                  <div class="help_form_header">
                    <input type="submit" class="send-button" name="help_form" value="Send" />
                    <div  class="help_form_tabs">
                      <label class="help_btn_labels">To</label>
                      <input type="text" name="drg_emailto" id="drf_emailto" disabled value="<?php echo Yii::app()->params['company_email']; ?>" size="220" style="width:477px" />
                      <div class="clear" style="height:5px"></div>
                      <label class="help_btn_labels">Subject</label>
                      <input name="drg_subject" id="drf_subject" type="text" />
                    </div>
                  </div>
                  <div class="clear" ></div>
                  <div class="help_form_body">
                    <strong style="text-align:center;">Please complete the subject field above and the required security information below</strong>
                    <br />
                    <ul style="color:#808080;">
                      <li>
                        <label>Username:</label>
                        <input name="drg_username" id="drf_username" type="text" class="large_width" />
                        <span style="clear:both"></span>
                      </li>
                      <li>
                        <label>Surname:</label>
                        <input name="drg_surname" id="drf_surname" type="text" />
                        <span style="clear:both"></span>
                      </li>
                      <li>
                        <label>Email address:</label>
                        <input name="drg_email" id="drf_email" type="text" />
                        <span style="clear:both"></span>
                      </li>
                    </ul>
                    <div>
                    <label style="color:#808080;">Message
                    <a class="sl-tip tooltip" href="javascript:void(0)">
                    	?<span class="classic">
                        	Please provide as much information as possible so that your query can be dealt with promptly. 
                         </span>
                     </a>
                     </label>
                    <textarea style="padding:5px; float:right; margin-top:5px;" name="drg_message" id="drf_message" rows="8" cols="54"></textarea>
                    <span style="clear:both"></span>
                   </div>
                  </div>
                  
                </form>
                </div>
              <!-- /help-form --> 
          </div>
         
    
  <script>
function help_form_vaidations() 
{    
    
	var failedvalidation = false;	
    
    jQuery('#help_form input,textarea').removeClass('mandatoryerror');

	var drf_username = document.getElementById("drf_username").value;
    if((drf_username == ""))
    {                
       jQuery("#drf_username").addClass('mandatoryerror');
	   jQuery("#drf_username").attr('placeholder','Enter Your Username'); 
       failedvalidation = true;            
    } 

    var drf_surname = document.getElementById("drf_surname").value;
    if(drf_surname == "")
        {                
            jQuery("#drf_surname").addClass('mandatoryerror');
            jQuery("#drf_surname").attr('placeholder','Enter Your Surname');                
            failedvalidation = true;             
        }  

    var x = document.getElementById("drf_email").value;           
    var atpos=x.indexOf("@");            
    var dotpos=x.lastIndexOf(".");            
    if ((atpos < 1 || dotpos<atpos+2 || dotpos+2>=x.length)  || (x==''))             
        {              
            jQuery("#drf_email").addClass('mandatoryerror');
            jQuery("#drf_email").attr('placeholder','Please enter a valid email'); 
            failedvalidation = true;               
        }

	var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
/*	var drf_zip= document.getElementById("drf_zip").value;
    if(drf_zip == '' || !numberRegex.test(drf_zip))
    {                
       $("#drf_zip").addClass('mandatoryerror');
	   $("#drf_zip").attr('placeholder','Enter Your Correct Zip Code'); 
       failedvalidation = true;             
    } 
*/	
/*	var drf_dob= document.getElementById("drf_dob").value;
    if(drf_dob == '')
    {                
       $("#drf_dob").addClass('mandatoryerror');
	   $("#drf_dob").attr('placeholder','Enter Your DOB'); 
       failedvalidation = true;             
    }
*/
	var drf_subject = document.getElementById("drf_subject").value;
    if((drf_subject == ""))
    {                
       jQuery("#drf_subject").addClass('mandatoryerror');
	   jQuery("#drf_subject").attr('placeholder','Enter Subject'); 
       failedvalidation = true;            
    } 
	
	var drf_message= jQuery.trim(document.getElementById("drf_message").value);
    if(drf_message == '')
    {                
       jQuery("#drf_message").addClass('mandatoryerror');
	   jQuery("#drf_message").attr('placeholder','Enter Your Message'); 
       failedvalidation = true;             
    }
 	
	if (failedvalidation) 
	{
        return false;
    }
}
</script>  
    
    
  <?php /* <div class="registration-box">
        <div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
            <div class="clear"></div>
        </div> 
        <div class="registration-content" style="min-height:580px">
            <div class="my-account-links">
              <?php 
                $this->renderPartial("//layouts/my-account-links"); 
              ?>
            </div>
             <div class="content">
                <span style="margin-left:6px;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Under-Construction-1.jpg" /></span>
            </div>
        </div>
    </div> */ ?>