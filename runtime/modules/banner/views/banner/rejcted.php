<?php 
$this->breadcrumbs=array(
    'my account'=>Yii::app()->user->_user_Type=='user' ? array('/user/myaccount/update'):array('/business/myaccount/update'),
    'manage business listing'=>Yii::app()->user->_user_Type=='user' ? array('/listing'):array('/businesslisting'),
	'my marketing tools',
);
$UserData = User::model()->findByPk(Yii::app()->user->getID());
$Currency = Currency::model()->findByPk($UserData->drg_currency);

?>
<div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
    <div class="clear"></div>
</div>
<div class="registration-content banner-add-section" style="min-height:580px;float:left;"> 
        <div class="my-account-links">
          <?php 
            $this->renderPartial("//layouts/my-account-links");
          ?>
        </div>         
        <div class="marketing_tab">
          <div class="row" style="border-bottom: none;">
            <h2 class="mrg-left-20 color-blue"> &nbsp;&nbsp; Submit a banner advertisement
              <label class="submit-label"></label>
            </h2>
            <h3>(number of members that will receive your invitation: <span class="purple-color"><strong> <?php             
            $count =  User::model()->count("drg_pstatus = 1");
            echo $count;
            ?></strong></span>)</h3>
           <p class="darkGrey-text">A banner ad is on every page and a good way to maximize your exposure at only $1 a day it offers
            excellent value for money. <a href="https://db.tt/M0lGFinr" class="color-blue" target="_blank">Download a banner template here >> </a></p>
            <label>History</label>
             <table border="0" bordercolor="#fff"  class="table_style1" width="100%" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr >
                      <th>Date</th>
                      <th>Cost</th>
                      <th>Number of click through</th>
                      <th>Visitor acquisition rate</th>
                    </tr>
                   
                <?php 
                 
                $connection = Yii::app()->db;
                $qry = "SELECT date_format(banner_subdate,'%d/%m/%Y') as banner_date,banner_cost,banner_clicks,banner_path,banner_id,banner_approve_status ";
                $qry .=" FROM drg_banner_ads WHERE drg_user_id ='".Yii::app()->user->getID()."' limit 3";
                $command = $connection->createCommand($qry);
                $user_banners = $command->queryAll(); 
                
                
                $connection = Yii::app()->db;
                $qry1="SELECT date_format(banner_subdate,'%d/%m/%Y') as banner_date,banner_cost,banner_clicks,banner_path,banner_id,banner_approve_status ";
                $qry1 .=" FROM drg_banner_ads WHERE drg_user_id ='".Yii::app()->user->getID()."'";
                $command = $connection->createCommand($qry1);
                $user_all_banners = $command->queryAll();            
                
                $totalResults = Banner::model()->countByAttributes(array("drg_user_id"=>Yii::app()->user->getID()));             
                
                $totalPages=(int)($totalResults/3);
                $checkExtraPage=$totalResults%3;
                if($checkExtraPage>0){
                        $totalPages+=1;
                }
              $j=0;  
              for($i=0;$i<count($user_banners);$i++){
                
              ?>
            <tr <?php if($user_banners[$i]['banner_approve_status']==3 ){?>style='color:red;' <?php }  
            if($j==0){?> onMouseOver="ChangeColorGrey(this, true);" 
            onmouseout="ChangeColorGrey(this, false);" 
            class="GreyRow"<?php $j=1; 
            }else{?>
                            onMouseOver="ChangeColorMauve(this, true);" 
            onmouseout="ChangeColorMauve(this, false);" 
            class="MauveRow"
            <?php $j=0; } ?> >

              <td> 
              <?php echo $user_banners[$i]['banner_date']; ?>
              </td>
              <td><?php echo SharedFunctions::_get_currency_symbol($Currency->currency_code) . $user_banners[$i]['banner_cost']; ?></td>
              <td><?php echo  $user_banners[$i]['banner_clicks']; ?></td>
              <td>
              <?php 
              if($user_banners[$i]['banner_clicks']!=0){                    
                    $val= $user_banners[$i]['banner_cost']/$user_banners[$i]['banner_clicks'];                    
                    echo SharedFunctions::_get_currency_symbol($Currency->currency_code). number_format((float)$val, 2, '.', '');                     
              }else{
                    echo  "0"; 
              } 
              ?>              
              </td>
            </tr>
            <?php } ?> 
            <?php if(count($user_banners)==0){?>
            <tr onMouseOver="ChangeColorGrey(this, true);"  onmouseout="ChangeColorGrey(this, false);" onclick="DoNav('#');"  class="GreyRow">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php } ?>
             </tbody>
            </table>
            <label>Active banner</label>  
               
                 <form action="<?php echo Yii::app()->createUrl("banner/update/"); ?>" method="post" id="bannerForm" enctype="multipart/form-data" onsubmit="return checkbanner();">
                   <!-- <input type="file" style="display:none;" name="bannerImage" id="bannerImage" onChange="javascript:sub(this)" /> -->
                   <input type="file" style="display:none;" name="bannerImage" id="bannerImage" />  
                   <input type="hidden" name="banner_list_id" id="banner_list_id" value="<?php echo $model[0]->banner_list_id ?>" /> 
                   <input type="hidden" name="banner_id" id="banner_id" value="<?php echo $model[0]->banner_id ?>" /> 
                    
                     <?php 
                     $renewBannerId= Yii::app()->request->getParam('renewBannerId');
                     if(isset($renewBannerId)){
                        
                        $connection = Yii::app()->db;
                        $qry1="SELECT date_format(banner_subdate,'%d/%m/%Y') as banner_date,banner_cost,banner_clicks,banner_path,banner_id,banner_approve_status ";
                        $qry1 .=" FROM drg_banner_ads WHERE drg_user_id ='".Yii::app()->user->getID()."'";
                        $command = $connection->createCommand($qry1);
                        $user_all_banners = $command->queryAll();   
                     }                 
                     $this->renderPartial('//../modules/banner/views/layouts/bannerad_slider'); 
                   ?>
                     <input type="text" class="uploader-field banner-input" placeholder="Please upload a new image " name="banner_link" id="banner_link" value="" />
                     <div class="reject-banner" style="float: left;">
                        <label class="upload-img" onclick="javascript:getFile()" >Upload image</label>
                        <button class="login_sbmt"  name="login_sbmt" type="button" onClick="javascript:getFile()" title="Submit your vote">
                            <img class="user-btn-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png" >
                        </button>
                     </div>
                     <div class="sl-select-purchase"> 
                        <span class="image-size"><em>Image size must not exceed 100K</em></span> 
                     </div>
                     
                    <table class="table_style2">
                      <tr>
                        <td width="500" class="align-center">
                            <input type="submit" value="Update" class="button gray" />
                        </td>        
                      </tr>
                    </table>              
             </form>         
            </div><!-- Banner advert module -->  
            </div>
         
          
