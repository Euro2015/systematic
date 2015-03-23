<?php

/**
 * This is the model class for table "{{departments}}".
 *
 * The followings are the available columns in table '{{departments}}':
 * @property integer $slider_id
 * @property string $slider_name
 */
class Department extends CActiveRecord
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
		return '{{departments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dept_name, dept_email', 'required'),
			array('dept_name', 'length', 'max'=>1024),
			array('dept_email', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dept_id, dept_name, dept_email', 'safe', 'on'=>'search'),
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
			'dept_id' => 'id',
			'dept_name' => 'Department name',
			'dept_email' => 'Department email',
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

		$criteria->compare('dept_id',$this->dept_id);
		
		$criteria->compare('dept_name',$this->dept_name,true);		

		$criteria->compare('dept_email',$this->dept_email,true);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}