<style>
.grid-view .button-column{
width: 90px;
}</style>

<?php
$this->breadcrumbs=array(
    'Search cms page database'=>array('index')   
);?> 
<div class="user_listing_search"><br>
    <a href="<?php echo $this->createUrl('/admin/mailtemplate/create');?>" class="button blue">+Add</a>
<?php   
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'page-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model, 
    'itemsCssClass' => 'table-class display dataTable',
    'columns'=>array(
        array(
        'header' => 'Page Title',
        'name' => 'title',
        'value' => '$data->title',
        'type'  => 'raw', 
        ), 
       // array(
        // 'header' => 'Email',
        // 'name' => 'drg_email',
        // 'type' => 'raw',
        // 'value' => 'CHtml::link($data->drg_email, Yii::app()->createUrl("member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))', 
        // ),
        // array(
        // 'header' => 'Profession',
        // 'name' => 'drg_user_type',
        // 'type' => 'raw',
        // 'value' => 'CHtml::link($data->drg_user_type, Yii::app()->createUrl("member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
        
        // ),
        // array(
        // 'header' => 'Address',
        // 'name' => 'drg_addr1',
        // 'type' => 'raw',
        // 'value' => 'CHtml::link($data->drg_addr1, Yii::app()->createUrl("member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',        
        // ), 
        array(
            'class'=>'CButtonColumn',
            'header' => 'Action',
            'template' => '{view}{update}{delete}', 
            'buttons'=>array
                (
                    'view' => array
                    (
                        'label'=>'View',
                        //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                        'url'=>'Yii::app()->params["frontUrl"]."/index.php/site/page/$data->page_seo"',
                    ),                   
                ),
        ), 
        
    ),
));   ?>

</div>