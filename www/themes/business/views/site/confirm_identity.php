<div class="breadcrumb" style="top: 14px;">

<a href="/">Home</a> » <span>Confirm Your Identity</span>

</div>

<!-- Where business meets invention -->

	<div class="sl-photo-box" style="margin-left:0px; text-align:center">
					
					<div class="photo-upload-box1 listing-upload" style="  margin-top: 65px;
  height: 0%;">
						<div class="my-account-popup-box" id="upload-frame"> 
							<a class="pu-close" onclick=jQuery(".registration-box").show();jQuery(".photo-upload-box1").hide(); href="javaScript:void(0)" title="Close">X</a>
							<h2>Upload Attachment</h2>
							
                            
							<!--<iframe src="photo-upload/logo_listing.php" frameborder="0" width="390" height="310" id="pic_frame"></iframe>--> 
                            <div id="wrap" style="height: auto;">    
                                <div id="uploader">
                                    <div id="big_uploader">
                                    <div id="notice"><img src="ajax-loader.gif" /></div>
                            		
                                    <br />
                                    Browse for a legal document on your computer
                                    <br />
                                    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                                'id'=>'uploadFile',
                                                'config'=>array(
                                                       'action'=>Yii::app()->createUrl('site/fileupload'),
                                                       'allowedExtensions'=>array("jpg",'png','pdf','doc'),//array("jpg","jpeg","gif","exe","mov" and etc...
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
					</div>
					
					
<div class="registration-box contact_cont" style="margin-left: 10px; display: block;  top: 406px !important;">  

            	<form action="<?php echo Yii::app()->createUrl('site/identity_process'); ?>" method="post" id="member-form">            
				
				<div class="contact_inner" style="height: 399px; display: block;">           

				<div class="closebutton_pop" style="position: relative; top: -13px; z-index: 100;left: 379px; text-align: center;">       

				<a title="Close" href="<?php echo Yii::app()->getBaseUrl(true); ?>" id="close"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24"></a>              

				</div>     
				
				<div style="text-align: center; ">   

				<h2 style="color:rgb(233, 89, 64); margin-top: -15px;">We were unable to verify your details</h2>    

				<br/>
				
                <p style="margin: 0 4px 0 0;">Business Supermarket.com operates a secure website to protect its members and affiliates by ensuring that all registered members

can be verified. You are required to email a jpeg copy of a legal document that confirms your identity or any other means of

confirming your profile details.</p>  

<br/>

				</div>

<table width="100%" align="center">

                            <tbody>
							
							<tr>
							
							<td width="100" class="tbl1" align="right">Username:</td>
							
							<td class="last" id="tbl2"><input type="text" name="username" id="username" class="file_input_textbox" placeholder="Enter Username" style="cursor:initial;height: 12px;  border: 1px solid #000;  width: 220px;"  required=""></td>
							
							</tr>
							
							<tr>
							
							<td width="100" class="tbl1" align="right">Email:</td>
							
							<td class="last" id="tbl2"><input type="email" name="email" id="email" class="file_input_textbox" placeholder="Enter Email" style="cursor:initial;height: 12px;  border: 1px solid #000;  width: 220px;"  required=""></td>
							
							</tr>
							
							<tr>
							
							<td width="100" class="tbl1" align="right">Subject:</td>
							
							<td class="last" id="tbl2"><input type="text" name="subject" id="subject" class="file_input_textbox" placeholder="Enter Subject" style="cursor:initial;height: 12px;  border: 1px solid #000;  width: 220px;" value="Account verification request" readonly="true"></td>
							
							</tr>
							
							<tr>
							
							<td width="100" class="tbl1"  align="right">Attachment:</td>
							
							<td class="last" id="tbl2"><input type="text" name="attachment" id="attachment" class="file_input_textbox" style="cursor:initial;height: 12px;  border: 1px solid #000;  width: 577px;" required="">
							
							<br/><br/> 
							
							<a  onClick="show_picture_form1()" href="javaScript:void(0)" id="addatt"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Add Attachment</a>
							<a href="javaScript:void(0)" id="delatt" style="display:none"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Delete Attachment</a>
				
			
				</td>
							
							</tr>
							
							<tr>
							
							<td width="100" class="tbl1"  align="right">Message:</td>
							
							<td class="last" id="tbl2">
							
							 <textarea required="" class="file_input_textbox" placeholder="Describe your message" name="msg" id="msg" style="cursor:initial;width: 575px; height: 50px; padding: 4px; border: 1px solid #000;"> </textarea>
                            
							</td>				

							</tr>
							
							<tr>
							
							<td colspan="2" class="last" id="tbl2" align="center">
							
         Send a copy to my email address for my records <input type="checkbox" name="memail" value="yes">
   
							</td>				

							</tr>
							
							<tr>
							
							<td colspan="2" class="last" id="tbl2" align="center">
				<input type="submit" name="sendmaillist" tabindex="12" id="sendmaillist" class="button black" value="Send">
							
							</td>				

							</tr>
							
							
							
                      </tbody>
					  
					  </table>
 
</div>
</form>
</div>
<script type="text/javascript">
	
    function show_picture_form1(){
         jQuery(".photo-upload-box1").show();
		 jQuery(".registration-box").hide();
    }
	
	 function getUploadfilename(result){
    if(result.success){ 
	
        jQuery("#attachment").val(result.filename);
		 jQuery(".photo-upload-box1").hide();
	  jQuery(".registration-box").show();
		jQuery("#addatt").hide();
		jQuery("#delatt").show();
		
   }
 }

      $("#delatt").click(function(event){
        var d1=$('#member-form').serialize();
  $.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('site/delete_file'); ?>",
             data:  d1 ,
             success: function(result)
             {
                    if(result =='success'){
                        $("#attachment").val('');
                       $("#addatt").show();
		              $("#delatt").hide();
                    }
        	},
            })
		});
</script>