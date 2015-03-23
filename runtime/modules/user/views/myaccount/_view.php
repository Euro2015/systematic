<?php
/* @var $this MyaccountController */
/* @var $data Myaccount */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->drg_id), array('view', 'id'=>$data->drg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_uid')); ?>:</b>
	<?php echo CHtml::encode($data->drg_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_name')); ?>:</b>
	<?php echo CHtml::encode($data->drg_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_surname')); ?>:</b>
	<?php echo CHtml::encode($data->drg_surname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_email')); ?>:</b>
	<?php echo CHtml::encode($data->drg_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_username')); ?>:</b>
	<?php echo CHtml::encode($data->drg_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_pass')); ?>:</b>
	<?php echo CHtml::encode($data->drg_pass); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_image')); ?>:</b>
	<?php echo CHtml::encode($data->drg_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_addr1')); ?>:</b>
	<?php echo CHtml::encode($data->drg_addr1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_addr2')); ?>:</b>
	<?php echo CHtml::encode($data->drg_addr2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_addr3')); ?>:</b>
	<?php echo CHtml::encode($data->drg_addr3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_town')); ?>:</b>
	<?php echo CHtml::encode($data->drg_town); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_county')); ?>:</b>
	<?php echo CHtml::encode($data->drg_county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_zip')); ?>:</b>
	<?php echo CHtml::encode($data->drg_zip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_country')); ?>:</b>
	<?php echo CHtml::encode($data->drg_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_phone')); ?>:</b>
	<?php echo CHtml::encode($data->drg_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_gender')); ?>:</b>
	<?php echo CHtml::encode($data->drg_gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_dob')); ?>:</b>
	<?php echo CHtml::encode($data->drg_dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_question')); ?>:</b>
	<?php echo CHtml::encode($data->drg_question); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_answer')); ?>:</b>
	<?php echo CHtml::encode($data->drg_answer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_pstatus')); ?>:</b>
	<?php echo CHtml::encode($data->drg_pstatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_notes')); ?>:</b>
	<?php echo CHtml::encode($data->drg_notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_rdate')); ?>:</b>
	<?php echo CHtml::encode($data->drg_rdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_ltime')); ?>:</b>
	<?php echo CHtml::encode($data->drg_ltime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_ip')); ?>:</b>
	<?php echo CHtml::encode($data->drg_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_status')); ?>:</b>
	<?php echo CHtml::encode($data->drg_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_currency')); ?>:</b>
	<?php echo CHtml::encode($data->drg_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_slogon')); ?>:</b>
	<?php echo CHtml::encode($data->co_slogon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_title')); ?>:</b>
	<?php echo CHtml::encode($data->co_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_fax')); ?>:</b>
	<?php echo CHtml::encode($data->co_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_website')); ?>:</b>
	<?php echo CHtml::encode($data->co_website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_name')); ?>:</b>
	<?php echo CHtml::encode($data->co_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_user_type')); ?>:</b>
	<?php echo CHtml::encode($data->drg_user_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_verifycode')); ?>:</b>
	<?php echo CHtml::encode($data->drg_verifycode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_active_link')); ?>:</b>
	<?php echo CHtml::encode($data->drg_active_link); ?>
	<br />

	*/ ?>

</div>