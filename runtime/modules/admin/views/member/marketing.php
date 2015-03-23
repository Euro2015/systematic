<?php
$themeurl = Yii::app()->theme->baseUrl;
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($themeurl.'/js/tinymce/tinymce.min.js');
Yii::app()->clientScript->registerCssFile($themeurl.'/css/button.css');
?>
<?php
$this->breadcrumbs=array(
	'Search user database'=>array('index')	 
);?> 

<?php if(Yii::app()->user->hasFlash('send_mail_error')):?>
    <div class="error">
        <?php echo Yii::app()->user->getFlash('send_mail_error'); ?>
    </div>
<?php endif; ?>
<div style="margin:243px 16px 0 0;" class="close_caform"><a title="Close" href="<?php echo $this->createUrl('/admin/dashboard');?>" class="button white smallrounded">X</a></div>
<div id="info_panel">
    <h1 style="margin:10px auto; text-align: center;" class="Blue">Email / contact business supermarket members</h1>
     <br><br>
     <?php
        if(Yii::app()->user->hasFlash('success'))
            echo Yii::app()->user->getFlash('success').'<br><br>';
     ?>
     <?php $form=$this->beginWidget('CActiveForm', array(
         'id'=>'page-form',
         'enableAjaxValidation'=>true,
		 'enableClientValidation'=>false,
         'clientOptions'=>array(
         //validation when submitting form, if validation don't perform, form will not send
        'validateOnSubmit'=>true,
    )
     )); ?>

     <?php echo $form->errorSummary($model);?>

     <table class="slisting-head">
            <tr class="tableHeading">
                
                <td class="sl-select-space"></td>
                <td>Member status:</td>
                <td>
                    <select id="sl_lookfor" name="MarketingForm[status]" data-placeholder="Please select" class="chzn-select" style="width:140px;border-radius:5px;border:1px solid #aaa" title="Select a what you are looking for from the list">
                        <option value="">Select</option>
                        <?php 
                            $profs = Profession::model()->findAll();
                            if($profs){
                                foreach ($profs as $data) {?>
                        <option value="<?php echo $data['drg_profession'];?>"><?php echo $data['drg_profession'];?></option>
                        <?php } }?>
                        
                    </select>
                </td>

                <td class="sl-select-space"></td>
                <td>Category:</td>
                <td>
                    <select id="sl_category" name="MarketingForm[category]" class="chzn-select" style="width:140px;border-radius:5px;border:1px solid #aaa" title="Limit your exposure to a country of your choice " >
                        <option value="">Select</option>
                        <?php 
                            $categories = ListingCategory::model()->findAll();
                            if($categories){
                                foreach ($categories as $data1) {?>
                        <option value="<?php echo $data1['list_category_id'];?>" title="<?php echo $data1['list_category_title'];?>"> <?php echo $data1['list_category_name'];?></option>
                        <?php } }?>
                    </select>
                </td>

                <td class="sl-select-space"></td>
                <td>Sector:</td>
                <td>
                    <select id="sl_sector" name="MarketingForm[sector]" data-placeholder="Please select" class="chzn-select" style="width:140px;border-radius:5px;border:1px solid #aaa" title="Select a business sector from the drop down menu" >
                        <option value="">Select</option>
                        <?php 
                            $lprofs = ListingProfession::model()->findAll();
                            if($lprofs){
                                foreach ($lprofs as $data2) {?>
                        <option value="<?php echo $data2['list_profession_id'];?>" title="<?php echo $data2['list_profession_title'];?>"><?php echo $data2['list_profession_name'];?></option>
                        <?php }}?>
                        
                    </select>
                </td>
                
                <td class="sl-select-space"></td>
                <td>Geo location:</td>
                <td>
                    <select id="drf_ctry" name="MarketingForm[country]" data-placeholder="Worldwide" class="chzn-select" style="width:140px;border-radius:5px;border:1px solid #aaa" tabindex="2">
                            <option value="Worldwide">Worldwide</option>
                            <?php 
                                $countries = Country::model()->findAll();
                                if($countries){
                                    foreach ($countries as $data3) {?>
                            <option value="<?php echo $data3['country_id'];?>" title="<?php echo $data3['country'];?>"><?php echo $data3['country'];?></option>
                            <?php }}?>
                    </select>
                </td>
        </tr>
        </table>
        <br><br>
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>130)); ?>
		<br><br>
      
     <?php echo $form->textArea($model,'body',array('rows'=>20, 'cols'=>50)); ?>

    <div class="toolbar">
        <input type="submit" value="SEND" name="send" class="button black"/>
    </div>
     <?php $this->endWidget(); ?>





</div>
<script type="text/javascript"> 
 
     tinymce.init({
        forced_root_block : "", 
        selector: "#MarketingForm_body",
        plugins: [
            "advlist autolink lists link  charmap  preview anchor",
            "searchreplace visualblocks  ",
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });  
	
</script> 
<script type="text/javascript">
    $(document).ready(function() {

       // $(".chzn-select").chosen();
    });
</script>