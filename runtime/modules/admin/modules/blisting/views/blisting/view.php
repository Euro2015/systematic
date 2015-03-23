<?php
/* @var $this BListingController */
/* @var $model BListing */

$this->breadcrumbs=array(
	'Blistings'=>array('index'),
	$model->drg_blid,
);

$this->menu=array(
	array('label'=>'List BListing', 'url'=>array('index')),
	array('label'=>'Create BListing', 'url'=>array('create')),
	array('label'=>'Update BListing', 'url'=>array('update', 'id'=>$model->drg_blid)),
	array('label'=>'Delete BListing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->drg_blid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BListing', 'url'=>array('admin')),
);
?>

<h1>View BListing #<?php echo $model->drg_blid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'drg_blid',
		'drg_uid',
		'drg_category',
		'drg_profession',
		'drg_viewlimit',
		'drg_slogon',
		'drg_whoweare',
		'drg_offer',
		'drg_keyword',
		'drg_testimonial',
		'drg_datetime',
		'drg_status',
		'drg_lstatus',
		'drg_video1',
		'drg_video2',
		'approved',
	),
)); ?>
