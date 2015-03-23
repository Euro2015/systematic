<?php

/**
 * This is the model class for table "{{listing_images}}".
 *
 * The followings are the available columns in table '{{listing_images}}':
 * @property integer $drg_image_id
 * @property string $drg_listing_image
 * @property string $drg_imgdesc
 * @property integer $drg_lid
 * @property integer $order_id
 */
class Userlistingimages extends CActiveRecord
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
		return '{{listing_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('drg_listing_image, drg_imgdesc, drg_lid,', 'required'),
			array('drg_lid, order_id', 'numerical', 'integerOnly'=>true),
			array('drg_listing_image', 'length', 'max'=>250),
			array('drg_imgdesc', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('drg_image_id, drg_listing_image, drg_imgdesc, drg_lid, order_id', 'safe', 'on'=>'search'),
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
			'drg_image_id' => 'Drg Image',
			'drg_listing_image' => 'Drg Listing Image',
			'drg_imgdesc' => 'Drg Imgdesc',
			'drg_lid' => 'Drg Lid',
			'order_id' => 'Order',
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

		$criteria->compare('drg_image_id',$this->drg_image_id);
		$criteria->compare('drg_listing_image',$this->drg_listing_image,true);
		$criteria->compare('drg_imgdesc',$this->drg_imgdesc,true);
		$criteria->compare('drg_lid',$this->drg_lid);
		$criteria->compare('order_id',$this->order_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}