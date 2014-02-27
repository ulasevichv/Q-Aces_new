<?php

class User extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'user';
	}
	
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('general', 'ID'),
			'firstName' => Yii::t('general', 'First Name'),
			'lastName' => Yii::t('general', 'Last Name'),
			'email' => Yii::t('general', 'Email'),
			'password' => Yii::t('general', 'Password'),
		);
	}
}