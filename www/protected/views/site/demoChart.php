<?php
$baseUrl = Yii::app()->theme->baseUrl;

Yii::app()->clientScript->registerScriptFile($baseUrl.'/assets/js/RGraph.common.core.js');
Yii::app()->clientScript->registerScriptFile($baseUrl.'/assets/js/RGraph.common.effects.js');
Yii::app()->clientScript->registerScriptFile($baseUrl.'/assets/js/RGraph.rose.modified.js');
Yii::app()->clientScript->registerCssFile($baseUrl.'/assets/css/roseChart.css');
?>

<h1><?php echo Yii::t('general', 'Chart demo'); ?></h1>

<div class="chart_container">
	<canvas id="roseChart" width="930" height="500">[No canvas support]</canvas>
	<div class="_header_section _section">
		<div class="_title">Political Climate</div>
		<div class="_desc">Every election cycle has its own issue;
		what Americans care about is constantly changing.
		Every January, the Pew Research Center for the
		People and the Press surveys Americans about
		what their top political priorities are for the year.
		There are their answers, going back to 2009.</div>
	</div>
	<div class="select_year_section _section">
		<div class="_title">Select Year</div>
		<div class="_content">
			<div id="year_2008" class="_year rotate_90">2008</div>
			<div id="year_2009" class="_year rotate_90">2009</div>
			<div id="year_2010" class="_year rotate_90">2010</div>
		</div>
	</div>
	<div class="select_party_section _section">
		<div class="_title">Select Party</div>
		<div class="_content">
			<div id="party_all" class="_party">
				<div class="_color _yellow"> </div>
				<div class="_text">All AMERICANS</div>
			</div>
			<div id="party_democrats" class="_party">
				<div class="_color _blue"> </div>
				<div class="_text">DEMOCRATS</div>
			</div>
			<div id="party_republicans" class="_party">
				<div class="_color _red"> </div>
				<div class="_text">REPUBLICANS</div>
			</div>
		</div>
	</div>
</div>

<?php
Yii::app()->clientScript->registerScript(uniqid(), "
	
	$('.chart_container ._year').on('click', function()
	{
		alert('ok');
	});
	
	var data = [40,100,60,30,20,50,40,80,60,30,20,50];
//	var data = [[20,60],[20,40],[10,50],[40,30],[70,50],[80,30],[40,50],[30,40],[20,60],[40,50]];
	
	var jCanvas = $('#roseChart');
//	var hdc = jCanvas.get(0).getContext('2d');
	
	var chartSize = { x : jCanvas.attr('width'), y : jCanvas.attr('height') };
	
	drawRose(data, chartSize);
	
	function drawRose(roseData, chartSize)
	{
		var rose = new RGraph.Rose('roseChart', roseData)
			.Set('radius', 220)
			.Set('centerx', chartSize.x - 300)
			.Set('centery', 250)
//			.Set('gutter.left', 0)
			.Set('ymax', 100)
			.Set('margin', 1)
//			.Set('angles.start', -(HALFPI/2))
			.Set('angles.start', 0)
			.Set('labels.axes', '')
			.Set('labels', ['Economy','Jobs','Terrorism','Education','Health Care','Military','Energy','Insurance','Taxes','Immigration','Global Trade','Climate'])
			.Set('labels.position', 'center')
			.Set('text.font', 'Consolas')
			.Set('text.size', 8)
//			.Set('text.color', '#636363')
			.Set('text.color', '#aaaaaa')
			.Set('background.grid', true)
			.Set('background.grid.color', '#212121')
//			.Set('background.grid.color2', '#636363')
			.Set('background.grid.color2', 'rgba(255, 255, 255, 0.07)')
			.Set('background.grid.color3', '#2d2d2d')
			.Set('background.grid.count', 10)
			.Set('background.grid.spokes', 12)
			.Set('background.grid.spokes.overhang', -10)
			.Set('background.axes', false)
			.Set('colors', ['#ffff00']);
//			.Set('colors.sequential', true);
		RGraph.Effects.Rose.RoundRobin(rose);
//		RGraph.Effects.Rose.Grow(rose);
	}
	
", CClientScript::POS_READY);