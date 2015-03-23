<?php

/**
 * This is the model class for table "{{activity_date}}".
 *
 * The followings are the available columns in table '{{activity_date}}':
 * @property string $id
 * @property integer $user_id
 * @property integer $total_minutes
 * @property integer $total_requests
 * @property string $date
 */
class ActivityDate extends CActiveRecord
{
	public $weekday,$week, $this_month, $avg_per_month;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ActivityDate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{activity_date}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, date', 'required'),
			array('user_id, total_minutes, total_requests', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, total_minutes, total_requests, date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'total_minutes' => 'Total Minutes',
			'total_requests' => 'Total Requests',
			'date' => 'Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('total_minutes',$this->total_minutes);
		$criteria->compare('total_requests',$this->total_requests);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getTimeThisMonth($user_id){
		$criteria = new CDbCriteria;
		$criteria->select = "SUM(t.total_minutes) as this_month";
		$criteria->condition = "t.user_id='".(int)$user_id."' AND YEAR(t.date)=YEAR(CURRENT_TIMESTAMP) AND MONTH(t.date)=MONTH(CURRENT_TIMESTAMP)";
		$total = self::model()->find($criteria)->this_month;
		return number_format($total/60,1);
	}

	public function getAvgPerMonth($user_id){
		$sql = "SELECT SUM(`this_month`)/COUNT(*) as `avg_per_month` FROM (SELECT t.date,SUM(t.total_minutes) as `this_month` FROM `drg_activity_date` `t` WHERE t.user_id='".(int)$user_id."' GROUP BY YEAR(`t`.`date`), MONTH(`t`.`date`)) b";
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		return number_format($result['avg_per_month']/60,1);
	}
}