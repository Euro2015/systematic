<div class="user_image_container">
 <?php 
 if($model->drg_image){
     $img = $model->drg_image;
     $alt_img = $model->drg_name.' '.$model->drg_surname;            
 }else {
     $img = 'avatar.jpg';
     $alt_img = 'Avatar';
 }
 ?>
 <img src="<?php echo $this->createUrl('/upload/logo/'.$img);?>" alt="Profile Picture" />
</div>
    
<!-- User profile script goes here -->

 <div class="user_info_container">
     <div style="float: right; width: 78%; margin:-9px 6px 0 0;">
         <ul>
             <li><label class="field">Member since:</label> <?php echo $model->drg_rdate;?></li>
             <li><label class="field">Member type:</label> <?php echo $model->drg_user_type;?></li>
             <li><label class="field">Status:</label> Online</li>
             <li><label class="field">Prize wins:</label> 1</li>
             <li><label class="field">Total won:</label> $200</li>
             <li><label class="field">Time logged this month:</label> 25 hrs</li>
             <li><label class="field">Average time logged per month:</label> 65 hrs</li>
             <li><label class="field">Points total this month:</label> 120</li>
         </ul>
     </div>
</div>  
   
   <div class="clearBoth"></div>
<?php /*
  <?php if(isset($this->member) && !empty($this->member)) {$model = $this->member;?>
  <div class="update-profile-pic profile-pic">
        <?php 
        if($model->drg_image){
            $img = $model->drg_image;            
        }else {
            $img = 'avatar.jpg';
        }
        ?>
      <div class="pro-photo" style="float: left; width: 44%;">
            <img src="../<?php echo IMG_LOGO_PATH.$img;?>" alt="<?php Yii::app()->params['company_name']; ?>" />
        </div>
            <div class="profile-detail" style="width: 55%;">
                 <ul>
                     <li><label class="field">Member since:</label><?php echo $model->drg_rdate; ?> </li>
                     <li><label class="field">Status:</label> Online</li>
                     <li><label class="field">Prize wins:</label>0 </li>
                     <li><label class="field">Total won:</label>0 </li>
                     <li><label class="field">Time logged this month:</label>
                      <?php echo $this_month = ActivityDate::getTimeThisMonth($model->drg_id);?> hrs
                     </li>
                     <li><label class="field">Average time logged per month:</label> <?php echo ActivityDate::getAvgPerMonth($model->drg_id); ?> hrs</li>
                     <li><label class="field">Points total this month:</label><?php echo $this_month*60; ?> </li>
                 </ul>                
            </div>
       <div class="clearBoth"></div>
    </div>
    <?php } else {?>
    <div class="user_info_container">
    <div style="float: left; width: 50%;">
        <ul>
          <li>
            <label class="field">Registered users:</label>
            <strong>11</strong></li>
          <li>
            <label class="field">Users Online:</label>
            <strong>9</strong></li>
          <li>
            <label class="field">Registered business users:</label>
            <strong></strong></li>
          <li>
            <label class="field">Busness users Online:</label>
            <strong> </strong></li>
        </ul>
    </div>
    <div style="float: right; width: 50%;">   
        <ul>
          <li>
            <label class="field">Business owners:</label>
            <strong>3</strong></li>
          <li>
            <label class="field">Consumers:</label>
            <strong>2</strong></li>
          <li>
            <label class="field">Entrepreneurs:</label>
            <strong>3</strong></li>
          <li>
            <label class="field">Investors:</label>
            <strong>1</strong></li>
        </ul>
    </div> 
  </div>
  <?php }?>
  <div class="clearBoth"></div>
  */?>