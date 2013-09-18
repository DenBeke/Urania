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
		echo "Username or password invalid";
	}
}
else {
	//Form
}

?>
<form name="input" action="index.php?page=login" method="post">
Username: <input type="text" name="user">
Password: <input type="password" name="pass">
<input type="submit" value="Submit">
</form>