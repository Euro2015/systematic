
<style type="text/css">
    
    #more_record_chzn {
        top: 0px;
        left: 10px;
    }    
   
    .more_record_chzn_pagination {
        top: -35px !important;
        left: 10px !important;
        
    }
    
    .more_record_label_pagination {
        position: relative;
        top: -43px !important;
        left: 0px !important;
        color: #AC5099;
    }    
    
    .more_record_label {
        position: relative;
        top: -9px;
        left: 0px;
        color: #AC5099;
    }
    
    .chzn-search input{        
        width: 37px !important;        
    }
    
    .Container > .breadcrumb {
        top: 63px !important;
    }
    
</style>

<?php

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl.'/js/chosen.jquery.js');
$js->registerCssFile($baseUrl.'/css/chosen.css');

if( $userType == "user" ){
    
        $this->breadcrumbs=array(
                'Search user database'=>array('index')	 
        );

        $sql = "SELECT B.drg_profession, IFNULL(Z.count_member, 0) AS count_user";
        $sql .= " FROM {{profession}} B";
        $sql .= " LEFT JOIN ( SELECT COUNT(*) AS count_member, A.co_title
                                FROM {{user}} A 
                                WHERE A.drg_user_type = 'user'
                                GROUP BY A.co_title 
                          ) Z";
        $sql .= " ON B.drg_profession = Z.co_title";
        
        $usersProfession = Yii::app()->db->createCommand($sql)->queryAll();

        ?>

<!-- info_panel_table_search -->
    <div class="info_panel_table info_panel_table_search" style="position: relative;top: -80px;margin-bottom: -34px;left: 400px;width: 480px;">
        
                <div class="info_panel_row">

                    <div class="info_panel_cell">
                        
                        <?php

                            foreach ( $usersProfession as $userProfession ) {?>
                        
                                    <p><?=$userProfession['drg_profession'];?>:</p>
                            <?php 

                                $totalMembers += $userProfession['count_user'];                                


                            } ?>
                        
                            <p>Registered Members:</p>
                       
                    </div>

                    <div class="info_panel_cell">
                       
                        <?php

                            foreach ( $usersProfession as $userProfession ) {?>
                        
                                    <p><?=$userProfession['count_user'];?></p>
                        
                           <?php } ?>
                        
                        <p><?=$totalMembers;?></p>
						
                    </div>
                    
                    <div class="info_panel_cell">
                        
                        <?php

                            foreach ( $usersProfession as $userProfession ) {?>
                        
                                    <p><?php        
                                            echo $logguedInByProfession = count(CommonClass::getLoggedInUsersByCriteria("drg_user_type = 'user' AND co_title = '{$userProfession['drg_profession']}'"));
                                         ?>
                                    </p>
                            <?php
                            
                                $totalLogguedInMembers += $logguedInByProfession;
                            
                            } ?>
                        
                        <p><?=$totalLogguedInMembers;?></p>
						
                    </div>
                </div>
                <!-- end  info_panel_row--> 
              </div>
    <!-- end info_panel_table_search -->

<?php }else{
    
        $this->breadcrumbs=array(
            'Search business services user database'=>array('business')
        );
    
        $sql = "SELECT COUNT(*) AS business_count";
        $sql .= " FROM {{user}}";
        $sql .= " WHERE drg_user_type = 'business'; ";
        $businessCount = Yii::app()->db->createCommand($sql)->queryAll();
        $businessCount = $businessCount[0]['business_count'];      
        
        $businessLogguedIn = count(CommonClass::getLoggedInUsersByCriteria("drg_user_type = 'business'"));
        
        ?>
            
        <!-- info_panel_table_search -->
    <div class="info_panel_table info_panel_table_search" style="position: relative;margin-bottom: 36px;top: -80px;left: 400px;width: 480px;">
        
                <div class="info_panel_row">

                    <div class="info_panel_cell">
                        
                            <p>Registered Business users:</p>
                       
                    </div>

                    <div class="info_panel_cell">
                        
                        <p><?=$businessCount;?></p>
						
                    </div>
                    
                    <div class="info_panel_cell">
                        
                        <p><?=$businessLogguedIn;?></p>
						
                    </div>
                </div>
                <!-- end  info_panel_row--> 
              </div>
    <!-- end info_panel_table_search -->
    
    <?php
}


?>



<div class="user_listing_search" style="margin-top: -70px !important;"><br>
     <a href="<?php echo $this->createUrl('/admin/member/create');?>" class="button blue">+Add</a>
<?php   

    $this->widget('zii.widgets.grid.CGridView', array(
        
	'id'=>'member-grid',
        
	'dataProvider'=>$model->search(),
        
	'filter'=>$model, 
        
        'itemsCssClass' => 'table-class display dataTable',
        
	'columns'=>array(
                array(
                    'header' => 'Username',
                    'name' => 'drg_username',
                    'value' => 'CHtml::link($data->drg_username, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    'type'  => 'raw', 
                ), 
                array(
                    'header' => 'Email',
                    'name' => 'drg_email',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->drg_email, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))', 
                ),
                array(
                    'header' => 'Address',
                    'name' => 'drg_addr1',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->drg_addr1, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',        
                ),             
                array(
                    'header' => 'Country',
                    'name' => 'drg_country',
                    'type' => 'raw',
                    'value' => 'CHtml::link(Country::model()->findByPk($data->drg_country)->country, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))', 
                ),
                array(
                    'header' => 'Account status',
                    'name' => 'drg_status',
                    'type' => 'raw',
                    'value' => 'CHtml::link( CommonClass::getUserStatusLabel($data->drg_status), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))', 
                ),            
                array(
                    'header' => 'Date',
                    'name' => 'drg_rdate',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CommonClass::getUkDate($data->drg_rdate), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))', 
                ),

               /* array(
                    'class'=>'CButtonColumn',
                    'header' => 'Action',
                    'template' => '{update}{delete}', 
                ),*/
		
	),
        
));

?>
    
<form action='' method='post' id='showMoreRecordForm'>
    
    <?php

    $moreRecord = isset($_REQUEST['more_record']) ? $_REQUEST['more_record'] : Yii::app()->user->getState('pageSize');

    ?>
    
    <span id='more_record_label' class='more_record_label'>View</span>
    
    <?php
    
    echo CHtml::dropDownList('more_record', $moreRecord,
                            array('10' => '10', '20' => '20', '50' => '50', '100' => '100'),
                            array(
                                  'class'=>'chzn-select',
                                  'style' => 'width:75px;',
                                  'data-placeholder'=>'Please select',
                                  'name'=>'more_record',
                                  'title'=>'Show more record',
                                  'onchange' => "jQuery('#showMoreRecordForm').submit();"
                                )
         );

    ?>

</form>
     
</div>

<script type="text/javascript">
    
    jQuery(document).ready(function(){

        jQuery(".chzn-select").chosen();        
    
        // Add necessary style while there's a pagination
        if( jQuery('.yiiPager').is(":visible") ){
        
            jQuery('#more_record_label').addClass('more_record_label_pagination');
            jQuery('#more_record_chzn').addClass('more_record_chzn_pagination');
       
        }
        
    });
    
    
</script>

