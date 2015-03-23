<?php
$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');
$js->registerScriptFile($baseUrl . '/js/tinymce.min.js');


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
.black-popup{
position: fixed;
    top: 20%;
    left: 35%;
    z-index: 99999999;    
}  

.my-account-popup-box{
position: fixed;
    top: 20%;
    left: 35%;
    z-index: 99999999;	
	
}
.user_info_container {
    right: 0px !important;
}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tooltips.css" />  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/adminstyle.css" />
<div class="user_info_container">
        <ul>
          <li><?php echo SharedFunctions::get_user_names($row->drg_uid);?>
            <label class="field">Registered users:</label>
            <strong><?php 	echo 	User::model()->count(); ?></strong></li>
          <li>
            <label class="field">Users Online:</label>
           <strong><?php 	echo 	Listings::model()->count(); ?></strong></li>
          <li>
            <label class="field">Listing submissions:</label>
       <strong><?php 	echo 	Listings::model()->count(); ?></strong></li>
          <li>
            <label class="field">Active listings:</label>
               <strong><?php
			  echo    $count = Listings::model()->count( 'drg_listingstatus=:userid', array(':userid' => 1));
 ?></strong></li>
        </ul>
</div>

<div id="registration-tabs"> 
    <a class="active" href="javascript:void(0);" data-active="details">Details</a> 
    <a href="javascript:void(0);" data-active="sample">Samples</a>   
    <a href="javascript:void(0);" data-active="forum">Forum</a>   
    <a href="javascript:void(0);" data-active="marketing">Marketing data</a>   
    <a href="javascript:void(0);" data-active="portfolio">Portfolio</a>   
    <a href="javascript:void(0);" data-active="admin">Admin Tools</a>                  
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

 
<br>
    <div class="form">
   
      <h2 align="center" class="Blue" style="margin:6px 0;"><?php echo $model['drg_title']; ?></h2> 
<p style="text-align:center">Listing number : <?php echo $model->drg_lid; ?></p>
        <div class="companydetails">
            <table class="center-table" width="550" align="center">
                <tr>
                    <td>
<?php
$uid=$model['drg_uid'];
$connection = Yii::app()->db;
$command = $connection->createCommand("select * from `drg_user` where `drg_uid`='$uid'");
$myresult = $command->queryRow();

