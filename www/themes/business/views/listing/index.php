<?php
$this->breadcrumbs=array(
	'Userlistings'=>array('index'),
	'Manage',
);
?>
<div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
    <div class="clear"></div>
</div>
<div class="registration-content" style="min-height:580px"> 
        <div class="my-account-links">
          <?php 
            $this->renderPartial("//layouts/my-account-links"); 
          ?>
        </div>
        
        <div style="float:right; width:625px;">
        <div style="text-align: center;">
          <h1 style="font-size: 2em;">Select the listing you wish to manage </h1>
          <p style="color:#808080;">You may make changes to your listing as well as market it<br /> to other members and your social network groups</p>
        </div>
        <p style="color: #1dbfd8;">&nbsp; DA - Days Active</p>
        <p style="color: #1dbfd8;">&nbsp; DOI - Days Of Inactivity</p>   
        <table class="gernal_table manageListing" border="0" bordercolor="#fff" style="" width="50%" cellpadding="1" cellspacing="2">
          <tr class="tableHeading">
            <td class="date_column" style="cursor:default; text-align: center; width:50px;" title="Date published">Published</td>
            <td class="title_column" style="cursor:default" title="Listing title">Listing Title</td>
            <td class="doi_column" style="cursor:default; width:25px;" title="Days Active">DA</td>
            <td class="doi_column" style="cursor:default; width:25px;" title="Days Of Inactivity">DOI</td>
            <td class="" style="cursor:default; width:120px;" title="Total number of votes received">Total votes to date</td>
            <td class="" style="cursor:default; width:80px;" title="Total number of votes received">Access period</td>
          </tr>
          
          <?php 
             if(!empty($list)){
                $i=0;
                foreach($list as $listData){
                    if($i%2==0){
                    ?>
                        <tr onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('purchase_access.php');" class="GreyRow">
                    <?php    
                    }else {
                    ?>
                         <tr onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);" onclick="DoNav('select_listing_action.php');" class="MauveRow">
         
                    <?php     
                    }
                    ?>
                        <td>21/10/2012</td>
                        <td>Drivestop <span style="color:#F00;">(FREE listing)</span></td>
                        <td>36</td>
                        <td>5</td>
                        <td>999,999,999</td>
                        <td>purchase</td>
                      </tr>    
                    
               <?php
                $i++;     
                }                
             }else {
             ?>
                
                
                
             <?php
             }
            
          
          ?>
            <tr>
                <td colspan="6">
                    <?php $this->widget('CLinkPager',array('pages' => $pages,));?>
                </td>
            </tr>
        </table>    
  </div>
</div>
  