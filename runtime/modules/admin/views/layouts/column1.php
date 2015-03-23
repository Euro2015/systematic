<?php $this->beginContent('//layouts/main'); ?>
<?php 
if(!Yii::app()->user->isGuest){
?>
    <div class="Container">
         <?php echo $content; ?>
    </div> 
<?php }else {
?>
     <?php echo $content; ?>
<?php    
} ?>
<?php $this->endContent(); ?>