<?php


namespace UnitTest;



function test() {
	//throw new \exception('Error');
}


class Example extends UnitTest {
	
	
	private $testVarA;
	private $testVarB;
	
	
	public function __construct() {
		
		$this->testVarA = 'A random text string that will not be needed to redefined during the tests.';
		
	}
	
	
	public function Assignment() {
		
		$this->testVarB = $this->testVarA;
		$this->REQUIRE_EQUAL($this->testVarB, $this->testVarA);
		
		$this->REQUIRE_THROWS(test());
		
	}
	
	
	public function AnotherTest() {
		
		$var = explode(' ', $this->testVarA);
		$var = implode(' ', $var);
		
		$this->REQUIRE_EQUAL($var, $this->testVarA);
		
	}
	
	
}


?>