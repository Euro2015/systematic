<?php
/* @var $this ManagelistingController */
/* @var $model Managelisting */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'managelisting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_uid'); ?>
		<?php echo $form->textField($model,'drg_uid',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drg_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_category'); ?>
		<?php echo $form->textField($model,'drg_category',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_profession'); ?>
		<?php echo $form->textField($model,'drg_profession',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_profession'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_viewlimit'); ?>
		<?php echo $form->textField($model,'drg_viewlimit',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_viewlimit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_logo'); ?>
		<?php echo $form->textField($model,'drg_logo',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drg_logo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_title'); ?>
		<?php echo $form->textField($model,'drg_title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drg_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_desc'); ?>
		<?php echo $form->textField($model,'drg_desc',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drg_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_explanation'); ?>
		<?php echo $form->textArea($model,'drg_explanation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'drg_explanation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_businessidea'); ?>
		<?php echo $form->textArea($model,'drg_businessidea',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'drg_businessidea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_fprojections'); ?>
		<?php echo $form->textField($model,'drg_fprojections',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drg_fprojections'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_favailable'); ?>
		<?php echo $form->textField($model,'drg_favailable',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'drg_favailable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_famount'); ?>
		<?php echo $form->textField($model,'drg_famount',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drg_famount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_financial_data'); ?>
		<?php echo $form->textField($model,'drg_financial_data'); ?>
		<?php echo $form->error($model,'drg_financial_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_want'); ?>
		<?php echo $form->textField($model,'drg_want',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drg_want'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_keyword'); ?>
		<?php echo $form->textArea($model,'drg_keyword',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'drg_keyword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_video1'); ?>
		<?php echo $form->textField($model,'drg_video1',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drg_video1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_video2'); ?>
		<?php echo $form->textField($model,'drg_video2',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drg_video2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_mktquestion'); ?>
		<?php echo $form->textArea($model,'drg_mktquestion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'drg_mktquestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_mktqstatus'); ?>
		<?php echo $form->textField($model,'drg_mktqstatus',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'drg_mktqstatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_reporttime'); ?>
		<?php echo $form->textField($model,'drg_reporttime',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'drg_reporttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_date'); ?>
		<?php echo $form->textField($model,'drg_date',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_datetime'); ?>
		<?php echo $form->textField($model,'drg_datetime',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_status'); ?>
		<?php echo $form->textField($model,'drg_status',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_lstatus'); ?>
		<?php echo $form->textField($model,'drg_lstatus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_lstatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_listtype'); ?>
		<?php echo $form->textField($model,'drg_listtype',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'drg_listtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_name'); ?>
		<?php echo $form->textField($model,'drg_company_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_address1'); ?>
		<?php echo $form->textField($model,'drg_company_address1',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drg_company_address1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_address2'); ?>
		<?php echo $form->textField($model,'drg_company_address2',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drg_company_address2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_address3'); ?>
		<?php echo $form->textField($model,'drg_company_address3',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drg_company_address3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_town'); ?>
		<?php echo $form->textField($model,'drg_company_town',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drg_company_town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_county'); ?>
		<?php echo $form->textField($model,'drg_company_county',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drg_company_county'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_zip_code'); ?>
		<?php echo $form->textField($model,'drg_company_zip_code',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_company_zip_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_country'); ?>
		<?php echo $form->textField($model,'drg_company_country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drg_company_country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_tel_no'); ?>
		<?php echo $form->textField($model,'drg_company_tel_no',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'drg_company_tel_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_company_fax_no'); ?>
		<?php echo $form->textField($model,'drg_company_fax_no',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drg_company_fax_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_listingstatus'); ?>
		<?php echo $form->textField($model,'drg_listingstatus'); ?>
		<?php echo $form->error($model,'drg_listingstatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drg_approvedate'); ?>
		<?php echo $form->textField($model,'drg_approvedate',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drg_approvedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reject_list'); ?>
		<?php echo $form->textField($model,'reject_list'); ?>
		<?php echo $form->error($model,'reject_list'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->