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
            <h1 style="text-align:center;">Select access period you require for </h1>
            <h2 style="text-align:center;color:#FF9C2A"> <?php echo $model->drg_company_name; ?></h2>
            <p style="text-align: center;">
                While the website is under Beta development stage<br /> 
                access to this section will  be free<br />
                Please press continue to proceed.<br />
            </p>
            <div style="float:right; width:624px;" align="center">
                <form action="#" method="post">
                    <ul id="sl-front-page" class="period-select" style="height:383px; margin:-18px 0 0 12px;">
                        <li style="width:323px;">
                            <span>Access :</span>
                            <select name="payment" id="payment" class="chzn-select" data-placeholder="Please select" >
                                <option value="">Please select</option>
                                <option value="free">Free</option>
                            </select>  
                            <div class="clear"></div>      
                        </li>                
                        <li>
                            <input class="button blue" type="submit" value="Continue" id="" name="" />
                        </li>                     
                    </ul>
                </form>
            </div>
        </div> 
       </div>
      <div class="clear"></div>
    </div>
    <script type="text/javascript">
    $(".chzn-select").chosen();
    </script>