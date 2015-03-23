<?php

 
class Member extends CActiveRecord
{
	public $from_date,$to_date,$pos;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Member the static model class
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
			// array('drg_name,drg_surname, drg_email, drg_username, drg_addr1, drg_town, drg_county,drg_country, drg_zip, drg_country, drg_phone, drg_gender, drg_dob, drg_question, drg_answer', 'required'),
			// array('co_sector,co_name,co_title,drg_currency','required','on'=>'business'),
			array('drg_currency,drg_country', 'numerical', 'integerOnly'=>true),
			array('drg_uid, drg_town, drg_pstatus, drg_ip, co_slogon, co_title, co_fax, co_website, co_name, drg_verifycode', 'length', 'max'=>100),
			array('drg_name, drg_surname, drg_email, drg_username, drg_pass, drg_zip, drg_dob, drg_rdate, drg_user_type', 'length', 'max'=>50),
			array('drg_image, drg_addr1, drg_addr2, drg_addr3, drg_question', 'length', 'max'=>500),
			array('drg_county, drg_answer', 'length', 'max'=>200),
			array('drg_email','email'),
			array('drg_email','unique', 'className' => 'Member'),
			array('drg_phone', 'length', 'max'=>30),
			array('drg_gender', 'length', 'max'=>10),
			array('drg_status', 'length', 'max'=>2),
			array('drg_active_link', 'length', 'max'=>255),
            array('drg_notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('drg_id, drg_uid, drg_name, drg_surname, drg_email, drg_username, drg_pass, drg_image, drg_addr1, drg_addr2, drg_addr3, drg_town, drg_county, drg_zip, drg_country, drg_phone, drg_gender, drg_dob, drg_question, drg_answer, drg_pstatus, drg_notes, drg_rdate, drg_ltime, drg_ip, drg_status, drg_currency, co_slogon, co_title, co_fax, co_website, co_name, drg_user_type, drg_verifycode, drg_active_link', 'safe', 'on'=>'search'),
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
			'drg_uid' => 'Uid',
			'drg_name' => 'Name',
			'drg_surname' => 'Surname',
			'drg_email' => 'Email',
			'drg_username' => 'Username',
			'drg_pass' => 'Password',
			'drg_image' => 'Image',
			'drg_addr1' => 'Address 1',
			'drg_addr2' => 'Address 2',
			'drg_addr3' => 'Address 3',
			'drg_town' => 'Town',
			'drg_county' => 'County',
			'drg_zip' => 'Zip Code',
			'drg_country' => 'Country',
			'drg_phone' => 'Phone',
			'drg_gender' => 'Gender',
			'drg_dob' => 'Date Of Birth',
			'drg_question' => 'Security Question',
			'drg_answer' => 'Security Answer',
			'drg_pstatus' => 'Profession',
			'drg_notes' => 'Notes',
			'drg_rdate' => 'Rdate',
			'drg_ltime' => 'Ltime',
			'drg_ip' => 'Ip',
			'drg_status' => 'Status',
			'drg_currency' => 'Currency',
			'co_slogon' => 'Co Slogon',
			'co_title' => 'Title',
			'co_fax' => 'Fax',
			'co_website' => 'Website',
			'co_name' => 'Co Name',
			'drg_user_type' => 'Profession',
			'drg_verifycode' => 'Verifycode',
			'drg_active_link' => 'Active Link',
		);
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
                // Search by country, so it should get the country_id of the selected country                
                $sql = "SELECT country_id";
                $sql .= " FROM {{country}} ";
                $sql .= " WHERE country LIKE '%{$this->drg_country}%'";

                $countryResult = Yii::app()->db->createCommand($sql)->queryAll();
                $countryToSearch = array();

                if( $countryResult ){
                    // Put the country found in temporary array
                    foreach ($countryResult as $country) {
                        array_push($countryToSearch, $country['country_id']);
                    }
                
                }else{
                    // Default value is zero, no result for the selected contry
                    array_push($countryToSearch, 0);
                }
                
                // Get date as mysql format before search
                $rDate = CommonClass::getMySqlDate($this->drg_rdate);                
            
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
		$criteria->compare('drg_country',$countryToSearch,true);
		$criteria->compare('drg_phone',$this->drg_phone,true);
		$criteria->compare('drg_gender',$this->drg_gender,true);
		$criteria->compare('drg_dob',$this->drg_dob,true);
		$criteria->compare('drg_question',$this->drg_question,true);
		$criteria->compare('drg_answer',$this->drg_answer,true);
		$criteria->compare('drg_pstatus',$this->drg_pstatus,true);
		$criteria->compare('drg_notes',$this->drg_notes,true);
		$criteria->compare('drg_rdate',$rDate,true);
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

		if(!empty($this->from_date) && empty($this->to_date))
                {
                    $criteria->condition = "drg_rdate >= '$this->from_date'";  // date is database date column field
                    
                }elseif(!empty($this->to_date) && empty($this->from_date))
                {
                    $criteria->condition = "drg_rdate <= '$this->to_date'";
                    
                }elseif(!empty($this->to_date) && !empty($this->from_date))
                {
                    $criteria->condition = "drg_rdate  >= '$this->from_date' and drg_rdate <= '$this->to_date'";
                }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=> Yii::app()->user->getState('pageSize'),
                        ),
		));
	}

	public function search2()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('drg_username',$this->drg_username,true);		
		$criteria->compare('drg_status',$this->drg_status,true);		
		$criteria->compare('drg_user_type',$this->drg_user_type,true);
		$criteria->compare('drg_rdate',$this->drg_rdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static  function prev_member($member_id)
	{
	    $criteria = new CDbCriteria;
	    $criteria->select = array('drg_id');
	    $criteria->addCondition('drg_id <'.$member_id);
	    $criteria->order = 'drg_id DESC';
	    $criteria->limit = 1;
	    $member = Member::model()->find($criteria);
	    if($member)
	        return $member;
	    else
	        return false;    
	}

	public static function next_member($member_id)
	{
	    $criteria = new CDbCriteria;
	    $criteria->select = array('drg_id');
	    $criteria->addCondition('drg_id >'.$member_id);
	    $criteria->order = 'drg_id ASC';
	    $criteria->limit = 1;
	    $member = Member::model()->find($criteria);
	    if($member)
	        return $member;
	    else
	        return false;    
	}

	public static function getRowPosition($id)
	{
		//SELECT COUNT(drg_id) AS pos FROM drg_user WHERE drg_id <= 298 
		$criteria= new CDbCriteria();
		$criteria=array(
		            'select'=>'count(drg_id) as pos',
		            'condition'=>'drg_id <= '.$id,
		);
		return self::model()->count($criteria);
	}        
        

                
}