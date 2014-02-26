<?php
$cs = Yii::app()->clientScript;

$cs->scriptMap = array(
	'jquery.js' => false,
	'jquery.min.js' => false,
	'jquery-ui.js' => false,
	'jquery-ui.min.js' => false,
);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl.'/assets/css/jquery-ui-1.10.4.modified.css'; ?>" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl.'/assets/css/bootstrap.min.css'; ?>" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl.'/assets/css/bootstrap-theme.min.css'; ?>" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl.'/assets/css/general.css'; ?>" />
		<script src="<?php echo Yii::app()->theme->baseUrl.'/assets/js/jquery-1.11.0.min.js'; ?>"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl.'/assets/js/bootstrap-3.1.1.min.js'; ?>"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl.'/assets/js/jquery-ui-1.10.4.min.js'; ?>"></script>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>
	<body>
<!--		<div id="page" class="container">-->
<!--			<div id="mainmenu">-->
<!--				--><?php
//				$this->widget('zii.widgets.CMenu',array(
//					'items'=>array(
//						array('label'=>'Home', 'url'=>array('/site/index')),
//						array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
//						array('label'=>'Contact', 'url'=>array('/site/contact')),
//						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
//					),
//				));
//				?>
<!--			</div>-->
<!--			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">-->
<!--				<div class="container">-->
<!--					<div class="navbar-header">-->
<!--						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
<!--							<span class="sr-only">Toggle navigation</span>-->
<!--							<span class="icon-bar"></span>-->
<!--							<span class="icon-bar"></span>-->
<!--							<span class="icon-bar"></span>-->
<!--						</button>-->
<!--						<a class="navbar-brand" href="#">Bootstrap theme</a>-->
<!--					</div>-->
<!--					<div class="navbar-collapse collapse">-->
<!--						<ul class="nav navbar-nav">-->
<!--							<li class="active"><a href="#">Home</a></li>-->
<!--							<li><a href="#about">About</a></li>-->
<!--							<li><a href="#contact">Contact</a></li>-->
<!--							<li class="dropdown">-->
<!--								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>-->
<!--								<ul class="dropdown-menu">-->
<!--									<li><a href="#">Action</a></li>-->
<!--									<li><a href="#">Another action</a></li>-->
<!--									<li><a href="#">Something else here</a></li>-->
<!--									<li class="divider"></li>-->
<!--									<li class="dropdown-header">Nav header</li>-->
<!--									<li><a href="#">Separated link</a></li>-->
<!--									<li><a href="#">One more separated link</a></li>-->
<!--								</ul>-->
<!--							</li>-->
<!--						</ul>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<br/>-->
			<?php
				echo $this->widget('application.widgets.mainMenu.mainMenu', array(
				), true);
			?>
<!--			<br/>-->
<!--			<div class="clear"></div>-->
			<div class="container theme-showcase" role="main">
				<?php echo $content; ?>
			</div>
<!--			<div class="clear"></div>-->
<!--		</div>-->
	</body>
</html>