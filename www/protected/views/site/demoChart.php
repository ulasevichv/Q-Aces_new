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
			<div id="year_2010" class="_year rotate_90" selected="">2010</div>
		</div>
	</div>
	<div class="select_party_section _section">
		<div class="_title">Select Party</div>
		<div class="_content">
			<div id="party_all" class="_party" selected="">
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
	
	var selectedYear = '';
	var selectedParty = '';
	var roseChart = null;
	var graphData = {
		2008 : {
			all : [40,60,20,0,10,0,0,50,20,0,20,10],
			democrats : [60,30,20,10,40,0,0,30,20,0,40,10],
			republicans : [20,60,20,10,20,10,30,40,20,0,0,10]
		},
		2009 : {
			all : [60,80,40,10,40,20,20,70,40,10,40,30],
			democrats : [80,50,40,30,60,0,20,50,40,10,60,30],
			republicans : [40,80,40,30,40,30,50,60,40,10,20,30]
		},
		2010 : {
			all : [80,100,60,30,60,50,40,90,60,30,60,50],
			democrats : [100,70,60,50,80,10,40,70,60,30,80,50],
			republicans : [60,100,60,50,60,50,70,80,60,30,40,50]
		}
	};
	
	$(document).ready(function()
	{
		updateSelectedData();
		
		$('.chart_container ._year').on('click', function()
		{
			$('.chart_container ._year').removeAttr('selected');
			$(this).attr('selected', '');
			
			updateSelectedData();
		});
		
		$('.chart_container ._party').on('click', function()
		{
			$('.chart_container ._party').removeAttr('selected');
			$(this).attr('selected', '');
			
			updateSelectedData();
		});
	});
	
	function updateSelectedData()
	{
		var oldSelectedYear = selectedYear;
		var oldSelectedParty = selectedParty;
		
		selectedYear = $('.chart_container ._year[selected]').attr('id').replace('year_', '');
		selectedParty = $('.chart_container ._party[selected]').attr('id').replace('party_', '');
		
		if (selectedYear != oldSelectedYear || selectedParty != oldSelectedParty)
		{
			redrawGraph();
		}
	}
	
	function redrawGraph()
	{
		var jCanvas = $('#roseChart');
		var chartSize = { x : jCanvas.attr('width'), y : jCanvas.attr('height') };
		
		var data = graphData[selectedYear][selectedParty];
		
		console.log(data);
		
		var graphMainColor = null;
		
		switch (selectedParty)
		{
			case 'all': graphMainColor = '#ffff00'; break;
			case 'democrats': graphMainColor = '#23c0ff'; break;
			case 'republicans': graphMainColor = '#d73a44'; break;
		}
		
		if (roseChart != null)
		{
			roseChart.data = data;
			roseChart.Set('colors', [graphMainColor]);
//			roseChart.Draw();
//			RGraph.Effects.Rose.RoundRobin(roseChart);
			RGraph.Effects.Rose.Grow(roseChart);
		}
		else
		{
			roseChart = new RGraph.Rose('roseChart', data)
				.Set('radius', 220)
				.Set('centerx', chartSize.x - 300)
				.Set('centery', 250)
//				.Set('gutter.left', 0)
				.Set('ymax', 100)
				.Set('margin', 1)
//				.Set('angles.start', -(HALFPI/2))
				.Set('angles.start', 0)
				.Set('labels.axes', '')
				.Set('labels', ['Economy','Jobs','Terrorism','Education','Health Care','Military','Energy','Insurance','Taxes','Immigration','Global Trade','Climate'])
				.Set('labels.position', 'center')
				.Set('text.font', 'Consolas')
				.Set('text.size', 8)
//				.Set('text.color', '#636363')
				.Set('text.color', '#aaaaaa')
				.Set('background.grid', true)
				.Set('background.grid.color', '#212121')
//				.Set('background.grid.color2', '#636363')
				.Set('background.grid.color2', 'rgba(255, 255, 255, 0.07)')
				.Set('background.grid.color3', '#2d2d2d')
				.Set('background.grid.count', 10)
				.Set('background.grid.spokes', 12)
				.Set('background.grid.spokes.overhang', -10)
				.Set('background.axes', false)
				.Set('colors', [graphMainColor]);
//				.Set('colors.sequential', true);
//			roseChart.Draw();
			RGraph.Effects.Rose.RoundRobin(roseChart);
//			RGraph.Effects.Rose.Grow(roseChart);
		}
	}
	
", CClientScript::POS_HEAD);