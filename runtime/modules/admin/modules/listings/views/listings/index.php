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
	'Search for a  listing'=>array('./listings')	 
);?> 
<div class="user_listing_search"><br> 

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'listings-form',
	'enableAjaxValidation'=>false,
    'method'=>'post'
)); ?> 
    <div>
	 <h2 align="center" class="Blue" style="margin:15px 0;">Search for a  listing</h2> 
<table class="sl-select">
        <tr>
          <td style="text-align: right; cursor: default;" title="Select a category from the dropdown menu">Category:</td>
          <td>
          	<?php 
		 		 $listData =  CHtml::listData(Listingcategory::model()->findAll(),'list_category_id','list_category_name');
                 echo CHtml::dropDownList('drg_categorys',$_REQUEST['drg_categorys'],$listData,array('prompt' => 'Please Select','class'=>'chzn-select','data-placeholder'=>'Please select','id'=>'sl_category'));
		         echo $form->error($model,'drg_categorys');		
			?>
          </td>
          <td style="text-align: right; cursor:default;" title="Select a section from the dropdown menu">Looking For:</td>
          <td>
         <?php 
              $listData =  CHtml::listData(Listinglookingfor::model()->findAll(array("order"=>'sort_order asc')),'lookingfor_id','lookingfor_name');
              echo CHtml::dropDownList('drg_profession',$_REQUEST['drg_profession'],$listData,array('empty' => 'Please select','class'=>'chzn-select','data-placeholder'=>'Please select','id'=>'sl_profession','title'=>'Select a what you are looking for from the list'));
              echo $form->error($model,'drg_profession');  
          ?> 
          </td>
          <td style="text-align: right; cursor: default;" title="Select country from the dropdown menu">Limit search to:</td>
          <td>
          <?php 
            if(isset($_POST['drg_viewlimit'])){
                $drg_viewlimit = $_REQUEST['drg_viewlimit'];
            }else {
                $drg_viewlimit = $model->drg_viewlimit;
            }
              $listData = CHtml::listData(Country::model()->findAll(),'country_id','country');
    		 
              echo CHtml::dropDownList('drg_viewlimit',$drg_viewlimit,$listData,array('empty' => 'Worldwide (default)','class'=>'chzn-select','data-placeholder'=>'Worldwide (default)','onfocus'=>'getSelectNormal("#sl_vlimit");','id'=>'sl_vlimit','tabindex'=>'3','title'=>'Limit your exposure of your business idea to a country of your choice'));
              echo $form->error($model,'drg_viewlimit'); 
		  ?>
          </td>
        </tr>
      </table>
	  <div>
      <table class="sl-select">
        <tr>
          <td style="text-align: right; cursor: default;" title="Select a category from the dropdown menu">
          	Username:
          </td>
          <td><input type="text" name="username" value="<?php if(isset($_REQUEST['username'])){echo $_REQUEST['username'];} else {echo "";} ?>" style="width:176px"  /></td>
		  <input type="hidden" name="Listings[drg_uid]" value="" style="width:176px" />
          <td style="text-align: right; cursor: default;" title="Select a category from the dropdown menu">
          	Listing title:
          </td>
          <td><input type="text" name="drg_title" style="width:176px" value="<?php if(isset($_REQUEST['drg_title'])){echo $_REQUEST['drg_title'];} else {echo "";} ?>"/></td>
          <td style="text-align: right; cursor: default;" title="Select a category from the dropdown menu">
          	Keywords:
          </td>
          <td><input type="text" name="Keyword" style="width:176px"  value="<?php if(isset($_REQUEST['Keyword'])){echo $_REQUEST['Keyword'];} else {echo "";} ?>"/></td>
        </tr>
      </table>
    </div>
    <br />
    <div id="submitQuery">
      <input type="submit" value="Submit Query" class="button black"/>      
    </div>
