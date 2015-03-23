 <div class="content">
    <div class="right_content">
      <h2> Members menu </h2>
      <ul class="main_icons">
        <li>
            <a href="<?php echo $this->createUrl('/admin/member/create');?>" title="Business supermarket admin website information panel">             
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/new_users.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/admin/member');?>" title="<?php echo Yii::app()->params['company_name']; ?> members search menu">
              <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/members.jpg" width="75px" height="75px" />
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/admin/member/business');?>" title="Business supermarket business members search menu">
              <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/business-user.jpg" width="75px" height="75px" />
            </a>
        </li>
         <li>
            <a href="<?php echo $this->createUrl('/admin/member/marketing');?>" title="Business supermarket site wide marketing to members">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/marketing.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a href="#;" title="Blacklist users">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user-blacklist.jpg" width="75px" height="75px"  /> 
            </a>
        </li>
      </ul>
      <div class="clearBoth"></div>
      
      <h2> Listing menu </h2>
      <ul class="main_icons">
        <li>
            <a href="<?php echo Yii::app()->createUrl('admin/listings/listings');?>" title="<?php echo Yii::app()->params['company_name']; ?> search for a listing">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/search_listing.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <?php  $pendingforlisting = Listings::Model()->count("drg_listingstatus=:field", array("field" =>0)); ?>
            <a  href="<?php echo Yii::app()->createUrl('admin/listings/listings');?>" title="<?php echo Yii::app()->params['company_name']; ?> new submissions waiting for publication (<?php echo $pendingforlisting; ?>)">
              <?php 
                if($pendingforlisting >0){
                    $img = 'pending_listings_active.jpg';
                }else {
                    $img = 'pending_listings.jpg'; 
                }                
                ?>                
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/<?php echo $img; ?>" width="75px" height="75px" />
            </a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('admin/listings/listings');?>" title="<?php echo Yii::app()->params['company_name']; ?> listing doing poorly and need to be removed">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/poor_rating.jpg" width="75px" height="75px"   />
            </a>
        </li>
        <li>
            <a href="#;" onclick="deletelisting();" title="Remove listing marked for deletion by admin" > 
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/delete-listings.jpg" width="75px" height="75px"  />
            </a>
        </li>
      </ul>
      <div class="clearBoth"></div>
      
       <h2>Business Listing menu</h2>
      <ul class="main_icons">
        <li>
            <a href="<?php echo Yii::app()->createUrl('admin/blisting/blisting');?>" title="<?php echo Yii::app()->params['company_name']; ?> search for a listing">
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/search_listing.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <?php  $pendingforlisting =  Blisting::Model()->count("drg_blistingstatus=:field", array("field" =>0)); ?>
            <?php  
                if($pendingforlisting > 0){
                    $img = 'pending_listings_active.jpg';
                }else {
                    $img = 'pending_listings.jpg'; 
                }               
            ?>             
            <a href="<?php echo Yii::app()->createUrl('admin/blisting/blisting');?>" title="<?php echo Yii::app()->params['company_name']; ?> new submissions waiting for publication (<?php echo $pendingforlisting ;?>)">
                             
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/<?php echo $img; ?>" width="75px" height="75px" />
            </a>
        </li>
        
        
       </ul>
      <div class="clearBoth"></div>
      
      <h2> User samples menu </h2>
      <ul class="main_icons">
        <li>
            <a href="samples_waiting.php" title="<?php echo Yii::app()->params['company_name']; ?> user sample submissions">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/samples_subs_pending.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a  href="sample_active.php" title="<?php echo Yii::app()->params['company_name']; ?> active user samples">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/samples_active.jpg" width="75px" height="75px" />
            </a>
        </li>
      </ul>
      <div class="clearBoth"></div>
      
      <h2>Banner advertising</h2> 
     <ul class="main_icons">
        <li>
  
            <a  href="<?php echo $this->createUrl('/admin/banner/');?>" title="Business supermarket banner advert submissions">
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/banner_advert_subs_pending.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/admin/banner/banner/active');?>" title="Business supermarket published banner adverts">
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/banner_advert.jpg" width="75px" height="75px" />
            </a>
        </li>    
      </ul>
      <div class="clearBoth"></div>
      
      <h2>Website Info</h2>
      <ul class="main_icons">
          <li>
            <a href="<?php echo $this->createUrl('/admin/dashboard/infopanel');?>" title="Business supermarket admin website information panel">            
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/admin_info.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/admin//member/recent');?>" title="Business supermarket admin website information panel">             
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/new_users.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a  href="banking.php" title="Business supermarket banking module">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/banking.jpg" width="75px" height="75px" />
            </a>
        </li>
        <li>
            <a  href="transaction_search.php" title="Business supermarket transaction search module">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/search_financials.jpg" width="75px" height="75px" />
            </a>
        </li>
      </ul>
      <div class="clearBoth"></div>
      
      <h2>Homepage</h2>
      <ul class="main_icons">
        <li>
            <a href="home_page_update.html" title="Business supermarket update homepage">
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/home.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/admin/slider/slider');?>" title="Business supermarket update Sliders">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/slider_images.jpg" width="75px" height="75px" />
            </a>
        </li>
        <li>
            <a href="home_page_videos.html" title="Business supermarket update site videos">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/site_videos.jpg" width="75px" height="75px" />
            </a>
        </li>
      </ul>     
      <div class="clearBoth"></div>
      
      <h2>Website Templates</h2>
      <ul class="main_icons">
        <li>
            <a href="<?php echo $this->createUrl('/admin/contents');?>" title="FAQ">
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/support_btn.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/admin/contents');?>" title="FAQ">
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/legal_btn.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/admin/mailtemplate');?>" title="FAQ">
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/email-templates.jpg" width="75px" height="75px"  />
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/admin/contents');?>" title="FAQ">
                <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/ticker-tape.jpg" width="75px" height="75px"  />
            </a>
        </li>
      </ul>
      <div class="clearBoth"></div>
      
      <h2> Prize draw </h2>
      <ul class="main_icons">
        <li>
            <a href="cms_prizedraw.php" title="<?php echo Yii::app()->params['company_name']; ?> prize draw module">
              <img  src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/prizedraw.jpg" width="75px" height="75px" />
            </a>
        </li>
      </ul>
      <div class="clearBoth"></div>
    </div>
  </div>
  <script type="text/javascript">
 function deletelisting(){
  if(confirm("Are you sure you want to delete all listings?"))  
     window.location.href = '<?php  echo Yii::app()->createUrl('admin/dashboard/deletelisting');?>'; 
  }   
 </script>