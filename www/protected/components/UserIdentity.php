<?php

class UserIdentity extends CUserIdentity
{
	private $_id;
	
	public function authenticate()
	{
		$error = '';
		
		$userAR = User::model()->findByAttributes(array('email' => $this->username));
		
		if (!isset($userAR)) $error = self::ERROR_UNKNOWN_IDENTITY;
		
		if ($error == '')
		{
			$row = (object) $userAR->attributes;
			
			if ($row->password != $this->password) $error = self::ERROR_PASSWORD_INVALID;
		}
		
		if ($error == '')
		{
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