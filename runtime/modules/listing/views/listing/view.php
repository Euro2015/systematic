<?php
/* @var $this ListingController */
/* @var $model Userlisting */

$this->breadcrumbs=array(
	'Userlistings'=>array('index'),
	$model->drg_lid,
);

$this->menu=array(
	array('label'=>'List Userlisting', 'url'=>array('index')),
	array('label'=>'Create Userlisting', 'url'=>array('create')),
	array('label'=>'Update Userlisting', 'url'=>array('update', 'id'=>$model->drg_lid)),
	array('label'=>'Delete Userlisting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->drg_lid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userlisting', 'url'=>array('admin')),
);
?>

<h1>View Userlisting #<?php echo $model->drg_lid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'drg_lid',
		'drg_uid',
		'drg_category',
		'drg_profession',
		'drg_viewlimit',
		'drg_logo',
		'drg_title',
		'drg_desc',
		'drg_explanation',
		'drg_businessidea',
		'drg_fprojections',
		'drg_favailable',
		'drg_famount',
		'drg_financial_data',
		'drg_want',
		'drg_keyword',
		'drg_video1',
		'drg_video2',
		'drg_mktquestion',
		'drg_mktqstatus',
		'drg_reporttime',
		'drg_date',
		'drg_datetime',
		'drg_status',
		'drg_lstatus',
		'drg_listtype',
		'drg_company_name',
		'drg_company_address1',
		'drg_company_address2',
		'drg_company_address3',
		'drg_company_town',
		'drg_company_county',
		'drg_company_zip_code',
		'drg_company_country',
		'drg_company_tel_no',
		'drg_company_fax_no',
		'drg_listingstatus',
		'drg_approvedate',
		'reject_list',
	),
)); ?>
