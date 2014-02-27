<?php

$user = Yii::app()->user;

//echo '<br/><b>$user: </b>';
//echo '<pre>';
//echo htmlspecialchars(print_r($user, true));
//echo '</pre>';
?>

<div id="main_menu" class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?php echo CHtml::encode(Yii::t('general', 'Toggle navigation')); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/"><?php echo CHtml::encode(Yii::app()->name); ?></a>
		</div>
		<div class="navbar-collapse collapse">
			<?php
			echo $this->widget('zii.widgets.CMenu', array(
				'htmlOptions' => array('class' => 'nav navbar-nav'),
				'items' => array(
					array('label' => Yii::t('general', 'Home'), 'url' => array('/site/index')),
					array('label' => Yii::t('general', 'About'), 'url' => array('/site/page', 'view' => 'about')),
					array('label' => Yii::t('general', 'Contact'), 'url' => array('/site/contact')),
					array('label' => '',
						'template' => '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.Yii::t('general', 'Dropdown').'<b class="caret"></b></a>',
						'itemOptions' => array('class' => 'dropdown'),
						'submenuOptions' => array('class' => 'dropdown-menu'),
						'items' => array(
							array('label' => Yii::t('general', 'Action'), 'url' => '#'),
							array('label' => Yii::t('general', 'Another action'), 'url' => '#'),
							array('label' => Yii::t('general', 'Something else here'), 'url' => '#'),
							array('template' => '', 'itemOptions' => array('class' => 'divider')),
							array('label' => Yii::t('general', 'Nav header'), 'itemOptions' => array('class' => 'dropdown-header')),
							array('label' => Yii::t('general', 'Separated link'), 'url' => '#'),
							array('label' => Yii::t('general', 'One more separated link'), 'url' => '#'),
						),
					),
				),
			), true);
			
			echo $this->widget('zii.widgets.CMenu', array(
				'htmlOptions' => array('class' => 'nav navbar-nav login_items'),
				'items' => array(
					array(
						'label' => '',
						'url' => '',
						'itemOptions' => array('id' => 'profile_menu_item'),
//						'template' => '#{menu}#',
						'template' => '<a><div></div></a>',
					),
					array(
						'label' => Yii::t('general', 'Login'),
						'url' => '',
						'itemOptions' => array('id' => 'login_menu_item'),
					),
				),
			), true);
			?>
		</div>
	</div>
</div>

<?php

if (!empty(Yii::app()->user->id))
{
	echo 'zzzz';
}
else
{
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id' => 'doc_consent_dialog',
		'cssFile' => null,
		'options' => array(
			'title' => Yii::t('general', 'Modal title'),
			'modal' => true,
			'autoOpen' => false,
			'show' => array('effect' => 'size'),
			'hide' => array('effect' => 'size'),
			'position' => 'top',
			'width' => 800,
			'height' => 'auto',
			'draggable' => false,
			'resizable' => false,
			'closeText' => Yii::t('general', 'Close'),
			'dialogClass' => 'login_dialog',
			'buttons' => array(
				array(
					'text' => Yii::t('general', 'Submit'),
					'class' => 'btn btn-primary',
					'click' => 'js:function()
					{
						submitLoginForm();
					}',
				),
				array(
					'text' => Yii::t('general', 'Close'),
					'class' => 'btn btn-default',
					'click' => 'js:function()
					{
						$(this).dialog("close");
					}',
				),
			),
		),
	));
	echo '<div class="_content"></div>';
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	
	Yii::app()->clientScript->registerScript(uniqid(), "
		
		$('#login_menu_item').on('click', function()
		{
			var jDialog = $('#doc_consent_dialog');
			var jDialogContent = jDialog.children().first();
			
			jDialog.parent().find('button').attr('tabindex', -1); // Buttons tabulation bug-fix.
			
			jDialog.dialog({
				open: function(event, ui) {
					window.setTimeout(function() { jDialog.parent().find('button').removeAttr('tabindex'); }, 600);
				}
			});
			
			jDialogContent.html('zzz');
			
			jDialog.parent().css({position:'absolute'}); // Overlay height bug-fix.
			
			jDialog.dialog('open');
		});
		
		$('#test').on('click', function()
		{
//			$('#myModal').modal('show');
//			console.log($('#myModal'));
		});
		
		function submitLoginForm()
		{
			alert('submitLoginForm');
		}
		
	", CClientScript::POS_READY);
	
	?>
	
	<!-- Button trigger modal -->
	<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
		Launch demo modal
	</button>

	<button id="test" class="btn btn-primary btn-lg">
		Launch
	</button>

	<!-- Modal -->
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	
	<?php
}