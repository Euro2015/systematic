<h1 class="cms_page_title">Active Banners</h1>
<?php
    $this->breadcrumbs=array(
    	'active banners'=>array('../banner/banner/active')	 
    );
?> 
<div class="user_listing_search admin-banner-add">
    <h1 class="Blue" align="center">Active Banners <br /><span class="black-color" >( <?php echo $item_count; ?> )</span></h1>
    <br /> 
    <div class="Main">  
    <form action="" method="post" >
        <table class="sl-select" width="100%" >
            <tr>
              <th class="first" width="25%" title="Select a category from the dropdown menu">Username:</th>
              <th class="last" width="75%" title="Select a category from the dropdown menu">Keywords:</th>
            </tr>
            <tr>
              <td class="first" width="25%"><input type="text" name="username" value="<?php if(isset($_REQUEST['username'])){echo $_REQUEST['username'];} else {echo "";} ?>"  size="50"  /></td> 
              <td class="last" width="75%"><input type="text" name="Keyword" size="70"  value="<?php if(isset($_REQUEST['drg_title'])){echo $_REQUEST['drg_title'];} else {echo "";} ?>"/></td>
            </tr>
            <tr class="last">
                <td align="center" colspan="2"><input type="submit" value="Submit" class="button black"/></td>
            </tr>
          </table>
      </form> 
    </div>
    <div class="clearBoth"></div> 
     <br />
     <table class="gernal_table white-background" border="0" bordercolor="#fff" width="100%" cellpadding="1" cellspacing="2">
      <tr class="tableHeading">
        <td class="title_column" title="Username">Username</td>
        <td class="details_column" title="Image location">Image location</td>
        <td class="date_column" title="Date of submission">DOS</td>
        <td class="date_column"title="Cost">Cost($)</td> 
          <td class="date_column"title="Listing description">Status</td> 
      </tr>
      <?php   
       if($list > 0){
             foreach($list as $row){ 
                
              $user =   User::model()->findByPk($row->drg_user_id);
             ?>
                 <tr <?php if($i%2==0){?>onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('#');"<?php }else{?>onmouseover="ChangeColorMauve(this, true);"  onmouseout="ChangeColorMauve(this, false);"  onclick="DoNav('#');"<?php }?> class="<?php if($i%2==0){echo "MauveRow";}else{echo "GreyRow";}?>">
                     <td class="bannerview" data-role="<?php echo $row->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $row->banner_id;?>"><?php echo $user->drg_name; ?></a></td>
                     <td class="bannerview" data-role="<?php echo $row->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $row->banner_id;?>"><?php echo $row->banner_path; ?></a></td>
                     <td class="bannerview" data-role="<?php echo $row->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $row->banner_id;?>"><?php echo $row->banner_subdate; ?></a></td>
                     <td class="bannerview" data-role="<?php echo $row->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $row->banner_id;?>"><?php echo $row->banner_cost; ?></a></td>
                     <td class="bannerview" data-role="<?php echo $row->banner_id;?>">Active</td>
                  </tr>
             
            <?php $i++;
            }
        }
        ?>
     </table>
     <div style="clear: both;"></div>   
      <table class="sl-select ad-bnr-selec">
        <tr>
            <td class="drowpdown-mnu" title="Select number of records to view from the dropdown menu">View</td>
            <td>
                <?php 
                $count = Yii::app()->request->getParam('rows'); 
                if(!isset($count)){
                	$count = 6;
                }
                ?>
                <!--<select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2">-->
                <select name="drg_category" data-placeholder="12" class="chzn-select width60" tabindex="2" onchange="window.location = '?rows='+jQuery(this).val();">
                    <option value=""></option>
                    <option <?php echo ($count==6) ? 'selected=selected':'';?> value="6">6</option>
                    <option <?php echo ($count==10) ? 'selected=selected':'';?> value="10">10</option>
                    <option <?php echo ($count==20) ? 'selected=selected':'';?> value="20">20</option>
                    <option <?php echo ($count==50) ? 'selected=selected':'';?> value="50">50</option>
                    <option <?php echo ($count==100) ? 'selected=selected':'';?> value="100">100</option>  
                </select>
            </td>
        </tr>
    </table>
         <!-- Bottom navigation menu -->    
       <?php $this->widget('CLinkPager',array('pages' => $pages,'header' => '',
            	'firstPageLabel' => '<',
            	'prevPageLabel' => 'previous',
            	'nextPageLabel' => 'next',
                'maxButtonCount'=>5,
            	'lastPageLabel' => '>','htmlOptions'=>array('name'=>'test','id'=>'navlist','class'=>'pager'))
             ); ?>  
         
      <!-- /Bottom navigation menu --> 
     <div id="bannerdetails"></div>
</div>

<script language="javascript" type="text/javascript">  
jQuery("#sendmail").live("click",function(){
    jQuery("#mailsent").fadeIn("slow");
    
}); 
jQuery("td.bannerview").click(function(){
   var bannerid = jQuery(this).attr("data-role");
    jQuery('html,body').animate({ scrollTop: 500 }, 'slow', function () {});
   jQuery.ajax({
      url: '<?php echo Yii::app()->createUrl('admin/banner/banner/ajax') ?>',
      type: 'post',
      data: {'bannerid': bannerid},
      success: function(data, status) {
        jQuery("#bannerdetails").empty().append(data).fadeIn();
        

        
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    });  
   
})  
jQuery(".updatelink").live("click",function(){
   var bannerid = jQuery(this).attr("data-role");
   var bannerlink = jQuery("#bannerlink").val();
   if(bannerlink ==""){
    jQuery("#bannerlink").addClass("mandatoryerror");
    return false;
   }else {
    jQuery.ajax({
      url: '<?php echo Yii::app()->createUrl('admin/banner/banner/updatelink') ?>',
      type: 'post',
      data: {'bannerid': bannerid,'bannerlink':bannerlink},
      success: function(data, status) {
        
        
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    });  
    
   }
});

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
    
jQuery(".chzn-select").chosen();
</script> 
<style type="text/css"> 
.selected a{
    color: #00ACCE !important;
    font-weight: bold;
}
</style>