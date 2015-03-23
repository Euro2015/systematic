<?php
/* @var $this MailTemplateController */
/* @var $model MailTemplate */

$this->breadcrumbs=array(
	'Mail Templates'=>array('index'),
	$model->template_id=>array('view','id'=>$model->template_id),
	'Update',
);

?>
<div class="white-bg">
        <h1>Update MailTemplate <?php echo $model->template_id; ?></h1>
        
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>