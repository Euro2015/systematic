<?php

/**
 * This is the model class for table "{{slider_btns}}".
 *
 * The followings are the available columns in table '{{slider_btns}}':
 * @property integer $btn_id
 * @property string $btn_image
 * @property string $btn_text
 * @property integer $btn_sitelink
* @property integer $btn_videolink
* @property integer $slider_id
 */

class Sliderbtns extends CActiveRecord
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
		return '{{slider_btns}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('btn_image, btn_text, slider_id', 'required'),
			array('btn_id, slider_id', 'numerical', 'integerOnly'=>true),
			array('btn_image', 'length', 'max'=>1024),
			array('btn_text', 'length', 'max'=>1024),
			array('btn_sitelink', 'length', 'max'=>1024),
			array('btn_videolink', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('btn_id, btn_image, btn_text, btn_sitelink, btn_videolink, slider_id', 'safe', 'on'=>'search'),
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
			'btn_id' => 'Button Id',
			'btn_image' => 'Button Image',
			'btn_text' => 'Button Text',
			'btn_sitelink' => 'Button Site link',
			'btn_videolink' => 'Button Video link',
			'slider_id' => 'slider id',
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

		$criteria->compare('btn_id',$this->btn_id);
		$criteria->compare('btn_image',$this->btn_image,true);
		$criteria->compare('btn_text',$this->btn_text,true);
		$criteria->compare('btn_sitelink',$this->btn_sitelink,true);
		$criteria->compare('btn_videolink',$this->btn_videolink,true);
		$criteria->compare('slider_id',$this->slider_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}