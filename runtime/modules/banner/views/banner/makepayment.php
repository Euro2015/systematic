<div class="registration-content banner-add-section" style="min-height:580px;float:left;"> 
    Please wait ..... 
</div>

<form id="paypal" target="_top" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">    
    
    <input type="hidden" name="cmd" value="_xclick">
    
    <input type="hidden" name="business" value="testdemoartifex@gmail.com">
         
    <input type="hidden" name="item_name" value="Banner Advertisement  -  <?php echo $model->banner_id; ?>">
    <input type="hidden" name="item_number" value=" <?php echo $model->banner_id; ?>">
    <input type="hidden" name="amount" value="<?php echo number_format($model->banner_duration*3,2) ?>">
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    
    <input type="hidden" name="notify_url" value="" />
     
      
    <input type="hidden" value=" <?php echo Yii::app()->getBaseUrl(true);?>/banner/payment/listid/<?php echo $model->banner_list_id; ?>" id="return" name="return">
    
    <input type="hidden" value="0" name="discount_amount" id="discount_amount">
   
</form> 

<script type="text/javascript">
//<![CDATA[
jQuery(function(){ 
  jQuery("#paypal").submit();
});		 
//]]>
</script>


<?php /* <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" id="paypal">
    
    <input type="hidden" name="cmd" value="_s-xclick">
    
    <input type="hidden" name="hosted_button_id" value="LZXBLUEPJQ2ZN">
    
    <input type="hidden" name="currency_code" value="USD">
    
    <input type="hidden" name="item_name" value="Banner Advertisement  -  <?php echo $model->banner_id; ?>">    
    
    <input type="hidden" name="item_price" id="item_price" value="<?php echo $model->banner_duration*3;?>" />
    
    <input type="hidden" name="item_number" id="item_number" value="<?php echo $model->banner_id;?>" />
    
    <input type="hidden" name="quantity" id="quantity" value="1" /> 
    
    <input type="hidden" name="return" id="return" value="<?php echo Yii::app()->baseUrl;?>/banner/payment/listid/<?php echo $model->banner_list_id;?>" />
 
    <input type="hidden" name="amount" id="amount" value="<?php echo $model->banner_duration*3;?>"> 
    
    <input type="hidden" id="discount_amount" name="discount_amount" value="0" />
     
    <input type="image" src="<?php echo Yii::app()->theme->baseUrl;?>/images/Proceed-to-checkout-default.png" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
   
 
</form> */ ?>