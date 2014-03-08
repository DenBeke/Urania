<?php

namespace UnitTest;

class Equals extends UnitTest {


	public function Zero() {
		$this->REQUIRE_TRUE(0,0);
	}

	public function One() {
		$this->REQUIRE_TRUE(0,1);
		$this->REQUIRE_TRUE(1,-1);
	}
	
	
	public function Two() {
		$this->REQUIRE_TRUE(0,0);
	}
	
	public function Three() {
		$this->REQUIRE_TRUE(0,0);
	}
	
	public function Four() {
		$this->REQUIRE_TRUE(0,0);
	}
	
	public function Five() {
		$this->REQUIRE_TRUE(0,0);
	}
	
	

}

?>