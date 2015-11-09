<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity
{
        private $_id;
        
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
            if($user = User::model()->authAdmin($this->username, $this->password)) {
                $this->errorCode = self::ERROR_NONE;
                $this->_id = $user->id;
                $this->setState('username', $user->username);
                $this->setState('first_name', $user->first_name);
                $this->setState('last_name', $user->last_name);
                $this->setState('email', $user->email);
                $this->setState('is_admin', TRUE);
            }
            else {
                $this->errorCode= self::ERROR_UNKNOWN_IDENTITY;
            }
            
            return !$this->errorCode;
	}
        
        public function getId()
	{
		return $this->_id;
	}
        
}