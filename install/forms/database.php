<div class="database-config">
	
	<h2>Database Configuration</h2>
	
	<form method="post" action="index.php?step=database&process" class="pure-form">
	
		<fieldset class="pure-group">
			<input type="text" name="db_host" value="localhost" class="pure-input-1-2" placeholder="Database Host" required="required"/>
			<input type="text" name="db_database" value="" class="pure-input-1-2" placeholder="Database Name" required="required" />
		</fieldset>
		
		<fieldset class="pure-group">
			<input type="text" name="db_user" value="" class="pure-input-1-2" placeholder="Database Username" required="required" />
			<input type="password" name="db_password" value="" class="pure-input-1-2" placeholder="Password" required="required" />
		</fieldset>
		
		<input type="submit" name="submit" value="Submit" class="pure-button pure-input-1-2 pure-button-primary" />
	
	
	</form>
	
</div>