<?php
/* @var $this MemberController */
/* @var $model Member */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('index')),
	array('label'=>'Manage Member', 'url'=>array('admin')),
);
?>
<div class="white-bg">
<h1>Create Member</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

