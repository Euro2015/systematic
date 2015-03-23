<?php


class ForumModule extends CWebModule
{
    public $defaultController = 'Forum';
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components        
        
		$this->setImport(array(
			'forum.models.*',
                        'forum.components.*'
		));
                
                Yii::import('listing.models.*');
                
                //$path = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.forum.assets'));
                Yii::app()->clientScript->registerCssFile(Yii::getPathOfAlias('application.modules.forum.assets') . '/css/forum.css');
                Yii::app()->clientScript->registerScriptFile(Yii::getPathOfAlias('application.modules.forum.assets') . '/js/engine.js');
                Yii::app()->clientScript->registerScriptFile(Yii::getPathOfAlias('application.modules.forum.assets') . '/js/common.js');
                
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
