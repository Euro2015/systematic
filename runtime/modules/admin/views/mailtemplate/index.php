<?php  
$this->breadcrumbs=array(
	'Mail Templates'=>'index',
);  
?> 
<h1>Mail Templates</h1>
<div class="user_listing_search"><br>
    <span class="red">Note : Default template(1-5) are not deletable. That is required by system.</span>
    <a href="<?php echo $this->createUrl('/admin/mailtemplate/create');?>" class="button blue">+Add</a>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'mailtemplate-grid',
        'dataProvider'=>$model->search(),
        //'filter'=>$model, 
        'itemsCssClass' => 'table-class display dataTable',
        'columns' => array(
                    array(
                        'header'=> 'Template',
                        'name'=>'template_id', 
                        'value' => 'CHtml::link($data->template_id, Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                        'type'=>'raw',
                        'htmlOptions'=>array('style'=>'width:30px')	
                    ),
                    array(
                        'header'=>'Template Name',
                        'name'=>'template_module',
                        'value' =>'CHtml::link($data->template_module, Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                        'type'=>'raw',
                    ),
                    array(
                        'header'=>'Template Subject',
                        'name'=>'template_subject',
                        'value'=>'CHtml::link($data->template_subject, Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                        'type'=>'raw',
                    ),
                    /*array(
                        'header'=>'Template Status',
                        'name'=>'template_status',
                        'value'=>'CHtml::link($data->template_status, Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                        'type'=>'raw',
                    ),*/
                    array(
                        'header'=>'Created Date',
                        'name'=>'template_create',
                        'value'=>'CHtml::link(date("d- m- Y",strtotime($data->template_create)), Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                        'type'=>'raw',
                        'htmlOptions'=>array('style'=>'width:110px')	
                    ),
                 /*   array(
                        'class'=>'CButtonColumn',
                        'header'=>'Action',
                        'template'=>'{update}{delete}',
                    ),
                 */
        
        ),
        
    )); ?>
</div>
