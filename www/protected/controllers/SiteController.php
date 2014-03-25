<?php

class SiteController extends Controller
{
	public function actions()
	{
		return array(
//			// captcha action renders the CAPTCHA image displayed on the contact page
//			'captcha' => array(
//				'class' => 'CCaptchaAction',
//				'backColor' => 0xFFFFFF,
//			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionMsg()
	{
		$this->render('msg');
	}
	
	public function actionDemoBootstrap()
	{
		$this->render('demoBootstrap', array());
	}
	
	public function actionDemoMarketing()
	{
		$this->render('demoMarketing', array());
	}

	public function actionDemoMarketingSignUp()
	{
		$model = new DemoMarketingSingUpForm();

		$data = array(
			'model' => $model,
		);

		$email = Yii::app()->request->getParam('email', '');
		
		$model->email = $email;
		
		$this->renderPartial('demoMarketingSignUp', $data, false, true);
	}
	
	public function actionDemoMarketingSignUpValidate()
	{
		$model = new DemoMarketingSingUpForm();
		
		if (Yii::app()->request->isAjaxRequest)
		{
			echo CActiveForm::validate($model);
		}
		
		Yii::app()->end();
	}
	
	public function actionDemoMarketingSignUpSave()
	{
		@ob_clean();
		header('Expires: Thu, 01 Jan 1970 00:00:01 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
		header('Content-Type: text/plain; charset=utf-8');
		
		$error = '';
		
		try
		{
			$model = new DemoMarketingSingUpForm();
			
			$model->saveCsv($_REQUEST);
		}
		catch (Exception $ex)
		{
			$error = $ex->getMessage();
		}
		
		$result = (object) array(
			'error' => $error,
		);
		
		echo json_encode($result);
		
		Yii::app()->end();
	}
	
	public function actionDemoChart()
	{
		$this->render('demoChart', array());
	}
	
//	public function actionContact()
//	{
//		$model=new ContactForm;
//		if(isset($_POST['ContactForm']))
//		{
//			$model->attributes=$_POST['ContactForm'];
//			if($model->validate())
//			{
//				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
//				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
//				$headers="From: $name <{$model->email}>\r\n".
//					"Reply-To: {$model->email}\r\n".
//					"MIME-Version: 1.0\r\n".
//					"Content-Type: text/plain; charset=UTF-8";
//				
//				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
//				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
//				$this->refresh();
//			}
//		}
//		$this->render('contact',array('model'=>$model));
//	}
}