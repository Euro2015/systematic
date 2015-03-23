<?php

/**
 * This is the model class for table "{{adminuser}}".
 *
 * The followings are the available columns in table '{{adminuser}}':
 * @property integer $admin_id
 * @property string $admin_name
 * @property string $admin_email
 * @property string $admin_password
 * @property string $create_date
 */
class Adminuser extends CActiveRecord
{
   /**
   	 * Returns the static model of the specified AR class.
   	 * @param string $className active record class name.
   	 * @return User the static model class
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
   		return '{{adminuser}}';
   	}

   	/**
   	 * @return array validation rules for model attributes.
   	 */
   	public function rules()
   	{
   		// NOTE: you should only define rules for those attributes that
   		// will receive user inputs.
   		return array(
   			array('username', 'length', 'max'=>45),
   			array('password, email', 'length', 'max'=>255),
   			// The following rule is used by search().
   			// Please remove those attributes that should not be searched.
   			array('user_id, username, password, email', 'safe', 'on'=>'search'),
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
   			'user_id' => 'User',
   			'username' => 'Username',
   			'password' => 'Password',
   			'email' => 'Email',
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

   		$criteria->compare('user_id',$this->user_id);
   		$criteria->compare('username',$this->username,true);
   		$criteria->compare('password',$this->password,true);
   		$criteria->compare('email',$this->email,true);

   		return new CActiveDataProvider($this, array(
   			'criteria'=>$criteria,
   		));
   	}
}