<?php
$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');
$js->registerScriptFile($baseUrl . '/js/tinymce/tinymce.min.js');
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".chzn-select").chosen();
        
        jQuery("#registration-tabs a").live("click",function(){
            jQuery("#registration-tabs a").removeClass("active");
            jQuery(this).addClass("active");  
            jQuery(".showhide").hide();
            /*var activediv =  jQuery(this).attr("data-active") ;
            jQuery(this).addClass("active");*/
            jQuery("#"+jQuery(this).attr("data-active")).show();
        });
    });


//jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>
<?php
/* @var $this AdminListingController */
/* @var $model AdminListing */
/* @var $form CActiveForm */
?>
<style>
.black-popup,.my-account-popup-box{
position: fixed;
    top: 20%;
    left: 35%;
    z-index: 99999999;  
      
} 
.mandatoryerror {color:black !important;} 
</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tooltips.css" />  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/adminstyle.css" />  
  
<div id="registration-tabs"> 
   <a class="active" href="javascript:void(0);" data-active="details">Details</a> 
    <a href="javascript:void(0);" data-active="sample">Samples</a>   
    <a href="javascript:void(0);" data-active="forum">Forum</a>   
    <a href="javascript:void(0);" data-active="marketing">Marketing data</a>   
    <a href="javascript:void(0);" data-active="portfolio">Portfolio</a>   
    <a href="javascript:void(0);" data-active="admin">Admin Tools</a>                  
    <div class="clear"></div>               
    <div class="clear"></div>
</div> 
  <style type="text/css">
#registration-tabs a{background: #e6d7e8; color: #A84793; border-bottom:1px solid #AC5099; font-size: 16px;  height: 25px; line-height: 25px;}
#registration-tabs a.active{background: #fff; color:#1DBFD8; border-bottom: 1px solid #fff;} 
.user_listing_search{ margin-top:6px;}
</style>
<div class="user_listing_search">

<div id="sample" style="display: none;" class="showhide">
    demo sample
</div>
<div id="forum" style="display: none;" class="showhide">
    demo forum
</div>
<div id="marketing" style="display: none;" class="showhide">
    demo marketing
</div>
<div id="portfolio" style="display: none;" class="showhide">
    demo portfolio
</div>
<div id="admin" style="display: none;" class="showhide">
 demo Admin
</div>

