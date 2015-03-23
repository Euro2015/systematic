<div class="form">
<?php 
// $logtime = Logtransaction::totalLoggedTime($model->drg_id);
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
  'clientOptions'=>array(
    'validateOnSubmit'=>true,
  ),
     //'action'=>Yii::app()->createUrl("/admin/member/update",array("id"=>$model->drg_id)),
)); ?>

    
<div class="userData">
  <fieldset>
	<p>
		<?php echo $form->labelEx($model,'drg_name',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_name'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_surname',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_surname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_surname'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_email',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_email'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_username',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_username'); ?>
	</p>
	<p>
		<?php echo $form->labelEx($model,'drg_addr1', array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_addr1',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drg_addr1'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_addr2', array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_addr2',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drg_addr2'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_addr3', array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_addr3',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drg_addr3'); ?>
	</p>
	 

	<p>
		<?php echo $form->labelEx($model,'drg_town', array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_town',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drg_town'); ?>
	</p>
  
  <p>
    <?php echo $form->labelEx($model,'drg_county',array('class'=>'field')); ?>
    <?php echo $form->textField($model,'drg_county',array('size'=>60,'maxlength'=>200)); ?>
    <?php echo $form->error($model,'drg_county'); ?>
  </p>

	<p>
		<?php echo $form->labelEx($model,'drg_zip', array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_zip',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_zip'); ?>
	</p>

	<p>
    	  <?php  $data = CHtml::listData(Country::getAll(), 'country_id', 'country');?>
          <?php echo $form->labelEx($model,'drg_country', array('class'=>'field')); ?>
          <?php echo $form->dropDownList($model,'drg_country',$data, array('prompt' => 'Please Select')); ?>
          <?php echo $form->error($model,'drg_country'); ?>
   </p>

	<p>
		<?php echo $form->labelEx($model,'drg_phone', array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_phone',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'drg_phone'); ?>
	</p>
    
    <p>
		<?php echo $form->labelEx($model,'co_fax',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'co_fax',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'co_fax'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_gender', array('class'=>'field')); ?>
        <?php echo $form->dropDownList($model,'drg_gender', array('Male'=>"Male",'Female'=>"Female"), array('prompt' => 'Select','options' => array($model->drg_gender =>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'drg_gender'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_dob', array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_dob',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drg_dob'); ?>
	</p>

	<p>
    	<?php $data = CHtml::listData(Question::getAll(), 'drg_question', 'drg_question');?>
        <?php echo $form->labelEx($model,'drg_question', array('class'=>'field')); ?>
        <?php echo $form->dropDownList($model,'drg_question',$data, array('prompt' => 'Select','options'=>array($model->drg_question=>array("selected"=>true)))); ?>
        <?php echo $form->error($model,'drg_question'); ?>
		
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_answer',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_answer',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drg_answer'); ?>
	</p>

	<p>
     	
		<?php $data = CHtml::listData(Profession::getAll(), 'drg_profession', 'drg_profession');?>
        <?php echo $form->labelEx($model,'co_title', array('class'=>'field')); ?>
        <?php echo $form->dropDownList($model,'co_title',$data, array('prompt' => 'Select','options'=>array($model->co_title=>array("selected"=>true)))); ?>
        <?php echo $form->error($model,'co_title'); ?>
		
	</p>
    
    <p>
		<?php echo $form->labelEx($model,'co_website',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'co_website',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'co_website'); ?>
	</p>
    
   	
   </fieldset>
</div>
<div class="userListingData">
	<?php /*<div class="profile-pic">
        <?php 
        if($model->drg_image){
            $img = $model->drg_image;            
        }else {
            $img = 'avatar.jpg';
        }
        ?>
    	<div class="pro-photo">
            <img src="../<?php echo IMG_LOGO_PATH.$img;?>" alt="<?php Yii::app()->params['company_name']; ?>" />
        </div>
            <div class="profile-detail">
                 <ul>
                     <li><label class="field">Member since:</label><?php echo $model->drg_rdate; ?> </li>
                     <li><label class="field">Status:</label> Online</li>
                     <li><label class="field">Prize wins:</label>0 </li>
                     <li><label class="field">Total won:</label>0 </li>
                     <li><label class="field">Time logged this month:</label>
                      <?php echo $this_month = ActivityDate::getTimeThisMonth($model->drg_id);?> hrs
                     </li>
                     <li><label class="field">Average time logged per month:</label> <?php echo ActivityDate::getAvgPerMonth($model->drg_id); ?> hrs</li>
                     <li><label class="field">Points total this month:</label><?php echo $this_month*60; ?> </li>
                 </ul>                
            </div>
       
    </div>*/?>
	   <?php 
     if(!$model->isNewRecord)
     {
     ?>
     <table class="gernal_table" border="0" style="background-color:#fff" width="100%" cellpadding="1" cellspacing="2">
      <tr class="tableHeading">
        <td class="" style="cursor:default" title="Date of submission">Register Date</td>
        <td class="title_column" style="cursor:default;" title="Title of listing">Title</td>
        <td class="status_column" style="cursor:default;" title="Status">Active</td>
      </tr>
    		<tr>
            	<td>
                    <?php echo $model->drg_rdate; ?>                    
				 </td>             
             	<td>
                    <?php echo ucfirst($model->co_title) ?>			 
             	<td>
             	<?php echo ucfirst($model->drg_status); ?>
				 
           </tr> 
    </table>
    <br/>
    <?php } ?>

    <div>
		<h2><?php echo $form->labelEx($model,'drg_notes'); ?></h2>
		<?php echo $form->textArea($model,'drg_notes',array('rows'=>9, 'cols'=>100, 'width'=>300)); ?>
		<?php echo $form->error($model,'drg_notes'); ?>
       
	</div>
    
</div>
<div class="clearBoth space"></div>
  <br/><br/><br/>
  <div class="userData_btns">
	<div class="row buttons">
    	<a href="<?php echo Yii::app()->createUrl('/admin/member'); ?>" class="button gray">New search</a>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update Profile', array('class' => 'button green')); ?>     
     <?php 
     if(!$model->isNewRecord)
     {
     ?>
                
       <a href="<?php echo Yii::app()->createUrl('/admin/member/sendmail',array("id"=>$model->drg_id)) ?>"  class="button blue various " >Send Email</a>       
       <?php 
        
       if(strtolower($model->drg_status)=='y'){       
       ?>       
            <a href="<?php echo Yii::app()->createUrl('/admin/member/suspend',array('id'=>$model->drg_id));?>" class="button pink">Suspend Account</a>
       <?php
       }else{ 
       ?>
            <a href="<?php echo Yii::app()->createUrl('/admin/member/activate',array('id'=>$model->drg_id));?>" class="button white">Activate Account</a>
      <?php
      }
      ?>  
      <a href="<?php echo Yii::app()->createUrl('/admin/member/del',array('id'=>$model->drg_id));?>" class="button red delete" >Delete Account</a>
	
    <?php
    }
    ?>
    </div>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->   
<script type="text/javascript">
     jQ = jQuery.noConflict();
     
     jQ('a.various').fancybox({
            type: "iframe",
            fitToView : false,
            height  : '80%',
            width  :"70%", 
            autoSize : false,
            scrolling    : 'no', 
        });
     /*jQ(".various").fancybox({  
        	'fitToView': true,
            'minHeight' : 380,
            'width' :500,
            'autoSize': true,
            'type '    : 'iframe',
            'scrolling'   : 'no', 
     }); */
     
     
    
 </script>
 
 
   