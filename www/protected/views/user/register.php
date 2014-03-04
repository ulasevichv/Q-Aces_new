<?php



?>

<h1><?php echo Yii::t('general', 'Register'); ?></h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'user_register_form',
	'enableClientValidation' => false,
	'enableAjaxValidation' => true,
	'action' => $this->createUrl('user/registerPerform'),
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions' => array(
		'autocomplete' => 'off',
//		'class' => (Yii::app()->request->isAjaxRequest ? '' : '_not_modal'),
//		'onsubmit' => "ajaxValidateUserLoginForm(); return false;",
	),
));
?>
	
	<div class="_row">
		<?php echo $form->labelEx($model, 'firstName'); ?>
		<?php echo $form->textField($model, 'firstName', array('class' => 'form-control', 'placeholder' => '', 'value' => '')); ?>
	</div>
	
	<div class="_row">
		<?php echo $form->labelEx($model, 'lastName'); ?>
		<?php echo $form->textField($model, 'lastName', array('class' => 'form-control', 'placeholder' => '', 'value' => '')); ?>
	</div>
	
	<div class="_row">
		<?php echo $form->labelEx($model, 'email'); ?>
		<?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => '', 'value' => '')); ?>
	</div>
	
	<div class="_row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => '', 'value' => '')); ?>
	</div>
	
	<div class="alert alert-danger"></div>
	
	<div class="_row">
		<?php echo CHtml::submitButton(Yii::t('general', 'Register'), array('class' => 'btn btn-primary')); ?>
	</div>
	
<?php $this->endWidget(); ?>


