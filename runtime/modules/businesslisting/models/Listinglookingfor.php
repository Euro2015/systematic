<?php

/**
 * This is the model class for table "{{listing_lookingfor}}".
 *
 * The followings are the available columns in table '{{listing_lookingfor}}':
 * @property integer $lookingfor_id
 * @property string $lookingfor_name
 * @property string $lookingfor_title
 * @property integer $sort_order
 */
class Listinglookingfor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Listinglookingfor the static model class
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
		return '{{listing_lookingfor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lookingfor_name, lookingfor_title, sort_order', 'required'),
			array('sort_order', 'numerical', 'integerOnly'=>true),
			array('lookingfor_name, lookingfor_title', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lookingfor_id, lookingfor_name, lookingfor_title, sort_order', 'safe', 'on'=>'search'),
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
			'lookingfor_id' => 'Lookingfor',
			'lookingfor_name' => 'Lookingfor Name',
			'lookingfor_title' => 'Lookingfor Title',
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

		$criteria->compare('lookingfor_id',$this->lookingfor_id);
		$criteria->compare('lookingfor_name',$this->lookingfor_name,true);
		$criteria->compare('lookingfor_title',$this->lookingfor_title,true);
		$criteria->compare('sort_order',$this->sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getAll()
	{
		return self::model()->findAll();
	}
    
    public function getRowTitle($id){
		$row = self::model()->findByPk($id);
		return $row->lookingfor_name;
	}
}