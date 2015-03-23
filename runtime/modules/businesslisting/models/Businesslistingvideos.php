<?php

/**
 * This is the model class for table "{{blisting_videos}}".
 *
 * The followings are the available columns in table '{{blisting_videos}}':
 * @property integer $drg_video_id
 * @property string $drg_videodesc
 * @property string $drg_listing_video
 * @property integer $drg_blid
 */
class Businesslistingvideos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Businesslistingvideos the static model class
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
		return '{{blisting_videos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('drg_videodesc, drg_listing_video, drg_blid', 'required'),
			array('drg_blid', 'numerical', 'integerOnly'=>true),
			array('drg_videodesc', 'length', 'max'=>250),
			array('drg_listing_video', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('drg_video_id, drg_videodesc, drg_listing_video, drg_blid', 'safe', 'on'=>'search'),
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
			'drg_video_id' => 'Drg Video',
			'drg_videodesc' => 'Drg Videodesc',
			'drg_listing_video' => 'Drg Listing Video',
			'drg_blid' => 'Drg Blid',
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

		$criteria->compare('drg_video_id',$this->drg_video_id);
		$criteria->compare('drg_videodesc',$this->drg_videodesc,true);
		$criteria->compare('drg_listing_video',$this->drg_listing_video,true);
		$criteria->compare('drg_blid',$this->drg_blid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}