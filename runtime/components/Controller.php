<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $pageTitle, $metaKeys,$metaDesc;

	public function setPageTitle($value)
	{
		$this->pageTitle=$value;
	}

	protected function beforeAction($action)
	{
		$this->writeStats($action);
		return parent::beforeAction($action);
	}

  	public function getStats ($event) {
		// echo $this->id;die;
		// Here you put all needed code to start stats collection
    }
    public function writeStats ($event) {
    	// if(isset($this->module)): echo $this->module->getName(); endif;die;
    	// Here you put all needed code to save collected stats
        if(!Yii::app()->user->isGuest && (!isset($this->module) || (isset($this->module) && $this->module->getName()!='admin'))){
        	$db_update = 0;
			$is_request = 0;
			$log = new ActivityLog;
			$log->user_id = Yii::app()->user->id;

			//if(!Yii::app()->controller->id && !Yii::app()->controller->action->id || (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'error'))
				//exit(0);

			if(Yii::app()->controller->id == 'ajax' && Yii::app()->controller->action->id == 'active'){
				$log->log_id = 11;
				$log->description = 'User is Active!';
			}
			else if(Yii::app()->controller->id == 'ajax' && Yii::app()->controller->action->id == 'idle'){
				$db_update = 1;
				$log->log_id = 12;
				$log->description = 'User is Idle!';
			}
			else if(Yii::app()->controller->action->id == 'logout'){
				$db_update = 1;
				$log->log_id = 14;
				$log->description = 'User logged out!';
			}
			else{
				$db_update = 1;
				$is_request = 1;
				$log->log_id = 13;
				$log->description = 'Link visited: '.self::getUrl();
			}
			$log->datetime = date('Y-m-d H:i:s');
			list($log->counted_minutes,$log->idle_minutes) = self::getActivityTime($log);
			if($log->save()){
				if($db_update == 1){
					if($log->counted_minutes > 0 || $is_request == 1){
						$date_log = ActivityDate::model()->findByAttributes(array('user_id'=>$log->user_id,'date'=>date('Y-m-d', strtotime($log->datetime))));
						if($date_log === null){
							$date_log = new ActivityDate;
							$date_log->user_id = $log->user_id;
							$date_log->date = date('Y-m-d', strtotime($log->datetime));
						}
						$date_log->total_minutes = $date_log->total_minutes + $log->counted_minutes;
						if($is_request == 1)
							$date_log->total_requests = $date_log->total_requests + 1;
						$date_log->save();
					}
				}
			}
			// else{
			// 	// print_r($log->getErrors());die;
			// }
		}
    }

    public function getUrl(){
		return Yii::app()->request->requestUri;
    }

    public function getActivityTime($log){
    	$mouse_timeout = 3;
		$click_timeout = 5;
	
    	$criteria = new CDbCriteria;
    	$criteria->condition = "t.user_id = '$log->user_id'";
    	$criteria->order = 't.id DESC';
    	$criteria->limit = 1;
    	$last_activity = ActivityLog::model()->find($criteria);
    	if($last_activity){
    		$counted_minutes = 0;
    		if(!in_array($last_activity->log_id, array(12,14))){
	    		$minutes = round((strtotime($log->datetime) - strtotime($last_activity->datetime)) /60);
	    		if($log->log_id == 13){
	    			$counted_minutes = $minutes>$click_timeout?$click_timeout:$minutes;
	    			$idle_minutes = 0;
	    		}
	    		else if($log->log_id == 12){
		    		if($last_activity->idle_minutes > 0){
		    			$counted_minutes = $minutes+$last_activity->idle_minutes>$click_timeout?$click_timeout-$last_activity->idle_minutes:$minutes;
		    			$idle_minutes = $minutes+$last_activity->idle_minutes>$click_timeout?$click_timeout:$minutes+$last_activity->idle_minutes;
		    		}
		    		else{
		    			$counted_minutes = $idle_minutes = $minutes>$click_timeout?$click_timeout:$minutes;
		    		}
		    	}
		    	else{
		    		$counted_minutes = $minutes>$click_timeout?$click_timeout:$minutes;
		    		$idle_minutes = $last_activity->idle_minutes;
		    	}
    		} 
    		else{
    			$idle_minutes = $last_activity->idle_minutes;
    		}
    		return array($counted_minutes, $idle_minutes);
    	}
    	else
    		return array(0,0);
    }

}