<?php

class UserController extends Controller
{
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}
	
	public function actionLogin()
	{
		$model = new LoginForm();
		
		$view = 'login';
		
		$data = array(
			'model' => $model,
		);
		
		if (isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			
			if ($model->validate() && $model->login())
			{
				$this->redirect(Yii::app()->user->returnUrl);
			}
			else
			{
				Yii::app()->user->setFlash('error', Helper::modelErrorsToMessage($model));
			}
		}
		
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
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionRegister()
	{
		$model = new RegisterForm();
		
		if (isset($_POST['RegisterForm']))
		{
			$model->attributes = $_POST['RegisterForm'];
			
			if ($model->validate())
			{
				Yii::app()->user->setFlash('success', Yii::t('general', 'Thank you for registration. Use your credentials to login.'));
				$this->redirect(array('/site/msg'));
			}
			else
			{
				Yii::app()->user->setFlash('error', Helper::modelErrorsToMessage($model));
			}
		}
		
		$this->render('register', array('model' => $model));
	}
	
	public function actionRegisterValidate()
	{
		$model = new RegisterForm();
		
		if (Yii::app()->request->isAjaxRequest)
		{
			echo CActiveForm::validate($model);
		}
		
		Yii::app()->end();
	}
}