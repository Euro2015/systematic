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
            $this->renderPartial('//../modules/listing/views/layouts/my-account-links');                 
          ?>
        </div> 
        
        <div style="float:right;">
            <h1 style="text-align:center;"><?php echo $model->drg_company_name; ?> </h1>
            <p Style="text-align:center; color:#808080;"><em>Listing edit menu</em></p>
            <br />
            <div style="float:right; width:624px;">
                <ul id="sl-front-page" style="height:383px; margin:-18px 0 0 12px;">
                    <li>
                        <h2>1. Modify update this listing</h2>
                        <a href="<?php echo Yii::app()->createUrl('listing/create/listid/'.$model->drg_lid); ?>"> Select this if you wish to modify or update this listing.</a>
                    </li>
                    
                    <li>
                        <h2>2. Market this listing</h2>
                        <a href="<?php echo Yii::app()->createUrl('banner/index/listid/'.$model->drg_lid); ?>"> Select this if you wish to generate drive traffic to this listing.</a>
                    </li>
                    
                    <li>
                        <h2>3. Upload / Modify  sample for this listing</h2>
                   <a href="<?php echo Yii::app()->createUrl('listing/user_listing_step4/listid/'.$model->drg_lid); ?>""> Select this if you wish to modify / update the contents of this section.</a> 
                    </li>
                                       
                    <li>
                        <h2>4. Access marketing data for this listing</h2>
                        <a href="<?php echo Yii::app()->createUrl('listing/purchaseaccess/listid/'.$model->drg_lid); ?>"> Select this if you wish to access your listings marketing data.</a>
                    </li>     
                    
                    <li>
                        <h2>5. Submit listing for auction</h2>
                        <a href="#"> User this option to auction a patent / business etc.</a>
                    </li>    
                    
                    <li>
                        <h2>6. Apply for funding</h2>
                        <a href="#">Select this if you wish to apply for funding for this listing </a>
                    </li>
                               
                </ul>
            </div>
        </div>
          
          
       </div>
      <div class="clear"></div>
    </div>