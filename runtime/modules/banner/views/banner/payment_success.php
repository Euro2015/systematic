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
          <div class="row">
            <div class="heading_part">
              <h1>My Marketing Tools</h1>
              <h2>Marketing tools for 
              <span class="orange-color">
              <?php 
              $title = '';
              $listId = Yii::app()->request->getParam('listid');
             
              if(Yii::app()->user->_user_Type=='user'){
                
               $listData =  Listings::model()->findByPk(array('drg_lid'=>$listId));
               $title = $listData->drg_title;                
              }else {
               $listData =  Businesslisting::model()->findByPk(array('drg_blid'=>$listId));
               $title = $listData->drg_title;
              }              
                print ucfirst($title);
              ?>
              </span>
              </h2>
              <p class="darkGrey-text">Market your listing to dragonsnet members and your social network contacts</p>
            </div>
            <h2 class="mrg-left-20">1. Offer prize points to attract traffic to your listing
              <label class="offer-label"></label>
            </h2>
            <h3>(number of members that will receive your invitation: <span style="color:#1DBFD8"> 
            <?php             
            $count =  User::model()->count("drg_pstatus = 1");
            echo $count;
            ?>
            </span></h3>
            <p class="darkGrey-text">Offering prize points to members is an excellent way to drive traffic to your listing. Members will receive the value of
              the prize points you select below when they visit your listing and vote and they can double them if they take part in</p>
            <label>History</label>  
            <table border="0" bordercolor="#fff"  class="table_style1" width="100%" cellpadding="0" cellspacing="0">
               <tbody>
                <tr >
                  <th>Date</th>
                  <th>Points purchased</th>
                  <th>Cost</th>
                  <th>Number of click through</th>
                  <th>Visitor acquisition rate</th>
                </tr> 
             
                <tr onMouseOver="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                  <td>18/05/2014</td>
                  <td>25</td>
                  <td>$25</td>
                  <td>235</td>
                  <td>$0.11</td>
                </tr>
                <tr onMouseOver="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr onMouseOver="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
            <ul id="navlist">
         <?php if($page==0 || $page==1){?> <li class="prev">&lt; previous</li><?php }else{ ?>
                      <li><a href="?page=0#bannerSection">&lt; previous</a></li>
                     <?php }?>
                     <?php for($p=1;$p<=$totalPages;$p++){
                     if($p==$page){
                     ?>
                        <li><?= $p; ?></li>
                      <?php }else{ ?>
                      <li><a href="?page=<?= $p; ?>#bannerSection"><?= $p; ?></a></li>
                      <?php } ?>
                      <?php } ?>
                       <?php if($page==$totalPages){?> <li class="next">next &gt;</li><?php }else{ ?>
                      <li><a href="?page=<?= ($page+1); ?>#bannerSection">next &gt;</a></li>
                     <?php }?>

                </ul>
                <table class="table_style2">
                  <tr>
                    <td width="95"><label>Purchase Points:</label></td>
                    <td><select class="chzn-select width-80">
                        <option>Select</option>
                        <option>25</option>
                        <option>50</option>
                        <option>75</option>
                        <option>100</option>
                      </select></td>
                    <td><label>Cost:</label></td>
                    <td width="90">
                      <span class="point-clc">1 point = <?php echo SharedFunctions::_get_currency_symbol($Currency->currency_code) ?>1.00</span>
                      <input class="point-input" type="text" placeholder="0:00" /></td>
                    <td align="right" width="176"><label>Make payment and submit</label></td>
                    <td>  
                        <button class="login_sbmt" disabled="disabled" name="login_sbmt" type="submit" title="Submit your vote">
                            <img class="border-radius5" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png" >
                        </button>
                    </td>
                  </tr>
                </table>
          </div>
          
          <div class="row">
            <h2 class="mrg-left-20 color-blue">2. Submit a banner advertisement
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
            $page = Yii::app()->request->getParam('page');
            if(!isset($page))
            {
                $page=0;
                $firstLimit=0;
            }else{
                if($page==0){

                        $page=0;
                        $firstLimit=0;
                }else{
                        $page=$page;
                        $firstLimit=($page-1)*3;

                }
            } 
            
            $connection = Yii::app()->db;
            $qry = "SELECT date_format(banner_subdate,'%d/%m/%Y') as banner_date,banner_cost,banner_clicks,banner_path,banner_id,banner_approve_status ";
            $qry .=" FROM drg_banner_ads WHERE drg_user_id ='".Yii::app()->user->getID()."' limit $firstLimit ,3";
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
            onclick="javascript: location.href='?<?php if($user_banners[$i]['banner_approve_status']!=3 ){?>renewBannerId<?php }else{?>updateBanner<?php } ?>=<?= $user_banners[$i]['banner_id']; ?>&page=<?= $page; ?>#bannerSection'"
            class="GreyRow"<?php $j=1; 
            }else{?>
                            onMouseOver="ChangeColorMauve(this, true);" 
            onmouseout="ChangeColorMauve(this, false);" 
            onclick="javascript: location.href='?<?php if($user_banners[$i]['banner_approve_status']!=3 ){?>renewBannerId<?php }else{?>updateBanner<?php } ?>=<?= $user_banners[$i]['banner_id']; ?>&page=<?= $page; ?>#bannerSection'"
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
                        
                <ul id="navlist">
                 <?php if($page==0 || $page==1){?> 
                                <li class="prev">&lt; previous</li><?php 
                        }else{ ?>
                                <li><a href="?page=0#bannerSection">&lt; previous</a></li>
                        <?php 
                        }
                        for($p=1;$p<=$totalPages;$p++){
                             if($p==$page){
                             ?>
                                    <li><?=$p;?></li>
                              <?php 
                              }else{ 
                                ?>
                                    <li><a href="?page=<?=$p;?>#bannerSection"><?=$p;?></a></li>
                              <?php } 
                        }
                        if($page==$totalPages){
                        ?> 
                               <li class="next">next &gt;</li>
                        <?php 
                        }else{?>
                                <li><a href="?page=<?=($page+1); ?>#bannerSection">next &gt;</a></li>
                        <?php } ?>
        
                </ul>
                 <form action="<?php echo Yii::app()->createUrl("banner/makepayment/listid/$listId"); ?>" method="post" id="bannerForm" enctype="multipart/form-data" onsubmit="return checkbanner();">
                   <!-- <input type="file" style="display:none;" name="bannerImage" id="bannerImage" onChange="javascript:sub(this)" /> -->
                   <input type="file" style="display:none;" name="bannerImage" id="bannerImage" />                 
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
                 
                 if(isset($renewBannerId)){
                 ?>
                     <div class="renew-banner">
                        <form action="" method="post" enctype="multipart/form-data" id="formSubmit"> 
                          <input type="checkbox" name="renew_banner" value="<?php echo $user_all_banners[0]['banner_id']; ?>" style="margin-top:4px;" id="term_agree" value="1" />
                          <label style="color:#A47A8F;">Renew <a class="sl-tip tooltip" href="#;">?<span class="classic">Select this to renew your existing banner for another term </span></a></label>
                        </form>
                     </div>
                <?php 
                }                
                ?> 
                <?php  
                if(!isset($renewBannerId)){ ?>
                            <?php 
                             $updateBanner= Yii::app()->request->getParam('updateBanner');                    
                            ?>
                
                            <div class="update-banner"> 
                               
                                 <?php 
                                 if(isset($updateBanner)){ ?>
                                     <form action="" method="post"  id="formSubmit"> 
                                        <input type="hidden" name="updateBanner" value="<?=$updateBanner;?>"  />
                                     </form>
                                 <?php 
                                 } 
                                 ?>
                    <?php if(!isset($updateBanner)){ ?>    
            
                      <div class="sl-select-purchase">  
                    <table class="sl-select purchase-access">
                        <tr>
                            <td>
                                <select id="drg_category" name="drg_category" data-placeholder="Please select banner link" class="chzn-select" style="width:425px;" tabindex="2" required="">            
                                <option value="" title=""></option>
                                <option value="0" title="">None</option>
                                
                                <?php 
                                if(Yii::app()->user->_user_Type=='user'){                                    
                                   $listData =  Listings::model()->findAllByAttributes(array("drg_uid" =>Yii::app()->user->getState('uid')));
                                   if($listData){
                                        foreach($listData as $listing){                                            
                                            echo '<option value="'.$listing->drg_lid.'" title="">'.$listing->drg_title.'</option>';   
                                        }                                    
                                   }     
                                }else {
                                    
                                   $listData =  Businesslisting::model()->findAllByAttributes(array("drg_uid" =>Yii::app()->user->getState('uid')));
                                   if($listData){
                                        foreach($listData as $listing){                                            
                                            echo '<option value="'.$listing->drg_lid.'" title="">'.$listing->drg_title.'</option>';   
                                        }                                    
                                   }  
                                }   
                                                   
                                ?>
                                </select>
                            </td>
                        </tr>   
                    </table>
                    <label class="select-banner">Select banner link</label>      
                          <br />
                    <div class="err" id="add_err" style="color:red"></div>
                    </div>
            
                      <input type="text" class="uploader-field banner-input" name="banner_link" id="banner_link" value="" />
                      <label class="banner-link">Banner link</label>
                      <div class="clear"></div> <?php } ?>
                      <input type="text" placeholder="708px wide x 129px high" class="uploader-field" id="uploader-field" name="<?php if(!isset($_GET['updateBanner'])){ ?>banner_path<?php }else{echo "update_banner_path" ; } ?>" value="<?php if(isset($_GET['uploaded_banner_path'])){ echo $_GET['uploaded_banner_path'];}else{
                              if(isset($_GET['updateBanner'])){
                                    echo $ban[0]['banner_path'];
                              }  
                               
                               
                    } ?>" />
                      <label class="upload-img" onclick="javascript:getFile()" >Upload image</label>
            
            
                                  <span class="confirm-img" style=" <?php if(isset($_GET['confirm'])){ echo "color:red;";}?>"><?php if(isset($_GET['confirm'])){
                                  if($_GET['confirm']=="wrongFile"){ 
                                    echo "File format not supported";
                                  }
                                  if($_GET['confirm']=="bigSize"){
                                    echo "Image file size is larger than 100K.<br /> Please select another file or reduce the size to 100K or lower";
                                  }
            
                                   if($_GET['confirm']=="submitted"){ 
                                  ?>
                                  <div class="confirm-email banner-confirm-email">
                                    <div class="u-email-box banner-email-box"> 
                                        <img class="banner-robot" src="images/robot/Robot-pointing-down.png"/>
                                          <div class="my-account-popup-box banner-account-popup"> 
                                            <div class="pop-up-content">
                                                <h1 class="brown-color" align="center">Success</h1>
                                            <br />
                                                <p class="success-submit"> Your banner advert has been successfully submitted</p>
                                            <br />
                                                <p class="banner-note">You will be notified by email when your banner ad is published <br />
                                                        You may close this dialogue box and return to your form
                                                        </p>
                                            <br />
                                            <br />
                                                <p><a class="button black" href="?#bannerSection">Close</a></p>
                                            <br />
                                            </div>
                                         </div>
                                    </div>
                                </div>
                                  <?php }
            
                                  }else{?>
                                            <span class="image-size"><em>Image size must not exceed 100K</em></span>
                                  <?php } ?>
                              </span>
                                <button class="login_sbmt"  name="login_sbmt" type="button" onClick="javascript:getFile()" title="Submit your vote">
                                    <img class="user-btn-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png" >
                                </button>
                            <?php if(isset($_GET['updateBanner'])){ ?>   <label class="update-banner-lable" onclick="javascript: location.href='?deleteBanner=<?= $_GET['updateBanner'];?>';" >Delete Banner</label>
                              <button class="login_sbmt"  name="login_sbmt" type="button" onClick="javascript:location.href='?deleteBanner=<?= $_GET['updateBanner'];?>';" title="Submit your vote">
                                <img class="user-btn-img" src="<?php echo Yii::app()->theme->baseUrl;?>/images/buttons/user.png" >
                              </button>
                    <?php } ?>
                    </div>
                
                <?php 
                }
                ?>                  
            <?php if(!isset($_GET['updateBanner'])){ ?>
                    <table class="table_style2">
                      <tr>
                        <td width="112"><label>Enter duration </label></td>
                        <td><select class="chzn-select" <?php  if(!isset($_GET['renewBannerId'])){ ?>name="totalWeeks"<?php }else{?>name="editTotalWeeks"<?php } ?> id="totalWeeks" style="width:80px;">
                            <option value="0">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="12">12</option>
                            <option value="25">25</option>
                            <option value="52">52</option>
                          </select></td>
                        <td width="48"><label>week/<br /> weeks</label></td>
                        <td>
                        <td width="180"><label>Cost:</label>
                          <input class="disable-input" type="text" disabled="disabled" id="cost"  <?php  if(!isset($_GET['renewBannerId'])){ ?>name="cost"<?php }else{?>name="editCost"<?php } ?> placeholder="0:00" />
                          <span class="currency-code">1 week = <?php echo SharedFunctions::_get_currency_symbol($Currency->currency_code); ?>3</span></td>
                        <td align="right" width="212">
                            <label class="make-payment-lable" onclick="javascript: $('#pay').trigger('click');">Make payment & submit</label>
                           <div style="text-align: -moz-center">
                            <button class="login_sbmt" name="login_sbmt" type="submit" id="pay"  title="Make your payment">
                                <!-- <img class="border-radius5" src="<?php echo Yii::app()->theme->baseUrl;?>/images/buttons/user.png" >-->
                                <img class="border-radius5" src="<?php echo Yii::app()->theme->baseUrl;?>/images/buttons/Proceed-to-checkout-default.png" width="50" style="cursor: pointer;" />
                            </button> 
                            </div>                           
                        </td>
                      </tr>
                              <tr>
                                  <td colspan="6">
                                      <span class="payment-error" id="paymentError">
                                      You must select a duration from the dropdown list before you can continue
                                      </span>
                                  </td>
                              </tr>
                    </table>
           <?php }
           if(isset($_GET['updateBanner'])){ ?>
                <table class="table_style2">
                  <tr>
                    <td width="500" class="align-center"> 
                        <input type="submit" value="Update" class="button gray" />
                    </td>        
                  </tr>
                </table>
        <?php } ?>  
         </form>         
        </div><!-- Banner advert module -->  
        </div>
         
          