</div> 
<style type="text/css">
.reject-banner{ width:125px;}
.reject-banner label{ }
.reject-banner  button img{ margin-top:0;}

.sl-select-purchase{ width:432px !important; text-align:center;}
</style>

<script type="text/javascript"> 
$(".chzn-select").chosen();
function ChangeColorGrey(tableRow, highLight)
{
    if (highLight)
        {
            tableRow.style.backgroundColor = '#C2C2C2';
        }
    else
        {
            tableRow.style.backgroundColor = '#EBEBEB';
        }
}
function ChangeColorMauve(tableRow, highLight)
{
    if (highLight)
        {
            tableRow.style.backgroundColor = '#C9C';
        }
    else
        {
            tableRow.style.backgroundColor = '#EADDED';
        }
}
function getFile(){
   document.getElementById("bannerImage").click(); 
     
}
function sub(obj){
    $('#bannerForm').submit();
}

function checkbanner(){
    var failedvalidation = false;
    
    var banner_link = $("#banner_link").val();
    var uploaderfield = $("#bannerImage").val(); 
     
     
    if(banner_link == "")
    {                
        $("#banner_link").addClass('mandatoryerror');
        $("#banner_link").attr('placeholder','Please upload banner to for banner link');             
        failedvalidation = true;    
    }
    if(uploaderfield == "")
    {                
        $(".upload-img").addClass('mandatoryerror');
        $(".upload-img").attr('placeholder','Please upload banner image');             
        failedvalidation = true;    
    }
    
     
    if (failedvalidation) 
	{
	   return false;
    }
    else {
        return true;
    }
}


jQuery(document).ready(function() {
    	 
	jQuery('#pay').live("click",function(){
		  jQuery('#cost,#banner_link').prop("disabled", false);
	});
    
    jQuery('#bannerImage').change( function() {
         
          if ($(this).val() != '') {             
             var file = $(this)[0].files[0];
             var currentDate = '<?php echo date('Y-m-d-h-i-s'); ?>';
             var fileName = file.name;
             var fileSize =  parseInt(file.size/1024);
             if(fileSize<101){
                $("#banner_link").removeAttr('disabled').val();  
                $("#banner_link").attr("readonly","true").val('banner-images/'+currentDate+fileName); 
             }else {
                alert("please select other image ");                
             }            
          }
          else {
            alert('Please select a file.')
          }
    }); 
    
    
});
</script> 


