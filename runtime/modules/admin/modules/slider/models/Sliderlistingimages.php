<?php

/**
 * This is the model class for table "{{slider_images}}".
 *
 * The followings are the available columns in table '{{listing_images}}':
 * @property integer $drg_image_id
 * @property string $drg_listing_image
 * @property string $drg_imgdesc
 * @property integer $drg_lid
 * @property integer $order_id
 */
class Sliderlistingimages extends CActiveRecord
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
		return '{{slider_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slider_image, slider_imagedesc, slider_id', 'required'),
			array('slider_id, order_id', 'numerical', 'integerOnly'=>true),
			array('slider_image', 'length', 'max'=>1024),
			array('slider_imagedesc', 'length', 'max'=>1024),
			array('slider_sitelink', 'length', 'max'=>1024),
			array('slider_videolink', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('image_id, slider_image, slider_imagedesc, slider_sitelink, slider_videolink, slider_id, order_id', 'safe', 'on'=>'search'),
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
			'image_id' => 'Image Id',
			'slider_image' => 'Image',
			'slider_imagedesc' => 'Image description',
			'slider_sitelink' => 'Site link',
			'slider_videolink' => 'Video link',
			'slider_id' => 'slider id',
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

		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('slider_image',$this->slider_image,true);
		$criteria->compare('slider_imagedesc',$this->slider_imagedesc,true);
		$criteria->compare('slider_sitelink',$this->slider_sitelink,true);
		$criteria->compare('slider_videolink',$this->slider_videolink,true);
		$criteria->compare('slider_id',$this->slider_id);
		$criteria->compare('order_id',$this->order_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}