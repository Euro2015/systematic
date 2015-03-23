<h1 class="cms_page_title">Banner adverts waiting for submission</h1>
<?php
    $this->breadcrumbs=array(
    	' banner ad submissions'=>array('../banner')	 
    );
?> 
<div class="user_listing_search admin-banner-add">
    <h1 class="Blue" align="center">Banner adverts waiting for submission</h1>
    <br />
    <div class="Main">
    <form class="" action="<?php echo Yii::app()->createUrl('admin/banner/banner/publish');?>" method="post" name="banner" id="banner" onsubmit="return check_valid();">
    <?php  
      if($list > 0){
            foreach($list as $row){             
              ?>
                 <div class="Left-Portion">
                    <span class="spTitleText">Click on the banner to enlarge </span>
                    
                    <div class="DrgonNet admin-banner-img">                        
                        <?php                         
                        if($row->banner_path !="" && file_exists('upload/'.$row->banner_path)){
                            $bannerimage = Yii::app()->baseUrl.'/upload/'.$row->banner_path;
                        ?> 
                            <a class="single_image" href="<?php echo $bannerimage; ?>"> <img src="<?php echo $bannerimage; ?>" alt="<?php echo $row->banner_link;?>" class="dragonMain" /> </a>
                        <?php    
                        }else {
                            $bannerimage = Yii::app()->baseUrl.'/upload/banner-images/blank.png';                             
                        ?>
                            <img src="<?php echo $bannerimage; ?>" alt="<?php echo $row->banner_link;?>" class="dragonMain" />
                        <?php  
                        }                        
                    ?>                                               
                    </div>
                    <div class="ChckBox">
                        <span class="RightColn">
                            <span>Publish</span>
                            <br />
                           <?php echo $row->banner_id ?> <input type="checkbox" id="ckPublish<?php echo $row->banner_id ?>" value="<?php echo $row->banner_id ?>" name="activebanner[]" class="checkbox1" />
                        </span>
                    </div>
                    <div class="bannerLink">
                        <?php 
                            $banner_link = '#';
                            if(trim($row->banner_link) !="" ){
                                $banner_link = $row->banner_link;
                            }
                        ?>
                       <input type="text" class="uploader-field admin-disabled-input" value="" readonly=""  disabled="disabled"/>
                        <a class="admin-banner-link" href="<?php echo $banner_link; ?>"  target="_blank"><?php echo $banner_link;?></a>
                        <span><a href="#;">Update</a></span>
                    </div>
                    <div class="BottMain">
                        <span class="purple-color">User:</span>
                        <span>
                        <?php 
                        $userData = User::model()->findByPk($row->drg_user_id);
                        echo $userData->drg_username;
                        ?></span>
                        <span class="padding-18">
                           <a class="buttonNew red" href="javascript:void(0);" data-role="<?php echo $row->banner_id ?>">Reject</a>                           
                        </span>
                        <span class="purple-color">Duration:</span>
                        <span><?php echo SharedFunctions::time_elapsed_string($row->banner_subdate); ?></span>
                    </div>
                </div> <!-- Left-Portion Ends -->
                <?php 
                }
            }        
        ?> 
        <div class="cls"></div>      
        <div class="Left-Portion-Btn">
            <a class="button gray" href="javascript:void(0);" id="selecctall" data-type="check">Select All</a>
        </div>
        <div class="Right-Portion-Btn">
            <div class="btnPublished"> 
                <?php echo CHtml::submitButton('Publish Selected Banner',array('name'=>'publis','class'=>'button blue')); ?>
            </div>    
        </div>
        </form>  
        
        <div class="show_delete_form big-popup" style="display: none;">
            <form action="<?php echo Yii::app()->createUrl('admin/banner/banner/reject') ?>" method="post">
                <input type="hidden" name="bannerid" id="bannerid" value="" />
                <input type="hidden" name="action" id="action" value="" />
                <div id="terms-conditions" class="u-email-box">
                    <div class="my-account-popup-box"> 
                        <a title="Close" href="javaScript:void(0)" onclick="close_delete_form()" class="pu-close">X</a>
                        <h2>message</h2>                          
                        <div id="email_error" class="error_msg"></div>
                        <table id="reg-table" class="banner-reg-table" style="width: 100%;">                             
                            <tr>
                                <th>
                                    <textarea rows="4" cols="50" name="admincomment"></textarea>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="confirmbtn">
                                        <input type="submit" name="delete" value="Submit" class="button black" />
                                    </div>
                                </td>
                            </tr>
                        </table>
                        

                    </div>
                </div>
            </form>
        </div>
    </div>   
</div>
<script type="text/javascript"> 
jQuery(".chzn-select").chosen();
jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
jQuery(".single_image").fancybox();
function close_delete_form()
{
    jQuery(".show_delete_form").fadeOut();
}

function check_valid(){
    if(jQuery(".checkbox1:checked").length < 1 ){
        jQuery(".checkbox1").addClass("mandatoryerror");    
        return false;    
    }else {
        return true;      
    }    
}




jQuery(document).ready(function() {
    jQuery('a#selecctall').click(function(event) {  //on click       
        if(jQuery(this).attr("data-type")==="check") { // check select status
            jQuery('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
            jQuery("a#selecctall").attr("data-type","uncheck");	  
        }else{
            jQuery('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });   
            jQuery("a#selecctall").attr("data-type","check");	      
        }
    });
   
   jQuery(".BottMain a").click(function(event){
    
        var id = jQuery(this).attr("data-role");
        var action = 'reject';
        jQuery("#bannerid").val(id);
        jQuery("#action").val(action);
        jQuery(".show_delete_form").fadeIn();
   });   
   
});
</script>
<style type="text/css"> 
.Main .big-popup {
      left: 26%;
    position: absolute;
    top: 30%;
    width: 910px;

}
.Main .my-account-popup-box {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 2px solid #C659B0;
    border-radius: 10px;
    box-shadow: -5px 5px 5px #999999;
    padding: 10px 40px 40px;
    text-align: left;
}
.Main .my-account-popup-box h2 {
    color: #1DBFD8;
    font-size: 25px;
    margin: 10px 0;
    text-align: center;
}
.selected a{
    color: #00ACCE !important;
    font-weight: bold;
}
</style>