<style type="text/css">
    
    #more_record_chzn {
        top: 0px !important;
        left: 10px !important;      
    }    
   
    .more_record_chzn_pagination {
        top: -35px !important;
        left: 10px !important;
        
    }
    
    .more_record_label_pagination {
        position: relative;
        top: -43px !important;
        left: 0px !important;
        color: #AC5099;
    }    
    
    .more_record_label {
        position: relative;
        top: -9px !important;
        left: 0px !important;
        color: #AC5099;
    }
    
    .chzn-search input{        
        width: 37px !important;        
    }
    
    .Container > .breadcrumb {
        top: 63px !important;
    }
    
</style>
<?php
/* @var $this UserFinancialTransactionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Manage Financial',
);
$x = new ECurrencyConverter();
$x->currencyConverter();
?>

 <div class="registration-box"> <!-- registration box start-->
      <div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
        <div class="clear"></div>
      </div> <!-- Tab contents-->

        <div class="registration-content" style="min-height:580px">
       	 <div class="my-account-links">
          <?php 
          $this->renderPartial("//layouts/my-account-links"); 
          ?>
        </div>  <!-- Tab area side menu -->
		
		 <div class="empty-msg-box">
              <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />

        
                <div class="my-account-popup-box">
                    <a title="Close" href="javaScript:void(0)" onclick="close_empty_msg_form()" class="pu-close">X</a>
             
      		<br/> 
                  <h2 style="font-size:16px;color:red;text-align:center;">Oops you must enter a value to continue</h2>
                    <div style="width:300px;margin:0 auto;"> 
					<div style="color:999;font-style:italic;text-align:center;">Please try again</div>
					
					<div>&nbsp;</div>
					<div style="width:72px;margin:0 auto;"> 
                    <input name="cancel"  id="cancel" value="Close" type="button" onclick="close_empty_msg_form()" class="button black"  />
					</div>
                    </div> 
                </div>
              </div>
            </div>
			
			<div class="withdraw-notice-box">
              <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
                <div class="my-account-popup-box">
                    <a title="Close" href="javaScript:void(0)" onclick= "close_withdraw_form()" class="pu-close">X</a>
					<h2>Your funds will be transferred to your account within the next 72hrs.</h2>
					<div>&nbsp;</div>
					<div style="width:300px;margin:0 auto;">
					<div style="color:999;font-style:italic;margin:0 auto;text-align: center;">If you have any queries please contact accounts@businesssupermarket.com</div>
					<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'withdraw-fund-form',
							'action' => Yii::app()->request->baseUrl.'/managefinancials/transaction/index',
							'htmlOptions'=>array('class'=>'form-search',),
					)); ?>
                        <div>&nbsp;</div>
					<div style="width:72px;margin:0 auto;"> 
					  <input name="btnok" id="btnok" value="OK" type="button" class="button black"  />
					  </div>
					<?php $this->endWidget(); ?>
                    </div> 
                </div>
              </div>
            </div>
			<div class="error-withdraw-notice-box">
              <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
                <div class="my-account-popup-box"> 
                	<a title="Close" href="javaScript:void(0)" onclick="close_error_withdraw_notice_box()" class="pu-close">X</a>
			<br/>
					 <h2 style="font-size:16px;color:red;">Oops you entered withdraw amount must be less than account balance</h2>
                    <div style="width:300px;margin:0 auto;"> 
					<div style="color:999;font-style:italic;text-align:center;">Please try again</div>
					
					<div>&nbsp;</div>
					<div style="width:72px;margin:0 auto;"> 
                    <input name="cancel" id="cancel" value="Close" type="button" onclick="close_error_withdraw_notice_box()" class="button black"  />
					</div> 
                    </div> 
                </div>
              </div>
            </div>
			
        <a href="<?php echo Yii::app()->createUrl('/'); ?>" class="fancybox" ></a>
        
        <div id="content" style="margin-top:-17px;">
            <h1 style="font-size:22px; padding-top:15px; text-align:center;">My financials transaction</h1>
            <br />
            <br />
			<?php

           $currencymodel = new Currency();
            $currenyCode=Currency::model()->getCurrencyCode($model->drg_currency);
          //  $locale = CLocale::getInstance('pl_PL');
          //  $symbol = $locale->getCurrencySymbol('USD');

       //     $lastTransaction = (UserFinancialTransaction::model()->lastTransactionCode()!="") ? UserFinancialTransaction::model()->lastTransactionCode(): $currenyCode;

         //  echo $symbol; exit;
			if($model->drg_currency == 1){
				$currenySign = '($) US Dollar';
			}
		else if($model->drg_currency == 2){
				$currenySign = '(£) British Pound';
			}else if($model->drg_currency == 3){
				$currenySign = '(€) Euro';
			}

			?>
			
			
            <div id="accountDetails" style="margin-left:10px; font-size:12px;">
                <p>Transaction history for:<span> <?php echo Yii::app()->user->getName();?> </span><br />
                Account No:<span> <?php echo Yii::app()->user->getId();?></span></p>
                <span style="color:#808080; font-size:0.9em;">cr - credit &nbsp &nbsp &nbsp db - debit<br />
                <em>Currency - <?php echo $currenySign;?> </em></span>
                <div class="clear"></div>
            </div> <!-- accountDetails div -->
           
            <div id="balance">
                    <!--<form name="addfuntdd"> -->
                    <p style="margin-bottom:0px; margin-top:5px; margin-left:58px;" class="accountBalance">Account balance:&nbsp;</p>
                    <input type="text" value="<?php echo $x->convert(number_format($accountBalance[0]['account_balance'],2),$accountBalance[0]['currency_code'],$currenyCode); ?>" readonly=readonly name="addFundsw" id="accountBalanceValue" />

                    <div class="clearfix"></div>
					<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'add-fund-form',
							'action' => Yii::app()->request->baseUrl.'/managefinancials/transaction/RequestPayment',
							'htmlOptions'=>array('class'=>'form-search',),
					)); ?>
                  <input type="button"  class="button black" value="Add funds" id="add_fund" name="add_fund" style="margin-left:28px; margin-top: 7px; font-size:1em;"/>
					
                    <input id="addFundsValue" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" value="00.00" name="addFunds" />
					<?php $this->endWidget(); ?>
                    <div class="clearfix"></div>

                    <input type="button" style="margin-left: -2px; margin-top: 5px; font-size:1em;" id="withdraw_fund" class="button black" value="Withdraw funds" />
                    <input id="withdrawFundsValue" style="margin-top:5px;" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" value="00.00" name="withdrawFunds" />
                   <!-- </form> -->
                </div> <!-- balance div -->
            
            <table class="gernal_table ManageFinancials" width="50%" cellspacing="2" cellpadding="1" bordercolor="#fff" border="0">
                <tbody>
                    <tr class="tableHeading">
                        <td class="date_column" title="Date published" style="cursor:default; text-align: center; width:50px;">Date</td>
                        <td class="title_column" title="Listing title" style="cursor:default; width:20px;" >Type</td>
                        <td class="doi_column" title="Days Active" style="cursor:default; width:130px;">Description</td>
						  <td class="doi_column" title="Days Active" style="cursor:default; width:80px;">Transaction ID</td>
                        <td class="doi_column" title="Days Of Inactivity" style="cursor:default; width:50px;">Paid out</td>
                        <td class="" title="Total number of votes received" style="cursor:default; width:50px;">Paid in</td>
                        <td class="" title="Total number of votes received" style="cursor:default; width:53px;">Balance</td>
                    </tr>

					<?php
					foreach($dataProvider AS $index=>$record):
					
						
						if($index%2==0)
								$class = 'GreyRow';
								//$style = "onclick="DoNav('#');" onmouseout="style='background-color: rgb(235, 235, 235);'" onmouseover="" style="background-color: rgb(235, 235, 235);"";
					    else
								$class = 'MauveRow';
							//	$style = "onclick="DoNav('#');" onmouseout="style='background-color: rgb(234, 221, 237);'" onmouseover="" style="background-color: rgb(234, 221, 237);"";
						?>
                        <tr class="<?php echo $class;?>" <?php if($record['withdraw_status'] =='1'){?> style="color:red;" <?php } ?>>
                        <td><?php echo $record['date'];?></td>
                        <td><?php echo $record['type'];?></td>
                        <td><?php echo $record['description'];?></td>
                        <td><?php echo $record['transactionId'];?></td>
                        <td><?php echo ($record['paid_out'] !='0.00')?$x->convert($record['paid_out'], $record['trans_currency_code'],$currenyCode):'';?></td>
                        <td><?php echo ($record['paid_in'] !='0.00')?$x->convert($record['paid_in'],$record['trans_currency_code'],$currenyCode):'';?></td>
						<td><?php echo $x->convert($record['balance'],$record['trans_currency_code'],$currenyCode);?></td>
                    </tr>
				<?php 	 endforeach;?>
                   
                </tbody>
            </table> <!-- /end gernal_table manageListing -->
            <br />           
            <table class="sl-select" style="margin-left: 117px;">
                <tr>
                    <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
                    <td><?php
    
    echo CHtml::dropDownList('more_record', $moreRecord,
                            array('10' => '10', '20' => '20', '50' => '50', '100' => '100'),
                            array(
                                  'class'=>'chzn-select',
                                  'style' => 'width:75px;',
                                  'data-placeholder'=>'Please select',
                                  'name'=>'more_record',
                                  'title'=>'Show more record',
                                  'onchange' => "jQuery('#showMoreRecordForm').submit();"
                                )
         );

    ?>
                    </td>
                </tr>
            </table>
           <!-- <ul id="navlist">
                <li style="color:#C8C8C8;">&#060 previous</li>
                <li style="color:#00acce;">1</li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">next &#062</a></li>
            </ul> --!> <!-- /Bottom navigation menu -->
        </div> <!-- / end content div -->

       </div> <!-- registration-content Ends -->
      <div class="clear"></div>
    </div> <!--end bottom carousel-----> 
    
  </div> <!-- /leftcontent -->

<div id="screen">
</div>
  
<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ ?>

<script type="text/javascript">

    jQ = jQuery.noConflict();
    $(".chzn-select").chosen();
function close_empty_msg_form(){
    $(".empty-msg-box").hide();
    jQ('#screen').removeAttr('style');
}

    function close_withdraw_form(){

        $(".withdraw-notice-box").hide();
        jQ('#screen').removeAttr('style');

    }

function close_withdraw_notice_box(){

	$(".withdraw-notice-box").hide();
    jQ('#screen').removeAttr('style');
}
function close_error_withdraw_notice_box(){
	$(".error-withdraw-notice-box").hide();
    jQ('#screen').removeAttr('style');
}
    jQ(document).ready(function(){

	$(".withdraw-notice-box").hide();
	$(".empty-msg-box").hide();
	$('.error-withdraw-notice-box').hide();
    jQ('#add_fund').click(function(){
	var add_fund_amount = $("input#addFundsValue").val();
	if (add_fund_amount == "00.00" || isNaN(add_fund_amount) || add_fund_amount == 0) {
		$(".empty-msg-box").show();
        jQ('#screen').css({ opacity: 0.6, 'width':'100%','height':'100%'});
        jQ('body').css({'overflow':'overflow'});
	}
	else
	{
		$( "#add-fund-form" ).submit();
	}
});



$('#add_fund').click(function(){
	$.post("<?php echo Yii::app()->request->baseUrl.'/managefinancials/transaction/RequestPayment'; ?>", function( data ) {
		return true;
	});
});

$('#btnok').click(function(){
	$('#withdraw-fund-form').submit();
});
	$('#withdraw_fund').click(function(){
		var withdrawAmt = $('#withdrawFundsValue').val();
		var accountBalance = $('#accountBalanceValue').val();
		//alert(accountBalance);
		if (withdrawAmt == "00.00" || withdrawAmt == 0 || isNaN(withdrawAmt)) {
			$(".empty-msg-box").show();
            jQ('#screen').css({ opacity: 0.6, 'width':'100%','height':'100%'});
            jQ('body').css({'overflow':'overflow'});

		}
		else if(accountBalance < parseFloat(withdrawAmt))
		{
				$('.error-withdraw-notice-box').show();
            jQ('#screen').css({ opacity: 0.6, 'width':'100%','height':'100%'});
            jQ('body').css({'overflow':'overflow'});
		}
		else
		{
			var dataString = 'withdrawAmount=' + withdrawAmt;
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl.'/managefinancials/transaction/RequestWithdraw'; ?>",
				data: dataString,
				cache: false,
				success: function(data) {
						if(data == 1)
						{	
							
							$(".withdraw-notice-box").show();
                            jQ('#screen').css({ opacity: 0.6, 'width':'100%','height':'100%'});
                            jQ('body').css({'overflow':'overflow'});
						}
						else
						{
							return false;
						}
					}
				});
		}
	});
});


</script>







