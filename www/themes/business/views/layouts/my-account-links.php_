<ul>
    <?php 
        $currentCuntroller = strtolower(Yii::app()->controller->id); 
         
        $currentMehod = strtolower(Yii::app()->controller->action->id);  
    ?> 

    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="myaccount"){ 
            echo CHtml::link('My account', array('/'.Yii::app()->user->_user_Type.'/myaccount/update'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('My account', array('/'.Yii::app()->user->_user_Type.'/myaccount/update'));
        }
        ?>
    </li>
    
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="mymessages"){ 
            echo CHtml::link('My messages', array('/'.Yii::app()->user->_user_Type.'/myaccount/update'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('My messages', array('/'.Yii::app()->user->_user_Type.'/myaccount/update'));
        }
        ?>
    </li>

   <?php 
   if(Yii::app()->user->_user_Type=='user'):   
   ?>
    <li>
        <?php 
        if($currentMehod=="create" && $currentCuntroller=="listing"){ 
$listid = $_REQUEST['listid'];
if($listid!="")
{
         echo CHtml::link('Create a listing', array('/listing/create'));  ?></li><li>
<?php
       echo CHtml::link('Manage listings', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;')); 
?>
</li>
<?php

}
else
{
  echo CHtml::link('Create a listing', array('/listing/create'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;')); 

        ?>  
    </li>  
    <li>
        <?php 
        if($currentMehod=="index" && $currentCuntroller=="listing"){ 

            echo CHtml::link('Manage listings', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Manage listings', array('/listing'));
        }

        ?>        
    </li>
<?php
}
        }else {
            echo CHtml::link('Create a listing', array('/listing/create'));
?>
</li>  
    <li>
        <?php 
        if($currentMehod=="index" && $currentCuntroller=="listing"){ 

            echo CHtml::link('Manage listings', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Manage listings', array('/listing'));
        }

        ?>        
    </li>
<?php
        }
  ?>  
    <?php else : ?>
    <?php 
     $blistCount = 0;
     $blistCount = Businesslisting::model()->count("drg_uid ='".Yii::app()->user->getState('uid')."'"); 
     if($blistCount<1){     
     ?>
     <li>
        <?php 
        if($currentMehod=="create" && $currentCuntroller=="businesslisting"){ 
            echo CHtml::link('Create business listing', array('/businesslisting/create'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Create business listing', array('/businesslisting/create'));
        }
        ?>  
    </li>
    <?php 
    }
    ?>
    <li>
        <?php 
        if($currentMehod=="index" && $currentCuntroller=="businesslisting"){ 
            echo CHtml::link('Manage business', array('/businesslisting'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Manage business', array('/businesslisting'));
        }
        ?>        
    </li>
    <?php endif; ?>
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="support"){ 
            echo CHtml::link('Support', array('/page/faq'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Support', array('/#'));
        }
        ?>        
    </li>
    <li>
        <?php
        if($currentMehod=="index" && $currentCuntroller=="transaction"){
            echo CHtml::link('Manage financials', array('/managefinancials/transaction/'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));
        }else {
            echo CHtml::link('Manage financials', array('/managefinancials/transaction/'));
        }
        ?>
    </li> 
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="investorarea"){ 
            echo CHtml::link('Investor area', array('/#'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Investor area', array('/#'));
        }
        ?>        
    </li>  
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="prizedraw"){ 
            echo CHtml::link('Prize draw', array('/#'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Prize draw', array('/#'));
        }
        ?>        
    </li>  
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="contact"){ 
            echo CHtml::link('Contact us', array('/#'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Contact us', array('/#'));
        }
        ?>        
    </li>  
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="termsservice"){ 
            echo CHtml::link('Terms of service', array('/#'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Terms of service', array('/#'));
        }
        ?>        
    </li> 
</ul>