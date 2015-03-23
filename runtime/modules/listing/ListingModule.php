<?php

class ListingModule extends CWebModule
{
    public $defaultController = 'Listing';
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components        
        
		$this->setImport(array(
			'listing.models.*',
			'listing.components.*',
		));

		// Import Forum models
                Yii::import('forum.models.*');
                Yii::import('forum.components.*');

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
