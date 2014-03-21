<?php
$baseUrl = Yii::app()->theme->baseUrl;

Yii::app()->clientScript->registerCssFile($baseUrl.'/assets/css/marketing_demo.css');
Yii::app()->clientScript->registerCssFile('http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700');
?>

<div id="mainCarousel" class="carousel slide" data-ride="carousel">
	
	<ol class="carousel-indicators">
		<li data-target="#mainCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#mainCarousel" data-slide-to="1"></li>
		<li data-target="#mainCarousel" data-slide-to="2"></li>
	</ol>
	
	<div class="carousel-inner">
		<div class="item active">
			<img />
			<div class="_content">
				<div class="_headerOne">Attention Attorneys:</div>
				<div class="_headerTwo">Not all Internet Marketing/SEO vendors are created equal.</div>
				<div id="pcImageOne"></div>
				<div id="pcImageTwo"></div>
			</div>
			<div class="carousel-caption">
			</div>
		</div>
		<div class="item">
			<img />
			<div class="carousel-caption">
				Attention Attorneys 2
			</div>
		</div>
		<div class="item">
			<img />
			<div class="carousel-caption">
				Attention Attorneys 3
			</div>
		</div>
	</div>
	
	<a class="left carousel-control" href="#mainCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	
	<a class="right carousel-control" href="#mainCarousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
	
</div>

<?php
Yii::app()->clientScript->registerScript(uniqid(), "
	
	$(document).ready(function()
	{
		$('.carousel').carousel({
		  interval: false
		});
	});
	
", CClientScript::POS_HEAD);