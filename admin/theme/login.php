<?php
/*
Theme part for login

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>


<div class="page">


	<h2>Login</h2>
	
	
	<?php
	
	if($this->notification != NULL) {
	?>
	<div class="notification <?php echo $this->notification->type ?>">
		<?php echo $this->notification->message; ?>
	</div>
	<?php
	}
	?>



	<?php if($this->notification == NULL or $this->notification->type != 'success') { ?>

	<form method="post" action="<?php echo SITE_URL; ?>admin/login/" class="pure-form">
			
		<fieldset class="pure-group">
			<input type="text" name="username" value="" class="pure-input-1-2" placeholder="Username">
			<input type="password" name="password" value="" class="pure-input-1-2" placeholder="Password">
		</fieldset>
				
		<input type="submit" name="submit" value="Login" class="pure-button pure-input-1-2 pure-button-primary">
			
			
	</form>
	
	<?php } ?>


</div>