$cid=$model['drg_company_country'];
$command1 = $connection->createCommand("select * from `drg_country` where `country_id`='$cid'");
$myresult1 = $command1->queryRow();
?>
                        <table width="100%" align="center">
                            <tr><td width="100" class="tbl1">Name:</td><td class="last"  id="tbl2"><?php echo $myresult['drg_name']; ?></td></tr>
                            <tr><td width="100" class="tbl1">Username:</td><td class="last" id="tbl2"><?php echo $myresult['drg_username']; ?></td></tr>
                            <tr><td width="100" class="tbl1">Email:</td><td class="last" id="tbl2"><?php echo $myresult['drg_email']; ?></td></tr>
                            <tr><td width="100" class="tbl1">Company Name:</td><td class="last" id="tbl2"><?php echo $model['drg_company_name']; ?></td></tr>
                            <tr><td width="100" class="tbl1">Tel No:</td><td class="last" id="tbl2"><?php echo $model['drg_company_tel_no']; ?></td></tr>
                            <tr><td width="100" class="tbl1">Website:</td><td class="last" id="tbl2"><?php echo $model['drg_company_town']; ?></td></tr>
                        </table>
                    </td>
                    <td>
                        <table width="100%" align="center">
                            <tr><td width="100" class="tbl1">Address 1:</td><td class="last" id="tbl2"><?php echo $model['drg_company_address1']; ?></td></tr>
                            <tr><td width="100" class="tbl1">Address 2:</td><td class="last" id="tbl2"><?php echo $model['drg_company_address2']; ?></td></tr>
                            <tr><td width="100" class="tbl1">Address 3:</td><td class="last" id="tbl2"><?php echo $model['drg_company_address3']; ?></td></tr>
                            <tr><td width="100" class="tbl1">County:</td><td class="last" id="tbl2"><?php echo $model['drg_company_county']; ?></td></tr>
                            <tr><td width="100" class="tbl1">Zip code:</td><td class="last" id="tbl2"><?php echo $model['drg_company_zip_code'] ?></td></tr>
                            <tr><td width="100" class="tbl1">Country:</td><td class="last" id="tbl2"><?php echo $myresult1['country'] ?></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        
      <?php /*?>  <table width="200" align="center">
            <tr><td width="100">Company name:</td><td><?php echo $model['drg_company_name']; ?></td>
            <tr><td width="100">Address1:</td><td><?php echo $model['drg_company_address1']; ?></td></tr>
            <tr><td width="100">Address2:</td><td><?php echo $model['drg_company_address2']; ?></td></tr>
            <tr><td width="100">Address3:</td><td><?php echo $model['drg_company_address3']; ?></td></tr>

            <tr><td width="100">County:</td><td><?php echo $model['drg_company_county']; ?></td></tr>
            <tr><td width="100">Zip Code:</td><td><?php echo $model['drg_company_zip_code']; ?></td></tr>
            <tr><td width="100">Contry:</td><td><?php echo $model['drg_company_country']; ?></td></tr>
            <tr><td width="100">Tel No:</td><td><?php echo $model['drg_company_tel_no']; ?></td></tr>
            <tr><td width="100">Fax No:</td><td><?php echo $model['drg_company_fax_no'] ?></td></tr>
        </table><?php */?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'listings-form',
            'enableAjaxValidation' => false,
			//'htmlOptions'=>array("onSubmit"=>'return listing_validation();'),
        ));
        ?>
        <?php echo $form->errorSummary($model); ?>

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
      
		  $userimage = Userlistingimages::model()->findAllByAttributes(array("drg_lid" => $model->drg_lid)); 
	  	
          $username = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid));  
            
          $userfolder = $username[0]['drg_username'].'_'.$username[0]['drg_id'];
          
	         
           for ($i = 1; $i <= 5; $i++) {
            ?>
            <div class="photo-upload-box<?php echo $i; ?>" id="photo-upload-box-tab">
                <img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
                <div class="my-account-popup-box" id="upload-frame"> 
                    <a class="pu-close" onclick='$(".photo-upload-box<?php echo $i; ?>").hide();' href="javaScript:void(0)" title="Close">X</a>
                    <h2>Upload user listing picture</h2>
                    Click <b>Browse...</b> to select a picture from your computer<br />
                    Click <b>Preview Picture</b> to see a thumbnail of your image<br />
                    Click <b>Upload Picture</b> to save your profile picture and close this dialog box.<br />
                    <br /> 
                </div>
            </div>
            <div class="sl-photo-box admin-photo" style="margin:0; text-align:center">
                <div class="clear"></div>
                <br>
                <div class="sl-photograph image_preview">
                    
                    <?php
                    if ($userimage[$i - 1]['drg_listing_image'] != '') {
                        //$img_src='../users/'.$user->get_log_folder($userimage['drg_uid']).'/listing/thumb/'.$data[$i-1]['drg_listing_image'];
                        //$img_src = Yii::app()->baseUrl.'/upload/users/' . Yii::app()->user->getState('ufolder') . $userfolder.'/listing/big/' . $userimage->drg_listing_image;
                       $img_src =  Yii::app()->baseUrl.'/upload/users/' .$userfolder .'/listing/thumb/'. $userimage[$i - 1]['drg_listing_image'];
                       
                       ?>
                        <div id="preview_logo_<?php echo $i; ?>">
                            <img src="<?php echo $img_src; ?>" alt=""/>
                        </div>
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
            <?php
            $userimage = Userlistingimages::model()->findAllByAttributes(array("drg_lid" => $model->drg_lid));
            ?>
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
        $uservideo = Userlistingvideos::model()->findAllByAttributes(array("drg_lid" => $model->drg_lid));
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

if($j=="1")
{
$vid=$model->drg_video1;
}
else if($j=="2")
{
$vid=$model->drg_video2;
}
$path = $_SERVER['DOCUMENT_ROOT'].'/'; 
                    $uservideoname = "";
                    $drg_videodesc = "";
                    if ($uservideo[$k]->drg_listing_video != "") {
                        $uservideoname = $uservideo[$k]->drg_listing_video;
                        $drg_videodesc = $uservideo[$k]->drg_videodesc;
                    }

$apath= $path."upload/users/".$userfolder."/videos/".$uservideoname;
                    ?>
                    <div id="show-<?php echo $k; ?>" > 
                        <input type="hidden" name="drg_videos[]" value="<?php echo $uservideoname; ?>" id="video-<?php echo $j; ?>" />  
<input type="hidden" name="drg_vid_<?php echo $j; ?>" value="<?php echo $uservideoname; ?>" id="video-<?php echo $j; ?>" /> 
                    </div>
                    <input type="hidden" name="drg_old_videos[]" value="<?php echo $uservideoname; ?>"/>
                </div>

                <div id="ova-example-player-container_<?php echo $j; ?>" class="video_player_container" style="">
                    <div id="ova-example-player_<?php echo $j; ?>" style="position:relative;">
                        <div id="ova-player-instance_<?php echo $j; ?>" loaded="false" class="video_player_instances" style=""> 
                            <!-- SELECTED PLAYER INSTANCE GOES IN HERE -->
                        </div>
                        <?php
                        if (file_exists($apath)) {
if($uservideoname!="")
{
  
                            ?> <script language="javascript">
                                jwplayer("ova-player-instance_<?php echo $j; ?>").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                                file: '<?php echo Yii::app()->baseUrl; ?>/upload/users/<?php echo $userfolder;?>/videos/<?php echo $uservideoname; ?>',
                                height: 260,
                                width: 338,
                                });
                            </script>  
                            <?php
                       } }
