<?php
/* @var $this AdminListingController */
/* @var $model AdminListing */

$this->breadcrumbs=array(
	'Listings'=>array('index'),
	'Create',
);

?>

<h1>Create Listing</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>