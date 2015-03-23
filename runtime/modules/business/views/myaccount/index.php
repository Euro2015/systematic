<?php
/* @var $this MyaccountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Myaccounts',
);

$this->menu=array(
	array('label'=>'Create Myaccount', 'url'=>array('create')),
	array('label'=>'Manage Myaccount', 'url'=>array('admin')),
);
?>

<h1>Myaccounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
