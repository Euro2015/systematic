<style type="text/css">
#chart_userActivityChart{margin-top:15px;}
.userData{top:-50px;}
</style>
<?php 
$this->breadcrumbs=array($model->drg_user_type=='business'?'business user account':'default user account'); 
?>

<?php $this->renderPartial('profile_info',array('model' =>$model,'total' =>$total)); ?>

<?php /*
<div class="update-profile-pic profile-pic">
      <?php 
      if($model->drg_image){
          $img = $model->drg_image;
          $alt_img = $model->drg_name.' '.$model->drg_surname;            
      }else {
          $img = 'avatar.jpg';
          $alt_img = 'Avatar';
      }
      ?>
    <div class="pro-photo" style="float: left; width: 44%;">
          <img src="<?php echo $this->createUrl('/upload/logo/'.$img);?>" alt="<?php Yii::app()->params['company_name']; ?>" />
      </div>
          <div class="profile-detail" style="width: 55%;">
               <ul>
                   <li><label class="field">Member since:</label><?php echo $model->drg_rdate; ?> </li>
                   <li><label class="field">Status:</label> Online</li>
                   <li><label class="field">Prize wins:</label>0 </li>
                   <li><label class="field">Total won:</label>0 </li>
                   <li><label class="field">Time logged this month:</label>
                    <?php echo $this_month = ActivityDate::getTimeThisMonth($model->drg_id);?> hrs
                   </li>
                   <li><label class="field">Average time logged per month:</label> <?php echo ActivityDate::getAvgPerMonth($model->drg_id); ?> hrs</li>
                   <li><label class="field">Points total this month:</label><?php echo $this_month*60; ?> </li>
               </ul> 
          </div>
            <?php 
            $prev_member = Member::prev_member($model->drg_id);
            $next_member = Member::next_member($model->drg_id);
            if($prev_member || $next_member)
            {
            ?>

            <div class="memberNavigation" style="width: 45%;"> 
                <?php if(is_object($prev_member)){  ?>
                    <aside class="prevLink floatLeft">
                        <?php echo CHtml::link('Previous', $this->createUrl('/admin/member/update/id/'.$prev_member->drg_id)); ?>    
                    </aside>
                <?php } ?>

                <?php if(is_object($next_member)){ ?>
                    <aside class="nextLink floatRight">
                        <?php echo CHtml::link('Next>>', $this->createUrl('/admin/member/update/id/'.$next_member->drg_id)); ?>
                    </aside>
                <?php } ?>
            </div>
            <?php
            }
            ?>            
     <div class="clearBoth"></div>
  </div>
*/?>

<div style="top:-30px;">
<?php 
$this->renderPartial('_form', array('model'=>$model/*,'list'=>$list,'pages' => $pages,'item_count'=>$item_count,'page_size'=>$page_size*/)); ?>
</div>
<?php

/*
    Add Charts in User Profile page 

*/ 
if(!$model->isNewRecord){
   /*
    ?>
    <div class="clearboth"></div>  
    <div class="chart">
        <h1>User data graph</h1>
        <div id="chartcontainer">Please wait.....</div>
        <script type="text/javascript">
            var myData = new Array(['unit', 20], ['unit two', 10], ['unit three', 30],['other unit', 10], ['last unit', 30]);
            var myChart = new JSChart('chartcontainer', 'bar');
            myChart.setDataArray(myData);
            myChart.draw();
        </script>
    </div>*/?>
    <?php
    $this->widget('application.modules.admin.extensions.fusioncharts.fusionChartsWidget', array( 
      'chartNoCache'=>true, // disabling chart cache
      'registerWithJS'=>true,
      'chartType'=>'MSColumn2D',
      'chartWidth' =>'1000',
      // 'chartAction'=>Yii::app()->createUrl('/admin/member/generateChart'), // the chart action that we just generated the xml data at
      'chartAction'=>Yii::app()->createUrl('/admin/member/userActivityChart/user_id/'.$model->drg_id), 
      'chartId'=>'userActivityChart')); // If you display more then one chart on a single page then make sure you specify and id
    ?>
    <script type="text/javascript">
    function updateChart(factoryIndex){ 
      //DataURL for the chart
      var strURL = "FactoryData.php?factoryId=" + factoryIndex;
      //Sometimes, the above Url and XML data gets cached by the browser.
      //If you want your charts to get new XML data on each request,
      //you can add the following line:
      //strURL = strURL + "&currTime=" + getTimeForURL();
      //getTimeForURL method is defined below and needs to be included
      //This basically adds a ever-changing parameter which bluffs
      //the browser and forces it to re-load the XML data every time.
      //Get reference to chart object using Dom ID "FactoryDetailed"
      //Send request for XML
       FusionCharts("userActivityChart").setXMLUrl(strURL);
      }

    </script>
<?php    
}
?>
