<?php 
$this->breadcrumbs = array(''); 
?>


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
                                                       'allowedExtensions'=>array("jpg",'png','rar','txt'),//array("jpg","jpeg","gif","exe","mov" and etc...
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
					
					
<!-- Where business meets invention --><div class="registration-box contact_cont" style="margin-left: 10px; display: none;  top: 406px !important;">    

          	<form action="<?php echo Yii::app()->createUrl('site/contact'); ?>" method="post" id="member-form"> 

			<div class="contact_inner" style="height: 399px; display: block;">    

			<div class="closebutton_pop" style="position: relative; top: -13px; z-index: 100;left: 379px; text-align: center;"> 

			<a title="Close" onclick=jQuery(".registration-box").hide();jQuery(".breadcrumb").css('top','0px');jQuery("#newcontent").show(); href="javaScript:void(0)"  id="close">
			
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24"></a>   

			</div>     								<div style="text-align: center; ">   	

			<br/>							

			<h2 style="color:#A14B93; margin-top: -15px;">Business Supermarket User Contact Form</h2>    

			<br/>				   

			<br/>		

			</div>
			
			<?php
			
			$user_id = Yii::app()->user->id;
			
			if($user_id!="")
			
			{
			
			$user_details = User::model()->findAllByAttributes(array("drg_id"=>$user_id));
			
			}
			
			?>
			
			<table width="100%" align="center">    

			<tbody>					

			<tr>										

			<td class="tbl1" align="right">Username:</td>		

			<td class="last" id="tbl2">
			
			<input type="text" name="username" id="username" class="file_input_textbox" placeholder="Enter Username" style="height: 12px;  border: 1px solid #000;  width: 175px;cursor: initial;"  required="" value="<?php echo $user_details[0]['drg_username']; ?>"></td>

			<td class="tbl1" align="right" style="width: 80px;">Department:</td>		

			<td class="last" id="tbl2">						

			<?php					

            $listData =  CHtml::listData(Department::model()->findAll(array("order"=>'dept_name asc')),'dept_email','dept_email');
           
    	    echo CHtml::dropDownList('dept_email','',$listData,array('class'=>'chzn-select','required'=>'true','data-placeholder'=>'Please select','onfocus'=>'getSelectNormal("#dept_email");','style'=>'width: 330px;','id'=>'dept_email','tabindex'=>'1','title'=>'Select a department from the drop down menu'));
            
			?>	

			</td>				

			</tr>					

			<tr>					

			<td width="100" class="tbl1" align="right">Email:</td>		

			<td class="last" id="tbl2" style="width: 184px;">
			
			<input type="email" name="email" id="email" class="file_input_textbox" placeholder="Enter Email" style="height: 12px;  border: 1px solid #000;  width: 175px;cursor: initial;"  required=""  value="<?php echo $user_details[0]['drg_email']; ?>"></td>									

			<td class="tbl1" align="right">&nbsp;</td>

			<td class="last" id="tbl2">&nbsp;</td>		

			</tr>											

			<tr>										

			<td width="100" class="tbl1" align="right">Subject:</td>	

			<td class="last" id="tbl2"  colspan="3"><input type="text" name="subject" id="subject" class="file_input_textbox" placeholder="Enter Subject" style="cursor: initial;height: 12px;  border: 1px solid #000;  width: 596px;" required=""></td>	

			</tr>							

			<tr>							

			<td width="100" class="tbl1" valign="top" align="right">Attachment:</td>		

			<td class="last" id="tbl2" colspan="3"><input type="text" name="attachment" id="attachment" class="file_input_textbox" style="cursor: initial;height: 12px;  border: 1px solid #000;  width: 596px;" required="">								

			<br/><br/> 											

			<a  onClick="show_picture_form1()" href="javaScript:void(0)" id="addatt"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Add Attachment</a>	

			<a href="javaScript:void(0)" id="delatt" style="display:none"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Delete Attachment</a>											</td>							
			
			</tr>		

			<tr>				

			<td width="100" class="tbl1"  align="right">Message:</td>	

			<td class="last" id="tbl2" colspan="3">						

			<textarea required="" class="file_input_textbox" placeholder="Describe your message" name="msg" id="msg" style="cursor: initial;width: 594px; height: 50px; padding: 4px; border: 1px solid #000;"> </textarea>                            

			</td>					

			<td class="tbl1" align="right">&nbsp;</td>		

			<td class="last" id="tbl2">&nbsp;</td>			

			</tr>											

			<tr>											

			<td colspan="4" class="last" id="tbl2" align="center">	

			&nbsp;   							</td>			

			</tr>											

			<tr>									

			<td colspan="4" class="last" id="tbl2" align="center">			

			Send a copy to my email address for my records <input type="checkbox" name="memail" value="yes"> 

			</td>								

			</tr>									

			<tr>											

			<td colspan="4" class="last" id="tbl2" align="center">		

			&nbsp;   						

			</td>									

			</tr>							

			<tr>								

			<td colspan="4" class="last" id="tbl2" align="center">		

			<input type="submit" name="contactus" tabindex="12" id="sendmaillist" class="button black" value="Send">							

			</td>										

			</tr>				

			</tbody>			

			</table> </div></form>
			
			</div>
			
			<div id="newcontent">
			
    <div id="main-content">
        <div id="main-title">
            <h1>Where business meets invention</h1>
        </div> <!-- /main-title -->
        <div id="main-copy">
            <div id="copy-column-1">
                <p style="text-align: left;"><span>Welcome to <?php echo Yii::app()->params['domain']; ?>, the home of business invention. Whether you have a great business idea that can revolutionise the world or an individual simply looking for  extra income, we can help. To find out more
					<a href="javascript:void(0)" onclick="show_video('http://youtu.be/TURWdiUPLzE');"  title='How business supermarket can help you video'><strong> click here>></strong></a><br />
                </span></p>
            </div>
            <div id="copy-column-2">
                <p style="text-align: left;"><span>If you have a great business idea and want to find out how we can help <a href="javascript:void(0)" onclick="show_video('http://youtu.be/9NsbbFyXF4A');" title='How dragonsnet business supermarket can help the entrepreneur video' ><strong>click here>></strong></a><br />
                Not interested in starting your own business but want to earn an income or be part of the next big thing? To find out more <a href="javascript:void(0)" onclick="show_video('http://youtu.be/YlIhWEhFyE4');" title='How dragonsnet business supermarket can help its members video' ><strong>click here>></strong></a></span></p>
            </div>
            <div class="clear"></div>
        </div> <!-- /main-copy --> 
    </div> <!-- /main-content -->    
    <div class="clear"></div>
    <?php 
    $this->renderPartial('bottom_slider');
    ?>
	
    <div class="page_content"> 
	
	<?php if($model && $model->desc) echo $model->desc;?>
	
	</div>	
	</div> 	
	<script type="text/javascript">	  

	$(".chzn-select").chosen();
	
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
	