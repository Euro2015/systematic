<?php
/* @var $this BListingController */
/* @var $model BListing */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'drg_blid'); ?>
		<?php echo $form->textField($model,'drg_blid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_uid'); ?>
		<?php echo $form->textField($model,'drg_uid',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_category'); ?>
		<?php echo $form->textField($model,'drg_category',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_profession'); ?>
		<?php echo $form->textField($model,'drg_profession',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_viewlimit'); ?>
		<?php echo $form->textField($model,'drg_viewlimit',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_slogon'); ?>
		<?php echo $form->textField($model,'drg_slogon',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_whoweare'); ?>
		<?php echo $form->textArea($model,'drg_whoweare',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_offer'); ?>
		<?php echo $form->textField($model,'drg_offer',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_keyword'); ?>
		<?php echo $form->textArea($model,'drg_keyword',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_testimonial'); ?>
		<?php echo $form->textArea($model,'drg_testimonial',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_datetime'); ?>
		<?php echo $form->textField($model,'drg_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_status'); ?>
		<?php echo $form->textField($model,'drg_status',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_lstatus'); ?>
		<?php echo $form->textField($model,'drg_lstatus',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_video1'); ?>
		<?php echo $form->textField($model,'drg_video1',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_video2'); ?>
		<?php echo $form->textField($model,'drg_video2',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approved'); ?>
		<?php echo $form->textField($model,'approved'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->