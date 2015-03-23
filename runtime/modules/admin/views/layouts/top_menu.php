<div id="menu-container"><!-- menu and Logo-container Start --> 
    <div id="menuh-container">
      <div id="menuh">
        <?php 
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'home', 'url'=>array('/admin')),                			
			), 
		));
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'|','itemOptions'=>array('class'=>'separator')),                			
			), 
		));        
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Search for a listing', 'url'=>array('/site/page', 'view'=>'about')),				
			),
		));
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'|','itemOptions'=>array('class'=>'separator')),                			
			), 
		));
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(			 
				array('label'=>'Samples', 'url'=>array('/site/contact')),                
			),
		));
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'|','itemOptions'=>array('class'=>'separator')),                			
			), 
		));
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(				
                array('label'=>'industrial', 'url'=>array('/site/contact')),               
			),
		)); 
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'|','itemOptions'=>array('class'=>'separator')),                			
			), 
		));
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			    array('label'=>'science & technology', 'url'=>array('/site/contact')),               
			),
		)); 
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'|','itemOptions'=>array('class'=>'separator')),                			
			), 
		));
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(			
                array('label'=>'business support', 'url'=>array('/site/contact')),				
			),
		));     
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'|','itemOptions'=>array('class'=>'separator')),                			
			), 
		));
        if(!Yii::app()->user->isGuest) {
        ?> 
            <ul id="login-logout">
                <li>You're logged in as <br>
               	<?php  echo Yii::app()->user->getState('username'); ?><br>
                <a title="Logout" href="<?php echo Yii::app()->createUrl('/admin/logout') ?>">(Logout)</a></li>
            </ul>
        <?php }
        else {
          $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                array('label'=>'You are not currently logged in','url'=>array('/'),'visible'=>Yii::app()->user->isGuest,'linkOptions'=>array('style'=>'color:#1DBFD8'),),				
			), 
		  ));
        }
        ?>       
      </div>        
    </div> 
    <div id="logo">
    	<a href="<?php echo Yii::app()->baseUrl; ?>" title="Return to homepage" >
        	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/dragonsnet-logo.png" alt="<?php echo Yii::app()->params['domain'] ?> business supermarket logo" title='Return to home' />
        </a>
    </div>  
</div> 
 