<div id="details" class="showhide">
	<?php 
		$user_details = User::model()->findByAttributes( array( 'drg_uid' => $model->drg_uid));
		//print_r($user);die;
		
	 ?>
     <div class="form">
     	 <h2 align="center" class="Blue" style="margin:15px 0;"><?php echo SharedFunctions::get_user_names($model['drg_uid']); ?></h2>
         
         <div class="companydetails">
          <table class="center-table" width="450" align="center">
        	<tr>
            	<td>
                	<table width="100%" align="center">
                    	<tr><td width="100">Company name:</td><td class="last"><?php echo $user_details['co_name']; ?></td>
                        <tr><td width="100">Address1:</td><td class="last"><?php echo $user_details['drg_addr1']; ?></td></tr>
                        <tr><td width="100">Address2:</td><td class="last"><?php echo $user_details['drg_addr2']; ?></td></tr>
                        <tr><td width="100">Address3:</td><td class="last"><?php echo $user_details['drg_addr3']; ?></td></tr>
                        <tr><td width="100">Town:</td><td class="last"><?php echo $user_details['drg_town']; ?></td></tr>
                    </table>
                </td>
                <td>
                	<table width="100%" align="center">
                    	<tr><td width="100">County:</td><td class="last"><?php echo $user_details['drg_county']; ?></td></tr>
                        <tr><td width="100">Zip Code:</td><td class="last"><?php echo $user_details['drg_zip']; ?></td></tr>
                        <tr><td width="100">Contry:</td><td class="last"><?php echo $user_details['drg_country']; ?></td></tr>
                        <tr><td width="100">Tel No:</td><td class="last"><?php echo $user_details['drg_phone']; ?></td></tr>
                        <tr><td width="100">Fax No:</td><td class="last"><?php echo $user_details['co_fax']; ?></td></tr>
                    </table>
                </td>
            </tr>
        </table>
         </div>
       
        <?php
       /* $form = $this->beginWidget('CActiveForm', array(
            'id' => 'blisting-form',
            'enableAjaxValidation' => false,
        ));
		*/
        $form=$this->beginWidget('CActiveForm', array('id'=>'businesslisting-form','enableAjaxValidation'=>false, 'htmlOptions'=>array('onSubmit'=>'return form_validation();')));
		 echo $form->errorSummary($model);
     	?>
        <div> <!-- Listing type drop down menu starts here -->     
            <div class="slisting-head">
                <p>Listing type<a class="sl-tip tooltip" href="#;">?<span class="classic">Please select a listing type from each drop down menu to continue</span></a></p>
            </div> <!-- /slisting-head -->
            <table class="slisting-head">
                <tr>
                    <td>Category:</td>
                    <td>
                        <?php
                        $listingCategory = CHtml::listData(Listingcategory::model()->findAll(), 'list_category_id', 'list_category_name');
                        echo $form->dropDownList($model, 'drg_category', $listingCategory, array('prompt' => 'Please Select', 'class' => 'chzn-select', 'data-placeholder' => 'Please select', 'onfocus' => 'getSelectNormal("#sl_category");', 'id' => 'sl_category'));
                        echo $form->error($model, 'drg_category');
                        ?>
                    </td>
                    <td class="sl-select-space" style="width:74px;"></td>

                    <td>Looking For:</td>
                    <td>
                        <?php
                        $listData = CHtml::listData(Listinglookingfor::model()->findAll(array("order" => 'sort_order asc')), 'lookingfor_id', 'lookingfor_name');
                        echo CHtml::dropDownList('Userlisting[drg_profession]', $model->drg_profession, $listData, array('empty' => 'Please select', 'class' => 'chzn-select', 'data-placeholder' => 'Please select', 'onfocus' => 'getSelectNormal("#sl_profession");', 'id' => 'sl_profession', 'title' => 'Select a what you are looking for from the list'));
                        echo $form->error($model, 'drg_profession');
                        ?> 
                    </td>
                    <td class="sl-select-space" style="width:74px;"></td>

                    <td>Limit viewing to:</td>
                    <td>
                 
                        <?php
							//$viewlimit = CHtml::listData(Viewlimit::model()->findAll(),'limit_view_id','limit_view');
							$viewlimit = CHtml::listData(Country::model()->findAll(),'country_id','country');
							echo $form->dropDownList($model,'drg_viewlimit',$viewlimit,array('prompt' => 'Worldwide (default)','class'=>'chzn-select','tabindex'=>'3','data-placeholder'=>'Worldwide (default)','onfocus'=>'getSelectNormal("#sl_vlimit");','id'=>'sl_vlimit'));
							echo $form->error($model,'drg_viewlimit');
						?>

                    </td>
                </tr>
            </table> <!-- /Table slisting-head -->
        </div>	
        <div style="margin-bottom: 3px;">
            <label style="color:#A47A8F;">Upload photographs <a class="sl-tip tooltip" href="#;">?<span class="classic">Select and upload five images in one of the following formats:- BMP, JPEG, PNG, GIF<br> Please NOTE image size MUST NOT exceed 6"x4" otherwise cropping will occur.</span></a></label>
        </div>
        <?php 
			 $userimage = Businesslistingimages::model()->findAllByAttributes(array("drg_blid" => $model->drg_blid));
			
			 $username = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); 
			 
		 $userfolder = $username[0]['drg_username']."_".$username[0]['drg_id'];
							
					?>
        <?php for($i=1; $i<=5; $i++)  { ?>
        <div class="sl-photo-box admin-photo" style="margin:0; text-align:center">
                <div class="clear"></div>
                <br>
                <div class="sl-photograph image_preview">
                    
                    <?php
                    if ($userimage[$i - 1]['drg_listing_image'] != '') { 
                        
						$img_src =  Yii::app()->baseUrl.'/upload/users/' .$userfolder .'/listing/big/'. $userimage[$i - 1]['drg_listing_image'];
						
                        ?>
                        <div id="preview_logo_<?php echo $i; ?>"><img src="<?php echo $img_src;?>" style="height:140px;" /></div>
                        <input type="hidden" name="img_name[]" value="<?php echo $userimage[$i - 1]['drg_listing_image']; ?>" id="logo_<?php echo $i; ?>" />
                        <?php
                    } else {
                        ?>
                        <div id="preview_logo_<?php echo $i; ?>"></div>
                        <input type="hidden" name="img_name[]" value="" id="logo_<?php echo $i; ?>" />
                        <?php
                    }
                    ?>								
                </div>
                <!-- File Upload for Company Logo -->
            </div>
            
        <?php } ?>
        
        <br class="clear" />
        <br class="clear" />
        <div class="slisting-head">
            <p>Enter a short description for each image <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter a short description explaining each image. Please note text is limited to 4 lines.</span></a></p>
        </div>
        <div class="sl-image-description admin-description">
            
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="img_desc img_desc_text">
                    <textarea rows="2" cols="9" class="drg_imgdesc" name="drg_imgdesc[]" id="image-description-<?php echo $i; ?>" maxlength="80"><?php echo $userimage[$i - 1]['drg_imgdesc']; ?></textarea>
                    <br>
                    Image <?php echo $i; ?> text
                </div>
                <!-- <?php echo $i; ?>Image text -->
            <?php } ?>  
             <br class="clear" />
        </div>
        <br class="clear" />
        <br class="clear" />
      
        <div style="margin-bottom: 10px;">
            <label style="color:#A47A8F;">Upload Videos <a class="sl-tip tooltip" href="#;">?<span class="classic">Upload your business videos in 3gp, avi, mpeg, mpg, mov, m4a, mj2, flv, wmv, mp4, ogg or webm formats only.<br>Long videos can be heavy going, so make your video short sharp and to the point and aim to get your main points across in 60 seconds or less.</span></a></label>
        </div>
        <?php
        $uservideo = Businesslistingvideos::model()->findAllByAttributes(array("drg_blid" => $model->drg_blid));
