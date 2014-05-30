<?php
/*
Theme part for admin themes page

Author: Mathias Beke
Url: http://denbeke.be
Date: May 2014
*/
?>


<h2 id="admin-themes-title">Themes</h2>


<div id="admin-themes pure-g-r">

<?php foreach ($this->themes as $theme) { ?>
	
	<div class="pure-u-sm-1 pure-u-md-1-2 pure-u-lg-1-3 theme-container">
		
		
		<div class="theme">	
		
			<!-- Theme preview image -->
			<img src="<?php echo SITE_URL . 'theme/default/screenshot.png'; ?>" class="theme-image">
			
			
			
			<div class="meta">
			
				<!-- Theme name -->
				<h4>
					<?php echo $theme->name; ?>	
				</h4>
				
				
				<!-- Theme author -->
				<p>
					<?php echo $theme->author; ?>
				</p>
				
				<!-- Theme description -->
				<p>
					<?php echo $theme->description; ?>
				</p>
				
			</div>
			
			<center><a href="" class="pure-button pure-button-primary">Activate</a></center>
			
		</div>
		
	</div>
	
<?php } ?>

</div>