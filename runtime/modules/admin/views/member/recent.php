<?php
$this->breadcrumbs=array(
	'Search user database'=>array('index')	 
);?> 
<?php $this->renderPartial('application.modules.admin.views.layouts.user_info'); ?>

<div style="margin:243px 16px 0 0;" class="close_caform"><a title="Close" href="<?php echo $this->createUrl('/admin/dashboard');?>" class="button white smallrounded">X</a></div>
<div id="info_panel">
    <h1 style="margin:10px auto; text-align: center;" class="Blue">New User Registeration</h1>
     <br><br>
     <?php $form=$this->beginWidget('CActiveForm', array(
         'id'=>'page-form',
         'enableAjaxValidation'=>true,
     )); ?>
      
     <b>From :</b>
     <?php
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
         'name'=>'from_date',  // name of post parameter
         'value'=>'',//date('Y-m-d'),
          'options'=>array(
             'showAnim'=>'fold',
             'dateFormat'=>'yy-mm-dd',
         ),
         'htmlOptions'=>array(
             'style'=>'height:20px;',
             'autocomplete'=>'off',
         ),
     ));
     ?>
     <b>To :</b>
     <?php
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
         'name'=>'to_date',
         'value'=>'',//date('Y-m-d'),
          'options'=>array(
             'showAnim'=>'fold',
             'dateFormat'=>'yy-mm-dd',
      
         ),
         'htmlOptions'=>array(
             'style'=>'height:20px;',
             'autocomplete'=>'off',
         ),
     ));
     ?>
     <input type="button" name="searchBtn" id="searchBtn" value="Search"/>
     <input type="reset" name="reset" id="resetBtn" value="Clear"/>
     <?php $this->endWidget(); ?>

<?php   
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'member-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model, 
    'itemsCssClass' => 'table-class display dataTable',
	'columns'=>array(
        array(
        'header' => 'Username',
        'name' => 'drg_username',
        'value' => 'CHtml::link($data->drg_username, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
        'type'  => 'raw', 
        ), 
        array(
        'header' => 'Type',
        'name' => 'drg_user_type',
        'type' => 'raw',
        'value' => ucfirst('$data->drg_user_type'), 
        ),
        array(
        'header' => 'Date',
        'name' => 'drg_rdate',
        'type' => 'raw',
        'value' => '$data->drg_rdate', 
        ),
        array(
        'header' => 'Activated',
        'name' => 'drg_pstatus',
        'type' => 'raw',
        'value' => '$data->drg_pstatus==1 ? "Yes":"No"', 
        ),
		array(
			'class'=>'CButtonColumn',
            'header' => 'Action',
            'template' => '{update}{delete}', 
		), 	
	),
));   ?>

<div class="toolbar">
    <a href="<?php echo $this->createUrl('/admin/member/sendnewregcsv');?>" class="button black">Send Mail</a>
</div>

</div>

<?php 
$exportUrl = $this->createUrl('/admin/member/exportFile');
$script2 = <<< EOD
$("#searchBtn").click(function(){
    var from_date = $.trim($("#from_date").val());
    var to_date = $.trim($("#to_date").val());
    if(from_date || to_date)
    {
        //$(this).val('Searching...');
        var dataItem = $("#page-form").serialize();
        $.fn.yiiGridView.update('member-grid', {data: dataItem});
    }
});

// $('#from_date, #to_date').change(function(){
//         var dataItem = $("#page-form").serialize();
//         $.fn.yiiGridView.update('member-grid', {data: dataItem});
// });

$('#resetBtn').click(function(){
    window.location.reload();
    // $("#from_date").val('');
    // $("#to_date").val('');
    // var dataItem = $("#page-form").serialize();
    // $.fn.yiiGridView.update('member-grid', {data: dataItem});
});
EOD;
Yii::app()->clientScript->registerScript('script2', $script2,CClientScript::POS_READY);
?>