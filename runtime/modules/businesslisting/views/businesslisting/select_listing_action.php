<p class="breadcrumb">
    <a href="index.php" >Home</a> &gt; 
    <a href="<?php echo Yii::app()->createUrl('user/myaccount/update');?>"> my profile</a> &gt; 
    <a href="<?php echo Yii::app()->createUrl('listing');?>" title="Goto manage listings menu" > manage listings</a>&gt;  select listing action
</p>
 <div class="clear"></div>
 <div class="registration-box"><!-- registration box start-->
      <div id="registration-tabs"> <a href="javascript:void(0);">My Profile</a>
        <div class="clear"></div>
      </div> 
      <div class="registration-content" style="min-height:580px">
       	 <div class="my-account-links">
          <?php 
            //$this->renderPartial('//../modules/listing/views/layouts/my-account-links');                             
          ?>
          <?php 
          $this->renderPartial("//layouts/my-account-links");          
          ?>
        </div> 
        
        <div style="float:right;">            
            <h1 style="text-align:center;"><?php echo $userData->co_name; ?> </h1>
            <p Style="text-align:center; color:#808080;"><em>Listing edit menu</em></p>
            <div style="float:right; width:624px;">
                <ul id="sl-front-page" style="height:383px; margin:-18px 0 0 12px;">
                    <li>
                        <h2>1. Market this listing</h2>
                        <a href="#"> Select this if you wish to generate drive traffic to this listing.</a>
                    </li>
                    <li>
                        <h2>2. Upload / Modify  sample for this listing</h2>
                        <a href="#"> Select this if you wish to modify / update the contents of this section.</a> 
                    </li>
                   
                    <li>
                        <h2>3. Access marketing data for this listing</h2>
                        <a href="<?php echo Yii::app()->createUrl('businesslisting/purchaseaccess/blistid/'.$model->drg_blid); ?>"> Select this if you wish to access your listings marketing data.</a>
                    </li>                    
                </ul>
            </div>
        </div>
          
          
       </div>
      <div class="clear"></div>
    </div>