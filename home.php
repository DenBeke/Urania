<div id="home" class="page">
	<ul>
		<?php
		
		$imageHeight = 240;
		$imageWidth = 240;
		
		
		foreach ($u->getAllAlbums() as $album) {			
			?>
			<li>
				<div style="background-image: url(./core/timthumb.php?src=<?php echo $album->getImage(0)->getFileName() . "&h=$imageHeight&w=$imageWidth"; ?>);">
					<a href="index.php?page=album&album=<?php echo $album->getId(); ?>">
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