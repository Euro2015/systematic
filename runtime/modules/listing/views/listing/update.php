<?php
/* @var $this ListingController */
/* @var $model Userlisting */

$this->breadcrumbs=array(
	'Userlistings'=>array('index'),
	$model->drg_lid=>array('view','id'=>$model->drg_lid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userlisting', 'url'=>array('index')),
	array('label'=>'Create Userlisting', 'url'=>array('create')),
	array('label'=>'View Userlisting', 'url'=>array('view', 'id'=>$model->drg_lid)),
	array('label'=>'Manage Userlisting', 'url'=>array('admin')),
);
?>

<h1>Update Userlisting <?php echo $model->drg_lid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>