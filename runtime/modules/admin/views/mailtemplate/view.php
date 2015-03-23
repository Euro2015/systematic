<?php
/* @var $this MailTemplateController */
/* @var $model MailTemplate */

$this->breadcrumbs=array(
	'Mail Templates'=>array('index'),
	$model->template_id,
);

$this->menu=array(
	array('label'=>'List MailTemplate', 'url'=>array('index')),
	array('label'=>'Create MailTemplate', 'url'=>array('create')),
	array('label'=>'Update MailTemplate', 'url'=>array('update', 'id'=>$model->template_id)),
	array('label'=>'Delete MailTemplate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->template_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MailTemplate', 'url'=>array('admin')),
);
?>

<h1>View MailTemplate #<?php echo $model->template_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'template_id',
		'template_module',
		'template_subject',
		'template_body',
		'template_status',
		'template_create',
	),
)); ?>
