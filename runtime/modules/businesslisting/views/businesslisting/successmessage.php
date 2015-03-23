 <!--- Confirm close pop up---->        
        
        <br /><br /><br /><br /><br /><br />
        <div class="confirm" style="display: block; background: none;" >
          <div class="u-email-box success-popup"  style="margin-left: 24px;"> 
          	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-torso.png" style="z-index:999999; position:relative;   top: -3px;  margin-right: 117px;" />
            <div class="my-account-popup-box" style="margin-top:-38px !important;width: 340px;"> 
           
              <h2 style="  font: 30px AuraBoldRegular, Helvetica, Arial;">             Success
              </h2><p> You have Successfully submitted your business listing.</p>
              <p><em>You will be notified when your listing is published</em></p>   
              <div class="center-button"><a href="<?php echo Yii::app()->createUrl('business/myaccount/update'); ?>" class="black button">Close</a></div>
              <!--<table align="center" width="100%">
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