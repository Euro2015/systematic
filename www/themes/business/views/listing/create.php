<?php
/* @var $this ListingController */
/* @var $model Userlisting */

$this->breadcrumbs=array(
	'Userlistings'=>array('index'),
	'Create',
); 
echo $this->renderPartial('_form', array('model'=>$model)); 
?>