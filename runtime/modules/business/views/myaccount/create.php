<?php
/* @var $this MyaccountController */
/* @var $model Myaccount */

$this->breadcrumbs=array(
	'Myaccounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Myaccount', 'url'=>array('index')),
	array('label'=>'Manage Myaccount', 'url'=>array('admin')),
);
?>

<h1>Create Myaccount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>