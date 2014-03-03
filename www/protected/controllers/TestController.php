<?php

class TestController extends Controller
{
	public function actionGetPwd()
	{
		$plainPassword = '123456';
		
		$fullHash = UserIdentity::getPasswordFullHash($plainPassword);
		
//		echo '<br/><b>$plainPassword: </b>'.htmlspecialchars($plainPassword).'<br/>';
		echo '<br/><b>$fullHash: </b>'.htmlspecialchars($fullHash).'<br/>';
		
		Yii::app()->end();
	}
	
	public function actionCheckPwd()
	{
		$plainPassword = '123456';
		$fullHash = '8e42a6338021335f2492983f8f178ad9:Jbx8TpAalSHIdaX8';
		
//		echo '<br/><b>$plainPassword: </b>'.htmlspecialchars($plainPassword).'<br/>';
		echo '<br/><b>$fullHash: </b>'.htmlspecialchars($fullHash).'<br/>';
		
		$result = UserIdentity::validatePassword($plainPassword, $fullHash);
		
		echo '<br/><b>$result: </b>' . ($result ? 'true' : 'false') . '<br/>';
		
		Yii::app()->end();
	}
}