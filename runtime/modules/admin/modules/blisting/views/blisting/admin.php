<?php
/* @var $this BListingController */
/* @var $model BListing */

$this->breadcrumbs=array(
	'Blistings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BListing', 'url'=>array('index')),
	array('label'=>'Create BListing', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#blisting-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Blistings</h1>

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
	'id'=>'blisting-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'drg_blid',
		'drg_uid',
		'drg_category',
		'drg_profession',
		'drg_viewlimit',
		'drg_slogon',
		/*
		'drg_whoweare',
		'drg_offer',
		'drg_keyword',
		'drg_testimonial',
		'drg_datetime',
		'drg_status',
		'drg_lstatus',
		'drg_video1',
		'drg_video2',
		'approved',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
