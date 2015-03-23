<?php

/**
 * This is the model class for table "{{business_listing}}".
 *
 * The followings are the available columns in table '{{business_listing}}':
 * @property integer $drg_blid
 * @property string $drg_uid
 * @property string $drg_category
 * @property string $drg_profession
 * @property string $drg_viewlimit
 * @property string $drg_slogon
 * @property string $drg_whoweare
 * @property string $drg_offer
 * @property string $drg_keyword
 * @property string $drg_testimonial
 * @property string $drg_datetime
 * @property string $drg_status
 * @property string $drg_lstatus
 * @property string $drg_video1
 * @property string $drg_video2
 * @property integer $approved
 */
class Businesslisting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Businesslisting the static model class
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
		return '{{business_listing}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('drg_slogon,drg_whoweare,drg_offer,drg_category,drg_profession,drg_viewlimit', 'required'),
			array('approved', 'numerical', 'integerOnly'=>true),
			array('drg_uid', 'length', 'max'=>100),
			array('drg_category, drg_profession, drg_viewlimit, drg_status, drg_lstatus', 'length', 'max'=>50),
			array('drg_slogon, drg_video1, drg_video2', 'length', 'max'=>200),
			array('drg_offer', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('drg_blid, drg_uid, drg_category, drg_profession, drg_viewlimit, drg_slogon, drg_whoweare, drg_offer, drg_keyword, drg_testimonial, drg_datetime, drg_status, drg_lstatus, drg_video1, drg_video2, approved', 'safe', 'on'=>'search'),
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
			'drg_blid' => 'Blid',
			'drg_uid' => 'Uid',
			'drg_category' => 'Category',
			'drg_profession' => 'Profession',
			'drg_viewlimit' => 'Viewlimit',
			'drg_slogon' => 'Slogon',
			'drg_whoweare' => 'Whoweare',
			'drg_offer' => 'Offer',
			'drg_keyword' => 'Keyword',
			'drg_testimonial' => 'Testimonial',
			'drg_datetime' => 'Datetime',
			'drg_status' => 'Status',
			'drg_lstatus' => 'Lstatus',
			'drg_video1' => 'Video1',
			'drg_video2' => 'Video2',
			'approved' => 'Approved',
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

		$criteria->compare('drg_blid',$this->drg_blid);
		$criteria->compare('drg_uid',$this->drg_uid,true);
		$criteria->compare('drg_category',$this->drg_category,true);
		$criteria->compare('drg_profession',$this->drg_profession,true);
		$criteria->compare('drg_viewlimit',$this->drg_viewlimit,true);
		$criteria->compare('drg_slogon',$this->drg_slogon,true);
		$criteria->compare('drg_whoweare',$this->drg_whoweare,true);
		$criteria->compare('drg_offer',$this->drg_offer,true);
		$criteria->compare('drg_keyword',$this->drg_keyword,true);
		$criteria->compare('drg_testimonial',$this->drg_testimonial,true);
		$criteria->compare('drg_datetime',$this->drg_datetime,true);
		$criteria->compare('drg_status',$this->drg_status,true);
		$criteria->compare('drg_lstatus',$this->drg_lstatus,true);
		$criteria->compare('drg_video1',$this->drg_video1,true);
		$criteria->compare('drg_video2',$this->drg_video2,true);
		$criteria->compare('approved',$this->approved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}