//print_r($uservideo);
        $k = 0;
        for ($j = 1; $j <= 2; $j++) {
            
            ?>
            <div class="video-upload-box<?php echo $j; ?>" id="video-upload-box-tab">
                <img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
                <div class="my-account-popup-box" id="upload-frame"> 
                    <a class="pu-close" onclick='jQuery(".video-upload-box<?php echo $j; ?>").hide();' href="javaScript:void(0)" title="Close">X</a>
                    <h2>Upload user listing video</h2>
                    Click <b>Browse...</b> to select a picture from your computer<br />
                    Click <b>Upload Video</b> to save your video and close this dialog box
                    <br /><br />
                    <!-- <iframe src="video-upload/step_1.php?id=<?php echo $j; ?>" frameborder="0" width="390" height="340" id="pic_frame_<?php echo $j; ?>"></iframe>-->
                </div>
            </div>  

            <div class="sl-photo-box" style="margin:<?php
            if ($j == 1) {
                echo '0 0 30px 80px;';
            } else {
                echo '0 0 30px 80px;';
            }
            ?> width:360px;">
                <div class="clear"></div>
                <br>
                <div id="preview-<?php echo $j; ?>" class="sl-photograph video_preview" style="margin-left: 90px;">                                   
                    <?php
                    $uservideoname = "";
                    $drg_videodesc = "";
                    if ($uservideo[$k]->drg_listing_video != "") {
                        $uservideoname = $uservideo[$k]->drg_listing_video;
                        $drg_videodesc = $uservideo[$k]->drg_videodesc;
                    }
                    ?>
                    <div id="show-<?php echo $k; ?>" > 
                        <input type="hidden" name="drg_videos[]" value="<?php echo $uservideoname; ?>" id="video-<?php echo $j; ?>" />  
                    </div>
                    <input type="hidden" name="drg_old_videos[]" value="<?php echo $uservideoname; ?>"/>
                </div>

                <div id="ova-example-player-container_<?php echo $j; ?>" class="video_player_container" style="">
                    <div id="ova-example-player_<?php echo $j; ?>" style="position:relative;">
                        <div id="ova-player-instance_<?php echo $j; ?>" loaded="false" class="video_player_instances" style=""> 
                            <!-- SELECTED PLAYER INSTANCE GOES IN HERE -->
                        </div>
                        <?php
                        if ($uservideoname != "") {
                            ?> <script language="javascript">
        						jwplayer("ova-player-instance_<?php echo $j; ?>").setup({
        						flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
        						file: '<?php echo Yii::app()->baseUrl; ?>/upload/users/<?php echo $userfolder;?>/videos/<?php echo $uservideoname; ?>',
                            // image: "http://business-supermarket.com/themes/business/images/video_icon.jpg",
        						height: 260,
        						width: 338,
        						});
                            </script>  
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <br />
                <div id="progressbox_<?php echo $j; ?>" class="progressbox" style="display:none;">
                    <div class="uploading_<?php echo $j; ?>"> Uploading ....</div>
                    <div id="progressbar_<?php echo $j; ?>" class="progressbar" ></div >
                    <div id="statustxt_<?php echo $j; ?>" class="statustxt" >0%</div>                                    
                </div>

                <div id="progressstatus_<?php echo $j; ?>" class="progressstatus" style="display:none;"></div>

                <p class="slisting-head">Video <?php echo $j; ?> (Meet the company) <a class="sl-tip tooltip" href="#;">?<span class="classic">Potential investors want to know the person behind the business; your skills, how you present yourself, your experience and credibility, all play a vital role if you wish to see your business idea succeed.<br><br /></span></a></p>

                <input value="<?php echo $drg_videodesc; ?>" type="text" name="drg_videodesc[]" id="fileName<?php echo $j; ?>" class="file_input_textbox" style="width:335px;" />
                <div class="clear"></div>
                <!-- File Upload for Company Logo -->
                <div style="margin-top:20px; margin-bottom:50px; text-align:center;">  
                    <?php 
                    if($uservideoname !=""){
                    ?>
                        <a class="button gray" title="Upload logo" href="<?php echo Yii::app()->baseUrl;?>/admin/blisting/blisting/downloadvideo?file=<?php echo $uservideoname; ?>" > &nbsp; Download Video<?php echo $j; ?> &nbsp;</a> 
                    <?php 
                    }else {
                    ?>   
                        <a class="button gray" title="Upload logo" href="#" onclick="alert('Video file not exist..');"> &nbsp; Download Video<?php echo $j; ?> &nbsp;</a>       
                    <?php    
                    }
                    ?>
                    <div class="upload_video_res_<?php echo $j; ?>"></div>
                    <div id="loading_<?php echo $j; ?>" style="display: none;"><img src="loading.gif"></div> 

                </div>
                <p class="slisting-head">Video <?php echo $j; ?> (YouTube link) <a class="sl-tip tooltip" href="#;">?<span class="classic">YouTube link place.<br><br /></span></a></p>

                <?php echo $form->textField($model, 'drg_video' . $j, array('size' => 60, 'maxlength' => 200)); ?>
                <?php echo $form->error($model, 'drg_video' . $j); ?>


            </div> 
            <?php
           $k++; 
        }
        ?>
	<div style="clear:both; height:20px;"></div>
	 <br class="clear" />
     <br class="clear" />	
     	<div class="sl-basic-info pro-field" style="width:700px; margin-left:24px;">
            <label>Company slogon <a href="#;" class="sl-tip tooltip">?<span class="classic">Enter your business slogan.</span></a></label>
            <br>
            <?php echo $form->textField($model, 'drg_slogon', array('class' => 'inp width-500', 'id' => 'slogon', 'onfocus' => "getNormal('#drg_list_title');")); ?>
            <br>
            <label>Who we are<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter full details of your business activities, services, history etc.</span></a></label>
            <br>
            <?php
            echo $form->textArea($model, 'drg_whoweare', array('size'=>60,'id'=>'whoweare','class'=>'textarea-full','style'=>'height:100px', 'onfocus' => "getNormal('#drg_list_what');"));
            ?>

            <br>
            <label>What we offer.<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter details of what your business has to offer including any special offers to new businesses.</span></a></label>

            <?php echo $form->textArea($model, 'drg_offer', array('size'=>60,'id'=>'offer','class'=>'textarea-full','style'=>'height:70px', 'onfocus' => "getNormal('#drg_list_explanation');",)); ?>

        </div>
          <div class="sl-basic-info" style="width:100% !important; margin-left:24px;">
            
            <br/>
                        
            
            <div class="sl-basic-info" style="width:96.5% !important;">
                <label>Customer testimonail.<a href="#;" class="sl-tip tooltip">?<span class="classic">Are you looking to sell your idea?<br>Are you looking for a partner or an investor?<br>Do you want to license your idea?<br></span></a></label>

<?php //echo $form->textArea($model, 'drg_testimonial', array('id' => 'testimonial', 'class' => 'textarea-full', 'style' => 'height:100px;', 'onfocus' => "getNormal('#drg_list_detail');",)); ?>
          
         <?php echo $form->textArea($model,'drg_testimonial',array('class'=>'textarea-full', 'id'=>'testimonial', 'style'=>'height:100px',)); ?>
		          <?php echo $form->error($model,'drg_testimonial'); ?>	</div>
				  
          
            </div>
        </div>
        <div class="sl-basic-info" style="width:96.5% !important; margin-left:24px;">
            <label>Enter keywords for our search engine.<a href="#;" class="sl-tip tooltip">?<span class="classic">Be specific in the choice of your keywords. <br>A few well chosen descriptive words give better response than a large block of text that could make it difficult for you to attract the right kind of interest.<br>Separate each word with a comma and a space. </span></a></label>
<?php echo $form->textArea($model, 'drg_keyword', array('id' => 'keyword', 'class' => 'textarea-full', 'style' => 'height:100px;', 'onfocus' => "getNormal('#drg_list_businessidea');",)); ?>

        </div>
      
        	<br class="clear" />
        <br class="clear" />
          <div class="sl-bottom-buttons admin-button">
          
          
        <!--<a href="<?php echo Yii::app()->createUrl('/admin/blisting/blisting/delete', array('id' => $model->drg_blid)); ?>" class="button red">Delete</a>-->
            <?php  if ($model->drg_blistingstatus == 3) { ?>
                <a href="<?php echo Yii::app()->createUrl('/admin/blisting/blisting/restore', array('id' => $model->drg_blid)); ?>" class="button pink">Restore</a>

                <?php
            } else {
                ?>
                <a href="javaScript:void(0)" onClick="delete_confirm()"  class="button red">Delete</a></td>
<?php } ?>
            <a href="javaScript:void(0)" onClick="show_reject_form()"  class="button orange">Reject</a></td>
                   <!--  <a href="javaScript:void(0)" onClick="show_email_form()" class="button blue">Update</a></td>-->
                      <a href="javaScript:void(0)" onClick="validform()"  class="button blue">Update</a>
            <?php
            if ($model->drg_blistingstatus == 1) {
                ?>
                <a href="javaScript:void(0)" onClick="show_suspension_form()" class="button black">Suspend</a></td>
                <?php
            } else {
                ?>
                <a href="<?php echo Yii::app()->createUrl('/admin/blisting/blisting/publish', array('id' => $model->drg_blid)); ?>" class="button green">Publish</a>
   <?php } ?>	
   		<div class="clear"></div>
        </div>
	
        <div class="row buttons">
<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>
        <!--- Update User Listing --->
        <div class="update-email-box big-popup" style="display: none;">
            <div id="terms-conditions" class="u-email-box">
                <div class="my-account-popup-box"> 
                    <a title="Close" href="javaScript:void(0)" onclick="close_email_form()" class="pu-close">X</a>
                    <h2>User listing update notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                    <h3><span class="fltL">User: <span><?php echo $userdetails[0]['drg_name']; ?></span></span> <span class="fltR">Listing title: <span><?php echo $model['drg_slogon']; ?></span></span></h3>
                    <div id="email_error" class="error_msg"></div>

                    <table id="reg-table" style="width: 100%;">
                        <tr>
                            <th class="black-text">Details of changes made</th><br/>
                        </tr>
                        <tr><td><?php echo $model['drg_slogon']; ?></td></tr>
                      
                    </table>
                    <div class="confirmbtn">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Sumbit', array('class' => 'button black', 'name' => 'update')); ?>
                    </div>

                </div>
            </div>
        </div>
        
        
        

		<?php $this->endWidget(); ?>
        <div class="admin-popup">
        <div class="show_reject_form big-popup" style="display: none;">
            <form action="<?php echo Yii::app()->createUrl('/admin/blisting/blisting/rejection', array('id' => $model->drg_blid)); ?>" method="post">
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_reject_form()" class="pu-close">X</a>
                        <h2>User listing rejection notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                        <h3><span class="fltL">User: <span><?php echo $userdetails[0]['drg_name']; ?></span></span><span class="fltR">Listing title: <span><?php echo $model['drg_slogon']; ?></span></span></h3>
                        <div id="email_error" class="error_msg"></div>

                        <table id="reg-table" style="width: 100%;">
                            <tr>
                                <th  class="black-text">Reason for rejection</th>
                            </tr>
                            <tr>
                                <th>
                                    <textarea rows="4" cols="50" name="rejectval">
Text entered here by admin appears here
                                    </textarea>
                                </th>

                            </tr>

                        </table>
                        <div class="confirmbtn">
                                            <!--<a href="<?php echo Yii::app()->createUrl('/admin/blisting/blisting/rejection', array('id' => $model->drg_blid)); ?>" class="button black">Sumbit</a>-->
                            <input type="submit" name="rejection" value="Submit" class="button black" />
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <div class="show_publish_form" style="display: none;">
            <form action="<?php echo Yii::app()->createUrl('/admin/blisting/blisting/publish', array('id' => $model->drg_blid)); ?>" method="post">
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_publish_form()" class="pu-close">X</a>
                        <h2>User listing publish notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                        <h3>User:<?php echo $userdetails[0]['drg_name']; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;              Listing title:<?php echo $model['drg_slogon']; ?></h3>
                        <div id="email_error" class="error_msg"></div>

                        <table id="reg-table" style="width: 100%;">
                            <tr>
                                <th  class="darkGrey-text">Notification of publish</th>
                            </tr>
                            <tr>
                            <input type="hidden" name="listing_title" value="<?php echo $model['drg_slogon']; ?>">
                            <th>
                                <textarea rows="4" cols="50" name="publishval">
Text entered here by admin appears here
                                </textarea>
                            </th>

                            </tr>

                        </table>
                        <span class="middle"> 
                            <input type="submit" name="publish" value="Submit" class="button black" />
                        </span>

                    </div>
                </div>
            </form>
        </div>
        <div class="show_suspension_form big-popup" style="display: none;">
            <form action="<?php echo Yii::app()->createUrl('/admin/blisting/blisting/suspension', array('id' => $model->drg_blid)); ?>" method="post">
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_suspension_form()" class="pu-close">X</a>
                        <h2>User listing suspension notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                        <h3><span class="fltL">User: <span><?php echo $userdetails[0]['drg_name']; ?></span></span> <span class="fltR"> Listing title: <span><?php echo $model['drg_slogon']; ?></span></span></h3>
                        <div id="email_error" class="error_msg"></div>

                        <table id="reg-table" style="width: 100%;">
                            <tr>
                                <th  class="darkGrey-text">Notification of suspension</th>
                            </tr>
                            <tr>
                            <input type="hidden" name="listing_title" value="<?php echo $model['drg_slogon']; ?>">
                            <th>
                            <tr>

                                <th>
                                    <textarea rows="4" cols="50" name="suspensionval">
Text entered here by admin appears here
                                    </textarea>
                                </th>

                            </tr>

                        </table>
                        <div class="confirmbtn">
                                        <input type="submit" name="suspension" value="Submit" class="button black" />
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="show_delete_form big-popup" style="display: none;">
            <form action="<?php echo Yii::app()->createUrl('/admin/blisting/blisting/rdelete', array('id' => $model->drg_blid)); ?>" method="post">
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_delete_form()" class="pu-close">X</a>
                        <h2>User listing deletion notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                        <h3><span class="fltL">User:<span><?php echo $userdetails[0]['drg_name']; ?></span></span><span class="fltR">Listing title:<span><?php echo $model['drg_slogon']; ?></span></span></h3>
                        <div id="email_error" class="error_msg"></div>

                        <table id="reg-table" style="width: 100%;">
                            <tr>
                                <th  class="black-text">Reason for deletion</th>
                            </tr>
                            <tr>
                                <th>
                                    <textarea rows="4" cols="50" name="deletionval">
Text entered here by admin appears here
                                    </textarea>
                                </th>

                            </tr>

                        </table>
                        <div class="confirmbtn">
                            <input type="submit" name="delete" value="Submit" class="button black" />
                        </div>

                    </div>
                </div>
            </form>
        </div>
        
        
         <div class="delete_confirm black-popup" style="display: none;">

        <div id="terms-conditions" class="u-email-box">
            <div class="my-account-popup-box"> 
                <h1 style="color:black;  text-align: center; font-size:20px;">WARNING</h1><br/>
                <span>Are you sure you want to move this listing to the recycle bin?</span><br/>
                <span>This listing will be totally removed off the server in 7 days</span><br/>
                <span>After 7 days you will NOT be able to recover this listing.</span>
                <div class="confirmbtn">
                    <button onClick="deleteDilog()">OK</button>&nbsp;&nbsp;&nbsp;&nbsp;<button onClick="jQuery('.delete_confirm').hide();
        return false;">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <div class="delete_confirm1 black-popup" style="display: none;">

        <div id="terms-conditions" class="u-email-box">
            <div class="my-account-popup-box"> 
                <span>Are you sure you want to delete this listing from the website?</span><br/>
                <span>Warning this action cannot be undone</span><br/>

                <div class="confirmbtn">
                    <button onClick="jQuery('.delete_confirm1').hide();
        jQuery('.show_delete_form').fadeIn();
        return false;">OK</button>&nbsp;&nbsp;&nbsp;&nbsp;<button onClick="jQuery('.delete_confirm1').hide();
        return false;">Cancel</button>
                </div>
            </div>
        </div>
    </div>

        </div>
        
        </div>
        
        
     </div>

 

<script type="text/javascript">
    function delete_confirm()
    {
        jQuery(".delete_confirm").fadeIn();
    }
    function deleteDilog()
    {
        jQuery(".delete_confirm").hide();
        jQuery(".delete_confirm1").fadeIn();
    }

    jQuery(document).ready(function() {
        jQuery(".show_reject_form").hide();
        jQuery(".show_delete_form").hide();
        jQuery(".show_suspension_form").hide();
        jQuery(".show_publish_form").hide();
        jQuery(".delete_confirm").hide();
        jQuery(".delete_confirm1").hide();
    });
    // show email form
    function show_email_form()
    {
        jQuery(".update-email-box").fadeIn();
    }
    function close_email_form() {
        jQuery(".update-email-box").fadeOut();

    }
    function show_reject_form()
    {
        jQuery(".show_reject_form").fadeIn();
    }
    function close_reject_form()
    {
        jQuery(".show_reject_form").fadeOut();
    }
    function show_delete_form()
    {
        jQuery(".show_delete_form").fadeIn();
    }
    function close_delete_form()
    {
        jQuery(".show_delete_form").fadeOut();
    }
    function show_suspension_form()
    {
        jQuery(".show_suspension_form").fadeIn();
    }
    function close_suspension_form()
    {
        jQuery(".show_suspension_form").fadeOut();
    }
    function show_publish_form()
    {
        jQuery(".show_publish_form").fadeIn();
    }
    function close_publish_form()
    {
        jQuery(".show_publish_form").fadeOut();
    }
	
	
	var checkForFinance = false;
jQuery('.financial input').click(function(){
	if(jQuery('.amountselect input[name="drg_famount"]:checked').length){
		jQuery('.amountselect input').prop('checked', false);                
	}
        checkForFinance = false;
        if(jQuery('.no_financeData input[type="text"]').hasClass('mandatoryerror')){
            jQuery('.no_financeData input[type="text"]').removeClass('mandatoryerror');
        }
	jQuery('.no_financeData input[type="text"]').attr({'disabled':'disabled','placeholder':''});
        jQuery('.no_financeData input[type="text"]').css({'background':'#F0F0F0'});
});

jQuery('.amountselect input').click(function(){
	if(jQuery('.financial input[name="drg_financial_data"]:checked').length){
		jQuery('.financial input').prop('checked', false);		
	}
        checkForFinance = true;
	jQuery('.no_financeData input[type="text"]').removeAttr('disabled');
        jQuery('.no_financeData input[type="text"]').css({'background':'#F1E5E2'});
});



<!--
    // Advert Carousel
    var JQ1 =jQuery.noConflict(); 
 
     
         
      //form validations
	function validform(){
		var failedvalidation = false;
/*
	for(var i=1;i<=5;i++){            
	
		if(JQ1('#image-description-'+i).val() == "")
		{
			JQ1('#image-description-'+i).addClass('mandatoryerror');
			JQ1('#image-description-'+i).attr('placeholder','Please enter image description');
			failedvalidation = true;            	
		}
		else
		{
			JQ1('#image-description-'+i).removeClass('mandatoryerror');
			JQ1('#image-description-'+i).attr('placeholder','');
           
		}
        	if(JQ1('#image-description-'+i).val()=='Please enter image description'){
			JQ1('#image-description-'+i).val('');
		}
	
	
	}*/



		
		JQ1('.select_error').remove();	
				
		/**	@validation for listing category */
	var sl_category = JQ1('#sl_category option:selected').val();
	if(sl_category == ""){
		JQ1("#sl_category").siblings().addClass('mandatoryerror');
		JQ1("#sl_category").siblings().css('border-radius','5px');
		var sibling_id = JQ1("#sl_category").siblings().attr('id');
		JQ1('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		JQ1("#sl_category").siblings().removeClass('mandatoryerror');
		JQ1("#sl_category").siblings().css('border-radius','0');
	}

	/**	@validation for listing profession */
	var sl_profession = JQ1('#sl_profession option:selected').val();
	if(sl_profession == ""){
		JQ1("#sl_profession").siblings().addClass('mandatoryerror');
		JQ1("#sl_profession").siblings().css('border-radius','5px');
		var sibling_id = JQ1("#sl_profession").siblings().attr('id');
		JQ1('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		JQ1("#sl_profession").siblings().removeClass('mandatoryerror');
		JQ1("#sl_profession").siblings().css('border-radius','0');
	}


      
		/** @check address1 empty or not */
		var category = JQ1('#profession').val();
		if(category == ""){                
			JQ1("#profession").addClass('mandatoryerror');
			JQ1("#profession").attr('placeholder','Please enter your profession');             
			failedvalidation = true;            
		}else{
			JQ1("#profession").removeClass('mandatoryerror');
			JQ1("#profession").attr('placeholder','');
		}
		
		var slogon = JQ('#slogon').val();
		if(slogon == "")
		{
			JQ1("#slogon").addClass('mandatoryerror');
			JQ1("#slogon").attr('placeholder','Please enter company slogon');
			failedvalidation = true;            	
		}
		else
		{
			JQ1("#slogon").removeClass('mandatoryerror');
			JQ1("#slogon").attr('placeholder','');
		}
		/** @check town empty or not */
		var whoweare = JQ1('#whoweare').val();
		if(whoweare == ""){                
			JQ1("#whoweare").addClass('mandatoryerror');
			JQ1("#whoweare").attr('placeholder','Please enter who we are');             
			failedvalidation = true;            
		}else{
			JQ1("#whoweare").removeClass('mandatoryerror');			
			JQ1("#whoweare").attr('placeholder','');
		}
		/** @check county empty or not */
		var offer = JQ1('#offer').val();
		if(offer == ""){                
			JQ1("#offer").addClass('mandatoryerror');
			JQ1("#offer").attr('placeholder','Please write what we offer');             
			failedvalidation = true;            
		}else{
			JQ1("#offer").removeClass('mandatoryerror');
			JQ1("#offer").attr('placeholder','');
		}
		/** @check zip_code empty or not */
		var keyword = JQ1('#keyword').val();
		if(keyword == ""){                
			JQ1("#keyword").addClass('mandatoryerror');
			JQ1("#keyword").attr('placeholder','Please enter your keyword');             
			failedvalidation = true;            
		}else{
			JQ1("#keyword").removeClass('mandatoryerror');
			JQ1("#keyword").attr('placeholder','');
		}
		/** @check tel_no empty or not */
		var tel_no = JQ1('#testimonial').val();
		if(tel_no == ""){                
			JQ1("#testimonial").addClass('mandatoryerror');
			JQ1("#testimonial").attr('placeholder','Please enter your testimonial');             
			failedvalidation = true;            
		}else{
			JQ1("#testimonial").removeClass('mandatoryerror');
			JQ1("#testimonial").attr('placeholder','');
		}

		if (failedvalidation){
			JQ1('#submit_user_listing_step1').val(0);
            return false;
		}else{
		  
			//JQ1("#businesslisting-form").submit();
            //jQuery('#submit_user_listing_step1').val(1);
             JQ1(".update-email-box").fadeIn();
            
		}	
        
        
        
	}
    jQuery(document).ready(function(){
       jQuery(".pu-close1").live("click",function(){
            jQuery(".confirm").show();
        })
            
        close_form(); 
    });
    
    function close_form()
    {   JQ1(".confirm").hide();
    }
    
    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value=1;
        document.getElementById("businesslisting-form").submit();       
    }	
  //--></script>
  
  
  
  
  <script type="text/javascript"> 
 
     tinymce.init({
        selector: "#testimonial",
        plugins: [
            "advlist autolink lists link  charmap  preview anchor",
            "searchreplace visualblocks  ",
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });  
    
    jQuery(document).ready(function(){
       jQuery(".pu-close1").live("click",function(){
            jQuery(".confirm").show();
        })
            
        close_form(); 
    });
    
    function close_form()
    {   jQuery(".confirm").hide();
    }
    
    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value=1;
        document.getElementById("business_listing_step4").submit();       
    }
</script>