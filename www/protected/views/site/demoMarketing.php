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
		<li data-target="#mainCarousel" data-slide-to="3"></li>
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
		<div class="item">
			<img />
			<div class="_content">
				<div class="_textBlack _textPart1">
					Only one law firm from each law practice area (Personal Injury, DUI, Divorce, etc.) and metro area will be allowed in to the FREE private beta.
					Time is running out - sign up!
				</div>
				<div class="_map_container">
					<div id="statesMap" class="_map">
					</div>
					<div class="_map_key_container">
						<div class="_map_key">
							<div class="_item">
								<div class="_img map_circle map_circle_yellow"></div>
								<div class="_text">1 practice/area</div>
							</div>
							<div class="_item">
								<div class="_img map_circle map_circle_orange"></div>
								<div class="_text">2 practices/area</div>
							</div>
							<div class="_item">
								<div class="_img map_circle map_circle_red"></div>
								<div class="_text">3 practices/area</div>
							</div>
						</div>
					</div>
				</div>
				<div class="_textBlack _textPart2">
					Interested to see if you qualify? Want more information?<br/>Don't wait until it is too late!
				</div>
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
	
	var mapCoords = [
		{x:128, y:291, cityName:'Phoenix'},
		{x:446, y:274, cityName:'Atlanta'},
		{x:564, y:150, cityName:'New York'},
		{x:50,  y:263, cityName:'Los Angeles'},
		{x:410, y:164, cityName:'Chicago'},
		{x:317, y:312, cityName:'Dallas'},
		{x:331, y:348, cityName:'Houston'},
		{x:558, y:161, cityName:'Philadelphia'},
		{x:538, y:178, cityName:'Washington D.C.'},
		{x:536, y:380, cityName:'Ft. Lauderdale'},
		{x:586, y:111, cityName:'Boston'},
		{x:16,  y:205, cityName:'San Francisco'},
		{x:60,  y:263, cityName:'Riverside'},
		{x:462, y:146, cityName:'Detroit'},
		{x:332, y:124, cityName:'Minneapolis'},
		{x:387, y:271, cityName:'St. Louis'},
		{x:217, y:202, cityName:'Denver'}
	];
	
	var mapCircles = [];
	var mapAnimationIntervalId = -1;
	var numMapCirclesDrawn = 0;
	
	$(document).ready(function()
	{
		$('.carousel').carousel({
		  interval: false
		});
		
		resetMapCircles();
		startMapAnimation();
	});
	
	function getMapCircleByMapCoord(mapCoord)
	{
		for (var i = 0; i < mapCircles.length; i++)
		{
			var circle = mapCircles[i];
			
			if (circle.x == mapCoord.x && circle.y == mapCoord.y) return circle;
		}
		
		return null;
	}
	
	function resetMapCircles()
	{
		mapCircles = [];
		
		mapCoords.forEach(function(mapCoord, i)
		{
			mapCircles.push({
				id : i,
				x : mapCoord.x,
				y : mapCoord.y,
				level : 0
			});
		});
	}
	
	function startMapAnimation()
	{
		mapAnimationIntervalId = window.setInterval(function () { drawMapCircle(); }, 1000);
	}
	
	function drawMapCircle()
	{
		var jMap = $('#statesMap');
		
		var notFinishedCircles = [];
		
		mapCircles.forEach(function(circle, i)
		{
			if (circle.level < 3) notFinishedCircles.push(circle);
		});
		
		if (notFinishedCircles.length == 0)
		{
			resetMapCircles();
			jMap.html('');
			return;
		}
		
		var index = Math.floor(Math.random()*notFinishedCircles.length);
		
		var circle = notFinishedCircles[index];
		
		var newCircleSize = { x : 0, y : 0 };
		var newCircleCssClass = '';
		
		switch (circle.level)
		{
			case 0:
			{
				newCircleSize = { x : 25, y : 25 };
				newCircleCssClass = 'map_circle_yellow';
				break;
			}
			case 1:
			{
				newCircleSize = { x : 34, y : 34 };
				newCircleCssClass = 'map_circle_orange';
				break;
			}
			case 2:
			{
				newCircleSize = { x : 43, y : 43 };
				newCircleCssClass = 'map_circle_red';
				break;
			}
		}
		
		var circleX = Math.floor(circle.x - newCircleSize.x / 2);
		var circleY = Math.floor(circle.y - newCircleSize.y / 2);
		
		var style = 'position:absolute; left:'+circleX+'px; top:'+circleY+'px;';
		var circleHtml = '<div class=\"map_circle '+newCircleCssClass+'\" style=\"'+style+'\"></div>';
		
		jMap.append(circleHtml);
		
		circle.level++;
	}
	
", CClientScript::POS_HEAD);