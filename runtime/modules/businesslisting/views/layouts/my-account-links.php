<ul>
<?php 
$currentCuntroller = strtolower(Yii::app()->controller->id);  
$currentMehod = strtolower(Yii::app()->controller->action->id);  
?> 

    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="myaccount"){ 
            echo CHtml::link('My account', array('/user/myaccount/update'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('My account', array('/user/myaccount/update'));
        }
        ?>
    </li>
    
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="mymessages"){ 
            echo CHtml::link('My messages', array('/user/myaccount/update'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('My messages', array('/user/myaccount/update'));
        }
        ?>
    </li>
    <li>    
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="Offersamples"){ 
            echo CHtml::link('Offer samples', array('/myaccount/update'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Offer samples', array('/myaccount/update'));
        }
        ?>        
    </li>
   <?php 
   if(Yii::app()->user->_user_Type=='user'):   
   ?>
    <li>
        <?php 
        if($currentMehod=="create" && $currentCuntroller=="listing"){ 
            echo CHtml::link('Create a listing', array('/listing/create'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Create a listing', array('/listing/create'));
        }
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
    
    <?php else : ?>
      <li>
        <?php 
        if($currentMehod=="create" && $currentCuntroller=="businesslisting"){ 
            echo CHtml::link('Create business listing', array('/businesslisting/create'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Create business listing', array('/businesslisting/create'));
        }
        ?>  
    </li>
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
            echo CHtml::link('Support', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Support', array('/listing'));
        }
        ?>        
    </li>
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="managefinancials"){ 
            echo CHtml::link('Manage financials', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Manage financials', array('/listing'));
        }
        ?>        
    </li> 
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="investorarea"){ 
            echo CHtml::link('Investor area', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Investor area', array('/listing'));
        }
        ?>        
    </li>  
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="prizedraw"){ 
            echo CHtml::link('Prize draw', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Prize draw', array('/listing'));
        }
        ?>        
    </li>  
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="contact"){ 
            echo CHtml::link('Contact us', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Contact us', array('/listing'));
        }
        ?>        
    </li>  
    <li>
        <?php 
        if($currentMehod=="update" && $currentCuntroller=="termsservice"){ 
            echo CHtml::link('Terms of service', array('/listing'),array('class'=>'my-active-link','htmlOptions'=>'cursor:default;'));  
        }else {
            echo CHtml::link('Terms of service', array('/listing'));
        }
        ?>        
    </li> 
</ul>