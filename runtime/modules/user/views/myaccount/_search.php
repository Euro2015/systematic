<?php
/* @var $this MyaccountController */
/* @var $model Myaccount */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'drg_id'); ?>
		<?php echo $form->textField($model,'drg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_uid'); ?>
		<?php echo $form->textField($model,'drg_uid',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_name'); ?>
		<?php echo $form->textField($model,'drg_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_surname'); ?>
		<?php echo $form->textField($model,'drg_surname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_email'); ?>
		<?php echo $form->textField($model,'drg_email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_username'); ?>
		<?php echo $form->textField($model,'drg_username',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_pass'); ?>
		<?php echo $form->textField($model,'drg_pass',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_image'); ?>
		<?php echo $form->textField($model,'drg_image',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_addr1'); ?>
		<?php echo $form->textField($model,'drg_addr1',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_addr2'); ?>
		<?php echo $form->textField($model,'drg_addr2',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_addr3'); ?>
		<?php echo $form->textField($model,'drg_addr3',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_town'); ?>
		<?php echo $form->textField($model,'drg_town',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_county'); ?>
		<?php echo $form->textField($model,'drg_county',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_zip'); ?>
		<?php echo $form->textField($model,'drg_zip',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_country'); ?>
		<?php echo $form->textField($model,'drg_country',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_phone'); ?>
		<?php echo $form->textField($model,'drg_phone',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_gender'); ?>
		<?php echo $form->textField($model,'drg_gender',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_dob'); ?>
		<?php echo $form->textField($model,'drg_dob',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_question'); ?>
		<?php echo $form->textField($model,'drg_question',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_answer'); ?>
		<?php echo $form->textField($model,'drg_answer',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_pstatus'); ?>
		<?php echo $form->textField($model,'drg_pstatus',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_notes'); ?>
		<?php echo $form->textArea($model,'drg_notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_rdate'); ?>
		<?php echo $form->textField($model,'drg_rdate',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_ltime'); ?>
		<?php echo $form->textField($model,'drg_ltime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_ip'); ?>
		<?php echo $form->textField($model,'drg_ip',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_status'); ?>
		<?php echo $form->textField($model,'drg_status',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_currency'); ?>
		<?php echo $form->textField($model,'drg_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_slogon'); ?>
		<?php echo $form->textField($model,'co_slogon',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_title'); ?>
		<?php echo $form->textField($model,'co_title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_fax'); ?>
		<?php echo $form->textField($model,'co_fax',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_website'); ?>
		<?php echo $form->textField($model,'co_website',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_name'); ?>
		<?php echo $form->textField($model,'co_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_user_type'); ?>
		<?php echo $form->textField($model,'drg_user_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_verifycode'); ?>
		<?php echo $form->textField($model,'drg_verifycode',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_active_link'); ?>
		<?php echo $form->textField($model,'drg_active_link',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->