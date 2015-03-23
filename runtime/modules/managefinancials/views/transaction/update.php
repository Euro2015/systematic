<?php
/* @var $this UserFinancialTransactionController */
/* @var $model UserFinancialTransaction */

$this->breadcrumbs=array(
	'User Financial Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserFinancialTransaction', 'url'=>array('index')),
	array('label'=>'Create UserFinancialTransaction', 'url'=>array('create')),
	array('label'=>'View UserFinancialTransaction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserFinancialTransaction', 'url'=>array('admin')),
);
?>

<h1>Update UserFinancialTransaction <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>