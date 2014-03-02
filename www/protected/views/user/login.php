<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'user_login_form',
	'enableClientValidation' => true,
	'enableAjaxValidation' => true,
	'action' => $this->createUrl('user/loginPerform'),
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions' => array(
		'autocomplete' => 'off',
		'onsubmit' => "ajaxValidateUserLoginForm(); return false;",
	),
));
?>
	
	<div class="input-group">
		<span class="input-group-addon glyphicon glyphicon-user"></span>
		<?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email'), 'value' => 'admin@q-aces.com')); ?>
	</div>
	
	<div class="input-group">
		<span class="input-group-addon glyphicon glyphicon-lock"></span>
		<?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password'), 'value' => '123456')); ?>
	</div>
	
	<div class="input-group">
		<?php echo $form->checkBox($model, 'rememberMe', array('value' => 1, 'checked' => 'checked')); ?>
		<?php echo $form->label($model, 'rememberMe'); ?>
	</div>
	
	<div id="<?php echo $form->id.'_error'; ?>" class="alert alert-danger" style="display:none;">
	</div>
	
	<input type="submit" style="display:none;" />
	
<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript(uniqid(), "
	
	if (typeof(LoginFormJsAdded) == 'undefined')
	{
		var LoginFormJsAdded = true;
		
		function ajaxValidateUserLoginForm()
		{
			$('#".$form->id." .input-group').removeClass('has-error');
			
			var jFormErrorDiv = $('#".$form->id."_error');
			
			jFormErrorDiv.css('display', 'none');
			
			var request = $.ajax({
				url : '?r=user/loginValidate',
				data : $('#user_login_form').serialize(),
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
					var jInputGroup = $('#'+String(errors[0].id)).parents('.input-group');
					
					jInputGroup.addClass('has-error');
					
					jFormErrorDiv.html(errors[0].msg);
					jFormErrorDiv.css('display', 'block');
					return;
				}
				
				$('#".$form->id."').removeAttr('onsubmit');
				$('#".$form->id."').submit();
			});
			
			request.error(requestTimedOut);
		}
		
		function ajaxFormValidationJsonToArray(json)
		{
			var arr = new Array();
			
			for (var property in json)
			{
				arr.push({ id : property, msg : json[property] });
			}
			
			return arr;
		}
		
		function requestTimedOut(request, status, error)
		{
			if (status == 'timeout') alert('".Yii::t('general', 'Request timed out. Please, try again')."');
		}
	}
	
", CClientScript::POS_END);