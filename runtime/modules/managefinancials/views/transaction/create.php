<?php
/* @var $this UserFinancialTransactionController */
/* @var $model UserFinancialTransaction */

$this->breadcrumbs=array(
	'User Financial Transactions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserFinancialTransaction', 'url'=>array('index')),
	array('label'=>'Manage UserFinancialTransaction', 'url'=>array('admin')),
);
?>

<h1>Create UserFinancialTransaction</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>