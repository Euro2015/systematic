<?php

/**
 * This is the model class for table "{{comments}}".
 *
 * The followings are the available columns in table '{{comments}}':
 * @property integer $id
 * @property string $message
 * @property string $user_id
 * @property string $listing_id
 * @property string $likes_total
 * @property string $dislikes_total
 * @property string $attachement
 * @property string $is_spam
 * @property string $first_comment
 * @property string $date_create
 */
class Comments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comments the static model class
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
		return '{{comments}}';
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
        
        /**
         * Get the post comment for the current comment (first_comment)
         *
         * @param no params
         *
         * @return Array of posts comment
         *
        */        
        
        
        public function getPostComments(){            
            
	    $sql = "SELECT c.*";
            $sql .= "FROM {{posts_comments}} pc ";
            $sql .= "INNER JOIN {{comments}} c ";
            $sql .= " ON pc.post_id = c.id ";
            //$sql .= "INNER JOIN {{user}} u ";
            //$sql .= " ON c.user_id = u.drg_id ";
            $sql .= " WHERE pc.comment_id = {$this->id}";
            $sql .= " ORDER BY c.date_create ASC";
            
            $postComments = Yii::app()->db->createCommand($sql)->queryAll();
            
	    if($postComments)
	        return $postComments;
	    else
	        return null;
        
        }
        
        

        /**
         * List the comments
         *
         * @param $listingId
         * @param $offset
         * @param $limit
         * @param $commentOrderBy
         * @param $userReputation
         * @param $userProfession
         * 
         * @return new date formated
         *
        */        
        
        public static function getCommentsByListing($listingId, $offset, $limit, $commentOrderBy, $userReputation, $userProfession){
            
            $result = array();
            
            $CDbCriteria = FALSE;
            
            if( ($commentOrderBy != "user_reputation desc") && ($commentOrderBy != "user_reputation asc") && ($userProfession == "0") ){
                
                $criteria = new CDbCriteria;
                $criteria->select = array('*, (likes_total - dislikes_total) as rate');
                $criteria->addCondition('listing_id = '.$listingId);
                $criteria->addCondition("first_comment = '1'");
                $criteria->offset = $offset;
                $criteria->limit = $limit;
                $criteria->order = $commentOrderBy;
                
                $CDbCriteria = TRUE;
                
            }elseif ( (($commentOrderBy == "user_reputation desc") || ($commentOrderBy == "user_reputation asc")) && ($userProfession == "0") ) {
            
                $sql = "SELECT c1.id FROM {{comments}} c1";
                $sql .= " INNER JOIN (";
                $sql .= " SELECT u.drg_id as user_id, (sum(likes_total) - sum(dislikes_total)) AS user_reputation";
                $sql .= " FROM {{comments}} c2";
                $sql .= " INNER JOIN {{user}} u";
                $sql .= " ON c2.user_id = u.drg_id";
                $sql .= " WHERE c2.listing_id = {$listingId}";
                $sql .= " GROUP BY c2.user_id) z";
                $sql .= " ON z.user_id = c1.user_id";
                $sql .= " WHERE c1.first_comment = '1'";
                $sql .= " AND c1.listing_id = {$listingId}";
                $sql .= " ORDER BY z.{$commentOrderBy}";
                $sql .= " LIMIT {$offset}, {$limit}; ";
                
            }elseif ( ($commentOrderBy != "user_reputation desc") && ($commentOrderBy != "user_reputation asc") && ($userProfession != "0") ) {
                
                $sql = "SELECT c.id, (likes_total - dislikes_total) as rate FROM {{comments}} c";
                $sql .= " INNER JOIN {{user}} u";
                $sql .= " ON c.user_id = u.drg_id";
                $sql .= " INNER JOIN {{profession}} p";
                $sql .= " ON u.drg_pstatus = p.profession_id";
                $sql .= " WHERE c.first_comment = '1'";
                $sql .= " AND c.listing_id = {$listingId}";
                $sql .= " AND p.profession_id = {$userProfession}";
                $sql .= " ORDER BY {$commentOrderBy}";
                $sql .= " LIMIT {$offset}, {$limit}; ";
                
            }elseif ( (($commentOrderBy == "user_reputation desc") || ($commentOrderBy == "user_reputation asc")) && ($userProfession != "0") ) {
            
                $sql = "SELECT c1.id, z.user_reputation FROM {{comments}} c1";
                $sql .= " INNER JOIN (";
                $sql .= " SELECT u.drg_id as user_id, (sum(likes_total) - sum(dislikes_total)) AS user_reputation";
                $sql .= " FROM {{comments}} c2";
                $sql .= " INNER JOIN {{user}} u";
                $sql .= " ON c2.user_id = u.drg_id";
                $sql .= " INNER JOIN {{profession}} p";
                $sql .= " ON u.drg_pstatus = p.profession_id";                
                $sql .= " WHERE c2.listing_id = {$listingId}";
                $sql .= " AND p.profession_id = {$userProfession}";
                $sql .= " GROUP BY c2.user_id) z";
                $sql .= " ON z.user_id = c1.user_id";
                $sql .= " WHERE c1.first_comment = '1'";                
                $sql .= " AND c1.listing_id = {$listingId}";
                $sql .= " ORDER BY {$commentOrderBy}";
                $sql .= " LIMIT {$offset}, {$limit}; ";
                
            }
            
            if( !$CDbCriteria ){
                                
                $commentsCommand = Yii::app()->db->createCommand($sql)->queryAll();
                
                foreach ($commentsCommand as $commentCommand) {
                    
                    $comment = Comments::model()->findByPk($commentCommand['id']);
                    
                    $result[$comment->id]['comment'] = $comment;

                    $postComments = $comment->getPostComments();

                    $result[$comment->id]['post_comment'] = $postComments;
                }
                
            }else{
                                
                $comments = Comments::model()->findAll($criteria);
                
                foreach ($comments as $comment) {

                    $result[$comment->id]['comment'] = $comment;

                    $postComments = $comment->getPostComments();

                    $result[$comment->id]['post_comment'] = $postComments;

                }
                
            }
            
	    return $result;
        
        }
        
        // It's more better for performance to extract in one query the user stats (username, nb of likes, nb of dislike ) like that
        // than to make multiple query for each comment
        
        public static function getUserStats($listingId){
            
            if( empty($listingId) ){
                
                return false;
            }
            
            $result = array();
            
            $sql = "SELECT u.drg_id as user_id, u.drg_username as username, sum(likes_total) as like_total, sum(dislikes_total) as dislike_total, (sum(likes_total) - sum(dislikes_total)) as user_reputation ";
            $sql .= "FROM {{comments}} c ";
            $sql .= "INNER JOIN {{user}} u ";
            $sql .= "ON c.user_id = u.drg_id ";
            $sql .= "WHERE c.listing_id = {$listingId}";
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
        
        
        public static function getTotalComments($listingId){
            
            $sql = "SELECT COUNT(*) as total_comments";
            $sql .= " FROM {{comments}} c";
            $sql .= " WHERE listing_id = {$listingId}; ";
            
            $totalComments = Yii::app()->db->createCommand($sql)->queryAll();
            
            return (int) $totalComments[0]['total_comments'];
            
        }

}