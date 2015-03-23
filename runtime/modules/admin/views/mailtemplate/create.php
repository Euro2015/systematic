<?php
/* @var $this MailTemplateController */
/* @var $model MailTemplate */

$this->breadcrumbs=array(
	'Mail Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MailTemplate', 'url'=>array('index')),
	array('label'=>'Manage MailTemplate', 'url'=>array('admin')),
);
?>
<div class="white-bg">
<h1>Create MailTemplate</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>