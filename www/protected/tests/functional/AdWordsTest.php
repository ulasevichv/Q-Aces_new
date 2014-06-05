<?php

//require_once('z:/usr/local/php5/PEAR/PHPUnit/Extensions/Selenium2TestCase.php');

//class AdWordsTest extends PHPUnit_Extensions_Selenium2TestCase
//{
////	public static $browsers = array(
//////		array(
//////			'name'    => 'Firefox on Linux',
//////			'browser' => '*firefox /usr/lib/firefox/firefox-bin',
//////			'host'    => 'my.linux.box',
//////			'port'    => 4444,
//////			'timeout' => 30000
//////		),
////		array(
////			'name'    => 'firefox',
////			'browser' => '*firefox d:/Programs/Mozilla Firefox/firefox.exe',
////			'host'    => 'localhost',
////			'port'    => 4444,
////			'timeout' => 10000
////		),
////	);
//
//	protected function setUp()
//	{
////		$this->setBrowser('firefox');
//
//
////		$this->setBrowser('firefox', '*firefox3 d:/Programs/Mozilla Firefox/firefox.exe', 'localhost', 4444, 10000);
//
////		$this->setBrowser('Firefox', '*firefox3 d:/Programs/Mozilla Firefox/firefox.exe', 'localhost', 4444, 10000);
//
//
//		$this->setBrowserUrl('http://www.example.com/');
//
//
//	}
//
//	public function testTitle()
//	{
//		$this->url('http://www.example.com/');
//		$this->assertEquals('Example WWW Page', $this->title());
//	}
//
//}

