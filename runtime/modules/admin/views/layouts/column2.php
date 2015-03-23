<?php $this->beginContent('application.modules.admin.views.layouts.main');  
if(!Yii::app()->user->isGuest){
?>  
<?php if($this->pageTitle) {?><h1 class="cms_page_title"><?php echo $this->pageTitle; ?></h1><?php } ?>
     <?php 
     $this->widget('zii.widgets.CBreadcrumbs', 
     array('links'=>$this->breadcrumbs,'htmlOptions'=>array('class'=>'breadcrumb')));
     ?>    
    <?php echo $content; ?>
     

<?php 
}else {

 echo $content;  
 
} 

$this->endContent(); 
?>