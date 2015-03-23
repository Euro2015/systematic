<div id="shadow-wrap">

  <div id="leftcontent"> <!-- slider-wrapper start -->
	<div>
        <?php 
            $this->renderPartial('//layouts/listing_slider');
        ?>    
    </div>
    <?php $drg_lookfor = "" ?>
    
    <p class="breadcrumb"><a href="index.php">Home</a>&#062 science & technology</p>
    
    <div class="clear"></div>
    
    <div class="sign-up-tabss"> <!-- start sign up tab -->
      
      <div id="tabs_container">
            <ul id="sign-up-tabs">
                <li class="active">
                    <a href="#taba" title="Full list of ALL ideas in science and technology">Science & Tech<br/>( 999,999,999 )</a>
                </li>
                <li>
                    <a href="#tab2" title="Listings under promotion">Promotions <br/>( 8 )</a>
                </li>
                <li>
                    <a href="#tab3" title="Businesses offering samples for market testing">Product samples<br/>( 9 )</a>
                </li>
                <li>
                    <a href="#tab4" title="My favourite industrial listings">My favourites<br/>( 1 )</a>
                </li>
                <li>
                    <a style="color:#808080; cursor: default;" href="#tab5" title="Businesses open for sale">Auction<br/>( 0 )</a>
                </li>
                <li>
                    <a style="color:#808080; cursor: default;" href="#tab6" title="Businesses open for investment">Open for investment<br/>( 0 )</a>
                </li>
            </ul>
        <div class="clear"></div>
    </div> <!-- /tabs_container -->
    
     <div id="tabs_content_container">
          
        <!-- Business Ideas Tab -->  
        <div id="taba" class="sign-up-tab_content" style="display: block;">
            <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">       
                <tr class="tableHeading">    
                    <td title="Sort in date order">
                        <select data-placeholder="Date" class="chzn-select" style="width:80px;">
                          <option value=""></option>
                          <option value="a_z" title="Sort list in descending order">Latest</option>
                          <option value="z_a" title="Sort list in ascending order">Longest</option>
                        </select>
                    </td> <!-- Arrange date order -->
                    <td title="Sort in title order">
                        <select data-placeholder="Title" class="chzn-select" style="width:110px;">
                          <option value=""></option>
                          <option value="a_z" title="Sort list in descending order">Title (a &#062 z)</option>
                          <option value="z_a" title="Sort list in ascending order">Title (z &#062 a)</option>
                        </select>
                    </td> <!-- Sort in title order -->
                    <td title="Sort in alphabetical order" style=" background-clip: padding-box;
                                background-color: #FFFFFF;
                                background-image: linear-gradient(#FFFFFF 20%, #F6F6F6 50%, #EEEEEE 52%, #F4F4F4 100%);
                                border: 1px solid #AAAAAA;
                                border-radius: 5px 5px 5px 5px;
                                box-shadow: 0 0 3px #FFFFFF inset, 0 1px 1px rgba(0, 0, 0, 0.1);
                                font-size:13px;
                                color: #A84793;
                                display: block;
                                height: 23px;
                                line-height: 24px;
                                overflow: hidden;
                                padding: 0 0 0 8px;
                                position: relative;
                                text-decoration: none;
                                white-space: nowrap; margin-top:4.5px; ">Description
                    </td>
                    <td>
                        <select id="sl_lookfor" name="drg_lookfor" data-placeholder="Looking for..." class="chzn-select" style="width:120px;" tabindex="2">
                          <option value=""></option>
                          <option value="All">All</option>
                          <option <?php if($drg_lookfor=='Funding'){echo"selected='selected'";}?> value="Funding" title="Are you looking for funding?">Funding</option>
                          <option <?php if($drg_lookfor=='Franchise'){echo"selected='selected'";}?>  value="Franchise" title="Are you looking to expand your business?">Franchise</option>
                          <option <?php if($drg_lookfor=='Investor'){echo"selected='selected'";}?>  value="Investor" title="Are you looking for investment?">Investor</option>
                          <option <?php if($drg_lookfor=='Licensing'){echo"selected='selected'";}?>  value="Licensing" title="Do you want to license your idea?">Licensing</option>
                          <option <?php if($drg_lookfor=='Market Research'){echo"selected='selected'";}?>  value="Market Research" title="Want to know if have a demand for your product?">Market Research</option>
                          <option <?php if($drg_lookfor=='Mentor'){echo"selected='selected'";}?>  value="Mentor" title="Are you looking for help?">Mentor</option>
                          <option <?php if($drg_lookfor=='Partner'){echo"selected='selected'";}?>  value="Partner" title="Are you looking for a partner?">Partner</option>
                          <option <?php if($drg_lookfor=='Skill Set'){echo"selected='selected'";}?>  value="Skill Set" title="Are you looking to employ help?">Skill Set</option>
                        </select></td> <!-- Looking for... -->
                    <td>
                        <?php 
							$country = CHtml::listData(Country::model()->findAll(), 'country_id', 'country');
							echo CHtml::dropdownlist('drg_country', 'Please Select', $country,array('empty' => 'Worldwide', 'style'=>'width:110px','class'=>'chzn-select'));
						?>
                    </td> <!-- Select Country -->
                </tr> <!-- /Table Headings -->             
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#;');"
                class="GreyRow">
                    <td>29/09/13</td>
                    <td>Drivestop</td>
                    <td>A security system to prevent petrol theft from gas stations</td>
                    <td>Business partner</td>
                    <td>New Zealand</td>
                </tr> <!-- /1st Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /2nd Row --> 
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#;');"
                class="GreyRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /3rd Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /4th Row --> 
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#;');"
                class="GreyRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /5th Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /6th Row --> 
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#;');"
                class="GreyRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /7th Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /8th Row --> 
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#;');"
                class="GreyRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /9th Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /10th Row --> 
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#;');"
                class="GreyRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /11th Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> <!-- /12th Row --> 
            </table> <!-- /Industrial Listing -->
            <br />           
            <table class="sl-select">
                <tr>
                    <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
                    <td><select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2">
                          <option value=""></option>
                          <option>12</option>
                          <option>20</option>
                          <option>50</option>
                          <option>100</option>
                        </select>
                    </td>
                </tr>
            </table>
            <ul id="navlist">
                <li style="color:#C8C8C8;">&#060 previous</li>
                <li style="color:#00acce;">1</li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">next &#062</a></li>
            </ul> <!-- /Bottom navigation menu --> 
        </div> <!-- /End of tab1 main business idea catalogue tab -->
        
        <!-- Promotions Tab -->
        <div id="tab2" class="sign-up-tab_content">
            <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
                <tr class="tableHeading">
                    <td title="Sort in title order">
                        <select data-placeholder="Title" class="chzn-select" style="width:110px;">
                          <option value=""></option>
                          <option value="a_z" title="Sort list in descending order">Title (a &#062 z)</option>
                          <option value="z_a" title="Sort list in ascending order">Title (z &#062 a)</option>
                        </select>
                    </td>
                    <td title="Sort in alphabetical order" style=" background-clip: padding-box;
                                background-color: #FFFFFF;
                                background-image: linear-gradient(#FFFFFF 20%, #F6F6F6 50%, #EEEEEE 52%, #F4F4F4 100%);
                                border: 1px solid #AAAAAA;
                                border-radius: 5px 5px 5px 5px;
                                box-shadow: 0 0 3px #FFFFFF inset, 0 1px 1px rgba(0, 0, 0, 0.1);
                                font-size:13px;
                                color: #A84793;
                                display: block;
                                height: 23px;
                                line-height: 24px;
                                overflow: hidden;
                                padding: 0 0 0 8px;
                                position: relative;
                                text-decoration: none;
                                white-space: nowrap; margin-top:4.5px; ">Details
                    </td>
                    <td title="Points offered">
                        <select data-placeholder="Points" class="chzn-select" style="width:76px;">
                          <option value=""></option>
                          <option value="a_z" title="Sort list in descending order">Highest</option>
                          <option value="z_a" title="Sort list in ascending order">Lowest</option>
                        </select>
                    </td>
                </tr> <!-- tableHeading -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>3D TV Convertor</td>
                    <td>A unit for converting a standard domestic TV into a 3D ready unit with glasses.</td>
                    <td style="color:#ff8040; width:55px"><strong>100</strong></td>
                </tr> <!-- /1st Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td>Postmate</td>
                    <td>An all metal black zinc plated post holder suitable for fixing posts in soft ground.</td>
                    <td style="color:#ff8040"><strong>50</strong></td>
                </tr> <!-- /2nd Row --> 
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>Drivestop P7</td>
                    <td>A security device for the prevention of petrol theft from a petrol forecourt</td>
                    <td style="color:#ff8040"><strong>200</strong></td>
                </tr> <!-- /3rd Row -->
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td>DoorBuddy</td>
                    <td>A personal security keyring that will let you know if you've left your door open or create a security protected zone for children</td>
                    <td style="color:#ff8040"><strong>25</strong></td>
                </tr> <!-- /4th Row -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>Safety Case MKII</td>
                    <td>A storage case for 3D glasses made from 3DO material designed to resist impact damage up to 80Kgs!</td>
                    <td style="color:#ff8040"><strong>50</strong></td>
                </tr> <!-- /5th Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('http://www.dragonsnet.us/users/Jaguar/plummate/plummate.php');"
                class="MauveRow">
                    <td>Plummate</td>
                    <td>A domestic water saving device for the consumer market</td>
                    <td style="color:#ff8040"><strong>75</strong></td>
                </tr> <!-- /6th Row -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>Kanga Groomer</td>
                    <td>A grooming kit for your pet kangaroo</td>
                    <td style="color:#ff8040"><strong>100</strong></td>
                </tr> <!-- /7th Row -->
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td>Coasters "R" Us</td>
                    <td>New space age anti-slip, anti-bacterial and easy to clean table coasters</td>
                    <td style="color:#ff8040"><strong>100</strong></td>
                </tr> <!-- /8th Row --> 
            </table>
            <br />           
            <table class="sl-select">
                <tr>
                    <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
                    <td><select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2">
                          <option value=""></option>
                          <option>12</option>
                          <option>20</option>
                          <option>50</option>
                          <option>100</option>
                        </select>
                    </td>
                </tr>
            </table>
            <ul id="navlist">
                <li style="color:#C8C8C8;">&#060 previous</li>
                <li style="color:#00acce;">1</li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">next &#062</a></li>
            </ul> <!-- /Bottom navigation menu --> 
        </div> <!-- /End of tab2 Promotions tab -->
        
        <!-- Product Samples Tab -->
        <div id="tab3" class="sign-up-tab_content">
            <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
                <tr class="tableHeading">
                    <td title="Sort in title order">
                        <select data-placeholder="Title" class="chzn-select" style="width:110px;">
                          <option value=""></option>
                          <option value="a_z" title="Sort list in descending order">Title (a &#062 z)</option>
                          <option value="z_a" title="Sort list in ascending order">Title (z &#062 a)</option>
                        </select>
                    </td>
                    <td title="Sort in alphabetical order" style=" background-clip: padding-box;
                                background-color: #FFFFFF;
                                background-image: linear-gradient(#FFFFFF 20%, #F6F6F6 50%, #EEEEEE 52%, #F4F4F4 100%);
                                border: 1px solid #AAAAAA;
                                border-radius: 5px 5px 5px 5px;
                                box-shadow: 0 0 3px #FFFFFF inset, 0 1px 1px rgba(0, 0, 0, 0.1);
                                font-size:13px;
                                color: #A84793;
                                display: block;
                                height: 23px;
                                line-height: 24px;
                                overflow: hidden;
                                padding: 0 0 0 8px;
                                position: relative;
                                text-decoration: none;
                                white-space: nowrap; margin-top:4.5px; ">Sample details
                    </td>
                    <td title="Sample cost">
                        <select data-placeholder="Cost" class="chzn-select" style="width:85px;">
                          <option value=""></option>
                          <option value="All">All</option>
                          <option value="Free" title="Free">Free</option>
                          <option value="postage" title="Postage cost">Postage</option>
                          <option value="Purchase" title="Free">Purchase</option>
                        </select>
                    </td>
                    <td title="Sample availability">
                        <select data-placeholder="Availability" class="chzn-select" style="width:110px;">
                          <option value="Select Country"></option>
                            <option value="All">Worldwide</option>
                            <option value="Australasia">Australasia</option>
                            <option value="Canada">Canada</option>
                            <option value="Europe">Europe</option>
                            <option value="Far East">Far East</option>
                            <option value="UK & Ireland">UK & Ireland</option>
                            <option value="USA">USA</option>
                        </select>
                    </td>
                </tr> <!-- /Table Headings -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>3D TV Convertor</td>
                    <td>A unit for converting a standard domestic TV into a 3D ready unit with glasses.</td>
                    <td>Purchase</td>
                    <td>Worldwide</td>
                </tr> <!-- /1st Row -->
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td>Postmate</td>
                    <td>An all metal black zinc plated post holder suitable for fixing posts in soft ground.</td>
                    <td>Postage</td>
                    <td>UK</td>
                </tr> <!-- /2nd Row -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>Drivestop P7</td>
                    <td>A security device for the prevention of petrol theft from a petrol forecourt</td>
                    <td>Purchase</td>
                    <td>Worldwide</td>
                </tr> <!-- /3rd Row -->
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td>DoorBuddy</td>
                    <td>A personal security keyring that will let you know if you've left your door open or create a security protected zone for children</td>
                    <td>Free</td>
                    <td>France</td>
                </tr> <!-- /4th Row -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>Safety Case MKII</td>
                    <td>A storage case for 3D glasses made from 3DO material designed to resist impact damage up to 80Kgs!</td>
                    <td>Postage</td>
                    <td>USA</td>
                </tr> <!-- /5th Row --> 
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('http://www.dragonsnet.us/users/Jaguar/plummate/plummate.php');"
                class="MauveRow">
                    <td>Plummate</td>
                    <td>A domestic water saving device for the consumer market</td>
                    <td>Purchase</td>
                    <td>Worldwide</td>
                </tr> <!-- /6th Row -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>Olympic Badges </td>
                    <td>Support your home team with a personalised badge of your country of origin</td>
                    <td>Postage</td>
                    <td>UK</td>
                </tr> <!-- /7th Row -->
                <tr onmouseover="ChangeColorMauve(this, true);" 
                onmouseout="ChangeColorMauve(this, false);" 
                onclick="DoNav('#');"
                class="MauveRow">
                    <td>Kanga Groomer</td>
                    <td>A grooming kit for your pet kangaroo</td>
                    <td>Free</td>
                    <td>Australia</td>
                </tr> <!-- /8th Row -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>Coasters "R" Us</td>
                    <td>New space age anti-slip, anti-bacterial and easy to clean table coasters</td>
                    <td>Postage</td>
                    <td>Worldwide</td>
                </tr> <!-- /9th Row -->
            </table>
            <br />           
            <table class="sl-select">
                <tr>
                    <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
                    <td><select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2">
                          <option value=""></option>
                          <option>12</option>
                          <option>20</option>
                          <option>50</option>
                          <option>100</option>
                        </select>
                    </td>
                </tr>

            </table>
            <ul id="navlist">
                <li style="color:#C8C8C8;">&#060 previous</li>
                <li style="color:#00acce;">1</li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">next &#062</a></li>
            </ul> <!-- /Bottom navigation menu --> 
        </div> <!-- /End of tab3 Product samples tab -->
        
        <!-- My Favourites Tab -->
        <div id="tab4" class="sign-up-tab_content">
            <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
                <tr class="tableHeading">    
                    <td title="Sort in date order">
                        <select data-placeholder="Date" class="chzn-select" style="width:80px;">
                          <option value=""></option>
                          <option value="a_z" title="Sort list in descending order">Latest</option>
                          <option value="z_a" title="Sort list in ascending order">Longest</option>
                        </select>
                    </td> <!-- Arrange date order -->
                    <td title="Sort in title order">
                        <select data-placeholder="Title" class="chzn-select" style="width:110px;">
                          <option value=""></option>
                          <option value="a_z" title="Sort list in descending order">Title (a &#062 z)</option>
                          <option value="z_a" title="Sort list in ascending order">Title (z &#062 a)</option>
                        </select>
                    </td> <!-- Sort in title order -->
                    <td title="Sort in alphabetical order" style=" background-clip: padding-box;
                                background-color: #FFFFFF;
                                background-image: linear-gradient(#FFFFFF 20%, #F6F6F6 50%, #EEEEEE 52%, #F4F4F4 100%);
                                border: 1px solid #AAAAAA;
                                border-radius: 5px 5px 5px 5px;
                                box-shadow: 0 0 3px #FFFFFF inset, 0 1px 1px rgba(0, 0, 0, 0.1);
                                font-size:13px;
                                color: #A84793;
                                display: block;
                                height: 23px;
                                line-height: 24px;
                                overflow: hidden;
                                padding: 0 0 0 8px;
                                position: relative;
                                text-decoration: none;
                                white-space: nowrap; margin-top:4.5px; ">Description
                    </td>
                    <td>
                        <select id="sl_lookfor" name="drg_lookfor" data-placeholder="Looking for..." class="chzn-select" style="width:120px;" tabindex="2">
                          <option value=""></option>
                          <option value="All">All</option>
                          <option <?php if($drg_lookfor=='Funding'){echo"selected='selected'";}?> value="Funding" title="Are you looking for funding?">Funding</option>
                          <option <?php if($drg_lookfor=='Franchise'){echo"selected='selected'";}?>  value="Franchise" title="Are you looking to expand your business?">Franchise</option>
                          <option <?php if($drg_lookfor=='Investor'){echo"selected='selected'";}?>  value="Investor" title="Are you looking for investment?">Investor</option>
                          <option <?php if($drg_lookfor=='Licensing'){echo"selected='selected'";}?>  value="Licensing" title="Do you want to license your idea?">Licensing</option>
                          <option <?php if($drg_lookfor=='Market Research'){echo"selected='selected'";}?>  value="Market Research" title="Want to know if have a demand for your product?">Market Research</option>
                          <option <?php if($drg_lookfor=='Mentor'){echo"selected='selected'";}?>  value="Mentor" title="Are you looking for help?">Mentor</option>
                          <option <?php if($drg_lookfor=='Partner'){echo"selected='selected'";}?>  value="Partner" title="Are you looking for a partner?">Partner</option>
                          <option <?php if($drg_lookfor=='Skill Set'){echo"selected='selected'";}?>  value="Skill Set" title="Are you looking to employ help?">Skill Set</option>
                        </select></td> <!-- Looking for... -->
                    <td>
                        <?php 
							$country = CHtml::listData(Country::model()->findAll(), 'country_id', 'country');
							echo CHtml::dropdownlist('drg_country', 'Please Select', $country,array('empty' => 'Worldwide', 'style'=>'width:110px','class'=>'chzn-select'));
						?>
                    </td> <!-- Select Country -->
                </tr> <!-- /Table Headings -->
                <tr onmouseover="ChangeColorGrey(this, true);" 
                onmouseout="ChangeColorGrey(this, false);" 
                onclick="DoNav('#');"
                class="GreyRow">
                    <td>29/09/13</td>
                    <td>3D TV Convertor</td>
                    <td>A new water saving device for the central heating market/industry</td>
                    <td>Business partner</td>
                    <td>New Zealand</td>
                </tr>
            </table>
        </div> <!-- /End of tab4 My Favourites tab -->
        
        <!-- Open for Bidding Tab -->
        <div id="tab5" class="sign-up-tab_content">
            <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
                <p class="noteTemp">There are no listings currently open for sale</p>
            </table>
        </div> <!-- /End of tab5 Open for bidding tab -->
        
        <!-- Open for Auction Tab -->
        <div id="tab6" class="sign-up-tab_content">
            <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
                <p class="noteTemp">There are no listings currently open for investment</p>
            </table>
        </div> <!-- /End of tab6 Open for investment tab -->
        
    </div> <!-- /end of tabs_content_container -->
      
    </div> <!-- /end sign up tabss --> 
    
    </div> <!-- /leftcontent -->
  
  <!-- rightbar starts here -->
  <div id="rightbar">
  	
  <div class="clear"></div>
</div>
</div>
<!-- /shadow-wrap -->


<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript"> $(".chzn-select").chosen();</script>

<script language="javascript" type="text/javascript">
// Advert Carousel
jQuery(document).ready(function() {
    jQuery('#add-carousel-wrap').jcarousel({
        wrap: 'circular',
        scroll: 1
    });
});


// Change colour of table row on mouse over
function ChangeColorMauve(tableRow, highLight)
    {
        if (highLight)
            {
                tableRow.style.backgroundColor = '#C9C';
            }
        else
            {
                tableRow.style.backgroundColor = '#EADDED';
            }
    }

function ChangeColorGrey(tableRow, highLight)
    {
        if (highLight)
            {
                tableRow.style.backgroundColor = '#C2C2C2';
            }
        else
            {
                tableRow.style.backgroundColor = '#EBEBEB';
            }
    }

function DoNav(theUrl)
    {
        document.location.href = theUrl;
    }
    
// Accordion script
$(function() {
    $("#accordion").accordion({
            heightStyle: "content"
        });
});

//  When user clicks on tab, this code will be executed
$("#sign-up-tabs li").click(function() {
    //  First remove class "active" from currently active tab
    $("#sign-up-tabs li").removeClass('active');
    //  Now add class "active" to the selected/clicked tab
    $(this).addClass("active");
    //  Hide all tab content
    $(".sign-up-tab_content").hide();
    //  Here we get the href value of the selected tab
    var selected_tab = $(this).find("a").attr("href");
    //  Show the selected tab content
    $(selected_tab).fadeIn();
    //  At the end, we add return false so that the click on the link is not executed
    return false;
});

//  Add the text Password to password input field
function changefield(typ, vl) {
        if ((typ == 'text') && (vl == 'Password')) {
            document.getElementById("passwordbox").innerHTML = "<input id=\"pwd\" type=\"password\" name=\"drg_pass\" title=\"Password\" onblur=\"changefield(this.type,this.value);\" />";
            document.getElementById("pwd").focus();
        }
        if ((typ == 'password') && (vl == '')) {
            document.getElementById("passwordbox").innerHTML = "<input id=\"pwd\" type=\"text\" name=\"drg_pass\" value='Password' title=\"Password\" onfocus=\"changefield(this.type,this.value);\" />";
        }
    }
</script>

</body>
</html>
