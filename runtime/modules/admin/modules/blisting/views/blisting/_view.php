<?php
/* @var $this BListingController */
/* @var $data BListing */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_blid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->drg_blid), array('view', 'id'=>$data->drg_blid)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_slogon')); ?>:</b>
	<?php echo CHtml::encode($data->drg_slogon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_whoweare')); ?>:</b>
	<?php echo CHtml::encode($data->drg_whoweare); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_offer')); ?>:</b>
	<?php echo CHtml::encode($data->drg_offer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_keyword')); ?>:</b>
	<?php echo CHtml::encode($data->drg_keyword); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_testimonial')); ?>:</b>
	<?php echo CHtml::encode($data->drg_testimonial); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_video1')); ?>:</b>
	<?php echo CHtml::encode($data->drg_video1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drg_video2')); ?>:</b>
	<?php echo CHtml::encode($data->drg_video2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approved')); ?>:</b>
	<?php echo CHtml::encode($data->approved); ?>
	<br />

	*/ ?>

</div>