<?php

class SliderModule extends CWebModule
{
   //public $defaultController = 'Slider';
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		
       
        $this->setImport(array(
			'slider.models.*',
			'slider.components.*',
		));
          
        	$this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'slider/default/error'),
                'user' => array(
                'class' => 'CWebUser',             
                'loginUrl' => Yii::app()->createUrl('slider/default/login'),
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