<?php $this->endWidget();  ?>
    <div class="clearBoth"></div> 
     <br />
    <table class="gernal_table" border="0" bordercolor="#fff" style="background-color:#fff" width="100%" cellpadding="1" cellspacing="2">
      <tr class="tableHeading">
        <td class="date_column" title="Date of submission">Date</td>
        <td class="username_column" title="Username of member">Username</td>
        <td class="title_column" title="Title of listing">Title</td>
        <td class="details_column"title="Listing description">Description</td> 
        <td class="details_column"title="Listing description">Listing Type</td>
        <td class="details_column"title="Listing description">Listing Category</td>
        <td class="details_column"title="Listing description">Listing Status</td>
      </tr>
      <?php         
    
       if($list > 0){
            foreach($list as $row){             
              ?>      
                 <tr <?php if($i%2==0){?>onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('#');"<?php }else{?>onmouseover="ChangeColorMauve(this, true);"  onmouseout="ChangeColorMauve(this, false);"  onclick="DoNav('#');"<?php }?> class="<?php if($i%2==0){echo "MauveRow";}else{echo "GreyRow";}?>">
                     <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>"><?php echo $row->drg_date;?></a></td>
                     <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>"><?php echo SharedFunctions::get_user_names($row->drg_uid);?></a></td>
                     <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>"><?php echo substr($row->drg_title,0,30);?></a></td>
                     <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>"><?php echo substr($row->drg_desc,0,150);?></a></td>
                     <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>"><?php echo SharedFunctions::get_listingtype($row->drg_category);?></a></td>
                     <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>"><?php echo SharedFunctions::get_listingtype($row->drg_listingstatus);?></a></td>
                     <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->drg_lid)); ?>"><?php echo SharedFunctions::get_listingtype($row->drg_status);?></a></td>
                  </tr>
          
           <?php $i++;} 
       } ?>
      
     </table>
     <div class="clear"></div>
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
                              <!--<select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="window.location = '?rows='+jQuery(this).val();">--> 
                                 <select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="pagin(this.value);">
                                  <option <?php echo ($count==5) ? 'selected=selected':'';?> value="5">5</option>
                                  <option <?php echo ($count==10) ? 'selected=selected':'';?> value="10">10</option>
                                  <option <?php echo ($count==20) ? 'selected=selected':'';?> value="20">20</option>
                                  <option <?php echo ($count==50) ? 'selected=selected':'';?> value="50">50</option>
                                  <option <?php echo ($count==100) ? 'selected=selected':'';?> value="100">100</option>  
                                </select>
                                <form action="" id="paging" method="post"> 
                                   
                                    <?php 
                                    if(isset($_REQUEST)){
                                        foreach($_REQUEST as $key=>$val){
                                            echo '<input type="hidden" name="'.$key.'" value="'.$val.'" />';
                                        }
                                    }
                                    ?>
                                     <input type="hidden" name="rows" id="rows" />
                                </form>
                                <script type="text/javascript">
                                    function pagin(val){
                                        jQuery("#rows").val(val);
                                        jQuery("#paging").submit();
                                    }
                                   /* jQuery("#navlist a").on("click",function(){
                                        jQuery("#paging").submit();
                                    }); */
                                </script>
                              </td>                              
                            </tr>
                          </table>
                </div>
           
     <!-- Bottom navigation menu -->    
                   <?php $this->widget('CLinkPager',array('pages' => $pages,'header' => '',
                        	'firstPageLabel' => '<',
                        	'prevPageLabel' => 'previous',
                        	'nextPageLabel' => 'next',
                            'maxButtonCount'=>5,
                        	'lastPageLabel' => '>','htmlOptions'=>array('name'=>'test','id'=>'navlist','class'=>'pager'))
                         ); ?>  
                     
                    <!-- /Bottom navigation menu -->  
               <ul id="navlist" class="pager" name="test"></ul>
            <div class="clear"></div>
    
    
    
    
    
    
	  
<?php 
$user_name = CHtml::listData(User::model()->findAll(),'drg_uid','drg_name'); 
?>
<?php   
  /*  
  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'listings-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table-class display dataTable',
	'columns'=>array(
	 array(
        'header' => 'Date',
        'name' => 'drg_date',
        'value' => 'CHtml::link($data->drg_date, Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
        'type'  => 'raw', 
        ),
		array(
        'header' => 'User name',
        'name' => 'drg_uid',
        'value' => 'CHtml::link(SharedFunctions::get_user_names($data->drg_uid), Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
        'type'  => 'raw', 
        ), 
		array(
        'header' => 'Title',
        'name' => 'drg_title',
        'value' => 'CHtml::link($data->drg_title, Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
        'type'  => 'raw', 
        ),
		array(
		'header' =>'Description',
		'name' =>'drg_desc',
		'value' => 'CHtml::link($data->drg_desc, Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
        'type'  => 'raw', 
			
		),
			array(
		'header' =>'Listing Type',
		'name' =>'drg_desc',
		'value' => 'CHtml::link(SharedFunctions::get_listingtype($data->drg_category), Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
        'type'  => 'raw', 
			
		), 
	),
));  

*/

?> 
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
<style type="text/css">
.selected a{
    color: #1DBFD8;
}
</style>