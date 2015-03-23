<?php
/* @var $this BListingController */
/* @var $model BListing */

$this->breadcrumbs=array(
	'Blistings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BListing', 'url'=>array('index')),
	array('label'=>'Manage BListing', 'url'=>array('admin')),
);
?>

<h1>Create BListing</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>