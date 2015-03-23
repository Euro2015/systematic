<?php

/**
 * This is the model class for table "{{user_listing}}".
 *
 * The followings are the available columns in table '{{user_listing}}':
 * @property integer $drg_lid
 * @property string $drg_uid
 * @property string $drg_category
 * @property string $drg_profession
 * @property string $drg_viewlimit
 * @property string $drg_logo
 * @property string $drg_title
 * @property string $drg_desc
 * @property string $drg_explanation
 * @property string $drg_businessidea
 * @property string $drg_fprojections
 * @property string $drg_favailable
 * @property string $drg_famount
 * @property integer $drg_financial_data
 * @property string $drg_want
 * @property string $drg_keyword
 * @property string $drg_video1
 * @property string $drg_video2
 * @property string $drg_mktquestion
 * @property string $drg_mktqstatus
 * @property string $drg_reporttime
 * @property string $drg_date
 * @property string $drg_datetime
 * @property string $drg_status
 * @property string $drg_lstatus
 * @property string $drg_listtype
 * @property string $drg_company_name
 * @property string $drg_company_address1
 * @property string $drg_company_address2
 * @property string $drg_company_address3
 * @property string $drg_company_town
 * @property string $drg_company_county
 * @property string $drg_company_zip_code
 * @property string $drg_company_country
 * @property string $drg_company_tel_no
 * @property string $drg_company_fax_no
 * @property integer $drg_listingstatus
 * @property string $drg_approvedate
 * @property integer $reject_list
 */
