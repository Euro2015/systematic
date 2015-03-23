<p class="breadcrumb">
    <a href="index.php" >Home</a> &gt; 
    <a href="<?php echo Yii::app()->createUrl('myaccount/update');?>"> my account</a> &gt; manage listings    
</p> 
 <div class="clear"></div>
<div>
<?php 
    //$this->renderPartial('//layouts/listing_slider');
?>    
</div>
<div class="clear"></div>
<div id="registration-tabs"> <a href="javascript:void(0);">My Profile</a>
    <div class="clear"></div>
</div>
<div class="registration-content" style="min-height:580px"> 
        <div class="my-account-links">
          <?php 
            $this->renderPartial("//layouts/my-account-links"); 
          ?>
        </div>  
        <div style="float:right;width:625px;">
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
                    <td class="" style="cursor:default; width:120px;" title="Total number of page visits">Total page visits</td>
                    <td class="" style="cursor:default; width:80px;" title="Access period for listing">Access period</td>
                </tr>
                <tr onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);" class="GreyRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> 
                <tr onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"  class="GreyRow" style="background-color: rgb(234, 221, 237);">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
           	</table> 
            <div style="float:right; width:625px;margin-top: 20px;">            
                <div style="text-align: center;">
                <h1 style="font-size: 2em;">Listing waiting for publication </h1>
                <p style="color:#808080;">The following listing is waiting for Admin approval and publication.</p>
            </div> 
            
            <table class="gernal_table manageListing" border="0" bordercolor="#fff" style="" width="50%" cellpadding="1" cellspacing="2"> 
            <tr class="tableHeading">
                <td class="date_column" style="cursor:default; text-align: center; width:50px;" title="Date published">Submitted</td>
                <td class="title_column" style="cursor:default" title="Listing title">Listing Title</td>
                <td class="title_column" style="cursor:default" title="Listing title">Status</td>            
            </tr> 
            <?php 
            if($list){
                $j=1;
                foreach($list as $list1){                    
                    if($j%2=="1"){ 
                    ?>
                         <tr onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);" onclick="DoNav('<?php echo Yii::app()->createUrl('listing/create',array('listid'=>$list1->drg_lid));?>');" class="GreyRow">  
                    <?php  
                    }else {
                     ?>   
                        <tr onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);"  onclick="DoNav('<?php echo Yii::app()->createUrl('listing/create',array('listid'=>$list1->drg_lid));?>');" class="GreyRow" style="background-color: rgb(234, 221, 237);">

                    <?php    
                    }
                    ?>
                    <td><?php  echo $list1->drg_date;?></td>
                    <td><?php  echo $list1->drg_title;?></td>
                    <td>
                        <?php 
                		 if($list1->reject_list =="0")
                		 { 
                		      echo "Waiting for publication"; 
                         }
                		 else {
                		      echo "<span style='color:red;'>Rejected</samp>"; 
                         }
                		 ?>
                     </td>
                  </tr>
                 <?php
                }
             
            }
             
              /* $this->widget('zii.widgets.grid.CGridView', array(
            	'id'=>'managelisting-grid',
            	'dataProvider'=>$model->search(), 
                'itemsCssClass' => 'gernal_table manageListing',
                'rowCssClassExpression'=>'( $row%2 ? GreyRow : GreyRow1  )', 
                'columns'=>array(                    
                    array(
                       
                      'header' => 'Submitted',  
                      'type' => 'raw',
                      'name'=>'drg_profession', 
                      'value' => 'test',                      
                     //'htmlOptions'=>array('class'=>'test')
                        
                    ),
                    array(
                      'type' => 'raw',
                      'name'=>'drg_viewlimit',  
                    ),
                    array(
                      'type' => 'raw',
                      'name'=>'drg_logo',  
                    ),
                	array(
            			'class'=>'CButtonColumn',
                        'header' => 'Action',
                        'template' => '{update}{delete}', 
            		), 
            	),
            )); */
            
            ?>            
            </table>  
            
        </div>
                
    </div>        
</div>
<script>
    
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