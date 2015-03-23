<style>
a span:hover{color:rgb(165, 70, 134)}
a span{color:rgb(165, 70, 134)}
</style>
<div class="row-fluid">
<div class="span8">
<div id="left-content">
 <?php $this->breadcrumbs = array("$model->title"); ?>

<?php if($model->page_seo == 'faq'){

	if(Yii::app()->request->urlReferrer)
	$returnUrl = Yii::app()->request->urlReferrer;
else
	$returnUrl = $this->createUrl('/');
?>
    <br />
    <br />
<div class="close_caform_faq"><a class="button white smallrounded" href="<?php echo $returnUrl;?>" title="Close" >X</a></div>
<?php } ?>
<div class="page_content">
<?php if($model->page_seo == 'faq'){?>
<p class="p8 ft7" style="color: rgb(165, 70, 134);  text-align: left; margin-top: 9px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
	<strong><span style="font-size:18px;">Browse By Topic</span></strong></p>
<p class="p9 ft8" style=" color: rgb(35, 31, 32);  text-align: left; margin-top: 2px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
	Last Updated:<?php echo gmdate('d/m/Y H:i A', $model->created_date);?> GMT</p><hr />
<?php } ?>
<?php echo $model->desc;?>
</div>
</div>
</div>
<div class="span4">
</div></div> 
<?php 
if($model->page_seo='faq')
{?>
<style>
#left-content a:hover{color:#1dbfd8}
</style>
<?php }
?>