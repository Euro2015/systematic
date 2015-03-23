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
            <div class="marketing_tab" style="text-align: center;">
                <div class="heading_part">
                    <h1>Business supermarket terms & conditions</h1>
                </div>
                <div id="pop-up-toc" style="height: 600px;">
                    <?php $this->renderPartial("//business/toc"); ?>
                </div>
            </div>          
        </div>
    </div>