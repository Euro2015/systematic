<?php
/* @var $this UserFinancialTransactionController */
/* @var $model UserFinancialTransaction */

$this->breadcrumbs=array(
	'User Financial Transactions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserFinancialTransaction', 'url'=>array('index')),
	array('label'=>'Create UserFinancialTransaction', 'url'=>array('create')),
	array('label'=>'Update UserFinancialTransaction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserFinancialTransaction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserFinancialTransaction', 'url'=>array('admin')),
);
?>

<h1>View UserFinancialTransaction #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'date',
		'type',
		'description',
		'transactionId',
		'paid_out',
		'paid_in',
	),
)); ?>
