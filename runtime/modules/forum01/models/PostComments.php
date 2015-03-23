<?php

/**
 * This is the model class for table "{{posts_comments}}".
 *
 * The followings are the available columns in table '{{posts_comments}}':
 * @property integer $post_id
 * @property integer $comment_id
 */
class PostComments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PostComments the static model class
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
		return '{{posts_comments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{		
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
					);
	}

}