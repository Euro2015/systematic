<?php

/**
 * This is the model class for table "{{log_transaction}}".
 *
 * The followings are the available columns in table '{{log_transaction}}':
 * @property integer $transaction_id
 * @property integer $member_id
 * @property integer $log_id
 * @property string $transaction_description
 * @property string $transaction_date
 */
class Logtransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Logtransaction the static model class
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
		return '{{log_transaction}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, log_id, transaction_description, transaction_date', 'required'),
			array('member_id, log_id', 'numerical', 'integerOnly'=>true),
			array('transaction_description', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('transaction_id, member_id, log_id, transaction_description, transaction_date', 'safe', 'on'=>'search'),
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
			'transaction_id' => 'Transaction',
			'member_id' => 'Member',
			'log_id' => 'Log',
			'transaction_description' => 'Transaction Description',
			'transaction_date' => 'Transaction Date',
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

		$criteria->compare('transaction_id',$this->transaction_id);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('transaction_description',$this->transaction_description,true);
		$criteria->compare('transaction_date',$this->transaction_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}