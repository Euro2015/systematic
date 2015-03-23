<?php
/* @var $this UserFinancialTransactionController */
/* @var $model UserFinancialTransaction */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-financial-transaction-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textArea($model,'type',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transactionId'); ?>
		<?php echo $form->textField($model,'transactionId',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'transactionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paid_out'); ?>
		<?php echo $form->textField($model,'paid_out',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'paid_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paid_in'); ?>
		<?php echo $form->textField($model,'paid_in',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'paid_in'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->