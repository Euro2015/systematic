<?php

/**
 * This is the model class for table "{{mail_template}}".
 *
 * The followings are the available columns in table '{{mail_template}}':
 * @property string $template_id
 * @property string $template_module
 * @property string $template_subject
 * @property string $template_body
 * @property string $template_status
 * @property string $template_create
 */
class MailTemplate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mailtemplate the static model class
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
		return '{{mail_template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('template_module, template_subject, template_body, template_create', 'required'),
			array('template_module, template_subject', 'length', 'max'=>255),
			array('template_status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('template_id, template_module, template_subject, template_body, template_status, template_create', 'safe', 'on'=>'search'),
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
			'template_id' => 'Template',
			'template_module' => 'Template Module',
			'template_subject' => 'Template Subject',
			'template_body' => 'Template Body',
			'template_status' => 'Template Status',
			'template_create' => 'Template Create',
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

		$criteria->compare('template_id',$this->template_id,true);
		$criteria->compare('template_module',$this->template_module,true);
		$criteria->compare('template_subject',$this->template_subject,true);
		$criteria->compare('template_body',$this->template_body,true);
		$criteria->compare('template_status',$this->template_status,true);
		$criteria->compare('template_create',$this->template_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}