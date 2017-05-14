<?php

require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';

use PHPUnit\Framework\TestCase;
require_once 'classes/AdditiveTest.class.php';
use com\rentroi\codechallenges\salesforce\classes\AdditiveTest;

class AdditiveTestTest extends TestCase {
    

    public function setUp() {
		$this->AdditiveTestObj = new AdditiveTest(20);
	}
       
        
    public function tearDown() {
		unset($this->AdditiveTestObj);
	}
        

    public function testAdditiveTest() {
		$this->assertTrue(
			$this->AdditiveTestObj->isAdditive,
			'Response should be True'
		);
	}
}