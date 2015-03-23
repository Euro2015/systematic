<?php

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');

$this->breadcrumbs = array(
    'Dashboard' => 'index',
    'Info Panel',
);

$sql1 = "SELECT COUNT(*) AS user_count, drg_user_type";
$sql1 .= " FROM {{user}}";
$sql1 .= " WHERE LEFT(drg_rdate, 7) = LEFT(NOW(), 7)";
$sql1 .= " GROUP BY drg_user_type";
$sql1 .= " ORDER BY drg_user_type DESC";

$currentMonthUsers = Yii::app()->db->createCommand($sql1)->queryAll();

$currentMonthUsersResult = array();

foreach ($currentMonthUsers as $currentMonthUsersItem) {

    $currentMonthUsersResult[$currentMonthUsersItem['drg_user_type']] = $currentMonthUsersItem['user_count'];

}

$currentMonthCountUsers = isset($currentMonthUsersResult['user']) ? $currentMonthUsersResult['user'] : 0;
$currentMonthCountBusiness = isset($currentMonthUsersResult['business']) ? $currentMonthUsersResult['business'] : 0;


$sql2 = "SELECT B.drg_profession, IFNULL(Z.count_member, 0) AS count_user";
$sql2 .= " FROM {{profession}} B";
$sql2 .= " LEFT JOIN ( SELECT COUNT(*) AS count_member, A.co_title
                        FROM {{user}} A 
                        WHERE A.drg_user_type = 'user'
                        GROUP BY A.co_title 
                  ) Z";
$sql2 .= " ON B.drg_profession = Z.co_title";
$usersProfession = Yii::app()->db->createCommand($sql2)->queryAll();


$sql3 = "SELECT B.list_profession_id, B.list_profession_name, IFNULL(Z.count_business, 0) AS count_business";
$sql3 .= " FROM {{listing_profession}} B";
$sql3 .= " LEFT JOIN ( SELECT COUNT(*) AS count_business, A.co_sector
                        FROM {{user}} A 
                        WHERE A.drg_user_type = 'business'
                        GROUP BY A.co_sector 
                  ) Z";
$sql3 .= " ON B.list_profession_id = Z.co_sector";
$sql3 .= " ORDER BY B.list_profession_name ASC;";
$businessSector = Yii::app()->db->createCommand($sql3)->queryAll();



$sql4 = "SELECT B.drg_user_type, A.drg_listingstatus, COUNT(*) AS count_listings";
$sql4 .= " FROM {{user_listing}} A";
$sql4 .= " LEFT JOIN {{user}} B";
$sql4 .= " USING (drg_uid)";
$sql4 .= " WHERE A.drg_listingstatus IN (0, 1, 2, 6)";
$sql4 .= " GROUP BY B.drg_user_type, A.drg_listingstatus";

$listingsByTypeByStatus = Yii::app()->db->createCommand($sql4)->queryAll();

$listingsByTypeByStatusResult = array(); 

foreach ($listingsByTypeByStatus as $listingsByTypeByStatusItem) {

        $listingsByTypeByStatusResult[$listingsByTypeByStatusItem['drg_user_type']][$listingsByTypeByStatusItem['drg_listingstatus']] = $listingsByTypeByStatusItem['count_listings'];

}        

$countWaitingUserListing = isset($listingsByTypeByStatusResult['user']['0']) ? $listingsByTypeByStatusResult['user']['0'] : 0;
$countSuspendUserListing = isset($listingsByTypeByStatusResult['user']['2']) ? $listingsByTypeByStatusResult['user']['2'] : 0;
$countActiveUserListing = isset($listingsByTypeByStatusResult['user']['1']) ? $listingsByTypeByStatusResult['user']['1'] : 0;
$countNotDoingWellActiveUserListing = isset($listingsByTypeByStatusResult['user']['6']) ? $listingsByTypeByStatusResult['user']['6'] : 0;

$countWaitingBusinessListing = isset($listingsByTypeByStatusResult['business']['0']) ? $listingsByTypeByStatusResult['business']['0'] : 0;
$countSuspendBusinessListing = isset($listingsByTypeByStatusResult['business']['2']) ? $listingsByTypeByStatusResult['business']['2'] : 0;
$countActiveBusinessListing = isset($listingsByTypeByStatusResult['business']['1']) ? $listingsByTypeByStatusResult['business']['1'] : 0;
$countNotDoingWellBusinessListing = isset($listingsByTypeByStatusResult['business']['6']) ? $listingsByTypeByStatusResult['business']['6'] : 0;



