  <!-- Setup examples on this page -->
	<script type="text/javascript">
		//<![CDATA[
		jQuery(function(){
			jQuery('#demo-basic').poshytip();
			jQuery('#demo-basic1').poshytip();
			jQuery('#demo-basic2').poshytip();
			jQuery('#feedback').poshytip();
			jQuery('#demo-tip-yellow').poshytip();
            jQuery("#demo-basic").click(function(){
                jQuery(".feedback_cont").show(1000);
                jQuery(".feed_inner").fadeIn(1000);
                
            })
            jQuery("#close,.close").click(function(){
                jQuery(".feedback_cont").hide(1000);
                jQuery(".feed_inner").fadeOut(1000);
            })
            
		});		 
		//]]>
		
		function remove_thankspopup()
		{
			jQuery("#popcnt").fadeOut("slow");
			jQuery(".feedbacthanks").fadeOut("slow",function (){
			     var href = window.location.href.split('/?'); 
			    window.history.pushState(null, "hi", href[0]);			 
                jQuery(".feedbacthanks , .thanks_popup").css("display","none !important");
                jQuery(".feedbacthanks , .thanks_popup").css("background","none");
                jQuery(".feedbacthanks , .thanks_popup").css("z-index","-9999");
			});
             
		}
		jQuery( window ).load(function() {
			jQuery(".tip-yellow").css("left","50%");
		});
		
	</script>
 <?php 
 $pageslug = isset($_GET['slug']) ? $_GET['slug']:'';
    if(!Yii::app()->user->isGuest){    
    ?>
    <style type="text/css">
        #menu-container {
            position: relative;
            background: url(http://business-supermarket.com/themes/business/images/top-menu-border_login.png);
            background-repeat: no-repeat;
            width: 1025px;
            height: 160px;
            z-index: 10;
        }
        </style>
<?php } if(Yii::app()->user->getId()) { 
    $id = Yii::app()->user->getId();
    //$username= Yii::app()->db->createCommand("select * from users where id='$id'")->queryAll();

?>

<script>
function ck(val){
    document.getElementById('flag').value=val;
    document.getElementById('login_form_cookie').submit();
}
</script>
<?php } ?>
<div id="menu-container"><!-- menu and Logo-container Start --> 
    <div id="menuh-container">
      <div id="menuh">
        <?php 
        $page = Yii::app()->request->getParam('p');
        
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'home', 'url'=>$this->createAbsoluteUrl('/'),'active'=>Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='index'),
                            
            ), 
        ));
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'|','itemOptions'=>array('class'=>'separator')),
                            
            ), 
        ));
        
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
            // array('label'=>'business ideas', 'url'=>array('/page/business-ideas'),'active'=>Yii::app()->controller->module->id=='page' && Yii::app()->controller->id=='page' && Yii::app()->controller->action->id=='index' && $pageslug=='business-ideas'), 
            array('label'=>'business ideas', 'url'=>array('/listing/business-ideas'),'active'=>Yii::app()->controller->module->id=='listing' && Yii::app()->controller->id=='listing' && Yii::app()->controller->action->id=='business_ideas'),               
            ),
        ));
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'|','itemOptions'=>array('class'=>'separator')),
                            
            ), 
        ));
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(          
                // array('label'=>'retail', 'url'=>array('/page/retail'),'active'=>Yii::app()->controller->module->id=='page' && Yii::app()->controller->id=='page' && $pageslug=='retail'),
                array('label'=>'retail', 'url'=>array('/listing/retail'),'active'=>Yii::app()->controller->module->id=='listing' && Yii::app()->controller->id=='listing' && Yii::app()->controller->action->id=='retail'),                 
            ),
        ));
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'|','itemOptions'=>array('class'=>'separator')),
                            
            ), 
        ));
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(             
                // array('label'=>'industrial', 'url'=>array('/page/industrial'),'active'=>Yii::app()->controller->module->id=='page' && Yii::app()->controller->id=='page' && $pageslug=='industrial'),
                array('label'=>'industrial', 'url'=>array('/listing/industrial'),'active'=>(Yii::app()->controller->module->id=='listing' && Yii::app()->controller->id=='listing' && Yii::app()->controller->action->id=='industrial') || $page=='industrial'),                
            ),
        )); 
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'|','itemOptions'=>array('class'=>'separator')),
                            
            ), 
        ));
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                // array('label'=>'science & technology', 'url'=>Yii::app()->controller->module->id=='page' && Yii::app()->controller->id=='page' && $pageslug=='science-technology'),
                array('label'=>'science & technology', 'url'=>array('/listing/science-and-technology'),'active'=>Yii::app()->controller->module->id=='listing' && Yii::app()->controller->id=='listing' && Yii::app()->controller->action->id=='science_and_technology'),                
            ),
        )); 
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'|','itemOptions'=>array('class'=>'separator')),
                            
            ), 
        ));
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(         
                // array('label'=>'business services', 'url'=>array('/page/business-support'),'active'=>Yii::app()->controller->module->id=='page' && Yii::app()->controller->id=='page' && $pageslug=='business-support'),
                array('label'=>'business services', 'url'=>array('/businesslisting/businesslisting/business_services'),'active'=>(Yii::app()->controller->module->id=='businesslisting' && Yii::app()->controller->id=='businesslisting' && Yii::app()->controller->action->id=='business_services') || Yii::app()->controller->module->id=='businesslisting'),              
            ),
        ));     
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'|','itemOptions'=>array('class'=>'separator')),
                            
            ), 
        )); 
        if(!Yii::app()->user->isGuest){    
            $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    //array('label'=>'my account', 'url'=> (Yii::app()->user->getType() != 'business')? array('/myaccount/update/id/'.Yii::app()->user->getId()) : array('/myaccount/updatebusiness/id/'.Yii::app()->user->getId()) ),
                    array('label'=>'my account', 'url'=> Yii::app()->user->_user_Type=='user' ? array('/user/myaccount/update'):array('/business/myaccount/update')),           
                ),
            ));
        }
         /*
         if(!Yii::app()->user->isGuest) {
            $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                array('label'=>'You\'re logged in as  \n'.Yii::app()->user->getState('username').' <br /> (Logout)', 'url'=>array('/users/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        )); 
        }else {
            $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'You are not currently logged in','url'=>array('/'),'visible'=>Yii::app()->user->isGuest,'linkOptions'=>array('style'=>'color:#1DBFD8'),),               
            ), 
        ));
        }
        */
        if(!Yii::app()->user->isGuest) {
        ?> 
            <ul id="login-logout">
                <li>You're logged in as <br>
                <?php  echo Yii::app()->user->getState('username'); ?><br>
                <a title="Logout" href="<?php echo Yii::app()->createUrl('/logout') ?>">(Logout)</a></li>
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
      </div> <!-- /menuh -->       
    </div> <!-- /menuh-container -->
    <div id="logo">
        <a href="<?php echo Yii::app()->baseUrl; ?>" title="Return to homepage" >
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/dragonsnet-logo.png" alt="<?php echo Yii::app()->params['domain'] ?> business supermarket logo" title='Return to home' />
        </a>
    
    <!-- POPUP Code done by Jitendra : 19-09-2014  Start -->        
        <?php 
        if(!Yii::app()->user->isGuest){
        ?>
        <div class="feedback" id="feedbacklink">
            <a class="sl-tip1 tooltip1 helpico" href="#" id="demo-basic">
            	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/marketing-logo.png"  width="24" />
             <!--   <span class="classic">Please enter details of the error that you experience. If this is not the correct page then please use your browser back button to get back to the page that caused the error. Or if you have an idea to make this site better then tell us about it here.</span>-->
             <span class="classic">If you'd like to suggest any new features or wish to report a fault with the website. Then please click this link and tell us</span>
            
            </a>
        </div>
        
        
    <!-- popup for feecback -->
        <div class="registration-box feedback_cont" style="top:40px !important">
      
        	<form action="<?php echo Yii::app()->createUrl('feedback'); ?>" method="post">
            <input type="hidden" name="url" id="url" value="<?php echo Yii::app()->baseUrl;?>">
            	<div class="feed_inner">
            	<div class="closebutton_pop"></div>
                <div class="feed_heading">
                	<span class="span">
                    Email Address 
                    </span>
                    <a class="sl-tip tooltip" href="#;">?<span class="classic" style="font-size: 0.9em; width: 231px;">Please enter your email address if you wish to receive a response from us.</span></a></span>
                    <!--<a id="demo-basic" title="Please enter your email address if you wish to receive a response from us" href="#">
                        <span class="helpico">
                             ? 
                        </span>
                    </a>-->
                </div>
                <div class="feedwrap">
                	<input type="email" name="email" id="email" class="feedbackinput" placeholder="Please Enter your email if you wish a response" />
                </div>
                <?php /* ?><div class="form_heading">
                	<span class="span">
                    Error Page  
                    </span>
                    <a id="demo-basic1" title="Hey, there! This is a tooltip." href="#">
                        <span class="helpico">
                            ?
                        </span>
                    </a>
                </div>
                <div class="feedwrap">
                	<input type="text" name="email" id="email" class="feedbackinput" placeholder="http://business-supermarket.com/register">
                </div><?php */ ?>
                <div class="feed_heading">
                	<span class="span">
                    Message  
                    </span>
                     <a class="sl-tip tooltip" href="#;">?<span class="classic" style="font-size: 0.9em; width: 272px;">Please enter details of the error that you
                                                                experience. If this is not the correct page
                                                                then please use your browser back button
                                                                to get back to the page that caused the
                                                                error.<br />
                                                                Or if you have an idea to make this site
                                                                better then tell us about it here.
                                                           </span></a></span>
                   <!-- <a id="demo-basic2" title="Please enter details of the error that you experience. If this is not the correct page then please use your browser back button to get back to the page that caused the error. Or if you have an idea to make this site better then tell us about it here." href="#">
                        <span class="helpico">
                            ?
                        </span>
                    </a>-->
                </div>
                <div class="feedwrap textarewrap">
                	<textarea  required="required" class="feedbacktextarea" placeholder="Describe yourself with 4 words..." name="msg" id="msg"> </textarea>
                </div>
                <br /> 
                <div class="button_feedback close_button">
                	<input type="button" name="yt0" id="close" tabindex="12"  class="button close black" value="Close">
                </div>
                <div class="button_feedback">
                	<input type="submit" name="yt0" tabindex="12" id="register-user" class="button green_button" value="Submit">
                </div>
            </div>
            </form>
		</div>
        <?php } ?>
        
        <?php /** POPUP Code done by Jitendra : 19-09-2014  End (jiitendra.yadav@gmail.com) **/ ?>
    </div> 
    <?php 
    if(Yii::app()->user->isGuest){    
    ?>
        <div id="dragon_register">
            <a href="<?php echo $this->createUrl('/user/register');?>" title="Register for an account">Register for an account here &gt;&gt;</a>
        </div>
    <?php 
    }
    ?>
     
</div> 
<div class="clear"></div>

<div class="clear"></div>
<?php if($_GET['action']=="success"){ ?>
<div class="thanks_popup feedbacthanks"></div>
<div id="popcnt">
  <div class="u-email-box1" id="msg"> 
    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-torso.png" style="z-index:999999; position:relative; top:-3px;" />
    <div class="my-account-popup-box" style="margin-top:-38px !important"> 
      
      <br />
      <h2 class="Blue">Thankyou </h2>
      <p class="thanksp" id="confirm_email_popup"></p>
      <p style="text-align:center;"><font size="+0">You input is greatly appreciated.</font></p>
      <br />
      <table>
        <tr>
        <td colspan="2"> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
        </td>
         <td colspan="2">
        <input id="closethankspup" class="button black feedclose" name="Close" type="button" value="Close" onclick="remove_thankspopup()"/>
        </td>
      </tr>
      </table>
    </div>
  </div>
</div>
<?php }?>
