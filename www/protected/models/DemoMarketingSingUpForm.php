
<?php

class DemoMarketingSingUpForm extends CFormModel
{
	public $email;
	public $firstName;
	public $lastName;
	public $siteUrl;
	
	public function rules()
	{
		return array(
			array('email, firstName, lastName, siteUrl', 'required'),
			array('firstName, lastName', 'match', 'pattern' => '/^[[:alpha:]\- ]+$/u', 'message' => Yii::t('general', '{attribute} contains forbidden characters.')),
			array('email', 'email'),
			array('siteUrl', 'url'),
			array('email', 'checkUniqueEmail'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'email' => Yii::t('general', 'Email (must be associated with law firm)'),
			'firstName' => Yii::t('general', 'First name'),
			'lastName' => Yii::t('general', 'Last name'),
			'siteUrl' => Yii::t('general', 'Law firm website URL'),
		);
	}
	
	public function checkUniqueEmail($attribute, $params)
	{
		$fileName = Yii::app()->basePath.'/userdata/demoSignUps.csv';
		$handle = @fopen($fileName, 'r');
		if ($handle === false)
		{
			$this->addError($attribute, Yii::t('general', 'Cannot open file'));
			return;
		}
		
		while (!feof($handle))
		{
			$line = fgets($handle);
			
			$entries = explode(',', $line);
			
			if (count($entries) != 5) continue;
			
			$email = $entries[1];
			
			if ($this->email == $email)
			{
				$this->addError($attribute, Yii::t('general', 'Specified email is already registered'));
				break;
			}
		}
		
		fclose($handle);
	}
	
	public function saveCsv($request)
	{
		$formData = $request['DemoMarketingSingUpForm'];
		
		$dateTime = new DateTime('now', new DateTimeZone('UTC'));
		
		$entries = array();
		
		$entries[] = $dateTime->format('Y-m-d H:i:s');
		$entries[] = $formData['email'];
		$entries[] = $formData['firstName'];
		$entries[] = $formData['lastName'];
		$entries[] = $formData['siteUrl'];
		
		$lineStr = implode(',', $entries);
		
		$fileName = Yii::app()->basePath.'/userdata/demoSignUps.csv';
		$handle = @fopen($fileName, 'a+');
		if ($handle === false) throw new Exception(Yii::t('general', 'Cannot open file'));
		fwrite($handle, $lineStr."\n");
		fclose($handle);
	}
}