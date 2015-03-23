<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>    
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/images/favicon.ico" />
    <title><?php echo $this->pageTitle ? CHtml::encode($this->pageTitle).' - Business Supermarket':'Business Supermarket Admin'; ?></title> 
    <?php 
    $themepath = Yii::app()->theme->baseUrl;        
    if(Yii::app()->user->isGuest){
        Yii::app()->clientScript->registerCssFile($themepath.'/css/style.css');
        Yii::app()->clientScript->registerCssFile($themepath.'/css/login.css');     
    }else {          
        $themepath = Yii::app()->theme->baseUrl;
        Yii::app()->clientScript->registerCoreScript('jquery'); 
        Yii::app()->clientScript->registerScriptFile($themepath.'/js/chart/jscharts.js');
        Yii::app()->clientScript->registerScriptFile($themepath.'/js/tinymce/tinymce.min.js');
        Yii::app()->clientScript->registerScriptFile($themepath.'/js/common.js');
        Yii::app()->clientScript->registerCssFile($themepath.'/css/sample.css');
        Yii::app()->clientScript->registerCssFile($themepath.'/css/admin.css');
        Yii::app()->clientScript->registerCssFile($themepath.'/css/button.css');
        Yii::app()->clientScript->registerCssFile($themepath.'/css/fonts/fonts.css'); 
        Yii::app()->clientScript->registerCssFile($themepath.'/css/jquery.dataTables_themeroller.css'); 
        /* Fancybox code */
        Yii::app()->clientScript->registerCssFile($themepath.'/css/fancybox/jquery.fancybox-1.3.4.css');
        Yii::app()->clientScript->registerScriptFile($themepath.'/js/fancybox/jquery.easing-1.3.pack.js');
        Yii::app()->clientScript->registerScriptFile($themepath.'/js/fancybox/jquery.fancybox-1.3.4.pack.js');
        Yii::app()->clientScript->registerScriptFile($themepath.'/js/fancybox/jquery.mousewheel-3.0.4.pack.js');
        
    }  
    ?> 
</head> 
<body>
<div class="Container">
    <?php 
    if(!Yii::app()->user->isGuest){
        $this->renderPartial('application.modules.admin.views.layouts.top_menu');
    } 
    echo $content  ; 
    ?> 
</div>
</body>
</html>
