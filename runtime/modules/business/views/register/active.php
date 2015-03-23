<div class="clear"></div> 
 <?php $this->breadcrumbs = array('business user account activated'); ?>
  <?php //$this->renderPartial('//layouts/breadcrumbs') ?> 
    
    <div class="registration-box">
          <div class="close_caform">
          	<a class="button white smallrounded" href="<?php echo Yii::app()->baseUrl; ?>" title="Close" >X</a>
          </div>
          <div id="registration-tabs"><a href="#taba">Create Account</a>
            <div class="clear"></div>
          </div> 
            <div class="registration-content">
    		<div class="pop-up" style="width:350px; margin-top: 134px;">
                    <div id="robby-popup" style="top:0px;">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/robot-torso.png" alt="Dragonsnet membership account successfully activated" />
                    </div> 
    			  <div class="pop-up-content">
    				<h1 align="center">Activation successful</h1>
                                <br />
                                <p style="margin-bottom:34px;"><em>Welcome to our business community</em></p>
    				<a class="button black" href="<?php echo $this->createAbsoluteUrl('/'); ?>">Close</a><br /><br /></div>
    			</div> 
            <div class="clear"></div>
            </div> 
  	</div>   


<?php /*<div class="clear"></div> 
 <?php $this->breadcrumbs = array('Business user account active'); ?>
  <?php $this->renderPartial('//layouts/breadcrumbs') ?>
<div class="registration-box">
    <h2 class="Blue">Your account active now  </h2> 
    <p class="orange-color" id="confirm_email_popup"></p> 
</div> */?>  