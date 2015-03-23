<?php
/* @var $this ManagelistingController */
/* @var $data Managelisting */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_lid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->drg_lid), array('view', 'id'=>$data->drg_lid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_uid')); ?>:</b>
	<?php echo CHtml::encode($data->drg_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_category')); ?>:</b>
	<?php echo CHtml::encode($data->drg_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_profession')); ?>:</b>
	<?php echo CHtml::encode($data->drg_profession); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_viewlimit')); ?>:</b>
	<?php echo CHtml::encode($data->drg_viewlimit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_logo')); ?>:</b>
	<?php echo CHtml::encode($data->drg_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_title')); ?>:</b>
	<?php echo CHtml::encode($data->drg_title); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_desc')); ?>:</b>
	<?php echo CHtml::encode($data->drg_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_explanation')); ?>:</b>
	<?php echo CHtml::encode($data->drg_explanation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_businessidea')); ?>:</b>
	<?php echo CHtml::encode($data->drg_businessidea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_fprojections')); ?>:</b>
	<?php echo CHtml::encode($data->drg_fprojections); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_favailable')); ?>:</b>
	<?php echo CHtml::encode($data->drg_favailable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_famount')); ?>:</b>
	<?php echo CHtml::encode($data->drg_famount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_financial_data')); ?>:</b>
	<?php echo CHtml::encode($data->drg_financial_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_want')); ?>:</b>
	<?php echo CHtml::encode($data->drg_want); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_keyword')); ?>:</b>
	<?php echo CHtml::encode($data->drg_keyword); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_video1')); ?>:</b>
	<?php echo CHtml::encode($data->drg_video1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_video2')); ?>:</b>
	<?php echo CHtml::encode($data->drg_video2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_mktquestion')); ?>:</b>
	<?php echo CHtml::encode($data->drg_mktquestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_mktqstatus')); ?>:</b>
	<?php echo CHtml::encode($data->drg_mktqstatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_reporttime')); ?>:</b>
	<?php echo CHtml::encode($data->drg_reporttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_date')); ?>:</b>
	<?php echo CHtml::encode($data->drg_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->drg_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_status')); ?>:</b>
	<?php echo CHtml::encode($data->drg_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_lstatus')); ?>:</b>
	<?php echo CHtml::encode($data->drg_lstatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_listtype')); ?>:</b>
	<?php echo CHtml::encode($data->drg_listtype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_name')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_address1')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_address1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_address2')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_address2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_address3')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_address3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_town')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_town); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_county')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_zip_code')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_zip_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_country')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_tel_no')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_tel_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_company_fax_no')); ?>:</b>
	<?php echo CHtml::encode($data->drg_company_fax_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_listingstatus')); ?>:</b>
	<?php echo CHtml::encode($data->drg_listingstatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_approvedate')); ?>:</b>
	<?php echo CHtml::encode($data->drg_approvedate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reject_list')); ?>:</b>
	<?php echo CHtml::encode($data->reject_list); ?>
	<br />

	*/ ?>

</div>