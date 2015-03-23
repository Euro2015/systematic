<?php

class BannerModule extends CWebModule
{
	public $defaultController = 'Banner';
    
    public function init()
	{
	    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/banner_ads.css');  
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/chosen.css');  
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/chosen.jquery.js');
           
		$this->setImport(array(
			'banner.models.*',
			'banner.components.*',
		));
        
        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/default/error'),
                'user' => array(
                'class' => 'CWebUser',             
                'loginUrl' => Yii::app()->createUrl('admin/default/login'),
            )
        ));
        
        $this->layoutPath = Yii::getPathOfAlias('application.modules.admin.views.layouts');
        
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
