<?php
class PageModule extends CWebModule
{
	public $defaultController='Page';
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'application.components.*',
			'page.models.*',
			'page.components.*',
		));

		$this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'page/default/error'),
            'user' => array(
                'class' => 'CWebUser',             
                'loginUrl' => Yii::app()->createUrl('page/default/login'),
            )
        ));

        $this->layoutPath = Yii::getPathOfAlias('webroot.themes.business.views.layouts');
        $this->layout = 'column2';
	}
}
