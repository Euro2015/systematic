<?php /*
<h1 class="cms_page_title">Admin listing preview</h1>
<?php
$this->breadcrumbs=array(
	'Search for a Listings'=>array('./listings'),
	'Listing Update',
);
$this->renderPartial('_form', array('model'=>$model)); 
?>
*/ ?>


<h1 class="cms_page_title">Admin listing preview</h1>
<?php
$this->breadcrumbs=array(
	' Search for a  listing '=>array('./listings'),'Listing'." - ".$model['drg_title'] ,	 
);
$this->renderPartial('_form', array('model'=>$model)); 
?> 
