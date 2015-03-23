<?php

/**
 * This is the model class for table "{{slider_listing}}".
 *
 * The followings are the available columns in table '{{slider_listing}}':
 * @property integer $slider_id
 * @property string $slider_name
 */
class Createsliderlisting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userlisting the static model class
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
		return '{{slider_listing}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slider_title', 'required'),
			array('slider_title', 'length', 'max'=>250),
			array('page_id', 'length', 'max'=>250),
			array('page_name', 'length', 'max'=>250),
			array('page_slug', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('slider_id, slider_title, page_id, page_name, page_slug', 'safe', 'on'=>'search'),
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
			'slider_id' => 'id',
			'slider_name' => 'Slider name',
			'page_id' => 'Page id',
			'page_name' => 'Page Name',
			'page_slug' => 'Page file name',
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

		$criteria= new CDbCriteria;

		$criteria->compare('slider_id',$this->slider_id);
		$criteria->compare('slider_name',$this->slider_name,true);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}