$sql5 = "SELECT B.drg_user_type, A.banner_approve_status, COUNT(*) AS count_banners";
$sql5 .= " FROM {{banner_ads}} A";
$sql5 .= " LEFT JOIN {{user}} B";
$sql5 .= " ON A.drg_user_id = B.drg_id";
$sql5 .= " WHERE A.banner_approve_status IN (0, 1, 2)";
$sql5 .= " GROUP BY B.drg_user_type, A.banner_approve_status";

$countBanners = Yii::app()->db->createCommand($sql5)->queryAll();

$countBannersItemStatus = array(); 

foreach ($countBanners as $countBannersItem){

        $countBannersItemStatus[$countBannersItem['drg_user_type']][$countBannersItem['banner_approve_status']] = $countBannersItem['count_banners'];

}


$countWaitingUserBanner = isset($countBannersItemStatus['user']['0']) ? $countBannersItemStatus['user']['0'] : 0;
$countSuspendUserBanner = isset($countBannersItemStatus['user']['2']) ? $countBannersItemStatus['user']['2'] : 0;
$countActiveUserBanner = isset($countBannersItemStatus['user']['1']) ? $countBannersItemStatus['user']['1'] : 0;

$countWaitingBusinessBanner = isset($countBannersItemStatus['business']['0']) ? $countBannersItemStatus['business']['0'] : 0;
$countSuspendBusinessBanner = isset($countBannersItemStatus['business']['2']) ? $countBannersItemStatus['business']['2'] : 0;
$countActiveBusinessBanner = isset($countBannersItemStatus['business']['1']) ? $countBannersItemStatus['business']['1'] : 0;




// Admin activity

$sql8 = "SELECT COUNT(*) as total_activity";
$sql8 .= " FROM {{log_transaction_admin}}";
$sql8 .= " WHERE log_id = 2";

$usersTotalActivity = Yii::app()->db->createCommand($sql8)->queryAll();
$usersTotalActivity = (int) $usersTotalActivity[0]['total_activity'];


$nextPage = ( ((int) ( $currentPage * 5 )) <  $usersTotalActivity ) ? ( $currentPage + 1 ) : "NULL";
$previousPage = ( $currentPage > 1 ) ? (int) ( $currentPage - 1 ) : "NULL";
$offset = (int) ( ($currentPage - 1) * 5 );

$sql6 = "SELECT A.admin_id, B.username, A.transaction_date, A.ip_address";
$sql6 .= " FROM {{log_transaction_admin}} A";
$sql6 .= " LEFT JOIN {{adminuser}} B";
$sql6 .= " ON A.admin_id = B.user_id";
$sql6 .= " WHERE A.log_id = 2";
$sql6 .= " ORDER BY A.transaction_date DESC";
$sql6 .= " LIMIT {$offset}, 5";

$usersLoggingIn = Yii::app()->db->createCommand($sql6)->queryAll();

if( $usersLoggingIn ){

    $adminActivity = array(); 

    foreach ($usersLoggingIn as $userLoggingIn) {

            $sql7 = "SELECT MIN(A.transaction_date) as logout_date";
            $sql7 .= " FROM {{log_transaction_admin}} A";
            $sql7 .= " WHERE A.admin_id = {$userLoggingIn['admin_id']}";
            $sql7 .= " AND A.transaction_date > '{$userLoggingIn['transaction_date']}'";
            $sql7 .= " AND A.ip_address = '{$userLoggingIn['ip_address']}'";
            $sql7 .= " AND A.log_id = 3";

            // if no result the result is already connected
            $usersLoggingOut = Yii::app()->db->createCommand($sql7)->queryAll();

            array_push( $adminActivity, array('username' => $userLoggingIn['username'], 
                                             'login_date' => date( 'd/m/Y', strtotime($userLoggingIn['transaction_date'])),
                                             'login_time' => gmdate ( 'H:i', strtotime($userLoggingIn['transaction_date']))." GMT",
                                             'logout_time' => isset( $usersLoggingOut[0]['logout_date'] ) ? gmdate( 'H:i', strtotime($usersLoggingOut[0]['logout_date']))." GMT" : "-",
                                             'ip_address' => $userLoggingIn['ip_address'])
                      );

    }        

}

