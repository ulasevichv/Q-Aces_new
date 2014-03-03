<?php

class RegisterForm extends CFormModel
{
	public $firstName;
	public $lastName;
	public $email;
	public $password;
	
	public function rules()
	{
		return array(
			array('firstName, lastName, email, password', 'required'),
			array('email', 'email'),
//			array('password', 'authenticate'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'firstName' => Yii::t('general', 'First Name'),
			'lastName' => Yii::t('general', 'Last Name'),
			'email' => Yii::t('general', 'Email'),
			'password' => Yii::t('general', 'Password'),
		);
	}
}