          
<?php 
$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl.'/js/chosen.jquery.js');
$js->registerScriptFile($baseUrl.'/js/chosen.jquery.js');
$js->registerCssFile($baseUrl.'/css/chosen.css');
?>
<script type="text/javascript">
jQuery(document).ready(function(){
    
    jQuery(".chzn-select").chosen();
});
//jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>
<!--<h1 class="cms_page_title">Search For a Listing</h1>-->

<?php
$this->breadcrumbs=array(
	'Sliders'=>array('./slider')	 
);?> 
<div class="user_listing_search"><br> 

    <div>
	 <h2 align="center" class="Blue" style="margin:15px 0;">Create / Update Site Sliders  </h2> 
<div style="height: 39px;"><a href="<?php echo $this->createUrl('/admin/slider/slider/create');?>" class="button blue" style="float:right">+Add New Slider</a></div>
	  <div>
    <table class="gernal_table manageListing" border="0" bordercolor="#fff" style="" width="50%" cellpadding="1" cellspacing="2"> 
            <tr class="tableHeading">
                <!--<td class="date_column" style="cursor:default; text-align: center; width:50px;" title="Date published">Submitted</td>-->
<td class="title_column" style="cursor:default" title="Listing title">Slider Title</td>
<td class="title_column" style="cursor:default" title="Listing title">Page</td>
                <td class="title_column" style="cursor:default" title="Listing title">Slider File Name</td>       
            </tr>           
          <?php 
          if($list > 0){        foreach($list as $row){ 
                    if($i%2==0){
                    ?>
                        <tr onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('<?php echo Yii::app()->createUrl('admin/slider/slider/create/id/'.$row->slider_id);?>');" class="GreyRow">
                    <?php    
                    }else {
                    ?>
                         <tr onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);" onclick="DoNav('<?php echo Yii::app()->createUrl('admin/slider/slider/create/id/'.$row->slider_id);?>');" class="MauveRow">
         
                    <?php     
                    }
                    ?>
                        <td><?php  echo $row->slider_title;?></td><td><?php  
$id = $row->page_name; 
$connection = Yii::app()->db;
$getslider = $connection->createCommand("select * from `drg_site_actions` where `pslug`='$id'");
$sliderresult = $getslider->queryRow();
echo $sliderfile = $sliderresult['pname'];
?></td>
                             <td><?php  echo $row->page_slug;?></td>              
                        </tr>    
                    
               <?php
                $i++;   
                }                
             } 
          ?> 
        </table>  <div class="clear"></div>		 <div id="page_nav" class="art-page-nav">                          <table class="sl-select" id="example">                            <tr>                              <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>                              <td>                              <?php                               if(isset($_REQUEST['rows'])){                            	$count = $_REQUEST['rows'];                            }else {                            	$count = 20;                            }                                                           ?>                              <select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="window.location.href = '?rows='+jQuery(this).val();">                                   <option <?php echo ($count==20) ? 'selected=selected':'';?> value="20">20</option>                                  <option <?php echo ($count==50) ? 'selected=selected':'';?> value="50">50</option>                                  <option <?php echo ($count==100) ? 'selected=selected':'';?> value="100">100</option>                                </select>                                                              </td>                            </tr>                          </table>                </div>                    <!-- Bottom navigation menu -->                       <?php $this->widget('CLinkPager',array('pages' => $pages,'header' => '',                        	'firstPageLabel' => '<',                        	'prevPageLabel' => 'previous',                        	'nextPageLabel' => 'next',                            'maxButtonCount'=>5,                        	'lastPageLabel' => '>','htmlOptions'=>array('name'=>'test','id'=>'navlist','class'=>'pager'))                         ); ?>                                           <!-- /Bottom navigation menu -->             <ul name="test" id="navlist" class="pager"></ul>            <div class="clear"></div>
   
</div>
<script language="javascript" type="text/javascript">    

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
    
//$(".chzn-select").chosen();
</script> 