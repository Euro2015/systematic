<?php

/**
 * This is the model class for table "{{useraddress}}".
 *
 * The followings are the available columns in table '{{useraddress}}':
 * @property integer $drg_uaid
 * @property string $drg_uid
 * @property string $drg_addr1
 * @property string $drg_addr2
 * @property string $drg_addr3
 * @property string $drg_town
 * @property string $drg_county
 * @property string $drg_zip
 * @property string $drg_country
 * @property string $drg_phone
 * @property string $drg_createdate
 * @property string $drg_ipaddress
 */
class Useraddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Useraddress the static model class
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
		return '{{useraddress}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('drg_uid, drg_town, drg_country, drg_ipaddress', 'length', 'max'=>100),
			array('drg_addr1, drg_addr2, drg_addr3', 'length', 'max'=>500),
			array('drg_county', 'length', 'max'=>200),
			array('drg_zip', 'length', 'max'=>50),
			array('drg_phone', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('drg_uaid, drg_uid, drg_addr1, drg_addr2, drg_addr3, drg_town, drg_county, drg_zip, drg_country, drg_phone, drg_createdate, drg_ipaddress', 'safe', 'on'=>'search'),
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
			'drg_uaid' => 'Drg Uaid',
			'drg_uid' => 'Drg Uid',
			'drg_addr1' => 'Drg Addr1',
			'drg_addr2' => 'Drg Addr2',
			'drg_addr3' => 'Drg Addr3',
			'drg_town' => 'Drg Town',
			'drg_county' => 'Drg County',
			'drg_zip' => 'Drg Zip',
			'drg_country' => 'Drg Country',
			'drg_phone' => 'Drg Phone',
			'drg_createdate' => 'Drg Createdate',
			'drg_ipaddress' => 'Drg Ipaddress',
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

		$criteria->compare('drg_uaid',$this->drg_uaid);
		$criteria->compare('drg_uid',$this->drg_uid,true);
		$criteria->compare('drg_addr1',$this->drg_addr1,true);
		$criteria->compare('drg_addr2',$this->drg_addr2,true);
		$criteria->compare('drg_addr3',$this->drg_addr3,true);
		$criteria->compare('drg_town',$this->drg_town,true);
		$criteria->compare('drg_county',$this->drg_county,true);
		$criteria->compare('drg_zip',$this->drg_zip,true);
		$criteria->compare('drg_country',$this->drg_country,true);
		$criteria->compare('drg_phone',$this->drg_phone,true);
		$criteria->compare('drg_createdate',$this->drg_createdate,true);
		$criteria->compare('drg_ipaddress',$this->drg_ipaddress,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}