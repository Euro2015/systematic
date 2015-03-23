<?php

/**
 * This is the model class for table "{{user_financial_transaction}}".
 *
 * The followings are the available columns in table '{{user_financial_transaction}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $type
 * @property string $description
 * @property string $transactionId
 * @property string $paid_out
 * @property string $paid_in
 */
class UserFinancialTransaction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_financial_transaction}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, date, type, description, transactionId, paid_out, paid_in', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('transactionId', 'length', 'max'=>25),
			array('paid_out, paid_in', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, date, type, description, transactionId, paid_out, paid_in', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'type' => 'cr-credit,db-debit',
			'description' => 'Description',
			'transactionId' => 'Transaction',
			'paid_out' => 'Paid Out',
			'paid_in' => 'Paid In',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('transactionId',$this->transactionId,true);
		$criteria->compare('paid_out',$this->paid_out,true);
		$criteria->compare('paid_in',$this->paid_in,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserFinancialTransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function lastTransactionCode()
    {
        $lastTransaction = UserFinancialTransaction::model()->findAll("user_id=:userid", array(":userid" => Yii::app()->user->id));

        return ($lastTransaction)?$lastTransaction[0]['trans_currency_code']:'';
    }
}
