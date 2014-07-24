<?php
/*
Theme part for admin User page

Author: Mathias Beke
Url: http://denbeke.be
Date: July 2014
*/
?>


<h2 id="admin-user-title">User Control Panel</h2>

<hr>

<div class="pure-g">

	<div class="pure-u-lg-1-2 pure-u-1">

		<h4><span class="glyphicon glyphicon-lock"></span> Change password</h4>


		<form action="<?php echo SITE_URL . 'admin/user/change-password'; ?>" method="post" class="pure-form pure-form-aligned">


			<fieldset>

				<div class="pure-control-group">
					<label for="old-password">Old password</label>
					<input name="old-password" type="password" value="">
				</div>

				<div class="pure-control-group">
					<label for="new-password">New password</label>
					<input name="new-password" type="password" value="">
				</div>

				<div class="pure-control-group">
					<label for="confirm-password">Confirm new password</label>
					<input name="confirm-password" type="password" value="">
				</div>

				<div class="pure-controls">
					<label for="submit"></label>
					<input name="submit" type="submit" value="Save" class="pure-button pure-button-primary">
				</div>


			</fieldset>

		</form>


		<!-- Horizontal line for smaller screens -->
		<!-- Appears when 'Analytics' comes under 'General Configuration' -->
		<hr class="pure-hidden-desktop">


	</div>



	<div class="pure-u-lg-1-2 pure-u-1">


		

	</div>

</div>