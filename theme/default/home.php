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
			$imageWidth = 240;
			
			
			foreach ($this->albums as $album) {			
				?>
				<li>
					<div style="background-image: url(<?php echo SITE_URL; ?>core/timthumb.php?src=<?php echo $album->getImage(0)->getFileName() . "&amp;h=$imageHeight&amp;w=$imageWidth"; ?>);">
						<a href="<?php echo SITE_URL; ?>album/<?php echo $album->getId(); ?>/<?php echo $this->urania->simplifyFileName($album->getName()); ?>" title="<?php echo $album->getName(); ?>">
							<h3>
								<?php echo $album->getName(); ?>
							</h3>
						</a>
					</div>
					
				</li>
				<?php
				
			}
			?>
			
			
			
			
		</ul>
	</div>