?> 

<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery(".chzn-select").chosen();
    });
</script>
<!-- modif 16102014 -->
<div class="user_listing_search float_left">
    <h1 style="text-align: center;color: #ac5099;">Website Statistics</h1>

    <!-- main_panel -->
    <div class="main_panel ">
        
        <!-- Default Users -->      
        <div class="info_panel info_panel_style info_panel_style2" style="width: 345px;">
            
            <!--  info_panel_table-->
            <div class="info_panel_table">
                <div class="info_panel_row">

                    <div class="info_panel_cell">
                        <h2 class="bluehead">Default Users</h2>
                        <?php
                           foreach ( $usersProfession as $userProfessionItem ) {?>
                        
                                <p><?=$userProfessionItem['drg_profession'];?>:</p>

                            <?php 

                                $totalMembers += $userProfessionItem['count_user'];

                            }
                        ?>      
                        
                        <br/>

                        <p>This month:</p>
                        <p>Total todate:</p>

                    </div>

                    <div class="info_panel_cell">
                        <h2 class="blackhead">Total</h2>
                        
                        <?php
                           foreach ( $usersProfession as $userProfessionItem ) {?>
                        
                                <p><?=$userProfessionItem['count_user'];?></p>

                            <?php

                            }
                        ?>
                        
                        <br/>

                        <p><?=$currentMonthCountUsers;?></p>
                        <p><?=$totalMembers;?></p>

                    </div>
                    
                    <div class="info_panel_cell">
                        <h2 class="blackhead">Online</h2>
                        
                        <?php
                           foreach ( $usersProfession as $userProfessionItem ) {?>
                        
                                <p><?php 
                                        $count = count(CommonClass::getLoggedInUsersByCriteria("drg_user_type = 'user' AND co_title = '{$userProfessionItem['drg_profession']}'"));
                                        echo $count;
                                        $totalUserOnline += $count;
                                    ?>
                                </p>

                            <?php

                            }
                        ?>
                        
                        <br/>
                        <p>&nbsp;</p>
                        <p><?=$totalUserOnline;?></p>

                    </div>
                </div>
                <!-- end  info_panel_row--> 
                
                <div class="info_panel_row"></div>

                <!--  info_panel_row-->  
 
                <div class="info_panel_row">

                    <div class="info_panel_cell">
                        <h2 class="bluehead">Business Users</h2>
                        
                        <?php

                            foreach ( $businessSector as $businessSectorItem ) {?>

                                    <p><?=$businessSectorItem['list_profession_name'];?>:</p>
                            <?php 

                                $totalBusiness += $businessSectorItem['count_business'];


                            }         

                            ?>
                        <br/>

                        <p>This month:</p>
                        <p>Total todate:</p>

                    </div>

                    <div class="info_panel_cell">
                        <h2 class="blackhead">Total</h2>
                        <?php

                            foreach ( $businessSector as $businessSectorItem ) {?>
                                
                                    <p><?=$businessSectorItem['count_business'];?></p>
                            <?php 

                            }         

                            ?>
                                
                        <br/>

                        <p><?=$currentMonthCountBusiness;?></p>
                        <p><?=$totalBusiness;?></p>

                    </div>

                    <div class="info_panel_cell">
                        <h2 class="blackhead">Online</h2>
                        
                        <?php

                            foreach ( $businessSector as $businessSectorItem ) {?>

                                    <p>
                                        <?php
                                                $count = count(CommonClass::getLoggedInUsersByCriteria("drg_user_type = 'business' AND co_sector = {$businessSectorItem['list_profession_id']}"));
                                                echo $count;
                                                $totalBusinessOnline += $count;
                                        ?>
                                    </p>
                            <?php 

                            }         

                            ?>
                        
                        <br/>
                        <p>&nbsp;</p>
                        <p><?=$totalBusinessOnline;?></p>

                    </div>
                </div>
                <!-- end  info_panel_row-->     



            </div>
            <!-- end info_panel_table--> 
        </div>

        <!-- end Default Users -->

        <!-- Default User Listings -->
        <div class="info_panel info_panel_style" style="width: 272px;margin-bottom: 0px;">
            <!-- modif 16102014 info_panel_table-->
            <h2 class="bluehead" style="position: absolute;left: 60px;">Default User Listings</h2>     
            <h2 class="bluehead" style="position: absolute;left: 60px;top:105px;">Business User Listings</h2>

            <div class="info_panel_table">
                <!-- modif 16102014  info_panel_row--> 
                <div class="info_panel_row">

                </div>
                <div class="info_panel_row">

                    <div class="info_panel_cell" style="width: 442px;">

                        <p>Waiting publication:</p>
                        <p>Suspended listings:</p>
                        <p>Listings not doing well:</p>
                        <p>Active listings:</p>

                    </div>
                    <div class="info_panel_cell" style="width: 442px;">

                        <p><?=$countWaitingUserListing;?></p>
                        <p><?=$countSuspendUserListing;?></p>
                        <p><?=$countNotDoingWellActiveUserListing;?></p>
                        <p><?=$countActiveUserListing;?></p>

                    </div>
                </div>
                <!-- modif 16102014 fin info_panel_row-->   

                <!-- modif 16102014  info_panel_row-->   
                <div class="info_panel_row"></div>
                <div class="info_panel_row">



                    <div class="info_panel_cell">

                        <p>Waiting publication:</p>
                        <p>Suspended listings:</p>
                        <p>Listings not doing well:</p>
                        <p>Active listings:</p>

                    </div>
                    <div class="info_panel_cell">

                        <p><?=$countWaitingBusinessListing;?></p>
                        <p><?=$countSuspendBusinessListing;?></p>
                        <p><?=$countNotDoingWellBusinessListing;?></p>
                        <p><?=$countActiveBusinessListing;?></p>

                    </div>
                </div>
            </div>
            <!-- modif 16102014 fin info_panel_row--> 




        </div>
        <!-- end Default User Listings --> 


        <!-- Default Users Banner Adverts -->
        <div class="info_panel info_panel_style" style="width: 272px;">
            <!-- modif 16102014 info_panel_table-->
            <h2 class="bluehead" style="position: absolute;left: 40px;">Default Users Banner Adverts</h2>     
            <h2 class="bluehead" style="position: absolute;left: 40px;top:92px;">Business User Banner Adverts</h2>

            <div class="info_panel_table">
                <!--  info_panel_row--> 
                <div class="info_panel_row">

                </div>
                <div class="info_panel_row">

                    <div class="info_panel_cell" style="width: 442px;">

                        <p>Waiting publication:</p>
                        <p>Suspended Banners:</p>
                        <p>Active Banners:</p>


                    </div>
                    <div class="info_panel_cell" style="width: 442px;">

                        <p><?=$countWaitingUserBanner;?></p>
                        <p><?=$countSuspendUserBanner;?></p>
                        <p><?=$countActiveUserBanner;?></p>

                    </div>
                </div>
                <!-- end info_panel_row-->   

                <!--   info_panel_row-->   
                <div class="info_panel_row"></div>
                <div class="info_panel_row">



                    <div class="info_panel_cell">

                        <p>Waiting publication:</p>
                        <p>Suspended Banners:</p>
                        <p>Active Banners:</p>


                    </div>
                    <div class="info_panel_cell">

                        <p><?=$countWaitingBusinessBanner;?></p>
                        <p><?=$countSuspendBusinessBanner;?></p>
                        <p><?=$countActiveBusinessBanner;?></p>

                    </div>
                </div>
            </div>
            <!--  end  info_panel_row--> 


        </div>
        <!-- end Default Users Banner Adverts -->



        </div>
        <!-- end main_panel -->

        <!-- Admin activity -->
        <div class="info_panel info_panel_style info_panel_activity" style="width: 540px;margin-bottom: 0px;float: left;margin-top: -5px;">
            <!-- modif 16102014 info_panel_table-->
            <h2 class="bluehead" style="position: absolute;left: 177px;">Admin activity</h2>
            <div class="info_panel_table">
                <!--   info_panel_row--> 
                <div class="info_panel_row">

                </div>
                <div class="info_panel_row">

                    <div class="info_panel_cell"><span>Username</span></div>
                    <div class="info_panel_cell"><span>Date</span></div>
                    <div class="info_panel_cell"><span>Time in</span></div>
                    <div class="info_panel_cell"><span>Time out</span></div>
                    <div class="info_panel_cell"><span>IP Address</span></div>

                </div>
                <?php
                
                
                    foreach ($adminActivity as $adminActivityItem) {
                                                
                        ?>
                
                         <!--  Admin activity row-->   
                        <div class="info_panel_row">
                            <div class="info_panel_cell"><span><?=$adminActivityItem['username'];?></span></div>
                            <div class="info_panel_cell"><span><?=$adminActivityItem['login_date'];?></span></div>
                            <div class="info_panel_cell"><span><?=$adminActivityItem['login_time'];?></span></div>
                            <div class="info_panel_cell"><span><?=$adminActivityItem['logout_time'];?></span></div>
                            <div class="info_panel_cell"><span><?=$adminActivityItem['ip_address'];?></span></div>
                        </div>
                        <!--   end Admin activity row-->   
                    

                    <?php }
                
                ?>

                
                    
                    <!--  Admin activity row-->   
                    <div class="info_panel_row">
                        <form action="" method="post" id="admin_activity_form">
                        <?php if( $previousPage !== "NULL" ){?>
                            <div class="info_panel_cell"><span><a style="cursor: pointer;" onclick="jQuery('#admin_activity_action').val('previous');jQuery('#admin_activity_form').submit();">Previous</a></span></div> 
                        <?php }  ?>
                        <div class="info_panel_cell"><span></span></div>
                        <div class="info_panel_cell"><span></span></div>
                        <div class="info_panel_cell"><span> </span></div>
                        <?php if( $nextPage !== "NULL" ){?>
                            <div class="info_panel_cell" style="text-align: right;position: absolute;right: 30px;"><span><a style="cursor: pointer;" onclick="jQuery('#admin_activity_action').val('next');jQuery('#admin_activity_form').submit();">Next</a></span></div>
                        <?php }  ?>
                            
                    <input type="hidden" name="admin_activity_action" id="admin_activity_action" value="" />
                    <input type="hidden" name="current_page" id="current_page" value="<?=$currentPage;?>" />
                    
                </form>
                        
                    </div>
                    <!--   end Admin activity row-->
                    
                
                
                <!--  Admin activity row-->   
                 <div class="info_panel_row" style="position: relative;display: inline-block;">
                 <div class="info_panel_cell" style="position:absolute; left: 140px;top: -7px;">
                    
                    <h2 class="bluehead" >Select date range</h2>  
                               
                 </div>
                 </div>
                
                <!-- end  Admin activity row-->   
                
                
                
                 <!--  Admin activity row-->   
                 <div class="info_panel_row" style="position:relative;">
                                        
                    <div class="info_panel_cell" style="position: relative;">
                        
                        <span style="position: absolute;top: -25px;left: 13px;">From</span>
                        
                        <span>
                            
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'name'=>'admin_activity_from_date',
                                'flat'=>false,
                                'options'=>array(
                                    'dateFormat' => 'dd/mm/yy',
                                    'showAnim'=>'slideDown',
                                    'changeMonth'=>true,
                                    'changeYear'=>true,
                                    'onSelect'=>"js: function(dateText, inst) {jQuery('#CJuiDatePicker1').find('.ui-datepicker-div').hide()}",  
                                ),
                                'htmlOptions'=>array(
                                    'placeholder'=>'DD/MM/YYYY',
                                    'id' => 'CJuiDatePicker1' ,
                                    'tabindex'=> 8, 
                                    'readonly'=>'readonly',
                                    'style' => 'width:84px'
                                ),
                            ));
                            ?>
                            
                        </span>
                    </div>                
                    <div class="info_panel_cell" style="position: relative;">
                        <span style="position: absolute;top: -25px;left: 22px;">To</span>
                        <span>
                            <?php                            
                            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'name'=>'admin_activity_to_date',
                                'flat'=>false,
                                'options'=>array(
                                    'dateFormat' => 'dd/mm/yy',
                                    'showAnim'=>'slideDown',
                                    'changeMonth'=>true,
                                    'changeYear'=>true,
                                    'onSelect'=>"js: function(dateText, inst) {jQuery('#CJuiDatePicker2').find('.ui-datepicker-div').hide();}",  
                                ),
                                'htmlOptions'=>array(
                                    'placeholder'=>'DD/MM/YYYY',
                                    'id' => 'CJuiDatePicker2' ,
                                    'tabindex'=> 8, 
                                    'readonly'=>'readonly',
                                    'style' => 'width:84px'
                                ),
                            ));                            
                            ?>
                        </span>
                    </div>                    
                    
                    <div class="info_panel_cell" >
                        <form action="" method="post" id="admin_activity_export">
                            <span>
                                    <input type="button" id="admin_activity_export_send" name="admin_activity_export_send" onclick="
                                         jQuery('#admin_activity_from_date_hidden').val(jQuery('#CJuiDatePicker1').val());
                                         jQuery('#admin_activity_to_date_hidden').val(jQuery('#CJuiDatePicker2').val());
                                         jQuery('#admin_activity_export').submit();" value="Send" style="width: 50px;" class="send-btn">
                            </span>
                            <input type="hidden" name="admin_activity_from_date_hidden" id="admin_activity_from_date_hidden" value="" />
                            <input type="hidden" name="admin_activity_to_date_hidden" id="admin_activity_to_date_hidden" value="" />
                        </form>
                    </div>
                </div>

            </div>
            <!-- end  info_panel_row--> 

        </div>
        <!-- end Admin activity -->

