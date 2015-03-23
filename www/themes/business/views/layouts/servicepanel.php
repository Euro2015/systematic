<div id="robby-torso">
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/robot-torso.png" width="168px" height="135px" alt="Robot pointing to login form" />
</div>

<div id="box3">
    <div id="tabs_content_container">
        <div id="servicetab1" class="tab_content" style="display: block;">
           <h2 class="Blue">Support</h2>
           <p><span style="color: #808080;"><strong>Got a great idea? We have the skills and knowledge to help you take it to market and all the steps in between.</strong>
                   <br />
                   <br />
                   How do you list my idea?<br />
                   <a href="<?php echo $this->createUrl('/video_tutorials');?>" title='goto site videos' >See our 'how to' videos >> </a><br />
                   <!-- Link opens list of link videos in same panel. Video plays over photo carousel -->
                   <br />Frequently asked questions<br />
                   <a href="<?php echo $this->createUrl('/page/faq');?>" title='goto FAQ' >Get answers here >></a><br />
                   <!-- Link take user to FAQ Section of the support page -->
                   <br />Looking for business help?<br />
                   <a href="/businesslisting/business-services" title='goto business services' >Click here >></a><br />
                   <!-- Link take user to Support Section -->
               </span>
           </p>
        </div> <!-- /tab1 Ends -->
        <div id="servicetab2" class="tab_content">
           <h2 class="Blue">Services</h2>
           <p><span style="color: #808080;"><strong>We offer a comprehensive range of business services. Here are a few of them to help get you going.</strong><br />
                   <br />What is IPR?<br /><a href="support_IPR.php" title='goto IPR details' >Learn more here >></a><br />
                   <br />Where do I go for legal help?<br /><a href="#" title='goto business services catalogue' >Get answers here >></a><br />
                   <br />Why is copyright important?<br /><a href="#" title='goto copyright details' >Click here >></a><br />
               </span>
           </p>
        </div>  <!-- /tab2 Ends -->
    </div>  <!-- /tabs_content_container Ends -->

    <div id="tabs_container">
       <ul id="tabs">
           <li class="active"><a href="#servicetab1">Support</a></li>
           <li><a class="icon_accept  lastradius" href="#servicetab2">Services</a></li>
       </ul>
       <div class="clear"></div> 
    </div>  <!-- /tabs_container Ends -->
    <div class="clear"></div>
</div>   <!-- /box3 Ends -->

<script>
//When user clicks on tab, this code will be executed
var JQ1 = jQuery.noConflict();
JQ1("#tabs li").click(function() 
{
	JQ1("#tabs li").removeClass('active'); // First remove class "active" from currently active tab
	JQ1(this).addClass("active"); // Now add class "active" to the selected/clicked tab
	JQ1(".tab_content").hide(); // Hide all tab content
	var selected_tab = JQ1(this).find("a").attr("href"); // Here we get the href value of the selected tab
	JQ1(selected_tab).fadeIn(); // Show the selected tab content
	return false; // At the end, we add return false so that the click on the link is not executed
});
</script>