else if($vid!="")
{
?>
<script language="javascript">
                                jwplayer("ova-player-instance_<?php echo $j; ?>").setup({
                                flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                                file: '<?php echo $vid; ?>',  
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

                <p class="slisting-head">Video <?php echo $j; ?> (Person behind the business) <a class="sl-tip tooltip" href="#;">?<span class="classic">Potential investors want to know the person behind the business; your skills, how you present yourself, your experience and credibility, all play a vital role if you wish to see your business idea succeed.<br><br /></span></a></p>
<?php
if (file_exists($apath))
{
?>
                <input value="<?php echo $drg_videodesc; ?>" type="text" name="drg_videodesc[]" id="fileName<?php echo $j; ?>" class="file_input_textbox" style="width:335px;" />
<?php
}
else
{
?>
 <input value="<?php echo $vid; ?>" type="text" name="drg_videodesc[]" id="fileName<?php echo $j; ?>" class="file_input_textbox" style="width:335px;" />
<?php
}
?>
                <div class="clear"></div>
                <!-- File Upload for Company Logo -->
                <div style="margin-top:20px; margin-bottom:50px; text-align:center;">  
                     <?php 
                    if($uservideoname !=""){
                    ?>
                    <!-- <a class="button gray" title="Upload logo" href="<?php echo Yii::app()->baseUrl;?>/admin/listings/listings/downloadvideo?file=<?php echo $uservideoname; ?>" > &nbsp; Download Video<?php echo $j; ?> &nbsp;</a>--> 
                    <a class="button gray" title="Upload logo" href="<?php echo Yii::app()->createUrl('admin/listings/listings/downloadvideo',array('file'=>$uservideoname));?>" > &nbsp; Download Video<?php echo $j; ?> &nbsp;</a>
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
<input size="60" maxlength="200" class="file_input_textbox" name="Listings[drg_video<?php echo $j; ?>]" id="Listings_drg_video<?php echo $j; ?>" type="text">


            </div> 
            <?php
            $k++;
       
}
        ?>

        <div style="clear:both; height:20px;"></div>

        <div class="sl-photo-box" style="margin-top:32px; text-align:center;">
            <p style="margin:0 0 0 16px;">Thumbnail / Logo</p>
            <i style="font-size:7pt; color:#999999; margin-left:12px;">Upload a small thumbnail or your logo</i>
            <div class="clear"></div>
            <br>
            <div class="photo-upload-box1">
                <img class="side-robot-upload1" src="../images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
                <div class="my-account-popup-box" id="upload-frame"> 
                    <a class="pu-close" onclick=$(".photo-upload-box1").hide(); href="javaScript:void(0)" title="Close">X</a>
                    <h2>Upload thumbnail or logo</h2>
                    Click <b>Browse...</b> to select a picture from your computer<br />
                    Click <b>Preview Picture</b> to see a thumbnail of your image<br />
                    Click <b>Upload Picture</b> to save your profile picture and close this dialog box.<br />
                    <br />
                    <iframe src="photo-upload/logo_listing.php" frameborder="0" width="390" height="310" id="pic_frame"></iframe>
                </div>
            </div>
            <div class="sl-photograph">
                <p style="color:#808080;" id="showImg">
                    <?php
                    if (!empty($model['drg_logo'])) {
                         $img_src = '/upload/users/' . $userfolder.'/listing/thumb/' . $model->drg_logo;
                        ?>
                        <img src="<?php echo Yii::app()->baseUrl . $img_src; ?>" style="height:120px;" />
                        <?php
                    } else if (!empty($_SESSION['logo_listing'])) {
                        ?>
                        <img src="<?php echo $_SESSION['logo_listing']; ?>" style="height:120px;" />
                        <?php
                    } else {
                        ?>
                        <br />Image dimensions <br> must not exceed a <br> standard 6 x 4 photo <br /> 
                        (400 x 600 pixels max) <br /> 
                        &amp; must not exceed 2MB in size.
                        <?php
                    }
                    ?>
                </p>
            </div> <!-- File Upload for Company Logo -->
            <br class="clear" />
            <br class="clear" />

        </div>

        <div class="sl-basic-info pro-field" style="width:700px; margin-left:24px;">
            <label>Title <a href="#;" class="sl-tip tooltip">?<span class="classic">Give your business idea a title</span></a></label>
            <br>
            <?php echo $form->textField($model, 'drg_title', array('class' => 'inp width-500', 'id' => 'drg_list_title', 'onfocus' => "getNormal('#drg_list_title');")); ?>
            <br>
            <label>What is it?<a href="#;" class="sl-tip tooltip">?<span class="classic">In one sentence explain your business idea, for example:-<br><em style="font-size:0.9em; color:#A84793">'A security device to prevent fuel theft from gas stations'.</em></span></a></label>
            <br>
            <?php
            echo $form->textField($model, 'drg_desc', array('class' => 'inp width-500', 'id' => 'drg_list_what', 'onfocus' => "getNormal('#drg_list_what');"));
            ?>

            <br>
            <label>Enter a short explanation of what does it do or what problem does it solve.<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter a short explanation of your business idea or product in 1 to 2 sentences for example:-<br><em style="font-size:0.9em; color:#A84793">'A security system that uses patent protected stinger system to immobilise any vehicle by using a controlled deflation of the rear wheels.<br> The offending vehicle will come to rest at a known distance  from the point of theft.'.</em></span></a></label>

            <?php echo $form->textArea($model, 'drg_explanation', array('id' => 'drg_list_explanation', 'class' => 'width-500', 'style' => 'height:70px;', 'onfocus' => "getNormal('#drg_list_explanation');",)); ?>

        </div>
        <div class="sl-basic-info" style="width:96.5% !important; margin-left:24px;">
            <label>Enter details of your business idea / activities.<a href="#;" class="sl-tip tooltip">?<span class="classic">Use this space to detail your business.<br>
                        How did you come up with the idea?<br>
                        Why do you feel there is a need?<br>
                        Do you have any marketing data?<br>
                    </span></a></label>
<?php echo $form->textArea($model, 'drg_businessidea', array('id' => 'drg_list_businessidea', 'class' => 'textarea-full', 'style' => 'height:100px;', 'onfocus' => "getNormal('#drg_list_businessidea');",)); ?>

        </div>
        <div class="sl-basic-info" style="width:100% !important; margin-left:24px;">
            <label>Financial projections. <a href="#;" class="sl-tip tooltip">?<span class="classic">If you have been trading then detail any financial data that you may have in the table below.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 10K = 10,000<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 10M =10,000,000</span></a></label>
            <br/>
            <div class="text_content">please select one option if you do not have financial data</div>

            <div class="financial">
                <?php
                $disabled = '';
                $checkvalidate = true;
                $financial_data = Data::model()->findByPk('2');
                $financial_data1 = CJSON::decode($financial_data->data);
                foreach ($financial_data1 as $key => $value) {
                    $sel = '';
                    if ($model['drg_financial_data'] == $key) {
                        $sel = 'checked="checked"';
                        $disabled = 'disabled="disabled" style="background:#f0f0f0;"';
                        $checkvalidate = false;
                    }
                    ?> 

                    <div><div class="flow_left mrgn_right"><input <?php echo $sel; ?> type="radio" name="drg_financial_data" class="currency financial_data" value="<?php echo $key; ?>"/></div><div><?php echo $value; ?></div></div>
<?php } ?>
                <br class="clear"/>
            </div>
            <div class="text_content"> or if you have financial data then complete the table below and select your currency </div>

            <table class="sl-select no_financeData" style="width: 96%; left: -5px;">	
<?php $years = explode(',', $model->drg_fprojections); 
//print_r($model->drg_fprojections);
?>					
                <tr>
                    <td>Year 1<input <?php echo $disabled;?> onfocus="getNormal('#drf_list_year1');" onkeyup="format1(this)" type="text" name="drg_fprojections1" id="drf_list_year1" class="inp width-105" value="<?php echo $years[0]; ?>"/></td>
                    <td>Year 2<input <?php echo $disabled;?> onfocus="getNormal('#drf_list_year2');" onkeyup="format1(this)" type="text" name="drg_fprojections2" id="drf_list_year2" class="inp width-105" value="<?php echo $years[1]; ?>"/></td>
                    <td>Present<input <?php echo $disabled;?> onfocus="getNormal('#drf_list_yearpresent');" onkeyup="format1(this)" type="text" name="drg_fprojections3" id="drf_list_yearpresent" class="inp width-105" value="<?php echo $years[2]; ?>"/></td>
                    <td>Year 1<input <?php echo $disabled;?> onfocus="getNormal('#drf_list_years1');" type="text" onkeyup="format1(this)" name="drg_fprojections4" id="drf_list_years1" class="inp width-105" value="<?php echo $years[3]; ?>"/></td>
                    <td>Year 2<input <?php echo $disabled;?> onfocus="getNormal('#drf_list_years2');" type="text" onkeyup="format1(this)" name="drg_fprojections5" id="drf_list_years2" class="inp width-105" value="<?php echo $years[4]; ?>"/></td>
                    <td>Year 3<input <?php echo $disabled;?> onfocus="getNormal('#drf_list_years3');" type="text" onkeyup="format(this);" name="drg_fprojections6" id="drf_list_years3" class="inp width-105" value="<?php echo $years[5]; ?>"/></td>
                </tr>
            </table>
            <table class="no_financeData" style="margin-bottom:24px; ">

                <tr>
                    <td width="90%" valign="top" colspan="2">
                        <label style="color:#000;">Amount is in:-</label>
                    </td>
                    <td width="10%">&nbsp;  </td>						
                </tr>
                <tr>
                    <td colspan="2" width="100%" valign="top">
                        <div class="amountselect">

                            <?php
                            $amount_data = Data::model()->findByPk('1');
                            $amount_data1 = CJSON::decode($amount_data->data);
                            foreach ($amount_data1 as $key => $value) {
                                $sel = '';
                                if ($model->drg_famount == $key) {
                                    $sel = 'checked="checked"';
                                    $insert = false;
                                }
                                ?> 
                                <div ><div class="flow_left mrgn_right"><input <?php echo $sel; ?> type="radio" name="drg_famount" class="currency" value="<?php echo $key; ?>"/></div><div class="flow_left"><?php echo $value; ?></div></div>
<?php } ?>
                        </div>	
                    </td>

                </tr>
            </table>
            <div class="sl-basic-info" style="width:96.5% !important;">
                <label>Enter details of what you want.<a href="#;" class="sl-tip tooltip">?<span class="classic">Are you looking to sell your idea?<br>Are you looking for a partner or an investor?<br>Do you want to license your idea?<br></span></a></label>

<?php echo $form->textArea($model, 'drg_want', array('id' => 'drg_list_detail', 'class' => 'textarea-full', 'onfocus' => "getNormal('#drg_list_detail');",)); ?>
                <br class="clear"/><label>Enter keywords for our search engine.<a href="#;" class="sl-tip tooltip">?<span class="classic">
                            Be specific in the choice of your keywords. <br>A few well chosen descriptive words give better response than a large block of text that could make it difficult for you to attract the right kind of interest.<br>Separate each word with a comma and a space.</span></a></label>

<?php echo $form->textArea($model, 'drg_keyword', array('id' => 'drg_list_keyword', 'class' => 'textarea-full', 'onfocus' => "getNormal('#drg_list_keyword');",)); ?>
            </div>
        </div>
        <div class="clear"></div>
        <div class="slisting-head sl-basic-info" style="width:96.5% !important; margin-left:24px;">
            <p>Enter your marketing question below <a class="sl-tip tooltip" href="#;">?<span class="classic">Make sure your question is simple and easy to understand.<br>Please ensure that your question results in a YES, MAYBE or NO response. </span></a></p>
<?php echo $form->textArea($model, 'drg_mktquestion', array('id' => 'drg_list_maketing_question', 'class' => 'textarea-full mark-text', 'onfocus' => "getNormal('#drg_list_maketing_question');",)); ?>
        </div>
        <div class="clear"></div>
        <div class="clear"></div>
        <div class="sl-basic-info" style="width:15% !important; margin-left:24px;">
            <label style="color:#A47A8F;">Listing Notification <a class="sl-tip tooltip" href="#;">?<span class="classic">You will receive a progress report on your listing via email. You may chose the frequency of such notification here.  </span></a></label>
        </div>
        <label style="color:#000; text-align:center; display:block; margin:20px 0;">Send me a progress report  on this listing once every:-</label>
        <div style="text-align:center; margin:20px 0;">



            <input name="drg_reporttime" <?php echo ($model->drg_reporttime == 'day') ? 'checked="true"' : '' ?> value="day" type="radio" style="margin: 0 0 0 0px;" /> <?php echo "Day"; ?>
            <input name="drg_reporttime" <?php echo ($model->drg_reporttime == 'week') ? 'checked="true"' : '' ?> value="week" type="radio" style="margin: 0 0 0 60px;" /> <?php echo "Week"; ?>
            <input name="drg_reporttime" <?php echo ($model->drg_reporttime == 'month') ? 'checked="true"' : '' ?> value="month" type="radio" style="margin: 0 0 0 60px;" /> <?php echo "Month"; ?>

        </div>
        <div class="sl-bottom-buttons admin-button">
        <!--<a href="<?php echo Yii::app()->createUrl('/admin/listings/listings/delete', array('id' => $model->drg_lid)); ?>" class="button red">Delete</a>-->
            <?php if ($model->drg_listingstatus == 3) { ?>
                <a href="<?php echo Yii::app()->createUrl('/admin/listings/listings/restore', array('id' => $model->drg_lid)); ?>" class="button pink">Restore</a>

                <?php
            } else {
                ?>
                <a href="javaScript:void(0)<?php //echo Yii::app()->createUrl('/admin/listings/listings/rdelete',array('id'=>$model->drg_lid));  ?>" onClick="delete_confirm()"  class="button red">Delete</a></td>
<?php } ?>
            <a href="javaScript:void(0)" onClick="show_reject_form()"  class="button orange">Reject</a></td>
                     <a href="javaScript:void(0)" onClick="listing_validation()" class="button blue">Update</a></td>
            <?php
            if ($model->drg_listingstatus == 1) {
                ?>
                <a href="javaScript:void(0)" onClick="show_suspension_form()" class="button black">Suspend</a></td>
                <?php
            } else {
                ?>
                <a href="<?php echo Yii::app()->createUrl('/admin/listings/listings/publish', array('id' => $model->drg_lid)); ?>" class="button green">Publish</a>
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
                    <h3><span class="fltL">User: <span><?php echo $userdetails[0]['drg_name']; ?></span></span> <span class="fltR">Listing title: <span><?php echo $model['drg_title']; ?></span></span></h3>
                    <div id="email_error" class="error_msg"></div>

                    <table id="reg-table" style="width: 100%;">
                        <tr>
                         <th class="black-text">Details of changes made</th><br/>
                        </tr>
                        <tr><td>        <textarea rows="4" cols="50" name="changes" placeholder="Text entered here by admin appears here"></textarea></td></tr>
               
                    </table>
                    <div class="confirmbtn">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Submit', array('class' => 'button black', 'name' => 'update')); ?>
                    </div>

                </div>
            </div>
        </div>

<?php $this->endWidget(); ?>
		<div class="admin-popup">
        <div class="show_reject_form big-popup" style="display: none;">
            <form action="<?php echo Yii::app()->createUrl('/admin/listings/listings/rejection', array('id' => $model->drg_lid)); ?>" method="post">
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_reject_form()" class="pu-close">X</a>
                        <h2>User listing rejection notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                        <h3><span class="fltL">User: <span><?php echo $userdetails[0]['drg_name']; ?></span></span><span class="fltR">Listing title:<span> <?php echo $model['drg_title']; ?></span></span></h3>
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
                                            <!--<a href="<?php echo Yii::app()->createUrl('/admin/listings/listings/rejection', array('id' => $model->drg_lid)); ?>" class="button black">Submit</a>-->
                            <input type="submit" name="rejection" value="Submit" class="button black" />
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <div class="show_publish_form" style="display: none;">
            <form action="<?php echo Yii::app()->createUrl('/admin/listings/listings/publish', array('id' => $model->drg_lid)); ?>" method="post">
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_publish_form()" class="pu-close">X</a>
                        <h2>User listing publish notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                        <h3>User:<?php echo $userdetails[0]['drg_name']; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;              Listing title:<?php echo $model['drg_title']; ?></h3>
                        <div id="email_error" class="error_msg"></div>

                        <table id="reg-table" style="width: 100%;">
                            <tr>
                                <th  class="darkGrey-text">Notification of publish</th>
                            </tr>
                            <tr>
                            <input type="hidden" name="listing_title" value="<?php echo $model['drg_title']; ?>">
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
            <form action="<?php echo Yii::app()->createUrl('/admin/listings/listings/suspension', array('id' => $model->drg_lid)); ?>" method="post">
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_suspension_form()" class="pu-close">X</a>
                        <h2>User listing suspension notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                        <h3><span class="fltL">User: <span><?php echo $userdetails[0]['drg_name']; ?></span></span> <span class="fltR">Listing title: <span><?php echo $model['drg_title']; ?></span></span></h3>
                        <div id="email_error" class="error_msg"></div>

                        <table id="reg-table" style="width: 100%;">
                            <tr>
                                <th  class="black-text">Notification of suspension</th>
                            </tr>
                            <tr>
                            <input type="hidden" name="listing_title" value="<?php echo $model['drg_title']; ?>">
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
            <form action="<?php echo Yii::app()->createUrl('/admin/listings/listings/rdelete', array('id' => $model->drg_lid)); ?>" method="post">
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_delete_form()" class="pu-close">X</a>
                        <h2>User listing deletion notification</h2>
<?php $userdetails = User::model()->findAllByAttributes(array("drg_uid" => $model->drg_uid)); ?>
                        <h3><span class="fltL">User:<span><?php echo $userdetails[0]['drg_name']; ?></span></span><span class="fltR">Listing title:<span><?php echo $model['drg_title']; ?></span></span></h3>
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
        </div>


    </div><!-- form -->
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
 
 var JQ1 =jQuery.noConflict(); 

function listing_validation(frm)
{
	var failedvalidation = false;
	JQ1('.select_error').remove();	
	
	var regexPattern = /^[0-9.,\b]+$/;			
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
	
	/* var sl_vlimit = JQ1('#sl_vlimit option:selected').val();
	if(sl_vlimit == ""){
		JQ1("#sl_vlimit").siblings().addClass('mandatoryerror');
		JQ1("#sl_vlimit").siblings().css('border-radius','5px');
		var sibling_id = JQ1("#sl_vlimit").siblings().attr('id');
		JQ1('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		JQ1("#sl_vlimit").siblings().removeClass('mandatoryerror');
		JQ1("#sl_vlimit").siblings().css('border-radius','0');
	} */
	
	var title = JQ1('#drg_list_title').val();
		if(title == ""){                
			JQ1("#drg_list_title").addClass('mandatoryerror');
			JQ1("#drg_list_title").attr('placeholder','Enter title for your business listing');             
			failedvalidation = true;            
		}else{
			JQ1("#drg_list_title").removeClass('mandatoryerror');
			JQ1("#drg_list_title").attr('placeholder','');
		}
		
	var what_desc = JQ1('#drg_list_what').val();
	
	if(what_desc == ""){                
			JQ1("#drg_list_what").addClass('mandatoryerror');
			JQ1("#drg_list_what").attr('placeholder','Enter your What is it');             
			failedvalidation = true;            
		}else{
			JQ1("#drg_list_what").removeClass('mandatoryerror');
			JQ1("#drg_list_what").attr('placeholder','');
		}
	
	var drg_explanation = JQ1('#drg_list_explanation').val();
	if(drg_explanation == ""){                
			JQ1("#drg_list_explanation").addClass('mandatoryerror');
			JQ1("#drg_list_explanation").attr('placeholder','Enter your list explanation');             
			failedvalidation = true;            
		}else{
			JQ1("#drg_list_explanation").removeClass('mandatoryerror');
			JQ1("#drg_list_explanation").attr('placeholder','');
		}
		
		var drg_businessidea = JQ1('#drg_list_businessidea').val();
		if(drg_businessidea == "")
		{
			JQ1("#drg_list_businessidea").addClass('mandatoryerror');
			JQ1("#drg_list_businessidea").attr('placeholder','Enter business idea/activity');             
			failedvalidation = true;  
		}
		else
		{
			JQ1("#drg_list_businessidea").removeClass('mandatoryerror');
			JQ1("#drg_list_businessidea").attr('placeholder','');
		}
		
		var drg_list_detail = JQ1('#drg_list_detail').val();
		if(drg_list_detail== "")
		{
			JQ1("#drg_list_detail").addClass('mandatoryerror');
			JQ1("#drg_list_detail").attr('placeholder','Enter your list business detail');             
			failedvalidation = true;  
		}
		else
		{
			JQ1("#drg_list_detail").removeClass('mandatoryerror');
			JQ1("#drg_list_detail").attr('placeholder','');
		}
		
		var drg_list_keyword = JQ1('#drg_list_keyword').val();
		if(drg_list_keyword== "")
		{
			JQ1("#drg_list_keyword").addClass('mandatoryerror');
			JQ1("#drg_list_keyword").attr('placeholder','Enter your list business keyword');             
			failedvalidation = true;  
		}
		else
		{
			JQ1("#drg_list_keyword").removeClass('mandatoryerror');
			JQ1("#drg_list_keyword").attr('placeholder','');
		}
		
		var drg_list_maketing_question = JQ1('#drg_list_maketing_question').val();
		if(drg_list_keyword== "")
		{
			JQ1("#drg_list_maketing_question").addClass('mandatoryerror');
			JQ1("#drg_list_maketing_question").attr('placeholder','Enter your list marketing question');             
			failedvalidation = true;  
		}
		else
		{
			JQ1("#drg_list_maketing_question").removeClass('mandatoryerror');
			JQ1("#drg_list_maketing_question").attr('placeholder','');
		}
		
	if(checkForFinance){	
	/**	@validation for listing business Financial projections past year 1*/
	var drf_list_year1 = JQ1('#drf_list_year1').val();
	if(drf_list_year1 == ""){
		JQ1("#drf_list_year1").addClass('mandatoryerror');
		JQ1("#drf_list_year1").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		JQ1("#drf_list_year1").removeClass('mandatoryerror');
		JQ1("#drf_list_year1").attr({'placeholder':''});
	}

    if(drf_list_year1 !="" && !regexPattern.test(drf_list_year1)){
       	JQ1("#drf_list_year1").addClass('mandatoryerror');
		JQ1("#drf_list_year1").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    }    


	/**	@validation for listing business Financial projections past year 2 */
	var drf_list_year2 = JQ1('#drf_list_year2').val();
	if(drf_list_year2 == ""){
		JQ1("#drf_list_year2").addClass('mandatoryerror');
		JQ1("#drf_list_year2").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		JQ1("#drf_list_year2").removeClass('mandatoryerror');
		JQ1("#drf_list_year2").attr({'placeholder':''});
	}
    
    if(drf_list_year2 !="" && !regexPattern.test(drf_list_year2)){
       	JQ1("#drf_list_year2").addClass('mandatoryerror');
		JQ1("#drf_list_year2").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    } 
    
	/**	@validation for listing business Financial projections present year */
	var drf_list_yearpresent = JQ1('#drf_list_yearpresent').val();
	if(drf_list_yearpresent == ""){
		JQ1("#drf_list_yearpresent").addClass('mandatoryerror');
		JQ1("#drf_list_yearpresent").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		JQ1("#drf_list_yearpresent").removeClass('mandatoryerror');
		JQ1("#drf_list_yearpresent").attr({'placeholder':''});
	}
    if(drf_list_yearpresent !="" && !regexPattern.test(drf_list_yearpresent)){
       	JQ1("#drf_list_yearpresent").addClass('mandatoryerror');
		JQ1("#drf_list_yearpresent").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    } 
    
	/**	@validation for listing business Financial projections future year 1*/
	var drf_list_years1 = JQ1('#drf_list_years1').val();
	if(drf_list_years1 == ""){
		JQ1("#drf_list_years1").addClass('mandatoryerror');
		JQ1("#drf_list_years1").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		JQ1("#drf_list_years1").removeClass('mandatoryerror');
		JQ1("#drf_list_years1").attr({'placeholder':''});
	}
    if(drf_list_years1 !="" && !regexPattern.test(drf_list_years1)){
       	JQ1("#drf_list_years1").addClass('mandatoryerror');
		JQ1("#drf_list_years1").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    }
	/**	@validation for listing business Financial projections future year 2*/
	var drf_list_years2 = JQ1('#drf_list_years2').val();
	if(drf_list_years2 == ""){
		JQ1("#drf_list_years2").addClass('mandatoryerror');
		JQ1("#drf_list_years2").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		JQ1("#drf_list_years2").removeClass('mandatoryerror');
		JQ1("#drf_list_years2").attr({'placeholder':''});
	}
    if(drf_list_years2 !="" && !regexPattern.test(drf_list_years2)){
       	JQ1("#drf_list_years2").addClass('mandatoryerror');
		JQ1("#drf_list_years2").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    }
	/**	@validation for listing business Financial projections future year 3*/
	var drf_list_years3 = JQ1('#drf_list_years3').val();
	if(drf_list_years3 == ""){
		JQ1("#drf_list_years3").addClass('mandatoryerror');
		JQ1("#drf_list_years3").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		JQ1("#drf_list_years3").removeClass('mandatoryerror');
		JQ1("#drf_list_years3").attr({'placeholder':''});
	}
    if(drf_list_years3 !="" && !regexPattern.test(drf_list_years3)){
       	JQ1("#drf_list_years3").addClass('mandatoryerror');
		JQ1("#drf_list_years3").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    }
    
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
	function format1(input)
    {
        var nStr = input.value + ''; 
		nStr = nStr.replace( /\,/g, "");
        var x = nStr.split( '.' );
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while ( rgx.test(x1) ) {
            x1 = x1.replace( rgx, '$1' + ',' + '$2' );
        }
        input.value = x1 + x2;
		
    }
	
	JQ1(document).ready(function(){
       JQ1(".price1").trigger("keyup"); 
    });
	

</script> 