class Listings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_listing}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('drg_category, drg_profession, drg_viewlimit, drg_logo, drg_title, drg_desc, drg_explanation, drg_businessidea, drg_fprojections,drg_famount, drg_financial_data, drg_want, drg_keyword, drg_video1, drg_video2, drg_mktquestion,drg_reporttime, drg_date,drg_company_name, drg_company_address1, drg_company_address2, drg_company_address3, drg_company_town,drg_company_zip_code, drg_company_country, drg_company_tel_no, drg_company_fax_no, drg_listingstatus, drg_approvedate, reject_list', 'required'),
			array('drg_financial_data, drg_listingstatus, reject_list', 'numerical', 'integerOnly'=>true),
			array('drg_uid, drg_title, drg_desc, drg_company_town, drg_company_country, drg_approvedate', 'length', 'max'=>100),
			array('drg_category, drg_profession, drg_viewlimit, drg_date, drg_datetime, drg_status, drg_company_name, drg_company_zip_code', 'length', 'max'=>50),
			array('drg_logo, drg_famount, drg_video1, drg_video2, drg_company_county, drg_company_fax_no', 'length', 'max'=>200),
			array('drg_fprojections, drg_want, drg_company_address1, drg_company_address2, drg_company_address3', 'length', 'max'=>500),
			array('drg_favailable, drg_listtype', 'length', 'max'=>1),
			array('drg_mktqstatus, drg_reporttime', 'length', 'max'=>10),
			array('drg_company_tel_no', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('drg_lid, drg_uid, drg_category, drg_profession, drg_viewlimit, drg_logo, drg_title, drg_desc, drg_explanation, drg_businessidea, drg_fprojections, drg_favailable, drg_famount, drg_financial_data, drg_want, drg_keyword, drg_video1, drg_video2, drg_mktquestion, drg_mktqstatus, drg_reporttime, drg_date, drg_datetime, drg_status,  drg_listtype, drg_company_name, drg_company_address1, drg_company_address2, drg_company_address3, drg_company_town, drg_company_county, drg_company_zip_code, drg_company_country, drg_company_tel_no, drg_company_fax_no, drg_listingstatus, drg_approvedate, reject_list', 'safe', 'on'=>'search'),
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
			'drg_lid' => 'Drg Lid',
			'drg_uid' => 'Drg Uid',
			'drg_category' => 'Drg Category',
			'drg_profession' => 'Drg Profession',
			'drg_viewlimit' => 'Drg Viewlimit',
			'drg_logo' => 'Drg Logo',
			'drg_title' => 'Drg Title',
			'drg_desc' => 'Drg Desc',
			'drg_explanation' => 'Drg Explanation',
			'drg_businessidea' => 'Drg Businessidea',
			'drg_fprojections' => 'Drg Fprojections',
			'drg_favailable' => 'Drg Favailable',
			'drg_famount' => 'Drg Famount',
			'drg_financial_data' => 'Drg Financial Data',
			'drg_want' => 'Drg Want',
			'drg_keyword' => 'Drg Keyword',
			'drg_video1' => 'Drg Video1',
			'drg_video2' => 'Drg Video2',
			'drg_mktquestion' => 'Drg Mktquestion',
			'drg_mktqstatus' => 'Drg Mktqstatus',
			'drg_reporttime' => 'Drg Reporttime',
			'drg_date' => 'Drg Date',
			'drg_datetime' => 'Drg Datetime',
			'drg_status' => 'Drg Status',
			
			'drg_listtype' => 'Drg Listtype',
			'drg_company_name' => 'Drg Company Name',
			'drg_company_address1' => 'Drg Company Address1',
			'drg_company_address2' => 'Drg Company Address2',
			'drg_company_address3' => 'Drg Company Address3',
			'drg_company_town' => 'Drg Company Town',
			'drg_company_county' => 'Drg Company County',
			'drg_company_zip_code' => 'Drg Company Zip Code',
			'drg_company_country' => 'Drg Company Country',
			'drg_company_tel_no' => 'Drg Company Tel No',
			'drg_company_fax_no' => 'Drg Company Fax No',
			'drg_listingstatus' => 'Drg Listingstatus',
			'drg_approvedate' => 'Drg Approvedate',
			'reject_list' => 'Reject List',
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
 		    $criteria = new CDbCriteria;
            $criteria->compare('drg_lid',$this->drg_lid);  
            $criteria->compare('drg_uid',$this->drg_uid,true);
    		$criteria->compare('drg_category',$this->drg_category,true);
    		$criteria->compare('drg_profession',$this->drg_profession,true);
    		$criteria->compare('drg_viewlimit',$this->drg_viewlimit,true);
    		$criteria->compare('drg_logo',$this->drg_logo,true);
    		$criteria->compare('drg_title',$this->drg_title,true);
    		$criteria->compare('drg_desc',$this->drg_desc,true);
    		$criteria->compare('drg_explanation',$this->drg_explanation,true);
    		$criteria->compare('drg_businessidea',$this->drg_businessidea,true);
    		$criteria->compare('drg_fprojections',$this->drg_fprojections,true);
    		$criteria->compare('drg_favailable',$this->drg_favailable,true);
    		$criteria->compare('drg_famount',$this->drg_famount,true);
    		$criteria->compare('drg_financial_data',$this->drg_financial_data);
    		$criteria->compare('drg_want',$this->drg_want,true);
    		$criteria->compare('drg_keyword',$this->drg_keyword,true);
    		$criteria->compare('drg_video1',$this->drg_video1,true);
    		$criteria->compare('drg_video2',$this->drg_video2,true);
    		$criteria->compare('drg_mktquestion',$this->drg_mktquestion,true);
    		$criteria->compare('drg_mktqstatus',$this->drg_mktqstatus,true);
    		$criteria->compare('drg_reporttime',$this->drg_reporttime,true);
    		$criteria->compare('drg_date',$this->drg_date,true);
    		$criteria->compare('drg_datetime',$this->drg_datetime,true);
    		$criteria->compare('drg_status',$this->drg_status,true);
    	
    		$criteria->compare('drg_listtype',$this->drg_listtype,true);
    		$criteria->compare('drg_company_name',$this->drg_company_name,true);
    		$criteria->compare('drg_company_address1',$this->drg_company_address1,true);
    		$criteria->compare('drg_company_address2',$this->drg_company_address2,true);
    		$criteria->compare('drg_company_address3',$this->drg_company_address3,true);
    		$criteria->compare('drg_company_town',$this->drg_company_town,true);
    		$criteria->compare('drg_company_county',$this->drg_company_county,true);
    		$criteria->compare('drg_company_zip_code',$this->drg_company_zip_code,true);
    		$criteria->compare('drg_company_country',$this->drg_company_country,true);
    		$criteria->compare('drg_company_tel_no',$this->drg_company_tel_no,true);
    		$criteria->compare('drg_company_fax_no',$this->drg_company_fax_no,true);
    		$criteria->compare('drg_listingstatus',$this->drg_listingstatus);
    		$criteria->compare('drg_approvedate',$this->drg_approvedate,true);
    		$criteria->compare('reject_list',$this->reject_list);
        	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdminListing the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
