<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'marketing_demo_signup_form',
	'enableClientValidation' => false,
	'enableAjaxValidation' => true,
	'action' => $this->createUrl('site/demoMarketingSignUp'),
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions' => array(
		'autocomplete' => 'off',
		'onsubmit' => "ajaxValidateMarketingSignUpForm(); return false;",
	),
));
?>
	
	<div class="_row">
		<?php echo $form->labelEx($model, 'email'); ?>
		<?php echo $form->textField($model, 'email', array('class' => 'form-control', 'value' => $model->email)); ?>
	</div>
	<div class="_row">
		<?php echo $form->labelEx($model, 'firstName'); ?>
		<?php echo $form->textField($model, 'firstName', array('class' => 'form-control', 'value' => '')); ?>
	</div>
	<div class="_row">
		<?php echo $form->labelEx($model, 'lastName'); ?>
		<?php echo $form->textField($model, 'lastName', array('class' => 'form-control', 'value' => '')); ?>
	</div>
	<div class="_row">
		<?php echo $form->labelEx($model, 'siteUrl'); ?>
		<?php echo $form->textField($model, 'siteUrl', array('class' => 'form-control', 'value' => 'http://')); ?>
	</div>
	
	<div class="alert alert-danger"></div>
	
	<div class="_row _hidden">
		<?php echo CHtml::submitButton('#'); ?>
	</div>
	
<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript(uniqid(), "
	
	if (typeof(MarketingSignUpFormJsAdded) == 'undefined')
	{
		var MarketingSignUpFormJsAdded = true;
		
		function ajaxValidateMarketingSignUpForm()
		{
			$('#".$form->id." > ._row').removeClass('has-error');
			
			var jFormErrorDiv = $('#".$form->id." .alert');
			jFormErrorDiv.css('display', 'none');
			
			var request = $.ajax({
				url : '?r=site/demoMarketingSignUpValidate',
				data : $('#".$form->id."').serialize(),
				type : 'POST',
				dataType : 'json',
				cache : false,
				timeout : 5000
			});
			
			request.success(function(response, status, request)
			{
				var errors = ajaxFormValidationJsonToArray(response);
				
				if (errors.length > 0)
				{
					var jFormRow = $('#'+String(errors[0].id)).parents('._row');
					
					jFormRow.addClass('has-error');
					
					jFormErrorDiv.html(errors[0].msg);
					jFormErrorDiv.css('display', 'block');
					return;
				}
				
				saveMarketingSignUpForm();
			});
			
			request.error(requestTimedOutDefault);
		}
		
		function saveMarketingSignUpForm()
		{
			var request = $.ajax({
				url : '?r=site/demoMarketingSignUpSave',
				data : $('#".$form->id."').serialize(),
				type : 'POST',
				dataType : 'json',
				cache : false,
				timeout : 5000
			});
			
			request.success(function(response, status, request)
			{
				onSingUpSuccess();
			});
			
			request.error(requestTimedOutDefault);
		}
	}
	
", CClientScript::POS_END);