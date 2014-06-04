<?php
/*
Theme part for home page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>


	<div id="home" class="page">
		
		
		<h1 id="homeTitle">Albums</h1>
		
		
		<ul>
			<?php
			
			$imageHeight = 240;
			$imageWidth = 270;
			
			
			foreach ($this->albums as $album) {			
				?>
				<li>
					<a href="<?php echo SITE_URL; ?>album/<?php echo $album->getId(); ?>/<?php echo $this->urania->simplifyFileName($album->getName()); ?>" title="<?php echo $album->getName(); ?>">
						<div class="home-album-image-container" style="background-image: url(<?php echo SITE_URL; ?>core/timthumb.php?src=<?php echo $album->getImage(0)->getFileName() . "&amp;h=$imageHeight&amp;w=$imageWidth"; ?>);">
							
							<!-- <span class="glyphicon glyphicon-eye-open"></span> -->
							
							
						</div>
						
						<div class="home-album-title">
								<h3>
									<?php echo $album->getName(); ?>
								</h3>
							
						</div>
					</a>
					
				</li>
				<?php
				
			}
			?>
			
			
			
			
		</ul>
	</div>