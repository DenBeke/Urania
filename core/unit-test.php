<?php 

namespace UnitTest;



$numberOfTest = 0;
$tests;



class UnitTest {

	public function REQUIRE_TRUE($a, $b) {
		
		$trace = debug_backtrace();
		$previousCall = $trace[2]; // 0 is this call, 1 is call in previous function, 2 is caller of that function
		$method = $previousCall['args'][0][1];
		
		
		global $numberOfTest;
		global $tests;
		$numberOfTest++;
		
		$test = array();
		$test['a'] = $a;
		$test['b'] = $b;
		
		if($a == $b) {
			
			$test['result'] = true;
			
		}
		else {
			$test['result'] = false;
			
		}
		
		$tests[get_class($this)][$method][] = $test;
	}
	
	
	
	
	
	public function REQUIRE_FALSE($a, $b) {
	
	
		$trace = debug_backtrace();
		$previousCall = $trace[2]; // 0 is this call, 1 is call in previous function, 2 is caller of that function
		$method = $previousCall['args'][0][1];
		
		
		global $numberOfTest;
		global $tests;
		$numberOfTest++;
		
		$test = array();
		$test['a'] = $a;
		$test['b'] = $b;
		
		if($a != $b) {
			
			$test['result'] = true;
			
		}
		else {
			$test['result'] = false;
			
		}
		
		$tests[get_class($this)][$method][] = $test;
	
	}
	
	
	
	
	private function write() {
	
		global $tests;
	
	
		foreach ($tests as $class => $case) {
		
			//Strip namespace
			$class = explode('\\', $class);
			$class = $class[1];
		
			?>
			<h3><?php echo $class; ?></h3>
			<table>
			
				<tbody>
				
					<?php foreach ($case as $function => $section) { ?>
					
						<tr>
						
							<?php 
							$passed = true;
							foreach ($section as $test) { 
								if(!$test['result']) {
									$passed = false;
								}
							}
							?>
						
							<td>
							<?php echo $function; ?>
							</td>
							
							<td>
							
		
							
							<?php 
							$passed = true;
							foreach ($section as $test) { 
								if(!$test['result']) {
									$passed = false;
								}
							}
							
							
							
							if($passed) {
							
								echo 'OK';
							
							}
							else {
							
								echo 'FAILED';
							
							}
							
							
							
							?>
							
							
							</td>
							
						</tr>
						
					<?php	
					} ?>
				
				
				</tbody>
			
			</table>
	
	
	<?php
		}
	
	}
	
	
	public function run() {
		foreach (get_declared_classes() as $class) {
			if(preg_match('/UnitTest\\.*/i', $class) and get_class($this) != $class) {
				
				//Loop through functions of the class
				foreach (get_class_methods($class) as $method) {
					
					$object = new $class;
					//$this->tests[$class] = array();
					
					if(!in_array($method, get_class_methods(get_class($this)))) {
			
						
						
						call_user_func(array($object, $method));
					}
				}
				
			}
		}
		
		
		$this->write();
		
		
	}

}




class Equals extends UnitTest {


	public function Zero() {
		$this->REQUIRE_TRUE(0,0);
	}
	
	public function One() {
		$this->REQUIRE_TRUE(1,1);
		$this->REQUIRE_FALSE(1,-1);
	}
	
}



$t = new UnitTest;

$t->run();

?>