class AdWordsTest extends WebTestCase
{
	private $rootTestUrl = 'http://adwords.google.com/d/AdPreview';
	private $jQueryFilePath = '';
	private $jQueryScript = '';
	private $numLinksLimit = 30;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setBrowserUrl($this->rootTestUrl);
		$this->jQueryFilePath = 'Z:\home\mgh\www\themes\magellan\assets\js\jquery-1.9.1.min.js';
	}
	
	public function testIndex()
	{
		$fileName = $this->jQueryFilePath;
		$handle = fopen($fileName, 'r');
		$this->jQueryScript = fread($handle, filesize($fileName));
		fclose($handle);
		
		$this->open($this->rootTestUrl);
		
		$inputKeywordXpath = '//input[@class="aw-previewtool-searchterm-input"]';
		$btnPreviewXpath = '//button[contains(@class, "aw-previewtool-searchterm-button")][@gwtdebugid="preview-ads-button"]';
		$selectDomainXpath = '//select[@gwtdebugid="diagnose-keywords-domains"]';
		$selectLanguageXpath = '//select[@gwtdebugid="diagnose-keywords-languages"]';
		$linkLocationXpath = '//a[@gwtdebugid="location-edit-link"]';
		$inputLocationXpath = '//input[@gwtdebugid="geo-search-box"]';
		
//		$this->waitForElementPresent($inputKeywordXpath);
		$this->waitForElementPresent($inputLocationXpath);
		
		$this->runScript($this->jQueryScript);
		
//		$this->pause(1000);
		
		$this->focus($inputKeywordXpath);
		$this->type($inputKeywordXpath, 'lawyer');
		$this->pause(100);
		$this->keyPressNative('16'); // Shift
		
		$this->select($selectDomainXpath, 'value=com');
//		$this->select($selectDomainXpath, 'value=by');
//		$this->pause(20);
		$this->pause(1000);
		
		$requiredLanguageOptions = array('English', 'Английский');
//		$requiredLanguageOptions = array('Английский');
//		$requiredLanguageOptions = array('Dutch');
		
		foreach ($requiredLanguageOptions as $requiredLanguageOption)
		{
			try
			{
				$this->select($selectLanguageXpath, 'value='.$requiredLanguageOption);
				
				break;
			}
			catch (Exception $ex) {}
		}
		
//		$this->pause(20);
		$this->pause(1000);
		
		$this->click($linkLocationXpath);
		$this->pause(20);
		
		$this->focus($inputLocationXpath);
		$this->type($inputLocationXpath, 'Los Angeles');
		$this->pause(100);
		$this->keyPressNative('16');
//		$this->pause(400);
		$this->pause(2000);
		
		// Get list of all matching locations.
		
		$result = $this->getMatchingLocations();
		
		if ($result->error != '')
		{
			Yii::log('ERROR: '.$result->error, CLogger::LEVEL_TRACE, 'test');
			return;
		}
		
		$locations = $result->data;
		
//		Yii::log('LOCATIONS['.count($locations).']: '.json_encode($locations), CLogger::LEVEL_TRACE, 'test');
		
		// Clicking first matching location.
		
		$firstLocationLinkXpath = '//a[@tempid="locationLink_'.$locations[0]->index.'"]';
		
		$this->click($firstLocationLinkXpath);
		$this->pause(1000);
		
		// Calling preview.
		
		$this->click($btnPreviewXpath);
		$iframePreviewXpath = '//iframe[@gwtdebugid="diagnosticRootView-resultsPanel"]';
		
		$this->pause(1500);
		
		if (!$this->isElementPresent($iframePreviewXpath))
		{
			Yii::log('ERROR: no results iframe found', CLogger::LEVEL_TRACE, 'test');
			return;
		}
		
		// Getting iframe src.
		
		$result = $this->getResultsIFrameSrc();
		
		if ($result->error != '')
		{
			Yii::log('ERROR: '.$result->error, CLogger::LEVEL_TRACE, 'test');
			return;
		}
		
		
		
//		$this->runScript("");
//		$this->pause(400);
//		$resultsIframeSrc = $this->getEval("window.getResultsIframeSrc();");
//		
//		$this->open($resultsIframeSrc);
		
		Yii::log('FINISHED', CLogger::LEVEL_TRACE, 'test');
		return;
		
		// Getting links.
		
		$links = array();
		
		$pageIndex = 1;
		
		while (true)
		{
			if ($pageIndex != 1)
			{
				$linkXpath = '//table[@id="nav"]/tbody/tr/td[position()='.(1+$pageIndex).']/a';
				
				if (!$this->isElementPresent($linkXpath)) break;
				
				$this->click($linkXpath);
				$this->pause(500);
			}
			
			$pageLinks = $this->getPageLinks();
			$links = array_merge($links, $pageLinks);
			
			if (count($links) >= $this->numLinksLimit) break;
			
			$pageIndex++;
		}
		
		Yii::log('LINKS COUNT: '.count($links), CLogger::LEVEL_TRACE, 'test');
		Yii::log('LINKS: '.json_encode($links), CLogger::LEVEL_TRACE, 'test');
		
		$this->pause(8000);
		
		Yii::log('TEST COMPLETED', CLogger::LEVEL_TRACE, 'test');
	}
	
	private function getMatchingLocations()
	{
		$this->runScript("
		
		function jsGetMatchingLocations()
		{
			var error = '';
			var locations = [];
			
			try
			{
				var jLocationsPopupDiv = $('div[gwtdebugid=\"geo-suggestions-pop-up\"]');
				
				if (jLocationsPopupDiv.length == 0) throw new Error('jLocationsPopupDiv.length is zero');
				
				var jSuggestionsDiv = jLocationsPopupDiv.find('div[gwtdebugid=\"suggestions\"]');
				
				if (jSuggestionsDiv.length == 0) throw new Error('jSuggestionsDiv.length is zero');
				
				var jLocationsTable = jSuggestionsDiv.find('table[gwtdebugid=\"geotargets-table\"]');
				
				if (jLocationsTable.length == 0) throw new Error('jLocationsTable.length is zero');
				
				var jRows = jLocationsTable.find('tbody > tr');
				
				if (jRows.length == 0) throw new Error('jRows.length is zero');
				
				for (var i = 0; i < jRows.length; i++)
				{
					var jRow = jRows.eq(i);
					
					var jLocationNameDiv = jRow.find('div[class=\"aw-geopickerv2-bin-target-name\"]');
					var jLocationTypeDiv = jRow.find('div[class=\"aw-geopickerv2-feature-type-box\"]');
					var jLocationLink = jRow.find('a[class=\"aw-geopickerv2-bin-action-link\"]');
					
					var locationName = String(jLocationNameDiv.text());
					var locationType = String(jLocationTypeDiv.text()).replace(' - ', '');
					
					locations.push({
						index : i,
						name : locationName,
						type : locationType
					});
					
					jLocationLink.attr('tempid', 'locationLink_'+i); // Attribute names can be case sensitive, depending on a browser - use lower case.
				}
			}
			catch (ex)
			{
				error = ex.message;
			}
			
			var result = {
				error : error
			};
			
			if (error == '')
			{
				result.data = locations;
			}
			
			return JSON.stringify(result);
		}
		
		");
		$this->pause(400);
		$json = $this->getEval("window.jsGetMatchingLocations();");
		
		$result = json_decode($json);
		
		return $result;
	}
	
	private function getResultsIFrameSrc()
	{
		$this->runScript("
		
		function jsGetResultsIFrameSrc()
		{
			var error = '';
			var src = null;
			
			try
			{
				var jIFrame = $('iframe[gwtdebugid=\"diagnosticRootView-resultsPanel\"]');
				
				if (jIFrame.length == 0) throw new Error('jIFrame.length is zero');
				
				src = jIFrame.attr('src');
				
				if (src == null || src == '') throw new Error('jIFrame.src is empty');
			}
			catch (ex)
			{
				error = ex.message;
			}
			
			var result = {
				error : error
			};
			
			if (error == '')
			{
				result.data = src;
			}
			
			return JSON.stringify(result);
		}
		
		");
		$this->pause(400);
		$json = $this->getEval("window.jsGetResultsIFrameSrc();");
		
		$result = json_decode($json);
		
		return $result;
	}
	
	private function getPageLinks()
	{
		// Reloading of jQuery is required because page gets reloaded.
		
		$this->runScript($this->jQueryScript);
		$this->pause(200);
		
		$this->runScript("
		
		function trim(str)
		{
			if (typeof str !== 'string') str = str.toString();
			
			return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
		}
		
		function jsGetPageLinks()
		{
			var links = [];
			
			var jResultsDiv = $('#ires');
			
			jResultsDiv.css('border', '2px solid red');
			
			var jItemGroups = jResultsDiv.find('div.srg');
			
			for (var i = 0; i < jItemGroups.length; i++)
			{
				var jItemGroup = jItemGroups.eq(i);
				
				jItemGroup.css('border', '2px solid blue');
				
				var jItems = jItemGroup.find('li.g');
				
				if (typeof(console) != 'undefined') console.log('jItems.length: ' + jItems.length);
				
				for (var j = 0; j < jItems.length; j++)
				{
					var jItem = jItems.eq(j);
					
					jItem.css('border', '2px solid green');
					
					var jDiv = jItem.find('div.s');
					
					jDiv.css('border', '1px dotted #999900');
					
//					var jLink = jDiv.find('cite._Tc'); // Deprecated.
//					var jLink = jDiv.find('cite._0d');
					var jLink = jDiv.find('cite');
					
					jLink.css('border', '1px solid #ff0000');
					
//					var linkUrl = jLink.html(); // Wrong method.
					var linkUrl = jLink.text();
					
					if (linkUrl == null || linkUrl == '') continue;
					
					var greaterThanIndex = linkUrl.indexOf('›');
					
					if (greaterThanIndex != -1)
					{
						linkUrl = linkUrl.substr(0, greaterThanIndex);
					}
					
					var doubleDotIndex = linkUrl.indexOf('..');
					
					if (doubleDotIndex != -1)
					{
						linkUrl = linkUrl.substr(0, doubleDotIndex);
					}
					
					linkUrl = linkUrl.replace('<b>', '');
					linkUrl = linkUrl.replace('</b>', '');
					
					if (linkUrl.lastIndexOf('/') == linkUrl.length - 1)
					{
						linkUrl = linkUrl.substr(0, linkUrl.length - 1);
					}
					
					linkUrl = trim(linkUrl);
					
					links.push({
						url : linkUrl
					});
				}
			}
			
			return JSON.stringify(links);
		}
		
		");
		$this->pause(400);
		$linksJson = $this->getEval("window.jsGetPageLinks();");
		
		return json_decode($linksJson);
	}
}