<?php
/* @var $this AdminListingController */
/* @var $model AdminListing */

$this->breadcrumbs=array(
	'Listings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Listing', 'url'=>array('index')),
	array('label'=>'Create AdminListing', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#admin-listing-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Admin Listings</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'listings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'drg_lid',
		'drg_uid',
		'drg_category',
		'drg_profession',
		'drg_viewlimit',
		'drg_logo',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
