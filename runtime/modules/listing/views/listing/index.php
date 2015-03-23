<?php
if(isset($_POST['listing_delete_id']))
{
$id=$_POST['listing_delete_id'];
$this->loadModel($id)->delete();
$furl=$_POST['furl'];
$this->redirect(Yii::app()->createUrl("$furl"));
}
$this->breadcrumbs=array(
	'User listings'=>array('index'),
	'Manage',
);
?>
<div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
    <div class="clear"></div>
</div>
<div class="registration-content" style="min-height:580px"> 
        <div class="my-account-links">
          <?php 
            //$this->renderPartial("//layouts/my-account-links"); 
            $this->renderPartial('//../modules/listing/views/layouts/my-account-links');                 
          ?>
        </div>        
		<div class="delete_listing black-popup" style="display: none;">        <div class="delete_listing_popup">      	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" />           <div class="my-listing-delete-box">               <form action="" method="post">      <?php $surll= $_SERVER["REQUEST_URI"];
     $surll1 = ltrim($surll, '/'); ?>         
     <input type="hidden" name="furl" value="<?php echo $surll1; ?>">       <input type="hidden" value="" id="listing_delete_id" name="listing_delete_id" > <span style="font: 25px AuraBoldRegular, Helvetica, Arial;  margin-top: 20px;
  color: #1dbfd8;
  display: block;">Delete Listing</span><br/>   <span>Are you sure you want to Permanently delete this listing from the website?</span><br/>                <span style="  display: block;
  font-size: 11px;
}"><i style="color:red;">Warning this action cannot be undone</i></span><br/>                <div class="confirmbtn">                    <button  type="submit" name="deletelisting" class="button black">OK</button></form>&nbsp;&nbsp;&nbsp;&nbsp;<button class="button black" type="button" onClick="jQuery('.delete_listing').hide();jQuery('#listing_delete_id').val('0');jQuery('.userlistings').fadeIn('slow'); return false;">Cancel</button>                </div>            </div>        </div>    </div>

        <div style="float:right; width:625px;" class="userlistings">
        <div style="text-align: center;">
          <h1 style="font-size: 2em;">Select the listing you wish to manage </h1>
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
            <td class="" style="cursor:default; width:120px;" title="Total number of votes received">Total votes to date</td>
            <td class="" style="cursor:default; width:80px;" title="Listing access period">Access period</td>
            <td class="" style="cursor:default; width:35px;" title="Delete listing">Delete</td>
          </tr>
          <?php 
          if(!empty($list1)){
                $j=0;
                foreach($list1 as $listData1){
                   if($j%2==0){
                   ?>
                     <tr class="GreyRow">
                   <?php           
                   }else {
                   ?>
                     <tr class="MauveRow" <!--style="background-color: rgb(234, 221, 237);"--> >        
                   <?php 
                   }
                   ?>
                    <td  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/selectlisting/listid/'.$listData1->drg_lid);?>');" <?php if($j%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?>><?php echo date('d-m-Y',strtotime($listData1->drg_approvedate));?></td>
                    <td  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/selectlisting/listid/'.$listData1->drg_lid);?>');" <?php if($j%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?>><?php echo $listData1->drg_title;?></td>
                    <td  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/selectlisting/listid/'.$listData1->drg_lid);?>');" <?php if($j%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?>><?php
                            $from=date_create(date('Y-m-d'));
                            $to=date_create($listData1->drg_approvedate);
                            $diff=date_diff($to,$from);
                            echo $diff->format('%R%a days');
                        ?></td>
                    <td  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/selectlisting/listid/'.$listData1->drg_lid);?>');" <?php if($j%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?>>
                    <?php
                        if($listData1->drg_listingstatus==5){
                            $from=date_create(date('Y-m-d'));
                            $to=date_create($listData1->drg_approvedate);
                            $diff=date_diff($to,$from);
                            echo $diff->format('%R%a days');
                        }else {
                            echo 0;
                        }
                    ?>                    
                    </td>
                    <td  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/selectlisting/listid/'.$listData1->drg_lid);?>');" <?php if($j%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?>>0</td>
                    <td  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/selectlisting/listid/'.$listData1->drg_lid);?>');" <?php if($j%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?>>0</td>
                    <td style="text-align: center; background-color: #fff" ><input type="hidden" value="<?php echo $listData1->drg_lid; ?>" name="del_listidnew" id="del_listidnew"><a href="javascript:{}" onclick="delete_listingnew<?php echo $j; ?>();" title="Delete this listing"  class="delbtnnew<?php echo $j; ?>" id="delbtnnew"><img src="themes/business/images/icons/delete.gif" alt="Delete this listing"></a></td>
                    </tr>
					        <script>
					function delete_listingnew<?php echo $j; ?>() 
	{     
	jQuery(".delete_listing").fadeIn(); 
	jQuery(".userlistings").fadeOut('fast');
	var lid = $(".delbtnnew<?php echo $j; ?>").parent().find('#del_listidnew').val();
    $('#listing_delete_id').val(lid);
	}
	</script>
                   <?php 
				   $j++; 
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
                   <?php  $this->widget('CLinkPager',array('pages' => $pages1,'header' => '',
                        	'firstPageLabel' => '<',
                        	'prevPageLabel' => 'previous',
                        	'nextPageLabel' => 'next',                            
                        	'lastPageLabel' => '>','htmlOptions'=>array('name'=>'test','id'=>'navlist','class'=>'pager'))
                         );   ?>  
                     
                    <!-- /Bottom navigation menu -->  
            
            <div class="clear"></div>
            
             <div style="float:right; width:625px;margin-top: 20px;">            
                <div style="text-align: center;">
                <h1 style="font-size: 2em;">Listing waiting for publication </h1>
                <p style="color:#808080;">The following listing is waiting for Admin approval and publication.</p>
            </div> 
            <table class="gernal_table manageListing" border="0" bordercolor="#fff" style="" width="50%" cellpadding="1" cellspacing="2"> 
            <tr class="tableHeading">
                <td class="date_column" style="cursor:default; text-align: center; width:50px;" title="Date published">Submitted</td>
                <td class="title_column" style="cursor:default" title="Listing title">Listing Title</td>
                <td class="title_column" style="cursor:default; width: 130px;" title="Listing title">Status</td>
                <td class="" style="cursor:default; width:35px;" title="Delete listing">Delete</td><script>var imageNode= document.getElementById('delbtn');$("#delbtn").hover(function(){   e.preventDefault()       e.stopImmediatePropagation()  // Do something});</script>
            </tr>           
          <?php 
             if(!empty($list)){
                $i=0;
                foreach($list as $listData){
				?>
				
				<?php
                    if($i%2==0){
                    ?>
                        <tr class="GreyRow">
                    <?php    
                    }else {
                    ?>
                         <tr  class="MauveRow">
         
                    <?php     
                    }
                    ?>
                        <td onclick="DoNav('<?php echo Yii::app()->createUrl('listing/create/listid/'.$listData->drg_lid);?>');" <?php if($i%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?> ><?php  echo $listData->drg_date;?></td>
                        <td  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/create/listid/'.$listData->drg_lid);?>');" <?php if($i%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?> ><?php  echo $listData->drg_title;?></td>                        
                        <td  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/create/listid/'.$listData->drg_lid);?>');" <?php if($i%2==0){  ?> onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  <?php }else {  ?> onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"   <?php } ?> ><?php 
                		 if($listData->reject_list =="0")
                		 { 
                		      echo "Waiting for publication"; 
                         }
                		 else {
                		      echo "<span style='color:red;'>Rejected</samp>"; 
                         }
                		 ?></td>
                        <td style="text-align: center; background-color: #fff"><input type="hidden" value="<?php echo $listData->drg_lid; ?>" name="del_listid" id="del_listid"><a href="javascript:{}" onclick="delete_listing<?php echo $i; ?>();" title="Delete this listing"  class="delbtn<?php echo $i; ?>" id="delbtn"><img src="themes/business/images/icons/delete.gif" alt="Delete this listing"></a></td>
                      </tr>    
                    <script>
					function delete_listing<?php echo $i; ?>() 
	{     
	jQuery(".delete_listing").fadeIn(); 
	jQuery(".userlistings").fadeOut('fast');
	var lid = $(".delbtn<?php echo $i; ?>").parent().find('#del_listid').val();
    $('#listing_delete_id').val(lid);
	}
	</script>
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
                        	'lastPageLabel' => '>',
                            'htmlOptions'=>array('name'=>'test1','id'=>'navlist','class'=>'pager'))
                         ); 
                   ?>  
                     
                    <!-- /Bottom navigation menu -->  
            
        </div> 
  </div>
  <div class="clear"></div>
</div>
<script type="text/javascript">
      $(".chzn-select").chosen();
	
function ChangeColorMauve(tableRow, highLight)
    {
        if (highLight)
            {
                tableRow.closest("tr").style.backgroundColor = '#C9C';
            }
        else
            {
                tableRow.closest("tr").style.backgroundColor = '#EADDED';
            }
    }

function ChangeColorGrey(tableRow, highLight)
    {
        if (highLight)
            {
			                 tableRow.closest("tr").style.backgroundColor = '#C2C2C2';
            }
        else
            {
                tableRow.closest("tr").style.backgroundColor = '#EBEBEB';
            }
    }
	


function DoNav(theUrl)
    {
        document.location.href = theUrl;
    }

</script>