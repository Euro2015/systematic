<?php
$lid=$_POST['listid'];
$connection = Yii::app()->db;
$command1 = $connection->createCommand("select * from `drg_user_listing` where `drg_lid`='$lid'");
$myresult1 = $command1->queryRow();
$status=$myresult1['drg_listingstatus'];
$rp=$myresult1['drg_reporttime'];
if($status=="1")
{
?> 
<!--- Confirm close pop up---->        
        
        <br /><br /><br /><br /><br /><br />
        <div class="confirm" style="display: block; background: none;" >
            <div class="u-email-box success-popup" style="margin-left: 24px;"> 
          	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-torso.png" style="z-index:999999; position:relative; top:-2px;" />
            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
              <h2>Success</h2>
 <p><em>You have successfully changed the frequency notification
         for this listing.</em></p> 
          
              <p>An email notification of this change has been sent to your registered email address</p>   
              <div class="center-button"><a href="<?php echo Yii::app()->createUrl('user/myaccount/update'); ?>" class="black button">Close</a></div>   
             <!-- <table align="center" width="100%">
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
              	<tr>  
              </tr>
              </table>-->
            </div>
          </div>
        </div>
    <!-- end close--> 
<?php
}
else
{
?>
<!--- Confirm close pop up---->        
        
        <br /><br /><br /><br /><br /><br />
        <div class="confirm" style="display: block; background: none;" >
          <div class="u-email-box success-popup" style="margin-left: 24px;"> 
          	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-torso.png" style="z-index:999999; position:relative; top:-2px;" />
            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
              <br />
              <h2>
                  Thank you <span style="color: #e5a04d;"><?php echo Yii::app()->user->getState('name') ; ?>.</span><br />Your listing submission is complete<br />  and waiting for admin approval.<br />
              </h2>
              <p><em>You will be notified when your listing is published</em></p> 
              <br />
              <div class="center-button"><a href="<?php echo Yii::app()->createUrl('user/myaccount/update'); ?>" class="black button">Close</a></div>   
             <!-- <table align="center" width="100%">
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
              	<tr>  
              </tr>
              </table>-->
            </div>
          </div>
        </div>
    <!-- end close--> 
<?php
}
?>