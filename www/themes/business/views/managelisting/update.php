<?php
/* @var $this ManagelistingController */
/* @var $model Managelisting */

$this->breadcrumbs=array(
	'Managelistings'=>array('index'),
	$model->drg_lid=>array('view','id'=>$model->drg_lid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Managelisting', 'url'=>array('index')),
	array('label'=>'Create Managelisting', 'url'=>array('create')),
	array('label'=>'View Managelisting', 'url'=>array('view', 'id'=>$model->drg_lid)),
	array('label'=>'Manage Managelisting', 'url'=>array('admin')),
);
?>

<h1>Update Managelisting <?php echo $model->drg_lid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>