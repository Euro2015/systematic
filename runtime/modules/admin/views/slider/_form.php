<style>
.white-bg .userData input[type="text"]{width: 98%;}
.userData_btns input[type="submit"]{width:100px!important;}
.userData_btns{left:256px;margin-top: 10px;}
</style>
<?php
/* @var $this MailTemplateController */
/* @var $model MailTemplate */
/* @var $form CActiveForm */

$themeurl = Yii::app()->theme->baseUrl;
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($themeurl.'/js/tinymce/tinymce.min.js');
Yii::app()->clientScript->registerCssFile($themeurl.'/css/button.css');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mail-template-form',
	'enableAjaxValidation'=>false,
	//'action'=>$this->createUrl("/update",array("id"=>$model->template_id)),
)); ?>

	<!---<p class="note">Fields with <span class="required">*</span> are required.</p>-->
		
        <div class="userData" style="width:80%">
				<?php echo $form->errorSummary($model); ?>
            <fieldset>
                <table>
                	<tr>
						<td><?php echo $form->labelEx($model,'template_module',array('class'=>'field')); ?></td>
                        <td><?php echo $form->textField($model,'template_module',array('maxlength'=>255)); ?></td>
                        <?php echo $form->error($model,'template_module'); ?>
                    </tr>                
                    <tr>
                        <td><?php echo $form->labelEx($model,'template_subject',array('class'=>'field')); ?></td>
                        <td><?php echo $form->textField($model,'template_subject',array('maxlength'=>255)); ?></td>
                        <?php echo $form->error($model,'template_subject'); ?>
                    </tr>                
                    <tr>
                        <td><?php echo $form->labelEx($model,'template_body',array('class'=>'field')); ?></td>
                        <td><?php echo $form->textArea($model,'template_body',array('rows'=>20, 'cols'=>50)); ?></td>
                        <?php echo $form->error($model,'template_body'); ?>
                    </tr>   
                </table> 
           </fieldset> 
           <br/><br/>
           <div class="userData_btns">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'button update-green', 'style'=>'margin-left:135px;')); ?>
				</div>            
            <?php $this->endWidget(); ?>
        </div>
        <div class="clearBoth"></div>

</div><!-- form -->
<script type="text/javascript"> 
 
     tinymce.init({
        forced_root_block : "", 
        selector: "#MailTemplate_template_body",
        plugins: [
            "advlist autolink lists link  charmap  preview anchor",
            "searchreplace visualblocks  ",
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });  
</script> 