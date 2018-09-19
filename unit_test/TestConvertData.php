<?php
	require_once('ConvertData.php');
	 
	class TestConvertData extends PHPUnit_Framework_TestCase {
	  	public function setUp(){ }
	  	public function tearDown(){ }
	 
	  	public function testConvertDataIsValid() {
	    	$testObj = new ConvertData();
	    	$summ = 1000;
	    	$this->assertTrue($testObj->convert($summ) !== false);
	  	}
	}
?>