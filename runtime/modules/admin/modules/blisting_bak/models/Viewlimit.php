<?php

/**
 * This is the model class for table "{{view_limit}}".
 *
 * The followings are the available columns in table '{{view_limit}}':
 * @property integer $limit_view_id
 * @property string $limit_view
 * @property string $limit_view_code
 * @property integer $sort_order
 */
class Viewlimit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Viewlimit the static model class
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
		return '{{view_limit}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('limit_view, limit_view_code, sort_order', 'required'),
			array('sort_order', 'numerical', 'integerOnly'=>true),
			array('limit_view', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('limit_view_id, limit_view, limit_view_code, sort_order', 'safe', 'on'=>'search'),
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
			'limit_view_id' => 'Limit View',
			'limit_view' => 'Limit View',
			'limit_view_code' => 'Limit View Code',
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

		$criteria->compare('limit_view_id',$this->limit_view_id);
		$criteria->compare('limit_view',$this->limit_view,true);
		$criteria->compare('limit_view_code',$this->limit_view_code,true);
		$criteria->compare('sort_order',$this->sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}