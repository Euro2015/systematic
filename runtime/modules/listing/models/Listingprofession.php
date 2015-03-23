<?php

/**
 * This is the model class for table "{{listing_profession}}".
 *
 * The followings are the available columns in table '{{listing_profession}}':
 * @property integer $list_profession_id
 * @property string $list_profession_name
 * @property string $list_profession_title
 * @property integer $sort_order
 */
class Listingprofession extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Listingprofession the static model class
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
		return '{{listing_profession}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('list_profession_name, list_profession_title, sort_order', 'required'),
			array('sort_order', 'numerical', 'integerOnly'=>true),
			array('list_profession_name', 'length', 'max'=>100),
			array('list_profession_title', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('list_profession_id, list_profession_name, list_profession_title, sort_order', 'safe', 'on'=>'search'),
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
			'list_profession_id' => 'List Profession',
			'list_profession_name' => 'List Profession Name',
			'list_profession_title' => 'List Profession Title',
			'sort_order' => 'Sort Order',
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

		$criteria->compare('list_profession_id',$this->list_profession_id);
		$criteria->compare('list_profession_name',$this->list_profession_name,true);
		$criteria->compare('list_profession_title',$this->list_profession_title,true);
		$criteria->compare('sort_order',$this->sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}