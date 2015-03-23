 <p class="breadcrumb">
        <a href="index.php" >Home</a> > 
        my account</p>
    
    <!-- /main-content -->
    <div class="clear"></div>
    <div class="registration-box">
        <div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
            <div class="clear"></div>
        </div> 
        <div class="registration-content" style="min-height:580px">
            <div class="my-account-links">
              <?php 
                $this->renderPartial("//layouts/my-account-links"); 
              ?>
            </div>
             <div class="content">
                <span style="margin-left:6px;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Under-Construction-1.jpg" /></span>
            </div>
        </div>
    </div>