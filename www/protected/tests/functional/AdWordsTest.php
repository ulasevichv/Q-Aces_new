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
		$jQueryScript = fread($handle, filesize($fileName));
		fclose($handle);
		
		$this->open($this->rootTestUrl);
		
		$inputKeywordXpath = '//input[@class="aw-previewtool-searchterm-input"]';
		$btnPreviewXpath = '//button[contains(@class, "aw-previewtool-searchterm-button")][@gwtdebugid="preview-ads-button"]';
		$selectDomainXpath = '//select[@gwtdebugid="diagnose-keywords-domains"]';
		$selectLanguageXpath = '//select[@gwtdebugid="diagnose-keywords-languages"]';
		$linkLocationXpath = '//a[@gwtdebugid="location-edit-link"]';
		$inputLocationXpath = '//input[@gwtdebugid="geo-search-box"]';
		$tableLocationsXpath = '//table[@gwtdebugid="geotargets-table"]';
		
		$this->waitForElementPresent($inputKeywordXpath);
		
		$this->runScript($jQueryScript);
		
//		$this->pause(1000);
		
		$this->focus($inputKeywordXpath);
		$this->type($inputKeywordXpath, 'lawyer');
		$this->pause(100);
		$this->keyPressNative('16'); // Shift
		
		
		
//		
//		$this->click($inputKeywordXpath);
//		$this->focus($inputKeywordXpath);
//		
//		$this->pause(1000);
		
		
		
		
		
//		
//		
//		$this->pause(500);
//		
//		$this->runScript("$('button[gwtdebugid=\'preview-ads-button\']').removeAttr('disabled');");
		
		
		
		
		
//		$this->runScript("function test(value)
//		{
//			value = (typeof(value) != 'undefined' ? value : 'default');
//			
//			alert(value);
//		}");
		
//		$this->pause(100);
		
//		$this->runScript("test('new');");
		
//		$this->keyPress($inputKeywordXpath, '32');
		
//		$this->keyDown($inputKeywordXpath, "w");
//		$this->pause(1000);
//		$this->keyUp($inputKeywordXpath, "w");
		
//		$this->keyPressNative('l');
//		$this->keyPressNative('lawyer');
		
		
		
		
		
		
		
//		$this->click($btnPreviewXpath);
		
		$this->select($selectDomainXpath, 'value=com');
		$this->pause(20);
		
//		$requiredLanguageOptions = array('English', 'Английский');
		$requiredLanguageOptions = array('Английский');
		
		foreach ($requiredLanguageOptions as $requiredLanguageOption)
		{
			try
			{
				$this->select($selectLanguageXpath, 'value='.$requiredLanguageOption);
				
				break;
			}
			catch (Exception $ex) {}
		}

		$this->pause(20);
		
		$this->click($linkLocationXpath);
		$this->pause(20);

		$this->focus($inputLocationXpath);
		$this->type($inputLocationXpath, 'Los Angeles');
		$this->pause(100);
		$this->keyPressNative('16');
		$this->pause(400);
		
		// Get list of all matching locations.
		
		$this->runScript("function getMatchingLocations()
		{
			var jMatchingLocationsTable = $('div[gwtdebugid=\"geo-suggestions-pop-up\"] div[gwtdebugid=\"suggestions\"] table[gwtdebugid=\"geotargets-table\"]');
			
			var jRows = jMatchingLocationsTable.find('tbody > tr');
			
			var locations = [];
			
			for (var i = 0; i < jRows.length; i++)
			{
				var jRow = jRows.eq(i);
				
				var jLocationNameDiv = jRow.find('div[class=\"aw-geopickerv2-bin-target-name\"]');
				var jLocationTypeDiv = jRow.find('div[class=\"aw-geopickerv2-feature-type-box\"]');
				var jLocationLink = jRow.find('a[class=\"aw-geopickerv2-bin-action-link\"]');
				
				var locationName = String(jLocationNameDiv.html());
				var locationType = String(jLocationTypeDiv.html()).replace(' - ', '');
				
				locations.push({
					index : i,
					name : locationName,
					type : locationType
				});
				
				jLocationLink.attr('tempId', 'locationLink_'+i);
			}
			
			return JSON.stringify(locations);
		}");
		$this->pause(400);
		$locationsJson = $this->getEval("window.getMatchingLocations(); ");

		Yii::log($locationsJson, CLogger::LEVEL_TRACE, 'test');
		
		$locations = json_decode($locationsJson);
		
		if (count($locations) == 0)
		{
			Yii::log('ERROR: no suggested locations', CLogger::LEVEL_TRACE, 'test');
			return;
		}
		
		// Click first matching location.
		
//		$this->runScript("function clickFirstMatchingLocation()
//		{
//			
//		}");
//		$this->pause(400);
//		$result = $this->getEval("window.getMatchingLocations(); ");
		
		
		
		$firstLocationLinkXpath = '//a[@tempId="locationLink_'.$locations[0]->index.'"]';
		
		$this->click($firstLocationLinkXpath);

		$this->pause(100);

		$this->click($btnPreviewXpath);
		
		
		
		
		
		
		$this->pause(8000);
		
		Yii::log('TEST COMPLETED', CLogger::LEVEL_TRACE, 'test');
	}
}