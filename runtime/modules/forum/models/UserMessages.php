<?php

/**
 * This is the model class for table "{{user_messages}}".
 *
 * The followings are the available columns in table '{{user_messages}}':
 * @property integer $id
 * @property integer $blist_id
 * @property string $subject
 * @property string $message
 * @property integer $user_id
 * @property integer $likes_total
 * @property integer $dislikes_total
 * @property string $attachement
 * @property string $is_spam
 * @property string $first_message
 * @property string $created_date
 */
class UserMessages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_messages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/*public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('blist_id, subject, message, user_id, likes_total, dislikes_total, attachement, created_date', 'required'),
			array('blist_id, user_id, likes_total, dislikes_total', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>250),
			array('attachement', 'length', 'max'=>255),
			array('is_spam, first_message', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, blist_id, subject, message, user_id, likes_total, dislikes_total, attachement, is_spam, first_message, created_date', 'safe', 'on'=>'search'),
		);
	}*/

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
			'id' => 'ID',
			'blist_id' => 'Blist',
			'subject' => 'Subject',
			'message' => 'Message',
			'user_id' => 'User',
			'likes_total' => 'Likes Total',
			'dislikes_total' => 'Dislikes Total',
			'attachement' => 'Attachement',
			'is_spam' => 'Is Spam',
			'first_message' => 'First Message',
			'created_date' => 'Created Date',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('blist_id',$this->blist_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('likes_total',$this->likes_total);
		$criteria->compare('dislikes_total',$this->dislikes_total);
		$criteria->compare('attachement',$this->attachement,true);
		$criteria->compare('is_spam',$this->is_spam,true);
		$criteria->compare('first_message',$this->first_message,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserMessages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getPostComments($comment_id){

        $sql = "SELECT c.*";
        $sql .= "FROM {{post_messages}} pc ";
        $sql .= "INNER JOIN {{user_messages}} c ";
        $sql .=" ON c.id = pc.post_id ";
        //$sql .= "INNER JOIN {{user}} u ";
        //$sql .= " ON c.user_id = u.drg_id ";
       // $sql .= " WHERE pc.comment_id = $comment_id";
        $sql .= " GROUP BY pc.post_id";
        $sql .= " ORDER BY c.created_date ASC";


        $postComments = Yii::app()->db->createCommand($sql)->queryAll();

        if($postComments)
            return $postComments;
        else
            return null;

    }

    public static function getUserStats($listingId){

        if( empty($listingId) ){

            return false;
        }

        $result = array();

        $sql = "SELECT u.drg_id as user_id, u.drg_username as username,u.drg_image,u.drg_name,u.drg_surname, sum(likes_total) as like_total, sum(dislikes_total) as dislike_total, (sum(likes_total) - sum(dislikes_total)) as user_reputation ";
        $sql .= "FROM drg_user_messages c ";
        $sql .= "INNER JOIN drg_user u ";
        $sql .= "ON c.user_id = u.drg_id ";
        $sql .= "WHERE c.blist_id =".$listingId ;
        $sql .= " GROUP BY c.user_id";

        $usersStats = Yii::app()->db->createCommand($sql)->queryAll();

        if( $usersStats ){

            foreach ($usersStats as $userStats) {

                $result[$userStats['user_id']] = $userStats;

            }

            return $result;
        }
        else
            return null;

    }

    /**
     * Format a date
     *
     * @param $date to format
     *
     * @return new date formated
     *
     */
    public static function formatDate($date) {

        if( empty($date) )
            return NULL;

        $result['time'] = date('h:i A', strtotime($date));

        $result['date'] = date('d/m/Y', strtotime($date));

        return $result;

    }
}
