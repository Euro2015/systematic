<?php
/* @var $this MyaccountController */
/* @var $model Myaccount */

$this->breadcrumbs=array(
	'Myaccounts'=>array('index'),
	$model->drg_id,
);

$this->menu=array(
	array('label'=>'List Myaccount', 'url'=>array('index')),
	array('label'=>'Create Myaccount', 'url'=>array('create')),
	array('label'=>'Update Myaccount', 'url'=>array('update', 'id'=>$model->drg_id)),
	array('label'=>'Delete Myaccount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->drg_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Myaccount', 'url'=>array('admin')),
);
?>

<h1>View Myaccount #<?php echo $model->drg_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'drg_id',
		'drg_uid',
		'drg_name',
		'drg_surname',
		'drg_email',
		'drg_username',
		'drg_pass',
		'drg_image',
		'drg_addr1',
		'drg_addr2',
		'drg_addr3',
		'drg_town',
		'drg_county',
		'drg_zip',
		'drg_country',
		'drg_phone',
		'drg_gender',
		'drg_dob',
		'drg_question',
		'drg_answer',
		'drg_pstatus',
		'drg_notes',
		'drg_rdate',
		'drg_ltime',
		'drg_ip',
		'drg_status',
		'drg_currency',
		'co_slogon',
		'co_title',
		'co_fax',
		'co_website',
		'co_name',
		'drg_user_type',
		'drg_verifycode',
		'drg_active_link',
	),
)); ?>
