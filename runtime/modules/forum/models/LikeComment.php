<?php

/**
 * This is the model class for table "{{like_comment}}".
 *
 * The followings are the available columns in table '{{like_comment}}':
 * @property integer $id
 * @property integer $comment_id
 * @property integer $user_id
 * @property string $like_comment
 * @property string $date_create
 * @property string $date_update
 */
class LikeComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LikeComment the static model class
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
		return '{{like_comment}}';
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