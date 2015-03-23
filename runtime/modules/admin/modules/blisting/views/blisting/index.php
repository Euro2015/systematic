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
<h1 class="cms_page_title">Search For a Business Listing</h1>

<?php
$this->breadcrumbs=array(
	'Search for a Business listing'=>array('./blisting')	 
);?> 
<div class="user_listing_search">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blistings-form',
		'enableAjaxValidation'=>false,
)); ?> 
    <div>
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
	
          <td style="text-align: right; cursor: default;" title="Select a category from the dropdown menu">
          	Slogon:
          </td>
          <td><input type="text" name="drg_slogon" style="width:176px" value="<?php if(isset($_REQUEST['drg_slogon'])){echo $_REQUEST['drg_slogon'];} else {echo "";} ?>"/></td>
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
        <td class="details_column"title="Listing description">Slogon</td> 
        <td class="title_column" title="Title of listing">Who We Are</td>
        <td class="details_column"title="Listing description">Offer</td> 
    
      </tr>
      <?php         
    
       if($list > 0){
        foreach($list as $row){ 
            
          ?>      
             <tr <?php if($i%2==0){?>onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('#');"<?php }else{?>onmouseover="ChangeColorMauve(this, true);"  onmouseout="ChangeColorMauve(this, false);"  onclick="DoNav('#');"<?php }?> class="<?php if($i%2==0){echo "MauveRow";}else{echo "GreyRow";}?>">
                  <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>"><?php  $timestamp = strtotime($row->drg_datetime); echo date('d/m/Y', $timestamp); ?></a></td>
                 <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>"><?php echo SharedFunctions::get_user_names($row->drg_uid);?></a></td>
                 <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>"><?php echo substr($row->drg_slogon,0,150);?></a></td>
                 <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>"><?php echo substr($row->drg_whoweare,0,30);?></a></td>
                 <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update",array("id"=>$row->drg_blid)); ?>"><?php echo substr($row->drg_offer,0,30);?></a></td>
               

                
              </tr>
      
       <?php $i++;} }?>
      
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
                              <select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="window.location.href = '?rows='+jQuery(this).val();">
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
                            'maxButtonCount'=>5,
                        	'lastPageLabel' => '>','htmlOptions'=>array('name'=>'test','id'=>'navlist','class'=>'pager'))
                         ); ?>  
                     
                    <!-- /Bottom navigation menu -->  
           <ul name="test" id="navlist" class="pager"></ul>
            <div class="clear"></div>
    
	  
<?php 
$user_name = CHtml::listData(User::model()->findAll(),'drg_uid','drg_name'); 
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
