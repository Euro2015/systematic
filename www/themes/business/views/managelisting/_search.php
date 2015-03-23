<?php
/* @var $this ManagelistingController */
/* @var $model Managelisting */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'drg_lid'); ?>
		<?php echo $form->textField($model,'drg_lid'); ?>
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
		<?php echo $form->label($model,'drg_logo'); ?>
		<?php echo $form->textField($model,'drg_logo',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_title'); ?>
		<?php echo $form->textField($model,'drg_title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_desc'); ?>
		<?php echo $form->textField($model,'drg_desc',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_explanation'); ?>
		<?php echo $form->textArea($model,'drg_explanation',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_businessidea'); ?>
		<?php echo $form->textArea($model,'drg_businessidea',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_fprojections'); ?>
		<?php echo $form->textField($model,'drg_fprojections',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_favailable'); ?>
		<?php echo $form->textField($model,'drg_favailable',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_famount'); ?>
		<?php echo $form->textField($model,'drg_famount',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_financial_data'); ?>
		<?php echo $form->textField($model,'drg_financial_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_want'); ?>
		<?php echo $form->textField($model,'drg_want',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_keyword'); ?>
		<?php echo $form->textArea($model,'drg_keyword',array('rows'=>6, 'cols'=>50)); ?>
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
		<?php echo $form->label($model,'drg_mktquestion'); ?>
		<?php echo $form->textArea($model,'drg_mktquestion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_mktqstatus'); ?>
		<?php echo $form->textField($model,'drg_mktqstatus',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_reporttime'); ?>
		<?php echo $form->textField($model,'drg_reporttime',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_date'); ?>
		<?php echo $form->textField($model,'drg_date',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_datetime'); ?>
		<?php echo $form->textField($model,'drg_datetime',array('size'=>50,'maxlength'=>50)); ?>
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
		<?php echo $form->label($model,'drg_listtype'); ?>
		<?php echo $form->textField($model,'drg_listtype',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_name'); ?>
		<?php echo $form->textField($model,'drg_company_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_address1'); ?>
		<?php echo $form->textField($model,'drg_company_address1',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_address2'); ?>
		<?php echo $form->textField($model,'drg_company_address2',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_address3'); ?>
		<?php echo $form->textField($model,'drg_company_address3',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_town'); ?>
		<?php echo $form->textField($model,'drg_company_town',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_county'); ?>
		<?php echo $form->textField($model,'drg_company_county',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_zip_code'); ?>
		<?php echo $form->textField($model,'drg_company_zip_code',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_country'); ?>
		<?php echo $form->textField($model,'drg_company_country',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_tel_no'); ?>
		<?php echo $form->textField($model,'drg_company_tel_no',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_company_fax_no'); ?>
		<?php echo $form->textField($model,'drg_company_fax_no',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_listingstatus'); ?>
		<?php echo $form->textField($model,'drg_listingstatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drg_approvedate'); ?>
		<?php echo $form->textField($model,'drg_approvedate',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reject_list'); ?>
		<?php echo $form->textField($model,'reject_list'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->