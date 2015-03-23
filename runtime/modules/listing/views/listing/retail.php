<?php
/* @var $this ListingController */
/* @var $model Userlisting */

$this->breadcrumbs=array(
    // 'Home'=>array('/'),
    'retail',
);
// echo $this->renderPartial('_listing_view', array('model'=>$model));
$id=Yii::app()->user->id;
$connection = Yii::app()->db;
$command = $connection->createCommand("select * from `drg_user` where `drg_id`='$id'");
$myresult = $command->queryRow();
$cid=$myresult['drg_country'];
$command1 = $connection->createCommand("select * from `drg_user_listing` where `drg_viewlimit`='$cid' and drg_listingstatus='1'");
$myresult1 = $command1->queryRow();

$count_val=count($command1);
$command2 = $connection->createCommand("select * from `drg_user_listing` where `drg_viewlimit`='Worldwide' and drg_listingstatus='1'");
$count_val2=count($command2);
if($count_val2 > 0)
{
$count_val=$count_val + count_val2 ;
}
?>
<br />
<div>
    <?php
    $this->renderPartial('//../modules/listing/views/layouts/default_slider');
    ?>
</div>
<div class="clearboth"></div>
<div class="sign-up-tabss"> <!-- start sign up tab -->

<div id="tabs_container">
    <ul id="sign-up-tabs">
        <li class="active">
            <a href="#taba" title="Full list of ALL Business Ideas entries">Retail<br/>( <?php echo $total_posts; ?> )</a>
        </li>
        <li>
            <a href="#tab2" title="Listings under promotion">Promotions <br/>( 8 )</a>
        </li>
        <li>
            <a href="#tab3" title="Businesses offering samples for market testing">Product samples<br/>( 9 )</a>
        </li>
        <li>
            <a href="#tab4" title="My favourite industrial listings">My favourites<br/>( <?php echo count($fav_posts); ?> )</a>
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
<?php
// $date_cmd = $name_cmd = $prof_cmd = $cntry_cmd = $rows_cmd = '';
// if(isset($_REQUEST['date_sort']) && $_REQUEST['date_sort']=='oldest') $date_cmd = '&date_sort='.$_REQUEST['date_sort'];
// if(isset($_REQUEST['name_sort']) && $_REQUEST['name_sort']=='desc') $name_cmd = '&date_sort='.$_REQUEST['date_sort'];
// if(isset($_REQUEST['rows']) && $_REQUEST['rows']>12) $rows_cmd = '&rows='.$_REQUEST['rows'];
?>
<!-- Business Ideas Tab -->
<div id="taba" class="sign-up-tab_content" style="display: block;">
    <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
        <tr class="tableHeading">
            <td title="Sort in date order">
                <select data-placeholder="Date" class="chzn-select" style="width:68px;" onchange="window.location = '?date_sort='+$(this).val();">
                    <option value=""></option>
                    <option value="latest" title="Sort list in descending order">Latest</option>
                    <option value="oldest" title="Sort list in ascending order">Longest</option>
                </select>
            </td> <!-- Arrange date order -->
            <td title="Sort in title order">
                <select data-placeholder="Title" class="chzn-select" style="width:140px;" onchange="window.location = '?name_sort='+$(this).val();">
                    <option value=""></option>
                    <option value="a_z" title="Sort list in ascending order">Title (a &#062 z)</option>
                    <option value="z_a" title="Sort list in descending order">Title (z &#062 a)</option>
                </select>
            </td> <!-- Sort in title order -->
            <td title="Description" style=" background-clip: padding-box;
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
                                position: relative;width:272px;
                                text-decoration: none;
                                white-space: nowrap; margin-top:4.5px; ">Description
            </td>
            <td>
                <?php $listData1 =  CHtml::listData(Listinglookingfor::model()->findAll(array("order"=>'sort_order asc')),'lookingfor_id','lookingfor_name');
                echo CHtml::dropDownList('drg_lookfor','',$listData1,array('empty' => '','style'=>'width:100px','class'=>'chzn-select','data-placeholder'=>'Looking for','id'=>'sl_lookfor','tabindex'=>'2', 'onchange' => "window.location = '?looking_for='+$(this).val();"));?>
            </td> <!-- Looking for... -->
            <td>
                <?php $listData2 = CHtml::listData(Country::model()->findAll(),'country_id','country');
                echo CHtml::dropDownList('drg_country',$drg_country,$listData2,array('empty' => '','style'=>'width:106px','class'=>'chzn-select','data-placeholder'=>'Worldwide','id'=>'drg_country','tabindex'=>'3', 'onchange' => "window.location = '?country='+$(this).val();"));?>
            </td> <!-- Select Country -->
        </tr> <!-- /Table Headings -->
        <?php $posts_per_page=isset($_REQUEST['rows'])?$_REQUEST['rows']:12;$count=0; if($posts) {foreach ($posts as $post) {if($count%2==0){$color='Grey';}else{$color='Mauve';}?>
   <tr onmouseover="ChangeColor<?php echo $color; ?>(this, true);" 
                onmouseout="ChangeColor<?php echo $color; ?>(this, false);" 
                onclick="DoNav('<?php echo Yii::app()->createUrl('listing/view?id='.$post->drg_lid);?>');"
                class="<?php echo $color; ?>Row">
                    <td><?php echo date('d/m/y',strtotime($post->drg_approvedate));?></td>
                    <td><?php echo $post->drg_title;?></td>
                    <td><?php echo $post->drg_desc;?></td>
                    <td><?php echo Listinglookingfor::model()->getRowTitle($post->drg_profession);?></td>
                    <td><?php echo Country::model()->getRowTitle($post->drg_viewlimit);?></td>
                </tr>
<?php
 $count++;}} if($count<12){$j=12-$count;for($i=0;$i<$j;$i++){if($count%2==0){$color='Grey';}else{$color='Mauve';}?>
            <tr onmouseover="ChangeColor<?php echo $color; ?>(this, true);"
                onmouseout="ChangeColor<?php echo $color; ?>(this, false);"
                onclick="DoNav('#;');"
                class="<?php echo $color; ?>Row">
                <td  width="40px;"> </td>
                <td width="50px;"></td>
                <td width="400px;"></td>
                <td width="160px;"></td>
                <td width="20px;"></td>
            </tr> <!-- /Blank Rows -->
            <?php $count++;}}?>
    </table> <!-- /User Listing -->
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
    ?>
    <!-- /Bottom navigation menu -->
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
</div> <!-- /End of tab3 Product samples tab -->

<!-- My Favourites Tab -->
<div id="tab4" class="sign-up-tab_content">
    <table border="0" bordercolor="#fff" style="background-color:#fff; cursor:pointer" width="100%" cellpadding="1" cellspacing="2">
        <tr class="tableHeading">
            <td title="Sort in date order">
                <select data-placeholder="Date" class="chzn-select" style="width:68px;" onchange="window.location = '?date_sort='+$(this).val();">
                    <option value=""></option>
                    <option value="latest" title="Sort list in descending order">Latest</option>
                    <option value="oldest" title="Sort list in ascending order">Longest</option>
                </select>
            </td> <!-- Arrange date order -->
            <td title="Sort in title order">
                <select data-placeholder="Title" class="chzn-select" style="width:140px;" onchange="window.location = '?name_sort='+$(this).val();">
                    <option value=""></option>
                    <option value="a_z" title="Sort list in ascending order">Title (a &#062 z)</option>
                    <option value="z_a" title="Sort list in descending order">Title (z &#062 a)</option>
                </select>
            </td> <!-- Sort in title order -->
            <td title="Description" style=" background-clip: padding-box;
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
                                text-decoration: none;width:272px;
                                white-space: nowrap; margin-top:4.5px; ">Description
            </td>
            <td>
                <?php echo CHtml::dropDownList('drg_lookfor2','',$listData1,array('empty' => '','class'=>'chzn-select','data-placeholder'=>'Looking for','id'=>'fav_sl_lookfor','tabindex'=>'11', 'onchange' => "window.location = '?looking_for='+$(this).val();", 'style'=>"width:100px"));?>
            </td> <!-- Looking for... -->
            <td>
                <?php echo CHtml::dropDownList('drg_country',$drg_country,$listData2,array('empty' => '','class'=>'chzn-select','data-placeholder'=>'Worldwide','id'=>'fav_drg_country','tabindex'=>'12', 'onchange' => "window.location = '?country='+$(this).val();", 'style'=>"width:106px"));?>
            </td> <!-- Select Country -->
        </tr> <!-- /Table Headings -->
        <?php $posts_per_page=isset($_REQUEST['rows'])?$_REQUEST['rows']:12;$count=0; if($fav_posts) {foreach ($fav_posts as $post) {if($count%2==0){$color='Grey';}else{$color='Mauve';}?>
            <tr onmouseover="ChangeColor<?php echo $color; ?>(this, true);"
                onmouseout="ChangeColor<?php echo $color; ?>(this, false);"
                onclick="DoNav('<?php echo Yii::app()->createUrl('listing/view?id='.$post->drg_lid);?>');"
                class="<?php echo $color; ?>Row">
                <td width="30px;"><?php echo date('d/m/y',strtotime($post->drg_approvedate));?></td>
                <td width="100px;"><?php echo $post->drg_title;?></td>
                <td width="300px;"><?php echo $post->drg_desc;?></td>
                <td width="150px;"><?php echo Listinglookingfor::model()->getRowTitle($post->drg_profession);?></td>
                <td width="20px;"><?php echo Country::model()->getRowTitle($post->drg_viewlimit);?></td>
            </tr>
            <?php $count++;}} if($count<12){$j=12-$count;for($i=0;$i<$j;$i++){if($count%2==0){$color='Grey';}else{$color='Mauve';}?>
            <tr onmouseover="ChangeColor<?php echo $color; ?>(this, true);"
                onmouseout="ChangeColor<?php echo $color; ?>(this, false);"
                onclick="DoNav('#;');"
                class="<?php echo $color; ?>Row">
                <td width="30px;"></td>
                <td width="100px;"></td>
                <td width="300px;"></td>
                <td width="150px;"></td>
                <td width="20px;"></td>
            </tr> <!-- /Blank Rows -->
            <?php $count++;}}?>
    </table> <!-- /User Favourite Listing -->
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