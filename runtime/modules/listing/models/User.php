<?php
class User extends CActiveRecord
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
			array('drg_name', 'required','message'=>'Enter Your Name'),
            array('drg_surname', 'required','message'=>'Enter Your Surname'),
            array('drg_email', 'required','message'=>'Enter Valid Email Address'),
            array('drg_username', 'required','message'=>'Enter Your Username'),
            array('drg_pass', 'required','message'=>'Enter Your Password'), 
            //array("drg_verifycode","required","message"=>'Please Enter The Security Code'),
            array("drg_gender","required","message"=>''),
            array("co_title","required","message"=>''),
            array("drg_country","required","message"=>''),
            array("drg_dob","required","message"=>''),
                        
			array('drg_currency', 'numerical', 'integerOnly'=>true),
            array('drg_email','email'),
			array('drg_uid, drg_town, drg_country, drg_pstatus, drg_ip, co_slogon, co_title, co_fax, co_website, co_name', 'length', 'max'=>100),
			array('drg_name, drg_surname, drg_email, drg_username, drg_pass, drg_zip, drg_dob, drg_rdate, drg_user_type', 'length', 'max'=>50),
			array('drg_image, drg_addr1, drg_addr2, drg_addr3, drg_question,drg_active_link', 'length', 'max'=>500),
			array('drg_county, drg_answer', 'length', 'max'=>200),
			array('drg_phone', 'length', 'max'=>30),
			array('drg_gender', 'length', 'max'=>10),
			array('drg_status', 'length', 'max'=>2),            
            array('drg_email, drg_username', 'unique'),
            //array('drg_name,drg_active_link', 'safe'),
            //array('drg_pass', 'compare'),
            //array('drg_verifycode','captcha','allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'insert'), 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('drg_verifycode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'insert'),
			array('drg_id, drg_uid,drg_active_link, drg_name, drg_surname, drg_email, drg_username, drg_pass, drg_image, drg_addr1, drg_addr2, drg_addr3, drg_town, drg_county, drg_zip, drg_country, drg_phone, drg_gender, drg_dob, drg_question, drg_answer, drg_pstatus, drg_notes, drg_rdate, drg_ltime, drg_ip, drg_status, drg_currency, co_slogon, co_title, co_fax, co_website, co_name, drg_user_type', 'safe', 'on'=>'search'),
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
			'drg_id' => 'Drg',
			'drg_uid' => 'Drg Uid',
			'drg_name' => 'First Name',
			'drg_surname' => 'Last Name',
			'drg_email' => 'Email',
			'drg_username' => 'Username',
			'drg_pass' => 'Password',
			'drg_image' => 'Drg Image',
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
			'drg_question' => 'Drg Question',
			'drg_answer' => 'Drg Answer',
			'drg_pstatus' => 'Drg Pstatus',
			'drg_notes' => 'Drg Notes',
			'drg_rdate' => 'Drg Rdate',
			'drg_ltime' => 'Drg Ltime',
			'drg_ip' => 'Drg Ip',
			'drg_status' => 'Drg Status',
			'drg_currency' => 'Drg Currency',
			'co_slogon' => 'Slogon',
			'co_title' => 'Title',
			'co_fax' => 'Fax No.',
			'co_website' => 'Website',
			'co_name' => 'Name',
			'drg_user_type' => 'Drg User Type',
            'drg_verifycode'=>'Captcha',
            'drg_active_link'=>'drg_active_link'
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

	public function getUserFolder($userid)
	{
		$criteria = new CDbCriteria;
		$criteria->select='drg_id,drg_username,drg_uid';
		$model=User::model()->find($criteria);
		return $model ? $model->drg_username.'_'.$model->drg_id:false;
	}
}