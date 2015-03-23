<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
     
    public $userId; 
    
    private $_id;
    
    public $_idcode;
    
    private $_usertype;
    
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
         
        if($this->username==""){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
            
        }else if($this->password ==""){
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }else {
             
             
             $userData = User::model()->findByAttributes(array('drg_username'=>$this->username,'drg_pstatus'=>'1','drg_pass' =>SharedFunctions::app()->encrypt_code($this->password)));
             if(!empty($userData)){
                if($userData->drg_status=='n'){
                   $this->errorCode='Your account has been suspended !';
                }else{
                    Yii::app()->user->setState('name', $userData->drg_name.' '.$userData->drg_surname);
                    Yii::app()->user->setState('username', $userData->drg_username);
                    Yii::app()->user->setState('uid',$userData->drg_uid);
                    Yii::app()->user->setState('ufolder',$userData->drg_username.'_'.$userData->drg_id);
                    Yii::app()->user->setState('_user_Type',$userData->drg_user_type);
                    $this->_id = $userData->drg_id;
                    $this->_idcode = $userData->drg_uid; 
                    $this->errorCode=self::ERROR_NONE;
                }
             }else {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
             }   
        }        
        return !$this->errorCode;
        
        
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function getIdcode()
    {
        return $this->_idcode;
    }
     
}