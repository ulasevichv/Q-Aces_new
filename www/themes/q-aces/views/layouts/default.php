<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl.'/assets/css/bootstrap.min.css'; ?>" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl.'/assets/css/bootstrap-theme.min.css'; ?>" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl.'/assets/js/bootstrap.min.js'; ?>"></script>
		
	</head>
	<body>
		<?php echo $content; ?>
	</body>
</html>