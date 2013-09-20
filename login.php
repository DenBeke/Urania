<div id="login" class="page">
<?php 


	require_once('./core/login.php');
	
	
	//login();
	
	
	
	
	//checkLoginDetails()
	
	
	if(isset($_POST['user']) and isset($_POST['pass'])) {
		if(checkLogindetails($_POST['user'], $_POST['pass'])) {
			echo "Correct login";
			
			login();
			
			echo "<script language=\"javascript\">\n";
			echo "window.location = \"index.php?page=admin\";\n";
			echo "</script>\n";
			
			
		}
		else {
			echo '<div class="error">Username or password invalid</div>';
		}
	}
	else {
		//Form
	}
	
	?>
	<form name="input" action="index.php?page=login" method="post">
	
		<p>
			Username
		</p>
		
		<p>
			<input type="text" name="user">
		</p>
		
		<p>
			Password
		</p>
		
		<p>
			<input type="password" name="pass">
		</p>
		
		<p>
			<input type="submit" value="Submit">
		</p>
		
	</form>

</div>