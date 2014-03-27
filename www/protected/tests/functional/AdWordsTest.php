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
////		$this->focus($inputKeywordXpath);
//		$this->click($btnPreviewXpath);
//		
//		$this->pause(2000);
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

//		$this->waitForElementPresent($inputLocationXpath);
		$this->pause(200);

		$this->focus($inputLocationXpath);
		$this->type($inputLocationXpath, 'Los Angeles');
		$this->pause(100);
		$this->keyPressNative('16');
		
		$this->pause(500);
		
//		$html = $this->runScript("return $('table[gwtdebugid='\'geotargets-table\']').html();");
//		$html = $this->runScript("return 'ONETWOTHREE';");
		
		
		
//		$html = $this->executeScript("return 'ONE TWO THREE';");
		
//		Yii::log($html, CLogger::LEVEL_TRACE, 'test');

//		$this->runScript("
//			$('<div/>', {
//				id: 'foo',
//				title: 'Become a Googler',
//				rel: 'external',
//				text: 'Go to Google!'
//			}).appendTo('body');
//		");
		
		$this->pause(10000);
		
		Yii::log('TEST COMPLETED', CLogger::LEVEL_TRACE, 'test');
	}
}