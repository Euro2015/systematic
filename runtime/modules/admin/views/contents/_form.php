<div class="white-bg">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
    // 'action'=>Yii::app()->createUrl("member/create",array("id"=>$model->id)),
)); ?>

     
<div class="userData" style="width:100%">
  <fieldset>
	<table>
      <tr>
		<td><?php echo $form->labelEx($model,'title',array('class'=>'field')); ?></td>
		<td><?php echo $form->textField($model,'title',array('size'=>80)); ?></td>
		<?php echo $form->error($model,'title'); ?>
	</tr>

  <tr>
		<td><?php echo $form->labelEx($model,'desc',array('class'=>'field')); ?></td>
		<td><?php
        //ckeditor with ckfinder
        $this->widget('application.modules.admin.extensions.editor.CKkceditor',array(
            "model"=>$model,                # Data-Model
            "attribute"=>'desc',        # Attribute in the Data-Model
            "height"=>'500px',
            "width"=>'98%',
            "id"=>'editor',
            'config' => array(
                'editorTemplate'=>'full',        
                    // 'toolbar'=> array(
                    //     array( 'Source' ),
                    //     array( 'Bold', 'Italic', 'Underline', 'Strike','-', 'Subscript', 'Superscript' ),
                    //     array( 'NumberedList', 'BulletedList' ),
                    //     array( 'Outdent', 'Indent', 'Blockquote', 'CreateDiv' ),
                    //     array( 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord' ),
                    //     array( 'Print', 'SpellChecker', 'Scayt' ),
                    //     array( 'Undo', 'Redo', '-' , 'Find', 'Replace' ),
                    //     array( 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak' ),
                    //     array( 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ),
                    //     array( 'Link', 'Unlink', 'Anchor' ) ,
                    // ),
                  ),
                "filespath"=>Yii::app()->basePath."/../files/",
                "filesurl"=>Yii::app()->baseUrl."/files/",
        ) );
    ?></td>
		<?php echo $form->error($model,'desc'); ?>   
   	</tr>
   </table>
   </fieldset>
<br/><br/>
           <div class="userData_btns">
                    <div class="row buttons">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class'=>'button green')); ?>
                    </div>
        </div>            
            <?php $this->endWidget(); ?>
        </div>
        <div class="clearBoth"></div>

</div><!-- form -->
</div>
 
 
   