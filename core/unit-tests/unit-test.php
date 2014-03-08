<?php
/*
PHP Unit Tes framework

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/

/**
@brief Unit Test namespace

All classes of tests you want to run, must be in this namespace.  
If not placed in this namespace, the tests will not be recognized.
*/
namespace UnitTest;


require_once( dirname(__FILE__) . '/objects.php' );


$scenario = new Scenario;



/**
@brief Class for performing unit tests

Unit tests are written using classes and function.
- Each class represents a test case
- Each function represents a test section
- Within this functions you can call the `REQUIRE` functions


    <?php
    
    namespace UnitTest;
    
    class StringTest extends UnitTest {
    
    
	    	public function Word() {
	    		$this->REQUIRE_TRUE('word', 'word');
	    	}
	    
	    	public function Sentence() {
	    		$var1 = 'hello world!';
	    		$var2 = 'hello world!';
	    		$this->REQUIRE_TRUE($var1, $var2);
	    	}
	}
	?>
    	


Execute the `run` function to perform all declared tests.

All performed tests will be placed in the `Scenario`,
which can be accessed in orde to view te test results.  
You can also output the test to html using the `write` function.
*/
class UnitTest {

	public function REQUIRE_TRUE($a, $b) {
		
		
		$test = array();
		$test['a'] = $a;
		$test['b'] = $b;
		
		if($a == $b) {
			
			$test['result'] = true;
			
		}
		else {
			$test['result'] = false;
			
		}
		
		$this->saveTest($test);
	
	}
	
	
	
	
	
	public function REQUIRE_FALSE($a, $b) {
	

	
	}
	
	
	
	private function saveTest($test) {
		
		
		global $scenario;
		$scenario->numberOfTest++;
		
		//Get the line from which the REQUIRE function is called
		$test['line'] = debug_backtrace()[1]['line'];
		
		//Get the method from which the REQUIRE function is called
		$method = debug_backtrace()[3]['args'][0][1];
		
		//Get class name without namespace in front of it
		$class = get_class($this);
		$class = explode('\\', $class);
		unset($class[0]);
		$class = implode('\\', $class);
		
		//Check if there is a test case with the given class name
		if(!isset($scenario->tests[$class])) {
			$case = new TestCase;
			$case->name = $class;
			$scenario->tests[$class] = $case;
		}
		
		//Check for the test section
		if(!isset($scenario->tests[$class]->sections[$method])) {
			$section = new TestSection;
			$section->name = $method;
			$scenario->tests[$class]->sections[$method] = $section;
		}
		else {
			$section  = $scenario->tests[$class]->sections[$method];
		}
		
		$section->tests[] = $test;
		
		//Count the number of failures
		if($test['result'] == false) {
			$section->success= false;
			$scenario->numberOfFailures++;
		}
		
	}
	
	
	
	public function write() {
	
		global $scenario;
		include(dirname(__FILE__) . '/theme/content.php');
	
	}
	
	
	public function run() {
		
		//Loop through all declared classes
		foreach (get_declared_classes() as $class) {
			
			//Check if class in 'UnitTest' namespace
			if(preg_match('/UnitTest\\.*/i', $class) and get_class($this) != $class) {
				
				//Loop through functions of that class
				foreach (get_class_methods($class) as $method) {
					
					$object = new $class;
					
					//If not a method of this class, we call the function
					if(!in_array($method, get_class_methods(get_class($this)))) {
						call_user_func(array($object, $method));
					}
				}
				
			} //end if
		
		} //end foreach	 
		
	} // end run()

}


