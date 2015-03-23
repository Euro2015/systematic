<?php $this->beginContent('//layouts/main'); ?>
<div id="leftcontent">    
    <?php error_reporting(0);
    $sliderfunc=Yii::app()->controller->id."/".Yii::app()->controller->action->id;
    $connection = Yii::app()->db;
    $getslider = $connection->createCommand("select * from `drg_slider_listing` where `page_name`='$sliderfunc'");
    $sliderresult = $getslider->queryRow();
    $sliderfile = $sliderresult['page_slug'];
    if($sliderfile!="")
            {include('themes/business/views/slider/'.$sliderfile);}
        else
            {$this->renderPartial('//site/slider');}    
    ?>
		
    <?php $this->renderPartial('//layouts/breadcrumbs'); ?>

    <?php echo $content; ?>
</div>
<div id="rightbar">
    <?php
	if($sliderfunc=="site/video_tutorials")
	{
	$this->renderPartial('//site/video_quick_links');
	}
        else if(Yii::app()->user->getIsGuest()){
            $this->renderPartial('//site/login');    
        } else {
            $this->renderPartial('//site/accordian');
        } 
      $this->renderPartial('//layouts/servicepanel');
    ?>
</div>
<div class="clear"></div>

<?php /* <div id="leftcontent">	 
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div> */ ?>
<?php $this->endContent(); ?>