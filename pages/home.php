<div id="home" class="page">
	
	
	<h1 id="homeTitle">Albums</h1>
	
	
	<ul>
		<?php
		
		$imageHeight = 240;
		$imageWidth = 240;
		
		
		foreach ($u->getAllAlbums() as $album) {			
			?>
			<li>
				<div style="background-image: url(<?php echo $u->getSiteUrl(); ?>core/timthumb.php?src=<?php echo $album->getImage(0)->getFileName() . "&amp;h=$imageHeight&amp;w=$imageWidth"; ?>);">
					<a href="<?php echo $u->getSiteUrl(); ?>album/<?php echo $album->getId(); ?>/<?php echo $u->simplifyFileName($album->getName()); ?>" title="<?php echo $album->getName(); ?>">
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