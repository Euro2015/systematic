 <div class="admin-bnr-ajex">
 	<form action="<?php echo Yii::app()->createUrl('admin/banner/banner/ajaxbanner') ?>" method="post">
     <input type="hidden" name="bannerid" id="bannerid" value="<?php echo $model->banner_id;?>" />
     <div class="banner-img">
    <?php 
    if($model->banner_path !="")
    {        
    ?>
    <img src="<?php echo Yii::app()->baseUrl.'/upload/'.$model->banner_path; ?>" title="<?php echo $model->banner_link;?>" />  
    <?php    
    }
    ?> 
    </div>
    <div class="banner-url">
       
        <input type="text" value="<?php echo $model->banner_link ?>" name="bannerlink" id="bannerlink" />
        <a href="javascript:void(0);" data-role="<?php echo $model->banner_id;?>" class="updatelink">Update</a>        
    </div>
    <div class="how-to-process">
        <p>To Update the banner link do the following:</p>
        <p>1. Click the Update link next to the link field</p>
        <p>2. The email message interface will open</p>
        <p>3. Enter a new link in the link field</p>
        <p>4. Enter a message to the user</p>
        <p>5. Press Send</p>
    </div>
    <table class="active-table" width="100%" border="0" cellspacing="0" cellpadding="0">
    	<thead>
              <tr>
                <th>Usarname</th>
                <th>Submission Date</th>
                <th>Expiry Date</th>
                <th>Amount Paid</th>
                <th>Submissions</th>
                <th>Status</th>
              </tr>
          </thead>
          <tbody>
              <!--<tr>
                <td>&nbsp;</td>
                <td>01/10/2014</td>
                <td>02/10/2014</td>
                <td>$3</td>
                <td>2</td>
                <td class="blue-color">Active</td>
              </tr>-->
          <?php   
           if($model > 0){             
                  $user =   User::model()->findByPk($model->drg_user_id);
            ?>
                <tr>
                 <td  data-role="<?php echo $model->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $model->banner_id;?>"><?php echo $user->drg_name; ?></a></td>
                 <td  data-role="<?php echo $model->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $model->banner_id;?>"><?php echo $model->banner_subdate; ?></a></td>
                 <td  data-role="<?php echo $model->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $model->banner_id;?>"><?php echo $model->banner_cost; ?></a></td>
                 <td  data-role="<?php echo $model->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $model->banner_id;?>"><?php echo $model->banner_duration; ?></a></td>
                 
                 <td  data-role="<?php echo $model->banner_id;?>"><a class="bannerview" href="javascript:void(0);" data-role="<?php echo $model->banner_id;?>"><?php echo $model->banner_cost; ?></a></td>
                 <td  data-role="<?php echo $model->banner_id;?>">Active</td>
               </tr>
            <?php
            }
          ?>
          </tbody>
    </table>

    <div class="sl-bottom-buttons">
        <?php echo CHtml::submitButton('Delete',array('name'=>'action','id'=>'delete','class'=>'button red')); ?>
    	<?php echo CHtml::Button('Return',array('name'=>'return','id'=>'Return','class'=>'button black','onclick'=>'window.location.reload();')); ?>
        <?php echo CHtml::Button('Sent Email',array('name'=>'sendmail','id'=>'sendmail','class'=>'button blue')); ?>
        <?php echo CHtml::submitButton('Suspend',array('name'=>'action','id'=>'suspend','class'=>'button blue')); ?> 
    </div>
 </form>
    <div id="mailsent" style="display: none;">
        <form action="<?php echo Yii::app()->createUrl('admin/banner/banner/message') ?>" method="post"> 
            <div class="send-message">
                <input type="hidden" name="bannerid" id="bannerid" value="<?php echo $model->banner_id;?>" />
            	<label>Message</label>
                <textarea name="admincomment" id="admincomment"></textarea>
                <input type="submit" class="black button" id="submitcomment" name="" value="Send" />
            </div>  
        </form>
    </div>
 </div>
