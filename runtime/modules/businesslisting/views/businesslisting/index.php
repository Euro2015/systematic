<?php
/*$this->breadcrumbs=array(
	'Userlistings'=>array('index'),
	'Manage',
);*/
?>
<div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
    <div class="clear"></div>
</div>
<div class="registration-content" style="min-height:580px"> 
        <div class="my-account-links">
          <?php 
            $this->renderPartial('//layouts/my-account-links');         
          ?>
        </div>        
        <div style="float:right; width:625px;">
        <div style="text-align: center;">
          <h1 style="font-size: 2em;">Modify / update your business listing </h1>
          <p style="color:#808080;">You may make changes to your listing as well as market it<br /> to other members and your social network groups</p>
        </div>
        <p style="color: #1dbfd8;">&nbsp; DA - Days Active</p>
        <p style="color: #1dbfd8;">&nbsp; DOI - Days Of Inactivity</p>   
        <table class="gernal_table manageListing" border="0" bordercolor="#fff" style="" width="50%" cellpadding="1" cellspacing="2">
          <tr class="tableHeading">
            <td class="date_column" style="cursor:default; text-align: center; width:80px;" title="Date published">Published</td>
            <td class="title_column" style="cursor:default" title="Listing title">Listing Title</td>
            <td class="doi_column" style="cursor:default; width:25px;" title="Days Active">DA</td>
            <td class="doi_column" style="cursor:default; width:25px;" title="Days Of Inactivity">DOI</td>
            <td class="" style="cursor:default; width:120px;" title="Total number of votes received">Total page visits </td>
            <td class="" style="cursor:default; width:80px;" title="Total number of votes received">Total Page received </td>
          </tr>
          
           <?php 
           
          if(!empty($list1)){
                $j=0;
                foreach($list1 as $listData1){
                   if($j%2==0){
                   ?>
                     <tr onclick="DoNav('<?php echo Yii::app()->createUrl('businesslisting/create/blistid/'.$listData1->drg_blid);?>');" onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);" class="GreyRow">
                   <?php           
                   }else {
                   ?>
                     <tr onclick="DoNav('<?php echo Yii::app()->createUrl('businesslisting/create/blistid/'.$listData1->drg_blid);?>');" onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"  class="GreyRow" style="background-color: rgb(234, 221, 237);">
                   <?php 
                   }
                   ?>
                    <td><?php if($listData1->drg_blistingstatus == 1){
                            echo date('d-m-Y',strtotime($listData1->drg_datetime));
                        }else{
                            echo 'Pending';
                        }?></td>
                    <td><?php echo $listData1->drg_slogon;?></td>
                    <td><?php
                            $from=date_create(date('Y-m-d'));
                            $to=date_create(date('Y-m-d', strtotime($listData1->drg_datetime)));
                            $diff=date_diff($to,$from);
                            echo $diff->format('%R%a days');
                        ?></td>
                    <td>
                    <?php
                        $visitpage_from=date_create(date('Y-m-d'));
                       $visitpage_to=date_create(date('Y-m-d', strtotime($listData1->drg_last_page_visit)));
                    $visitpage_diff=date_diff($visitpage_to,$visitpage_from);
                        echo $visitpage_diff->format('%R%a days');
                    ?>                    
                    </td>
                    <td><?php echo $listData1->drg_page_visit; ?></td>
                    <td>0</td>
                    </tr>
                   <?php
                    
                }
            
          }
          ?>  
           	</table> 
                <div id="page_nav" class="art-page-nav">
                          <table class="sl-select" id="example">
                            <tr>
                              <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
                              <td>
                              <?php 
                              if(isset($_REQUEST['rows'])){
                            	$count = $_REQUEST['rows'];
                            }else {
                            	$count = 5;
                            }
                             
                              ?>
                              <select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="window.location = '?rows='+$(this).val();">
                                  <option <?php echo ($count==5) ? 'selected=selected':'';?> value="5">5</option>
                                  <option <?php echo ($count==10) ? 'selected=selected':'';?> value="10">10</option>
                                  <option <?php echo ($count==20) ? 'selected=selected':'';?> value="20">20</option>
                                  <option <?php echo ($count==50) ? 'selected=selected':'';?> value="50">50</option>
                                  <option <?php echo ($count==100) ? 'selected=selected':'';?> value="100">100</option>
                                </select>
                                
                              </td>
                            </tr>
                          </table>
                </div>
                <!-- Bottom navigation menu -->    
                   <?php $this->widget('CLinkPager',array('pages' => $pages1,'header' => '',
                        	'firstPageLabel' => '<',
                        	'prevPageLabel' => 'previous',
                        	'nextPageLabel' => 'next',                            
                        	'lastPageLabel' => '>','htmlOptions'=>array('name'=>'test','id'=>'navlist','class'=>'pager'))
                         ); ?>  
                     
                    <!-- /Bottom navigation menu -->  
            
            <div class="clear"></div>
             <?php /*<div style="float:right; width:625px;margin-top: 20px;">
                <div style="text-align: center;">
                <h1 style="font-size: 2em;">Listing waiting for publication </h1>
                <p style="color:#808080;">The following listing is waiting for Admin approval and publication.</p>
            </div> 
            <table class="gernal_table manageListing" border="0" bordercolor="#fff" style="" width="50%" cellpadding="1" cellspacing="2"> 
            <tr class="tableHeading">
                <td class="date_column" style="cursor:default; text-align: center; width:80px;" title="Date published">Submitted</td>
                <td class="title_column" style="cursor:default" title="Listing title">Listing Title</td>
                <td class="title_column" style="cursor:default" title="Listing title">Status</td>            
            </tr>           
          <?php 
             if(!empty($list)){
                $i=0;
                foreach($list as $listData){
                    if($i%2==0){
                    ?>
                        <tr onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('<?php echo Yii::app()->createUrl('businesslisting/create/blistid/'.$listData->drg_blid);?>');" class="GreyRow">
                    <?php    
                    }else {
                    ?>
                         <tr onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);" onclick="DoNav('<?php echo Yii::app()->createUrl('businesslisting/create/blistid/'.$listData->drg_blid);?>');" class="MauveRow">
         
                    <?php     
                    }
                    ?>
                        <td><?php  echo  date('d-m-Y',strtotime($listData->drg_datetime));?></td>
                        <td><?php  echo $listData->drg_slogon;?></td>                        
                        <td><?php  echo  $listData->drg_status;?></td>
                      </tr>    
                    
               <?php
                $i++;     
                }                
             }           
          
          ?> 
          
        </table> 
             <!-- Number of records to view drop down menu -->
                    <div id="page_nav" class="art-page-nav">
                      <table class="sl-select" id="example">
                        <tr>
                          <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
                          <td>
                          <?php 
                          if(isset($_REQUEST['row'])){
                        	$count = $_REQUEST['row'];
                        }else {
                        	$count = 5;
                        }
                         
                          ?>
                          <select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="window.location = '?row='+$(this).val();">
                              <option <?php echo ($count==5) ? 'selected=selected':'';?> value="5">5</option>
                              <option <?php echo ($count==10) ? 'selected=selected':'';?> value="10">10</option>
                              <option <?php echo ($count==20) ? 'selected=selected':'';?> value="20">20</option>
                              <option <?php echo ($count==50) ? 'selected=selected':'';?> value="50">50</option>
                              <option <?php echo ($count==100) ? 'selected=selected':'';?> value="100">100</option>
                            </select>
                            
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- Bottom navigation menu -->    
                   <?php $this->widget('CLinkPager',array('pages' => $pages,'header' => '',
                        	'firstPageLabel' => '<',
                        	'prevPageLabel' => 'previous',
                        	'nextPageLabel' => 'next',                            
                        	'lastPageLabel' => '>','htmlOptions'=>array('name'=>'test','id'=>'navlist','class'=>'pager'))); 
                    ?>  
                     
                    <!-- /Bottom navigation menu -->  
         
        </div>  */?>
                    
  </div>
  <div class="clear"></div>
</div>
<script type="text/javascript">
   $(".chzn-select").chosen();
//$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
 
    
    
// Change colour of table row on mouse over
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

function DoNav(theUrl)
    {
        document.location.href = theUrl;
    }

</script>