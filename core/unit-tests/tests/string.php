<?php

namespace UnitTest;

class String extends UnitTest {


	public function Word() {
		$this->REQUIRE_TRUE('word', 'word');
	}

	public function Sentence() {
		$var1 = 'hello world!';
		$var2 = 'hello world!';
		$this->REQUIRE_TRUE($var1, $var2);
	}
	
	public function SentenceWithMoreThanTwoWords() {
		$this->REQUIRE_TRUE('this is a sentence', 'which will not be equal to this part');
	}
	
	public function AnotherSentence() {
		$this->REQUIRE_TRUE('hello world!', 'hello world!');
	}
	
	public function LoremIpsum() {
		$this->REQUIRE_TRUE('hello world!', 'hello world!');
	}
	
	public function DolerSit() {
		$this->REQUIRE_TRUE('hello world!', 'hello world!');
	}

}

?>