<?php
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
<!--			<div class="login_button">--><?php //echo CHtml::encode(Yii::t('general', 'Login')); ?><!--</div>-->
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
//					array('label' => Yii::t('general', 'Login'), 'url' => '#', 'itemOptions' => array('class' => 'zzz')),
				),
			), true);
			echo $this->widget('zii.widgets.CMenu', array(
				'htmlOptions' => array('class' => 'nav navbar-nav login_items'),
				'items' => array(
					array('label' => Yii::t('general', 'Login'), 'url' => '#', 'itemOptions' => array('class' => 'zzz')),
				),
			), true);
//			echo '<div class="login_button">'.CHtml::encode(Yii::t('general', 'Login')).'</div>';
			?>
<!--			<div class="login_button_container">--><?php //echo CHtml::encode(Yii::t('general', 'Login')); ?><!--</div>-->
		</div>
	</div>
</div>