<hr />
<div id="footer">
        <div id="w3c">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo-w3c.png" />
        </div>
        <div id="links-1">
        	<?php echo CHtml::link('Terms & Privacy',array('url'=>'#')); ?><br />
            <?php echo CHtml::link('Technical Log In',Yii::app()->baseUrl.'/admin'); ?><br />
            <?php echo CHtml::link('Sitemap',array('url'=>'#')); ?>   
        </div>
        <div id="links-2">
            <a href="<?php echo Yii::app()->createUrl('contact'); ?>" title="contact us">Contact Us</a><br />
            <?php echo CHtml::link('Training Centre',array('url'=>'#')); ?><br />
            <?php echo CHtml::link('Accessibility',array('url'=>'#')); ?>   
        </div>
        <div id="links-3">        
            <?php echo CHtml::link('Useful Information',array('url'=>'#')); ?><br />
            <?php echo CHtml::link('Links',array('url'=>'#')); ?>            
        </div>
        <div id="contact-details">
            
            <p><span class="blue-font">Telephone</span> +44 (0)1234 567 890<br />
            <span class="blue-font">Email <a href="<?php echo Yii::app()->createUrl('contact'); ?>" title="contact us">support@<?php echo Yii::app()->params['domain']; ?></a></span></p>
        </div>
        <div id="social">
            <div id="facebook">
                <?php 
                $image = CHtml::image(Yii::app()->theme->baseUrl.'/images/buttons/button-facebook.png');
                echo CHtml::link($image,array('#')); 
                ?>
            </div>
            <div id="linkedin">
                <?php 
                $image = CHtml::image(Yii::app()->theme->baseUrl.'/images/buttons/button-linkedin.png');
                echo CHtml::link($image,array('#')); 
                ?>                
            </div>
            <div id="rss">
                <?php 
                $image = CHtml::image(Yii::app()->theme->baseUrl.'/images/buttons/button-rss.png');
                echo CHtml::link($image,array('#')); 
                ?>
            </div>
            <div id="youtube">
            <?php 
                $image = CHtml::image(Yii::app()->theme->baseUrl.'/images/buttons/button-youtube.png');
                echo CHtml::link($image,array('#')); 
                ?>                
            </div>
            <div id="twitter">
             <?php 
                $image = CHtml::image(Yii::app()->theme->baseUrl.'/images/buttons/button-twitter.png');
                echo CHtml::link($image,array('#')); 
                ?>
            </div>
        </div>
    </div> 