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
				<div class="_textWhite _textPart1">Attention Attorneys:</div>
				<div class="_textBlack _textPart2">Not all Internet Marketing/SEO vendors are created equal.</div>
				<div class="_laptops">
					<div class="_laptop _laptopOne">
						<div class="_title">Cost of Vendor #1</div>
						<div class="_img"></div>
					</div>
					<div class="_laptop _laptopTwo">
						<div class="_title">Cost of Vendor #2</div>
						<div class="_img"></div>
					</div>
				</div>
				<div class="_textBlack _textPart3">Until now, there was no clear way to know if you were getting a good deal on your marketing spend and how your
					cost per lead compares to others.</div>
			</div>
			<div class="carousel-caption">
			</div>
		</div>
		<div class="item">
			<img />
			<div class="_content">
				<div class="_textBlack _textPart1">
					Internet Marketing Fiduciaries (IMF) measures the effectiveness of the Internet Marketing/SEO vendor for your firm and compares you against
					similar law firms across the country, giving you the resources you need to come out on top in your local market.
				</div>
				<div class="_textYellow _textPart2">
					Possible Results From Your Internet Marketing Monthly Spend
				</div>
				<div class="_scale_container">
					<div class="_scale">
					</div>
				</div>
			</div>
			<div class="carousel-caption">
			</div>
		</div>
		<div class="item">
			<img />
			<div class="_content">
				<div class="_textBlack _textPart1">
					See how Internet Marketing Fiduciaries (IMF) can help you.
				</div>
				<div class="_video">
					<iframe width="600" height="400" frameborder="0" allowfullscreen="" src="//www.youtube.com/embed/sOWvEBTxUs0">
					</iframe>
				</div>
			</div>
			<div class="carousel-caption">
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