<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
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
//	public function authenticate()
//	{
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		elseif($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
//	}
	
	public function authenticate()
	{
		$error = '';
		
		$userAR = User::model()->findByAttributes(array('email' => $this->username));
		
//		echo '<br/><b>$userAR: </b>';
//		echo '<pre>';
//		echo htmlspecialchars(print_r($userAR, true));
//		echo '</pre>';
		
//		echo '<br/><b>$userAR: </b>' . ($userAR ? 'true' : 'false') . '<br/>';
		
		if (!isset($userAR)) $error = self::ERROR_UNKNOWN_IDENTITY;
		
		if ($error == '')
		{
			$row = (object) $userAR->attributes;
			
			if ($row->password != $this->password) $error = self::ERROR_PASSWORD_INVALID;

//			echo '<br/><b>$row: </b>';
//			echo '<pre>';
//			echo htmlspecialchars(print_r($row, true));
//			echo '</pre>';
		}

		if ($error == '')
		{
//			$this->setState('userName', $record->userName);
			
			$this->_id = $row->id;
		}

		$this->errorCode = ($error == '' ? self::ERROR_NONE : $error);
		
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}