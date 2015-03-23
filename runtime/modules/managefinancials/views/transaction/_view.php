<?php
/* @var $this UserFinancialTransactionController */
/* @var $data UserFinancialTransaction */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transactionId')); ?>:</b>
	<?php echo CHtml::encode($data->transactionId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paid_out')); ?>:</b>
	<?php echo CHtml::encode($data->paid_out); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('paid_in')); ?>:</b>
	<?php echo CHtml::encode($data->paid_in); ?>
	<br />

	*/ ?>

</div>