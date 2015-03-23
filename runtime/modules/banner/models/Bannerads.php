<?php

/**
 * This is the model class for table "{{banner_ads}}".
 *
 * The followings are the available columns in table '{{banner_ads}}':
 * @property string $banner_id
 * @property string $banner_path
 * @property integer $banner_duration
 * @property string $banner_cost
 * @property integer $banner_approve_status
 * @property string $drg_user_id
 * @property string $banner_subdate
 * @property integer $banner_clicks
 * @property string $banner_link
 * @property string $banner_adate
 */
class Bannerads extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bannerads the static model class
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
		return '{{banner_ads}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('banner_path, banner_duration, banner_cost, banner_approve_status, drg_user_id, banner_subdate, banner_clicks, banner_link, banner_adate', 'required'),
			array('banner_duration, banner_approve_status, banner_clicks', 'numerical', 'integerOnly'=>true),
			array('banner_path', 'length', 'max'=>100),
			array('banner_cost, drg_user_id', 'length', 'max'=>20),
			array('banner_link', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('banner_id,banner_list_id, banner_path, banner_duration, banner_cost, banner_approve_status, drg_user_id, banner_subdate, banner_clicks, banner_link, banner_adate', 'safe', 'on'=>'search'),
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
			'banner_id' => 'Banner',
			'banner_path' => 'Banner Path',
			'banner_duration' => 'Banner Duration',
			'banner_cost' => 'Banner Cost',
			'banner_approve_status' => 'Banner Approve Status',
			'drg_user_id' => 'Drg User',
			'banner_subdate' => 'Banner Subdate',
			'banner_clicks' => 'Banner Clicks',
			'banner_link' => 'Banner Link',
			'banner_adate' => 'Banner Adate',
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

		$criteria->compare('banner_id',$this->banner_id,true);
		$criteria->compare('banner_path',$this->banner_path,true);
		$criteria->compare('banner_duration',$this->banner_duration);
		$criteria->compare('banner_cost',$this->banner_cost,true);
		$criteria->compare('banner_approve_status',$this->banner_approve_status);
		$criteria->compare('drg_user_id',$this->drg_user_id,true);
		$criteria->compare('banner_subdate',$this->banner_subdate,true);
		$criteria->compare('banner_clicks',$this->banner_clicks);
		$criteria->compare('banner_link',$this->banner_link,true);
		$criteria->compare('banner_adate',$this->banner_adate,true);
        $criteria->compare('banner_list_id',$this->banner_list_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}