<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div class="clear"></div>
<div class="robot-img">
	<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-torso.png" />
</div>
<div class="page-error">
<h2>Error <?php echo $code; ?></h2>
<div class="error"> 
<?php echo CHtml::encode($message); ?>
</div>
</div>
<script>
$(function(){
	setTimeout(goto_home('<?php echo  $this->createAbsoluteUrl('/');?>'), 5000000);
});
function goto_home(url){
    location.href = url;     
}
</script>