<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $drg_id
 * @property string $drg_uid
 * @property string $drg_name
 * @property string $drg_surname
 * @property string $drg_email
 * @property string $drg_username
 * @property string $drg_pass
 * @property string $drg_image
 * @property string $drg_addr1
 * @property string $drg_addr2
 * @property string $drg_addr3
 * @property string $drg_town
 * @property string $drg_county
 * @property string $drg_zip
 * @property string $drg_country
 * @property string $drg_phone
 * @property string $drg_gender
 * @property string $drg_dob
 * @property string $drg_question
 * @property string $drg_answer
 * @property string $drg_pstatus
 * @property string $drg_notes
 * @property string $drg_rdate
 * @property string $drg_ltime
 * @property string $drg_ip
 * @property string $drg_status
 * @property integer $drg_currency
 * @property string $co_slogon
 * @property string $co_title
 * @property string $co_fax
 * @property string $co_website
 * @property string $co_name
 * @property string $drg_user_type
 * @property string $drg_verifycode
 * @property string $drg_active_link
 */
class Business extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Business the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('co_sector,drg_name, drg_surname, drg_email, drg_username, drg_pass,  drg_addr1,drg_town, drg_county, drg_zip, drg_country, drg_phone, drg_dob, co_title, co_name', 'required'),
			array('drg_currency', 'numerical', 'integerOnly'=>true),
			array('drg_uid, drg_town, drg_country, drg_pstatus, drg_ip, co_slogon, co_title, co_fax, co_website, co_name, drg_verifycode', 'length', 'max'=>100),
			array('drg_name, drg_surname, drg_email, drg_username, drg_pass, drg_zip, drg_dob, drg_rdate, drg_user_type', 'length', 'max'=>50),
			array('drg_image, drg_addr1, drg_addr2, drg_addr3, drg_question', 'length', 'max'=>500),
			array('drg_county, drg_answer', 'length', 'max'=>200),
			array('drg_phone', 'length', 'max'=>30),
			array('drg_gender', 'length', 'max'=>10),
			array('drg_status', 'length', 'max'=>2),
			array('drg_active_link', 'length', 'max'=>255),
			array('drg_email, drg_username', 'unique'),
			array('drg_username', 'match', 'pattern'=>'/^[A-Za-z0-9_]+$/u', 'message'=>'Username can contain only alphanumeric characters.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('drg_id, drg_uid, drg_name, drg_surname, drg_email, drg_username, drg_pass, drg_image, drg_addr1, drg_addr2, drg_addr3, drg_town, drg_county, drg_zip, drg_country, drg_phone, drg_gender, drg_dob, drg_question, drg_answer, drg_pstatus, drg_notes, drg_rdate, drg_ltime, drg_ip, drg_status, drg_currency, co_slogon, co_title, co_fax, co_website, co_name, co_sector,drg_user_type, drg_verifycode, drg_active_link', 'safe', 'on'=>'search'),
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
			'drg_id' => 'ID',
			'drg_uid' => 'User Code',
			'drg_name' => 'First Name',
			'drg_surname' => 'Last Name',
			'drg_email' => 'Email',
			'drg_username' => 'Username',
			'drg_pass' => 'Password',
			'drg_image' => 'Image',
			'drg_addr1' => 'Address line 1',
			'drg_addr2' => 'Address line 2',
			'drg_addr3' => 'Address line 3',
			'drg_town' => 'Town',
			'drg_county' => 'County',
			'drg_zip' => 'Zip Code',
			'drg_country' => 'Country',
			'drg_phone' => 'Tel No.',
			'drg_gender' => 'Gender',
			'drg_dob' => 'Date of birth',
			'drg_question' => 'Question',
			'drg_answer' => 'Answer',
			'drg_pstatus' => 'Pstatus',
			'drg_notes' => 'Notes',
			'drg_rdate' => 'Registered date',
			'drg_ltime' => 'Ltime',
			'drg_ip' => 'Ip',
			'drg_status' => 'Status',
			'drg_currency' => 'Currency',
			'co_slogon' => 'Business slogon',
			'co_title' => 'Title',
			'co_fax' => 'Fax No.',
			'co_website' => 'Website',
			'co_name' => 'Business Name',
            'co_sector'=>'Business Sector',
			'drg_user_type' => 'User Type',
            'drg_verifycode'=>'Captcha',
            'drg_active_link'=>'Active Link'
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

		$criteria->compare('drg_id',$this->drg_id);
		$criteria->compare('drg_uid',$this->drg_uid,true);
		$criteria->compare('drg_name',$this->drg_name,true);
		$criteria->compare('drg_surname',$this->drg_surname,true);
		$criteria->compare('drg_email',$this->drg_email,true);
		$criteria->compare('drg_username',$this->drg_username,true);
		$criteria->compare('drg_pass',$this->drg_pass,true);
		$criteria->compare('drg_image',$this->drg_image,true);
		$criteria->compare('drg_addr1',$this->drg_addr1,true);
		$criteria->compare('drg_addr2',$this->drg_addr2,true);
		$criteria->compare('drg_addr3',$this->drg_addr3,true);
		$criteria->compare('drg_town',$this->drg_town,true);
		$criteria->compare('drg_county',$this->drg_county,true);
		$criteria->compare('drg_zip',$this->drg_zip,true);
		$criteria->compare('drg_country',$this->drg_country,true);
		$criteria->compare('drg_phone',$this->drg_phone,true);
		$criteria->compare('drg_gender',$this->drg_gender,true);
		$criteria->compare('drg_dob',$this->drg_dob,true);
		$criteria->compare('drg_question',$this->drg_question,true);
		$criteria->compare('drg_answer',$this->drg_answer,true);
		$criteria->compare('drg_pstatus',$this->drg_pstatus,true);
		$criteria->compare('drg_notes',$this->drg_notes,true);
		$criteria->compare('drg_rdate',$this->drg_rdate,true);
		$criteria->compare('drg_ltime',$this->drg_ltime,true);
		$criteria->compare('drg_ip',$this->drg_ip,true);
		$criteria->compare('drg_status',$this->drg_status,true);
		$criteria->compare('drg_currency',$this->drg_currency);
		$criteria->compare('co_slogon',$this->co_slogon,true);
		$criteria->compare('co_title',$this->co_title,true);
		$criteria->compare('co_fax',$this->co_fax,true);
		$criteria->compare('co_website',$this->co_website,true);
		$criteria->compare('co_name',$this->co_name,true);
		$criteria->compare('drg_user_type',$this->drg_user_type,true);
		$criteria->compare('drg_verifycode',$this->drg_verifycode,true);
		$criteria->compare('drg_active_link',$this->drg_active_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}