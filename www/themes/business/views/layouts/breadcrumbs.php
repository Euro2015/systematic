<?php if(isset($this->breadcrumbs)):?>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(			
    			'links'=>$this->breadcrumbs,
    			'homeLink'=>CHtml::link('Home','/'),
                'htmlOptions'=>array('class'=>'breadcrumb'),
    		)); ?><!-- breadcrumbs -->
<?php endif; ?>

<div class="clearboth"></div>
<?php 
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="' . $key . '">' . $message . "</div>\n";
    }
?>