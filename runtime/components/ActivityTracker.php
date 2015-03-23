<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ActivityTracker extends CController
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
	
	protected function beforeAction($action)
	  {
	    var_dump($action->id, $this->id, $this->module->id); die;
	    
	    return parent::beforeAction($action);
	  }


	public function getStats ($event) {
		// echo '<pre>';print_r(Yii::app()->getController());die;
		// Here you put all needed code to start stats collection
    }
    public function writeStats ($event) {
    	// Here you put all needed code to save collected stats
        if(!Yii::app()->user->isGuest){
        	$db_update = 0;
			$is_request = 0;
			$log = new ActivityLog;
			$log->user_id = Yii::app()->user->id;

			if(!Yii::app()->controller->id && !Yii::app()->controller->action->id)
				{echo self::id.' error';die;}

			if(Yii::app()->controller->id == 'ajax' && Yii::app()->controller->action->id == 'active'){
				$log->log_id = 11;
				$log->description = 'User is Active!';
			}
			else if(Yii::app()->controller->id == 'ajax' && Yii::app()->controller->action->id == 'idle'){
				$db_update = 1;
				$log->log_id = 12;
				$log->description = 'User is Idle!';
			}
			else{
				$db_update = 1;
				$is_request = 1;
				$log->log_id = 13;
				$log->description = 'Link visited: '.self::getUrl();
			}
			$log->datetime = date('Y-m-d H:i:s');
			if($log->save()){
				if($db_update == 1){
					$minutes = self::getActivityTime($log);
					if($minutes > 0 || $is_request == 1){
						$date_log = ActivityDate::model()->findByAttributes(array('user_id'=>$log->user_id,'date'=>date('Y-m-d', strtotime($log->datetime))));
						if($date_log === null){
							$date_log = new ActivityDate;
							$date_log->user_id = $log->user_id;
							$date_log->date = date('Y-m-d', strtotime($log->datetime));
						}
						$date_log->total_minutes = $date_log->total_minutes + $minutes;
						if($is_request == 1)
							$date_log->total_requests = $date_log->total_requests + 1;
						$date_log->save();
					}
				}
			}
			else{
				print_r($log->getErrors());die;
			}
		}
    }

    public function getUrl(){
		return Yii::app()->request->requestUri;
    }

    public function getActivityTime($log){
    	$criteria = new CDbCriteria;
    	$criteria->condition = 't.log_id IN(11,13) AND t.id<'.$log->id;
    	$criteria->order = 't.id DESC';
    	$last_activity = ActivityLog::model()->find($criteria);
    	if($last_activity){
    		$minutes = round((strtotime($log->datetime) - strtotime($last_activity->datetime)) /60);
    		return $minutes;
    	}
    	else
    		return 0;
    }
}