<!-- bottom carousel -->
<div id="carousel-wrapper-2"> 
    <ul id="car-new" class="jcarousel-skin-tango">
        <li>
            <div class="smallpanel">
                <div class="carousel-box purple">
                    <div class="content-cara">
                        <h2>Science & Technology</h2><img class="float-img" src="<?php echo Yii::app()->theme->baseUrl ?>/images/icons/logoscience.png" />
                        <div class="clear"><br /></div>
                        <p><strong>Looking for a hi-tech idea or product that could help improve the quality of life or simply make it better?</strong><br /><br />Then find it here and make a difference</p>
                    </div>
                    <div class="click">
                        click here to get started <a href="/listing/science-and-technology" title='Goto science & technology catalogue' ><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/buttons/user.png" alt="Find out more button" width="25" /></a>
                    </div>
                </div>
            </div>
        </li> <!-- Science & Technology List End -->   

         <li> 
            <div class="smallpanel">
                <div class="carousel-box orange">
                    <div class="content-cara">
                        <h2>Support</h2><img class="float-img" src="<?php echo Yii::app()->theme->baseUrl ?>/images/icons/logoservices.png" />
                        <div class="clear"><br /></div>
                        <p><strong>Not sure what to do or simply need some advice?</strong><br /><br />Then this is the place for all your questions. </p>
                    </div>
                    <div class="click">
                        click here to find out more <a href="/page/faq" title='Goto DragonsNet support pages' ><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/buttons/user.png" alt="Find out more button" width="25" /></a>
                    </div>
                </div>
            </div>
        </li> <!-- /Services List End -->

        <li>
            <div class="smallpanel">
                <div class="carousel-box green">
                    <div class="content-cara">
                        <h2>Rewards</h2><img class="float-img" src="<?php echo Yii::app()->theme->baseUrl ?>/images/icons/logorewards.png" />
                        <div class="clear"><br /></div>
                        <p><strong>Your time and effort is valuable to us as is your opinion and advice you leave. </strong><br /><br />Your entry to the prize draw each month is automatic and our way of saying thank you. </p>
                    </div>
                    <div class="click">
                        click here to find out more <a href="javascript:void(0)" onclick="show_video('http://youtu.be/N65U3m00esw');" title='View prize draw video' ><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/buttons/user.png" alt="Find out more button" width="25" /></a>
                    </div>
                </div>
            </div>
        </li> <!-- /Rewards List End -->


        <li>
            <div class="smallpanel">
                <div class="carousel-box purple">
                    <div class="content-cara">
                        <h2>Retail</h2><img class="float-img" src="<?php echo Yii::app()->theme->baseUrl ?>/images/icons/logoretail.png" />
                        <div class="clear"><br /></div>
                        <p><strong>Got a business idea suitable for your local high street outlet or looking to expand your existing operation?</strong><br /><br />Let us help you get in front of the right people. </p>
                    </div>
                    <div class="click">
                        click here to find out more <a href="/listing/retail" title='Goto retail catalogue' ><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/buttons/user.png" alt="Find out more button" width="25" /></a>
                    </div>
                </div>
            </div>
        </li> <!-- /Retail List End -->

        <li>
            <div class="smallpanel">
                <div class="carousel-box orange">
                    <div class="content-cara">
                        <h2>Industrial</h2><img class="float-img" src="<?php echo Yii::app()->theme->baseUrl ?>/images/icons/logoindustry.png" />
                        <div class="clear"><br /></div>
                        <p><strong>Check out our economy changing ideas looking for an investor. </strong><br /><br />Alternatively you might have a great idea but need advice on how to get investment. Look no further. </p>
                    </div>
                    <div class="click">
                        click here to find out more <a href="/listing/industrial" title='Goto industrial catalogue' ><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/buttons/user.png" alt="Find out more button" width="25" /></a>
                    </div>
                </div>
            </div>
        </li> <!-- Industrial List -->

        <li>
            <div class="smallpanel">
                <div class="carousel-box green">
                    <div class="content-cara">
                        <h2>Business Ideas</h2><img class="float-img" src="<?php echo Yii::app()->theme->baseUrl ?>/images/icons/logoidea.png" />
                        <div class="clear"><br /></div>
                        <p><strong>Got a great idea and don't know what to do? </strong><br /><br />Then list it here; prove it is a good idea and let us turn it into a business.  </p>
                    </div>
                    <div class="click">
                        click here to find out more <a href="/listing/business-ideas" title='Goto business ideas catalogue' ><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/buttons/user.png" alt="Find out more button" width="25" /></a>
                    </div>
                </div>
            </div>
        </li> <!-- Business Idea List -->
    </ul>
</div> <!-- /carousel-wrapper-2 End -->
<script type="text/javascript">
// Controls bottom carousel
    jQuery(document).ready(function() {
        jQuery('#car-new').jcarousel({
         wrap: 'circular',
             scroll:1
        });
    });
</script>