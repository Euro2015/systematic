<?php
/* @var $this ListingController */
/* @var $model Userlisting */

$this->breadcrumbs=array(
    // 'Home'=>array('/'),
    'business services',
);
// echo $this->renderPartial('_listing_view', array('model'=>$model)); 
?>
<br />
<div>
    <?php
       $this->renderPartial('//../modules/businesslisting/views/layouts/default_slider');
    ?>  
</div>
<div class="clearboth"></div>
<div class="sign-up-tabss"> <!-- start sign up tab -->
    <div id="tabs_container">
        <ul id="sign-up-tabs">
            <li class="active"><a href="#taba" title="Full list of ALL businesses">Business services<br/>( <?php echo $total_posts; ?> )</a></li>
            <li><a href="#tab2" title="Businesses offering Prize Points">Promotions<br/>( 11 )</a></li>
            <li><a href="#tab3" title="Product samples">Product samples<br/>( <?php echo count($fav_posts); ?> )</a></li>
            <li><a href="#tab4" title="My favourite businesses">My Favourites<br/>( <?php echo count($fav_posts); ?> )</a></li>
            <li><a href="#tab5" title=""></a></li>
            <li><a href="#tab6" title=""></a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- /tabs_container -->

    <div id="tabs_content_container">
        <div id="taba" class="sign-up-tab_content" style="display: block;">                  
            <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
                <tr class="tableHeading">
                    <!-- Select profession drop down menu -->
                    <td title="Select profession">
                        <?php /* $listData1 =  CHtml::listData(Listinglookingfor::model()->findAll(array("order"=>'sort_order asc')),'lookingfor_id','lookingfor_name');
                        echo CHtml::dropDownList('drg_lookfor','',$listData1,array('empty' => 'Looking for','class'=>'chzn-select','data-placeholder'=>'Looking for','id'=>'sl_lookfor','tabindex'=>'2', 'onchange' => "window.location = '?looking_for='+$(this).val();"));
                        */
                ?>
                <select data-placeholder="Looking for" class="chzn-select" style="width:140px;margin-left: 10px;
    margin-right: 5px;">
                    <option value=""></option>
                    <option value="accountant" title="Accountants & Financial advisors">Accountant</option>
                    <option value="banks" title="Banks & Lending">Banks</option>
                    <option value="electrical" title="Electrical">Electrical</option>
                    <option value="electronics" title="Electronics">Electronics</option>
                    <option value="financial" title="Investors & Business angels">Financial</option>
                    <option value="graphic_design" title="Schematics and concept drawings">Graphic Design</option>
                    <option value="market" title="marketing">Marketing</option>
                    <option value="modelling" title="3D model producers">Modelling</option>
                    <option value="patent_attorney" title="IPR specialists">Patent Attorney</option>
                    <option value="stationery" title="Business stationery">Stationery</option>
                    <option value="solicitors" title="Business lawyers">Solicitors</option>
                    <option value="digital-media" title="Visualisation & Presentation">Digital Media</option>
                    <option value="website" title="Website creation & Support">Website</option>
                    <option value="workshop" title="Merchanical & Electrical workshops">Workshop</option>
                </select>
            </td>
            <td title="Sort in alphabetical order">
                <select data-placeholder="Title" class="chzn-select" style="width:150px;margin-left: 10px;
    margin-right: 5px;" onchange="window.location = '?name_sort='+$(this).val();">
                    <option value=""></option>
                    <option value="a_z" title="Sort list in ascending order">Title (a &#062 z)</option>
                    <option value="z_a" title="Sort list in descending order">Title (z &#062 a)</option>
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
                        white-space: nowrap; margin-top:4.5px;margin-left: 10px;
    margin-right: 5px; " >Description</td>
            <td title="Sort by country">
                <select data-placeholder="Origin" class="chzn-select" style="width:80px; margin-left: 10px;
    margin-right: 5px;" onchange="window.location = '?origin_sort='+$(this).val();">
                    <option value=""></option>
                    <option value="a_z" title="Sort list in descending order">a &#062 z</option>
                    <option value="z_a" title="Sort list in ascending order">z &#062 a</option>
                </select>
            </td>

            <!--<   <td title="Sort by star rating">
              <select class="chzn-select" style="width:60px;" data-placeholder="Pts">
                  <option value=""></option>
                  <option value="highest" title="Sort list in ascending order">1 > 5</option>
                  <option value="lowest" title="Sort list in descending order">5 < 1</option>
              </select>

          </td>-->
            <td title="Sort by star rating">
                <select class="chzn-select" style="width:80px;margin-left: 10px;
    margin-right: 5px;"  data-placeholder="Rating"  onchange="window.location = '?rating='+$(this).val();">
                    <option value=""></option>
                    <option value="highest" title="Sort list in ascending order">highest</option>
                    <option value="lowest" title="Sort list in descending order">lowest</option>s
                </select>

            </td>
        </tr>
        <!-- <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Electrical</td>
            <td>A &amp; R Cem Electrical Company</td>
            <td>For all your design &amp; development needs in the electrical industry</td>
            <td>Great Britain</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/2-stars.png" alt="two stars" /></td>
        </tr> -->
        <?php $posts_per_page=isset($_REQUEST['rows'])?$_REQUEST['rows']:12;$count=0; if($posts) {foreach ($posts as $post) {if($count%2==0){$color='Grey';}else{$color='Mauve';}?>
            <tr onmouseover="ChangeColor<?php echo $color; ?>(this, true);"
                onmouseout="ChangeColor<?php echo $color; ?>(this, false);"
                onclick="DoNav('<?php echo Yii::app()->createUrl('businesslisting/view?id='.$post->drg_blid);?>');"
                class="<?php echo $color; ?>Row">
                <?php
                // $blising = Businesslisting::model()->findByAttributes(array('drg_uid' =>$post->drg_uid));
                // print_r($blising);
                ?>

                <td width="50px;"><?php echo Listinglookingfor::model()->getRowTitle($post->drg_profession);?></td>
                <td width="120px;"><?php echo $post->co_name;?></td>
                <td width="290px;"><?php echo $post->drg_whoweare;?></td>
                <td width="90px;"><?php echo Country::model()->getRowTitle($post->drg_viewlimit);?></td>
                <?php /* <td width="80px;">&nbsp;</td> */ ?>
                <td width="60px;">NYR</td>

            </tr>
            <?php $count++;}} if($count<12){$j=12-$count;for($i=0;$i<$j;$i++){if($count%2==0){$color='Grey';}else{$color='Mauve';}?>
            <tr onmouseover="ChangeColor<?php echo $color; ?>(this, true);"
                onmouseout="ChangeColor<?php echo $color; ?>(this, false);"
                onclick="DoNav('#;');"
                class="<?php echo $color; ?>Row">
                <td width="50px;">&nbsp;</td>
                <td width="120px;">&nbsp;</td>
                <td width="290px;">&nbsp;</td>
                <td>&nbsp;</td>
                <td width="60px;">&nbsp;</td>
            </tr> <!-- /Blank Rows -->
            <?php $count++;}}?>
    </table>
    <br />
    <table class="sl-select">
        <tr>
            <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
            <td><select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="window.location = '?rows='+$(this).val();">
                    <!-- <option value=""></option> -->
                    <option <?php echo ($posts_per_page==12) ? 'selected=selected':'';?> value="12">12</option>
                    <option <?php echo ($posts_per_page==20) ? 'selected=selected':'';?> value="20">20</option>
                    <option <?php echo ($posts_per_page==50) ? 'selected=selected':'';?> value="50">50</option>
                    <option <?php echo ($posts_per_page==100) ? 'selected=selected':'';?> value="100">100</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
    $this->widget('CLinkPager',array('pages' => $pages,'header' => '',
            'firstPageLabel' => '<',
            'prevPageLabel' => 'previous',
            'nextPageLabel' => 'next',
            'lastPageLabel' => '>',
            'htmlOptions'=>array('name'=>'test1','id'=>'navlist','class'=>'pager2'))
    );
    ?> <!-- /Bottom navigation menu -->
</div> <!-- /End of taba main services catalogue tab -->

<!-- Start of Tab 2 contents -->

<div id="tab2" class="sign-up-tab_content">
    <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
        <tr class="tableHeading">
            <!-- Select profession drop down menu -->
            <td title="Select profession">
                <select class="chzn-select" style="width:112px;" data-placeholder="Looking for" >
                    <option value=""></option>
                    <option value="accountant" title="Accountants & Financial advisors">Accountant</option>
                    <option value="banks" title="Banks & Lending">Banks</option>
                    <option value="electrical" title="Electrical">Electrical</option>
                    <option value="electronics" title="Electronics">Electronics</option>
                    <option value="financial" title="Investors & Business angels">Financial</option>
                    <option value="graphic_design" title="Schematics and concept drawings">Graphic Design</option>
                    <option value="modelling" title="3D model producers">Modelling</option>
                    <option value="patent_attorney" title="IPR specialists">Patent Attorney</option>
                    <option value="stationery" title="Business stationery">Stationery</option>
                    <option value="solicitors" title="Business lawyers">Solicitors</option>
                    <option value="digital-media" title="Visualisation & Presentation">Digital Media</option>
                    <option value="website" title="Website creation & Support">Website</option>
                    <option value="workshop" title="Merchanical & Electrical workshops">Workshop</option>
                </select>
            </td>



            <td title="Sort in alphabetical order">
                <select class="chzn-select" style="width:190px;" data-placeholder="Title">
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
                        white-space: nowrap; margin-top:4.5px; ">Description</td>
            <td title="Sort by country">
                <select class="chzn-select" style="width:80px;" data-placeholder="Origin">
                    <option value=""></option>
                    <option value="a_z" title="Sort list in descending order">a &#062 z</option>
                    <option value="z_a" title="Sort list in ascending order">z &#062 a</option>
                </select>
            </td>
            <td title="Sort by star rating">
                <select class="chzn-select" style="width:80px;" data-placeholder="Points">
                    <option value=""></option>
                    <option value="highest" title="Sort list in ascending order">highest</option>
                    <option value="lowest" title="Sort list in descending order">lowest</option>
                </select>

            </td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Patent Attorney</td>
            <td>Barker Brettle &amp; Sons Ltd</td>
            <td>We offer great rates for the new business wishing to secure a patent application or register a logo with us</td>
            <td>New Zealand</td>
            <td style="color:#ff8040; width:55px"><strong>100</strong></td>
        </tr>
        <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Solicitors</td>
            <td>Micheal Powell &amp; Associates</td>
            <td>Legal contracts are our speciality.</td>
            <td>USA</td>
            <td style="color:#ff8040"><strong>50</strong></td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Electrical / Electronics</td>
            <td>A &amp; R Cem Electrical Company</td>
            <td>For all your design &amp; development needs in the electrical industry</td>
            <td>Great Britain</td>
            <td style="color:#ff8040"><strong>200</strong></td>
        </tr>
        <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Workshop</td>
            <td>Rebuild Precision Engineering Limited </td>
            <td>Prototyping and 3D models made to your requirements in any material</td>
            <td>Great Britain</td>
            <td style="color:#ff8040"><strong>25</strong></td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Solicitors</td>
            <td>Micheal Powell &amp; Associates</td>
            <td>Legal contracts are our speciality.</td>
            <td>USA</td>
            <td style="color:#ff8040"><strong>50</strong></td>
        </tr>
        <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Solicitors</td>
            <td>Silks & Co</td>
            <td>Business law solicitors that specialise in business and contractual law</td>
            <td>USSR</td>
            <td style="color:#ff8040"><strong>75</strong></td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Workshop</td>
            <td>Acme Engineering Ltd</td>
            <td>For all your engineering workshop requirements</td>
            <td>UK</td>
            <td style="color:#ff8040"><strong>100</strong></td>
        </tr>
        <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Electrical / Electronics</td>
            <td>PCB Designs</td>
            <td>Prototype electronics built to your designs and specifications</td>
            <td>Northern Ireland</td>
            <td style="color:#ff8040"><strong>100</strong></td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Modelling</td>
            <td>Streaming Designs Ltd</td>
            <td>3D visualisations of your designs. Very cost effective rates for the new business</td>
            <td>Germany</td>
            <td style="color:#ff8040"><strong>50</strong></td>
        </tr>
        <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Modelling</td>
            <td>Streaming Designs Ltd</td>
            <td>3D visualisations of your designs. Very cost effective rates for the new business</td>
            <td>Germany</td>
            <td style="color:#ff8040"><strong>100</strong></td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Solicitors</td>
            <td>Micheal Powell &amp; Associates</td>
            <td>Legal contracts are our speciality.</td>
            <td>Italy</td>
            <td style="color:#ff8040"><strong>100</strong></td>
        </tr>
    </table>
    <br />
    <table class="sl-select">
        <tr>
            <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
            <td><select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="window.location = '?rows='+$(this).val();">
                    <!-- <option value=""></option> -->
                    <option <?php echo ($posts_per_page==12) ? 'selected=selected':'';?> value="12">12</option>
                    <option <?php echo ($posts_per_page==20) ? 'selected=selected':'';?> value="20">20</option>
                    <option <?php echo ($posts_per_page==50) ? 'selected=selected':'';?> value="50">50</option>
                    <option <?php echo ($posts_per_page==100) ? 'selected=selected':'';?> value="100">100</option>
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

<!-- Start of Tab 3 contents -->

<div id="tab3" class="sign-up-tab_content">
    <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
        <tr class="tableHeading">
            <!-- Select profession drop down menu -->
            <td title="Select profession">
                <select class="chzn-select" style="width:112px;" data-placeholder="Looking for">
                    <option value=""></option>
                    <option value="accountant" title="Accountants & Financial advisors">Accountant</option>
                    <option value="banks" title="Banks & Lending">Banks</option>
                    <option value="electrical" title="Electrical">Electrical</option>
                    <option value="electronics" title="Electronics">Electronics</option>
                    <option value="financial" title="Investors & Business angels">Financial</option>
                    <option value="graphic_design" title="Schematics and concept drawings">Graphic Design</option>
                    <option value="modelling" title="3D model producers">Modelling</option>
                    <option value="patent_attorney" title="IPR specialists">Patent Attorney</option>
                    <option value="stationery" title="Business stationery">Stationery</option>
                    <option value="solicitors" title="Business lawyers">Solicitors</option>
                    <option value="digital-media" title="Visualisation & Presentation">Digital Media</option>
                    <option value="website" title="Website creation & Support">Website</option>
                    <option value="workshop" title="Merchanical & Electrical workshops">Workshop</option>
                </select>
            </td>
            <td title="Sort in alphabetical order">
                <select class="chzn-select" style="width:190px;" data-placeholder="Title">
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
                    white-space: nowrap; margin-top:4.5px; ">Description</td>
            <td title="Sort by country">
                <select class="chzn-select" style="width:80px;" data-placeholder="Origin">
                    <option value=""></option>
                    <option value="a_z" title="Sort list in descending order">a &#062 z</option>
                    <option value="z_a" title="Sort list in ascending order">z &#062 a</option>
                </select>
            </td>
            <td title="Sort by star rating">
                <select class="chzn-select" style="width:80px;" data-placeholder="Rating">
                    <option value=""></option>
                    <option value="highest" title="Sort list in ascending order">highest</option>
                    <option value="lowest" title="Sort list in descending order">lowest</option>
                </select>
            </td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Patent Attorney</td>
            <td>Barker Brettle &amp; Sons Ltd</td>
            <td>We offer great rates for the new business wishing to secure a patent application or register a logo with us</td>
            <td>New Zealand</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/4-stars.png" alt="four stars"></td>
        </tr>
        <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Electrical / Electronics</td>
            <td>A &amp; R Cem Electrical Company</td>
            <td>For all your design &amp; development needs in the electrical industry</td>
            <td>Great Britain</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/2-stars.png" alt="two stars"></td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Workshop</td>
            <td>Acme Engineering Ltd</td>
            <td>For all your engineering workshop requirements</td>
            <td>UK</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/5-stars.png" alt="five stars"></td>
        </tr>
        <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Workshop</td>
            <td>Rebuild Precision Engineering Limited </td>
            <td>Prototyping and 3D models made to your requirements in any material</td>
            <td>Great Britain</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/5-stars.png" alt="five stars"></td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Workshop</td>
            <td>Acme Engineering Ltd</td>
            <td>For all your engineering workshop requirements</td>
            <td>UK</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/5-stars.png" alt="five stars"></td>
        </tr>
        <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Website</td>
            <td>Web Designs "R" Us</td>
            <td>get your website designed by us at a cost effective rate</td>
            <td>USA</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/4-stars.png" alt="four stars"></td>
        </tr>
        <tr onmouseover="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="GreyRow">
            <td>Workshop</td>
            <td>Acme Engineering Ltd</td>
            <td>For all your engineering workshop requirements</td>
            <td>UK</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/5-stars.png" alt="five stars"></td>
        </tr>
    </table>
    <br />
    <table class="sl-select">
        <tr>
            <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
            <td><select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2" onchange="window.location = '?rows='+$(this).val();">
                    <!-- <option value=""></option> -->
                    <option <?php echo ($posts_per_page==12) ? 'selected=selected':'';?> value="12">12</option>
                    <option <?php echo ($posts_per_page==20) ? 'selected=selected':'';?> value="20">20</option>
                    <option <?php echo ($posts_per_page==50) ? 'selected=selected':'';?> value="50">50</option>
                    <option <?php echo ($posts_per_page==100) ? 'selected=selected':'';?> value="100">100</option>
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
</div> <!-- /End of tab3 My favourites tab -->

<!-- Start of Tab 4 contents -->

<!-- My Favourites Tab -->
<div id="tab4" class="sign-up-tab_content">
    <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
        <tr class="tableHeading">
            <!-- Select profession drop down menu -->
            <td title="Select profession">
                <?php echo CHtml::dropDownList('drg_lookfor','',$listData1,array('empty' => 'Looking for','class'=>'chzn-select','data-placeholder'=>'Looking for','id'=>'fav_sl_lookfor','tabindex'=>'2', 'onchange' => "window.location = '?looking_for='+$(this).val();", 'style'=>"width:120px"));?>
            </td>
            <td title="Sort in alphabetical order">
                <select class="chzn-select" style="width:150px;">
                    <option value="title">Title</option>
                    <option value="a_z" title="Sort list in descending order">a &#062 z</option>
                    <option value="z_a" title="Sort list in ascending order">z &#062 a</option>
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
                        white-space: nowrap; margin-top:4.5px; ">Description</td>
            <td title="Sort by country">
                <select class="chzn-select" style="width:80px;">
                    <option value="origin">Origin</option>
                    <option value="a_z" title="Sort list in descending order">a &#062 z</option>
                    <option value="z_a" title="Sort list in ascending order">z &#062 a</option>
                </select>
            </td>
            <td title="Sort by star rating">
                <select class="chzn-select" style="width:80px;">
                    <option value="rating">Rating</option>
                    <option value="highest" title="Sort list in ascending order">highest</option>
                    <option value="lowest" title="Sort list in descending order">lowest</option>
                </select>

            </td>
        </tr>
        <!-- <tr onmouseover="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="MauveRow">
            <td>Electrical</td>
            <td>A &amp; R Cem Electrical Company</td>
            <td>For all your design &amp; development needs in the electrical industry</td>
            <td>Great Britain</td>
            <td><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/star/2-stars.png" alt="two stars" /></td>
        </tr> -->
        <?php $posts_per_page=isset($_REQUEST['rows'])?$_REQUEST['rows']:12;$count=0; if($fav_posts) {foreach ($fav_posts as $post) {if($count%2==0){$color='Grey';}else{$color='Mauve';}?>
            <tr onmouseover="ChangeColor<?php echo $color; ?>(this, true);"
                onmouseout="ChangeColor<?php echo $color; ?>(this, false);"
                onclick="DoNav('<?php echo Yii::app()->createUrl('businesslisting/view?id='.$post->drg_blid);?>');"
                class="<?php echo $color; ?>Row">
                <td><?php echo Listinglookingfor::model()->getRowTitle($post->drg_profession);?></td>
                <td><?php echo $blisting->co_name;?></td>
                <td><?php //echo $post->drg_desc;?></td>
                <td><?php echo Country::model()->getRowTitle($blisting->drg_country);?></td>
                <td>NYR</td>
            </tr>
            <?php $count++;}} if($count<12){$j=12-$count;for($i=0;$i<$j;$i++){if($count%2==0){$color='Grey';}else{$color='Mauve';}?>
            <tr onmouseover="ChangeColor<?php echo $color; ?>(this, true);"
                onmouseout="ChangeColor<?php echo $color; ?>(this, false);"
                onclick="DoNav('#;');"
                class="<?php echo $color; ?>Row">
                <td width="50px;">&nbsp;</td>
                <td width="120px;">&nbsp;</td>
                <td width="290px;">&nbsp;</td>
                <td>&nbsp;</td>
                <td width="60px;">&nbsp;</td>
            </tr> <!-- /Blank Rows -->
            <?php $count++;}}?>
    </table>
</div> <!-- /End of tab4 My Favourites tab -->

<!-- Start of Tab 5 contents -->

<div id="tab5" class="sign-up-tab_content">
    <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
        <p class="noteTemp"> Needs to be NONE click-able by the user, because there is no content here </p>
    </table>
</div> <!-- /End of tab5 -->

<!-- Start of Tab 6 contents -->

<div id="tab6" class="sign-up-tab_content">
    <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
        <p class="noteTemp"> User account contents to go here </p>
    </table>
</div> <!-- /End of tab6 My Account tab -->

</div> <!-- /tabs_content_container -->

<div class="clear"></div>

</div> <!-- /end sign up tabss -->

<script src="<?php echo Yii::app()->basePath.'/business/js/chosen.jquery.js'; ?>" type="text/javascript"></script>
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

    $(document).ready(function(){
        $('select.chzn-select').change(function(){
            if($(this).val().trim() != ''){
                $(this).next().find('a.chzn-single span').css('color', '#A84793');
            } else {
                $(this).next().find('a.chzn-single span').css('color', '#444444');

            }
        });
    });
</script>
