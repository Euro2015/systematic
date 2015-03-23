<div class="clear"></div> 
 <?php //$this->breadcrumbs = array('User account active'); ?> 
 <br />
    <p class="breadcrumb"><a href="<?php echo Yii::app()->baseUrl; ?>" >Home</a> > registration</p> 
    <div class="registration-box"><!-- registration box start-->
          <div class="close_caform">
          	<a class="button white smallrounded" href="<?php echo Yii::app()->baseUrl; ?>" title="Close" >X</a>
          </div>
          <div id="registration-tabs"><a href="#taba">Create Account</a>
            <div class="clear"></div>
          </div> 
            <div class="registration-content">
                <div class="pop-up" style="width:530px; margin-top: 133px;">
                        <div id="robby-popup" style="top:0px;">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" alt="Business Supermarket membership account successfully activated" />
                        </div> 
                      <div class="pop-up-content">
						<h1 align="center">Account has already been activated</h1>
						<p style="margin-bottom:40px; font-size:1.2em; font-style:italic; color:#808080">Your <?php echo ucfirst(Yii::app()->params['domain']); ?> account has already been a activated.<br />Please login using your username and password</p>
						<a class="button black" href="<?php echo $this->createAbsoluteUrl('/'); ?>">
							Close
						</a><br /><br />
                     </div>  
        		</div> 
                <div class="clear"></div>
            </div>    
  	</div>