</div> 

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
    var category = $("#drg_category").val();
    var banner_link = $("#banner_link").val();
    var uploaderfield = $("#uploader-field").val();
    var totalWeeks = $("#totalWeeks").val();
    var cost = $("#cost").val();
     
    if(category == "")
    {                
        $("#drg_category").addClass('mandatoryerror');
        $("#drg_category").attr('placeholder','Please select banner link');             
        failedvalidation = true;    
    }
    if(banner_link == "")
    {                
        $("#banner_link").addClass('mandatoryerror');
        $("#banner_link").attr('placeholder','Please upload banner to for banner link');             
        failedvalidation = true;    
    }
    if(uploaderfield == "")
    {                
        $("#uploader-field").addClass('mandatoryerror');
        $("#uploader-field").attr('placeholder','Please upload banner image');             
        failedvalidation = true;    
    }
    if(totalWeeks == "")
    {                
        $("#totalWeeks").addClass('mandatoryerror');
        $("#totalWeeks").attr('placeholder','Please select duration ');             
        failedvalidation = true;    
    }
    if(cost == "" || cost == 'Nan')
    {                
        $("#cost").addClass('mandatoryerror');
        $("#cost").attr('placeholder','Please enter total cost');             
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
    jQuery('#add-carousel-wrap').jcarousel({
        wrap: 'circular',
        scroll: 1
    });
	jQuery('.active-result').click(function(){
	
	jQuery('#cost').val(parseInt(jQuery(this).html())*3);
	
	});
	jQuery('#pay').live("click",function(){
		  jQuery('#cost,#banner_link').prop("disabled", false);
	});
    
    $('#bannerImage').change( function() {
          if ($(this).val() != '') {             
             var file = $(this)[0].files[0];
             var currentDate = '<?php echo date('Y-m-d-h-i-s'); ?>';
             var fileName = file.name;
             var fileSize =  parseInt(file.size/1024);
             if(fileSize<101){
                $("#banner_link").removeAttr('disabled').val();  
                $("#uploader-field").attr("readonly","true").val('banner-images/'+currentDate+fileName); 
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


