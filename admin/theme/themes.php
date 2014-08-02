<?php
/*
Theme part for admin themes page

Author: Mathias Beke
Url: http://denbeke.be
Date: May 2014
*/
?>


<h2 id="admin-themes-title">Themes</h2>

<hr>

<div id="admin-themes pure-g-r">

<?php foreach ($this->themes as $theme_name => $theme) { ?>
	
	<div class="pure-u-sm-1 pure-u-md-1-2 pure-u-lg-1-3 theme-container">
		
		
		<div class="theme">	
		
			<!-- Theme preview image -->
			<div class="theme-image-container">
				
				<img src="<?php echo SITE_URL . 'themes/' . $theme_name . '/screenshot.png'; ?>" class="theme-image">
				
			</div>
			
			
			<div class="title">
				
				<!-- Theme name -->
				<h4>
					<?php echo $theme->name; ?>
				</h4>

				<?php if(THEME != $theme_name):  ?>
					
					<a href="<?php echo SITE_URL . 'admin/themes/activate/' . $theme_name; ?>" class="pure-button pure-button-primary activate-theme">Activate</a>
					
				<?php else: ?>
					
					<a class="pure-button pure-button-primary activate-theme active-theme-button"><span class="glyphicon glyphicon-ok"></span></a>
					
				<?php endif; ?>
	
				
				
			</div>
			
			

			<div class="meta">
				
				<!-- Theme author -->
				<p>
					<span class="label">Author: </span><span class="info"><?php echo $theme->author; ?><span>
				</p>
				
				<!-- Theme description -->
				<p>
					<span class="label">Description: </span><span class="info"><?php echo $theme->description; ?></span>
				</p>
				
			</div>
			
		</div>
		
	</div>
	
<?php } ?>

</div>