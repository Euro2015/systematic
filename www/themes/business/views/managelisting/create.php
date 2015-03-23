<?php
/* @var $this ManagelistingController */
/* @var $model Managelisting */

$this->breadcrumbs=array(
	'Managelistings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Managelisting', 'url'=>array('index')),
	array('label'=>'Manage Managelisting', 'url'=>array('admin')),
);
?>

<h1>Create Managelisting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>