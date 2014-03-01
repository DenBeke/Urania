<?php
/*
Theme part for login

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>


<div class="page">


	<h2>Logout</h2>
	
	
	<?php
	
	if($this->notification != NULL) {
	?>
	<div class="notification <?php echo $this->notification->type ?>">
		<?php echo $this->notification->message; ?>
	</div>
	<?php
	}
	?>


</div>