<?php

class UserController extends Controller
{
	public function actionLogin()
	{
		$model = new LoginForm();
		
		$view = 'login';
		
		$data = array(
			'model' => $model,
		);
		
		Yii::app()->request->isAjaxRequest ? $this->renderPartial($view, $data, false, true) : $this->render($view, $data);
	}
	
	public function actionLoginValidate()
	{
		$model = new LoginForm();
		
		if (Yii::app()->request->isAjaxRequest)
		{
			echo CActiveForm::validate($model);
		}
		
		Yii::app()->end();
	}
	
	public function actionLoginPerform()
	{
		$model = new LoginForm();
		
		if (isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			
			if ($model->validate() && $model->login()) $this->redirect(Yii::app()->user->returnUrl);
		}
		
		$this->render('login', array('model' => $model));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionRegister()
	{
		$model = null;
		
		$this->render('register', array('model' => $model));
	}
}