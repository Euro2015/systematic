<?php
/* @var $this MemberController */
/* @var $model Member */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('index')),
	array('label'=>'Create Member', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#member-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Members</h1>

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
	'id'=>'member-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'drg_id',
		'drg_uid',
		'drg_name',
		'drg_surname',
		'drg_email',
		'drg_username',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
