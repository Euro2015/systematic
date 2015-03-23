<?php
/* @var $this ListingController */
/* @var $model Userlisting */

$this->breadcrumbs=array(
	'Businesslistings'=>array('index'),
	$model->drg_blid=>array('view','id'=>$model->drg_blid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Businesslisting', 'url'=>array('index')),
	array('label'=>'Create Businesslisting', 'url'=>array('create')),
	array('label'=>'View Businesslisting', 'url'=>array('view', 'id'=>$model->drg_blid)),
	array('label'=>'Manage Businesslisting', 'url'=>array('admin')),
);
?>

<h1>Update Businesslistings <?php echo $model->drg_blid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'userData'=>$user_data));?>