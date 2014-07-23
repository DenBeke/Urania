<?php
/*
Theme part for admin themes page

Author: Mathias Beke
Url: http://denbeke.be
Date: May 2014
*/
?>


<h2 id="admin-configuration-title">Site Configuration</h2>

<hr>


<div class="pure-g">
	
	<div class="pure-u-lg-1-2 pure-u-1">

		<h4><span class="glyphicon glyphicon-globe"></span> General Configuration</h4>
	
	
		<form action="<?php echo SITE_URL . 'admin/configuration/edit-site-options'; ?>" method="post" class="pure-form pure-form-aligned">
			
			
			<fieldset>
				
				<div class="pure-control-group">
					<label for="site-title">Site Title</label>
					<input name="site-title" type="text" placeholder="My Photo Website" value="<?php echo SITE_TITLE; ?>">
				</div>
				
				<div class="pure-control-group">
					<label for="site-url">Site Url</label>
					<input name="site-url" type="text" placeholder="http://www.example.com/" value="<?php echo SITE_URL; ?>">
				</div>
				
				<div class="pure-control-group">
					<label for="footer">Footer text</label>
					<input name="footer" type="text" placeholder="Copyright Mathias Beke"  value="<?php echo htmlentities(COPYRIGHT); ?>">
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

	
		<h4><span class="glyphicon glyphicon-stats"></span> Analytics</h4>
		
		
		<form action="<?php echo SITE_URL . 'admin/configuration/edit-analytics'; ?>" method="post" class="pure-form pure-form-aligned">
		
		
			<fieldset>
		
				<div class="pure-control-group">
					<label for="analytics">Analytics Code</label>
					<textarea name="analytics" type="text"><?php echo ANALYTICS; ?></textarea>
				</div>
		
		
				<div class="pure-controls">
					<label for="submit"></label>
					<input name="submit" type="submit" value="Save" class="pure-button pure-button-primary">
				</div>
		
		
			</fieldset>
		
		</form>
		
	</div>

</div>
