<style>
#dragon_register a{font-size: 11px;}
</style>
<div class="clear"></div> 

    <p class="breadcrumb"><a href="<?php echo Yii::app()->baseUrl; ?>" >Home</a> > registration</p> 
    <div class="clear"></div>
        <div class="registration-box" style="min-height: 152px;"><!-- registration box start-->
            <!-- <div class="close_caform">
            <a class="button white smallrounded" href="<?php echo Yii::app()->baseUrl; ?>" title="Close" >X</a>
            </div>
            <div id="registration-tabs"><a href="#taba">Create Account</a>
            <div class="clear"></div>
            </div> -->



            <?php /* <div class="pop-up" style="width:350px;">
            <div id="robby-popup" style="top:0px;">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/robot-torso.png" alt="Dragonsnet membership account successfully activated" />
            </div> 
            <div class="pop-up-content">
            <h1 align="center">Activation successful</h1>
            <p style="margin-bottom:20px;">Welcome to our business community</p>
            <a class="button black" href="<?php echo Yii::app()->baseUrl; ?>">Close</a><br /><br /></div>
            </div> */ ?>
            <div class="pop-up" style="width:350px; background-color: #fff; margin-top:212px;">
                <div id="robby-popup" style="top:-157px;">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/robot-torso.png" alt="<?php echo ucfirst(Yii::app()->params['company_name']);?> membership account successfully activated" />
                </div> 
                <div class="pop-up-content">
                    <h1 align="center" class="Blue">Activation successful</h1>
                    <p style="margin-bottom:20px;"><em>Welcome to our business community</em></p>
                    <a class="button black" href="<?php echo $this->createAbsoluteUrl('/'); ?>">Close</a>
                    <br />
                    <br />
                </div>
            </div>                     
            <div class="clear"></div>
        </div>
                  
                  
                  
        </div>