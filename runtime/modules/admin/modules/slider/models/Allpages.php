<?php

/**
 * This is the model class for table "{{site_actions}}".
 *
 * The followings are the available columns in table '{{site_actions}}':
 * @property integer $id
 * @property string $pname
 * @property string $pslug
 */

class Allpages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userlistingimages the static model class
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
		return '{{site_actions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pslug, pname', 'required'),
			array('id','numerical', 'integerOnly'=>true),
			array('pslug', 'length', 'max'=>1024),
			array('pname', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pname, pslug', 'safe', 'on'=>'search'),
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
			'id' => 'Page Id',
			'pname' => 'Page Name',
			'pslug' => 'Page slug',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('pname',$this->pname,true);
		$criteria->compare('pslug',$this->pslug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}