<div class="info_panel info_panel_style info_panel_activity" style="width: 348px;margin-top: -5px;">
            <!-- modif 16102014 info_panel_table-->
            <h2 class="bluehead" style="position: absolute;left: 133px;">Blacklist address</h2>
              <div class="report_activity_block" style="margin-top:31px;">
                    <form id="report_activity_form" action="" method="post">            
                        <fieldset>            
                            <p>Enter blacklisted address separated by comma (example person@anonymous.com)</p>
                            <p><textarea name="blacklistaddress" style="background-color:#f1f0ef;width: 329px !important; height: 80px !important;"><?php if( isset($blacklistaddressString) ){ echo $blacklistaddressString; }  ?></textarea></p>
                            <p>Enter blacklisted domain / ips separated by comma (example anonymous.com)</p>
                            <p><textarea name="blacklistdomain" style="background-color: #f1f0ef;width: 329px !important; height: 80px !important;"><?php if( isset($blacklistdomainString) ){ echo $blacklistdomainString; }  ?></textarea></p>
                            <p>
                                <?php
                                    echo CHtml::submitButton('Save', array('class' => 'button green', 'style' => 'width:100px; margin-top: 9px;', 'id' => 'btnsendmail'));
                                ?>
                            </p>
                        </fieldset>
                    </form>
                </div>
        </div>

        <!--  main_panel -->


        <div class="info_panel info_panel_style" style="width: 222px;float: right;position: absolute;right: 10px;top:36px;">
            <!-- modif 16102014 info_panel_table-->

            <h2 class="bluehead" style="position: absolute;left: 40px;top:10px;">Website activity report</h2>

            <div class="info_panel" style="width: 200px;width: 200px;padding: 0;margin: 0;margin-top: 20px;">


                <div class="report_activity_block">
                    <form id="report_activity_form" action="" method="post">            
                        <fieldset>            
                            <p>Enter recipient email address</p>
                            <p><input type="text" name="report_recipient[]" value="<?php if (isset($report_recipient[0])) echo $report_recipient[0]; ?>" style="width:189px"  /></p>
                            <p><input type="text" name="report_recipient[]" value="<?php if (isset($report_recipient[1])) echo $report_recipient[1]; ?>" style="width:189px"  /></p>
                            <p><input type="text" name="report_recipient[]" value="<?php if (isset($report_recipient[2])) echo $report_recipient[2]; ?>" style="width:189px"  /></p>
                            <p>
                                <?php
                                
                                $reportFrequency = array('daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly');

                                echo CHtml::dropDownList('report_frequency', $_REQUEST['report_frequency'], $reportFrequency, array(
                                    'class' => 'chzn-select',
                                    'style' => 'width:80px',
                                    'data-placeholder' => 'Please select',
                                    'name' => 'report_frequency',
                                    'title' => 'Select report frequency'));
                                ?>
                            </p>
                            <p>
                                <?php
                                    echo CHtml::submitButton('Save', array('class' => 'button green', 'style' => 'width:100px; margin-top: 9px;', 'id' => 'btnsendmail'));
                                ?>
                            </p>
                        </fieldset>
                    </form>
                </div>





            </div>
            <!-- end info_panel_table--> 



        </div>

    </div>
    <!-- end user_listing_search -->


</div>
